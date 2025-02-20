<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AiController extends Controller
{
    public function mhrpciAi()
    {
        return view('mhrpci-ai');
    }

    public function imageGenerator()
    {
        return view('image-generator');
    }

    public function textAnalysis()
    {
        return view('text-analysis');
    }

    public function documentScanner()
    {
        return view('document-scanner');
    }

    public function documentConverter()
    {
        return view('document-converter');
    }

    public function mediaConverter()
    {
        return view('media-converter');
    }

    public function captionGenerator()
    {
        return view('caption-generator');
    }

    public function imageEnhancer()
    {
        return view('image-enhancer');
    }
    
    

}
