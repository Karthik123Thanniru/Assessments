<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HtmlQuestions extends Controller
{
    private $questions = [
        [
            'question' => 'What does HTML stand for?',
            'options' => ['Hyper Text Markup Language', 'Hyperlink and Text Markup Language', 'Home Tool Markup Language'],
            'answer' => 'Hyper Text Markup Language'
        ],
        [
            'question' => 'Which HTML tag is used to define an image?',
            'options' => ['<img>', '<picture>', '<image>', '<src>'],
            'answer' => '<img>'
        ],
        [
            'question' => 'What is the correct HTML element for the largest heading?',
            'options' => ['<h1>', '<heading>', '<head>', '<h6>'],
            'answer' => '<h1>'
        ],
        [
            'question' => 'What is the purpose of the HTML "alt" attribute?',
            'options' => ['It specifies an alternative text for an image', 'It defines an alert message box', 'It sets the alignment of an element', 'It adds an anchor link'],
            'answer' => 'It specifies an alternative text for an image'
        ],
        [
            'question' => 'Which HTML element is used to define a paragraph?',
            'options' => ['<paragraph>', '<p>', '<para>', '<text>'],
            'answer' => '<p>'
        ],
        [
            'question' => 'Which HTML element is used to link external CSS files?',
            'options' => ['<style>', '<css>', '<link>', '<stylesheet>'],
            'answer' => '<link>'
        ],
        [
            'question' => 'What does CSS stand for?',
            'options' => ['Cascading Style Sheets', 'Computer Style Sheets', 'Creative Style Sheets', 'Colorful Style Sheets'],
            'answer' => 'Cascading Style Sheets'
        ],
        [
            'question' => 'Which CSS property is used to change the text color of an element?',
            'options' => ['color', 'text-color', 'font-color', 'text-style'],
            'answer' => 'color'
        ],
        [
            'question' => 'What is the correct CSS syntax to select an element by its ID?',
            'options' => ['#element', '.element', 'element', 'id=element'],
            'answer' => '.element'
        ],
        [
            'question' => 'Which CSS property is used to add shadows to elements?',
            'options' => ['box-shadow', 'shadow', 'element-shadow', 'text-shadow'],
            'answer' => 'box-shadow'
        ],
    ];   
    public function viewModel(Request $request,$index, $score)
    {
        if ($request->isMethod('get')) {
            $selectedOptionIndex = $request->input('answer', -1);
            $correctOptionIndex = array_search($this->questions[$index]['answer'], $this->questions[$index]['options']);

            if ($selectedOptionIndex == $correctOptionIndex) {
                $score++;
            }

            // if ($request->input('action') === 'next') {
            //     $nextIndex = $index + 1;
            // } else {
            //     // User clicked "Submit," handle the submission here if needed.
            //     // For example, save the final score in the database or perform other actions.
            // }
        }
        return view('HtmlDisplay', [
            'question' => $this->questions[$index]['question'],
            'options' => $this->questions[$index]['options'],
            'answer' => $this->questions[$index]['answer'],
            'nextIndex' => $index + 1,
            'prevIndex' => $index - 1,
            'score' => $score,
            'totalQuestions' => count($this->questions),
        ]);
    }
}