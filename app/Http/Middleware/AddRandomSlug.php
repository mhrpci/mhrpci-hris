<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class AddRandomSlug
{
    /**
     * Paths that should be excluded from random parameter addition
     *
     * @var array
     */
    protected $excludedPaths = [
        'api/*',
        '_debugbar/*',
        'livewire/*',
        'sanctum/*',
        'login',
        'register',
        'password/*',
    ];

    /**
     * The query parameter name for the random string
     *
     * @var string
     */
    protected $paramName = 'q';

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // If URL already has our random parameter, proceed normally
        if ($request->has($this->paramName)) {
            return $next($request);
        }

        // Skip for excluded paths and AJAX requests
        if ($this->shouldSkip($request)) {
            return $next($request);
        }

        // Generate random string
        $randomStr = $this->generateRandomString();

        // Build the new URL with the random parameter
        $newUrl = $this->buildUrlWithRandomParam($request, $randomStr);

        // Only redirect if we're not already at the URL with the random parameter
        if ($request->fullUrl() !== $newUrl) {
            return redirect()->to($newUrl);
        }

        return $next($request);
    }

    /**
     * Determine if the request should skip random parameter addition
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function shouldSkip(Request $request): bool
    {
        if ($request->ajax() || $request->wantsJson()) {
            return true;
        }

        foreach ($this->excludedPaths as $path) {
            if ($request->is($path)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Generate a random string
     *
     * @return string
     */
    protected function generateRandomString(): string
    {
        // Generate only letters (no numbers)
        return Str::upper(Str::random(1)) . Str::lower(Str::random(7));
    }

    /**
     * Build URL with random parameter
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $randomStr
     * @return string
     */
    protected function buildUrlWithRandomParam(Request $request, string $randomStr): string
    {
        $queryParams = $request->query();
        $queryParams[$this->paramName] = $randomStr;

        return $request->url() . '?' . http_build_query($queryParams);
    }
}
