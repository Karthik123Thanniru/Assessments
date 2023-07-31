<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class resultDisplay extends Controller
{
    //
    function display()
    {
        $data='hello world';
        return $data;
    }
    function calculateResult(Request $request)
    {
        $userAnswers = $request->input('answers', []);
        echo 'helloworld';
    }
    
}
