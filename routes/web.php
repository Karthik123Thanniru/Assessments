<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HtmlQuestions;

Route::get('/', function () {
    return view('HtmlTest');
});

Route::get('/users/{index}/{score}', [HtmlQuestions::class, 'viewModel'])->name('show-question');
//Route::post('/users/{index}/{score}', [HtmlQuestions::class, 'viewModel'])->name('show-question');
