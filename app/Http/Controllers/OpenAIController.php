<?php

// app/Http/Controllers/OpenAIController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use OpenAI\Laravel\Facades\OpenAI;

class OpenAIController extends Controller
{
    public function generateText(Request $request)
    {
        $request->validate([
            'prompt' => 'required|string|max:1000',
        ]);

        try {
            $result = OpenAI::completions()->create([
                'model' => 'gpt-3.5-turbo-instruct',
                'prompt' => $request->prompt,
                'max_tokens' => 150,
            ]);

            return response()->json([
                'success' => true,
                'data' => $result->choices[0]->text,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function generateImage(Request $request)
    {
        $request->validate([
            'prompt' => 'required|string|max:1000',
        ]);

        try {
            $result = OpenAI::images()->create([
                'prompt' => $request->prompt,
                'n' => 1,
                'size' => '256x256',
            ]);

            return response()->json([
                'success' => true,
                'data' => $result->data[0]->url,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
