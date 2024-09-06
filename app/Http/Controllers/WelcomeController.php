<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function setSeasonalTheme(Request $request)
    {
        // Determine the current season
        $month = date('m');
        $season = $this->getSeason($month);

        // Set the theme based on the season
        $theme = $this->getThemeForSeason($season);

        // Store the theme in the session
        $request->session()->put('theme', $theme);

        return redirect()->back();
    }

    private function getSeason($month)
    {
        // Determine the season based on the month
        if ($month >= 3 && $month <= 5) {
            return 'spring';
        } elseif ($month >= 6 && $month <= 8) {
            return 'summer';
        } elseif ($month >= 9 && $month <= 11) {
            return 'fall';
        } else {
            return 'winter';
        }
    }

    private function getThemeForSeason($season)
    {
        // Define CSS files for each season
        $themes = [
            'spring' => 'spring.css',
            'summer' => 'summer.css',
            'fall' => 'fall.css',
            'winter' => 'winter.css',
        ];

        return $themes[$season] ?? 'default.css';
    }
}
