<?php

use App\Http\Controllers\GreetingController;
use App\Http\Controllers\LeaderboardController;
use App\Http\Controllers\Question1Controller;
use App\Http\Controllers\Question2Controller;
use App\Http\Controllers\Question3Controller;
use App\Http\Controllers\Question4Controller;
use App\Http\Controllers\Question5Controller;
use App\Http\Controllers\FinishController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [LeaderboardController::class, 'index'])->name('home');

Route::get('/already-login', [GreetingController::class, 'process']);

Route::middleware(['auth', 'checkquiztakentoday'])->group(function () {
    Route::get('/greeting', [GreetingController::class, 'index'])->name('greeting');
    Route::post('/quiz', [GreetingController::class, 'store'])->name('quiz');
    Route::get('/question-1/{id}', [Question1Controller::class, 'index'])->name('question-1');
    Route::post('/question-1-answer/{detail_id}', [Question1Controller::class, 'store'])->name('question-1-answer');
    Route::get('/question-1-result/{id}', [Question1Controller::class, 'process'])->name('question-1-result');
    Route::get('/question-1-notime/{id}', [Question1Controller::class, 'notime'])->name('question-1-notime');
    Route::get('/question-2/{id}', [Question2Controller::class, 'index'])->name('question-2');
    Route::post('/question-2-answer/{detail_id}', [Question2Controller::class, 'store'])->name('question-2-answer');
    Route::get('/question-2-result/{id}', [Question2Controller::class, 'process'])->name('question-2-result');
    Route::get('/question-2-notime/{id}', [Question2Controller::class, 'notime'])->name('question-2-notime');
    Route::get('/question-3/{id}', [Question3Controller::class, 'index'])->name('question-3');
    Route::post('/question-3-answer/{detail_id}', [Question3Controller::class, 'store'])->name('question-3-answer');
    Route::get('/question-3-result/{id}', [Question3Controller::class, 'process'])->name('question-3-result');
    Route::get('/question-3-notime/{id}', [Question3Controller::class, 'notime'])->name('question-3-notime');
    Route::get('/question-4/{id}', [Question4Controller::class, 'index'])->name('question-4');
    Route::post('/question-4-answer/{detail_id}', [Question4Controller::class, 'store'])->name('question-4-answer');
    Route::get('/question-4-result/{id}', [Question4Controller::class, 'process'])->name('question-4-result');
    Route::get('/question-4-notime/{id}', [Question4Controller::class, 'notime'])->name('question-4-notime');
    Route::get('/question-5/{id}', [Question5Controller::class, 'index'])->name('question-5');
    Route::post('/question-5-answer/{detail_id}', [Question5Controller::class, 'store'])->name('question-5-answer');
    Route::get('/question-5-result/{id}', [Question5Controller::class, 'process'])->name('question-5-result');
    Route::get('/question-5-notime/{id}', [Question5Controller::class, 'notime'])->name('question-5-notime');
    Route::get('/finish/{id}', [FinishController::class, 'index'])->name('finish');
    Route::get('/finish-end/{id}', [FinishController::class, 'process'])->name('finish-end');
    Route::post('/feedback/{id}', [FinishController::class, 'store'])->name('feedback-input');

});

Route::prefix('admin')
  ->namespace('App\Http\Controllers\Admin')
  ->middleware(['auth', 'verified', 'admin'])
  ->group(function() {
    Route::get('/', 'DashboardController@index')
      ->name('dashboard');
      Route::resource('question', 'QuestionController');
      Route::resource('quiz', 'QuizController');
      Route::post('/destroys', 'QuizController@destroys')->name('quiz.destroys');
      Route::resource('user', 'UserController');
      Route::resource('feedback', 'FeedbackController');
    });

require __DIR__.'/auth.php';
