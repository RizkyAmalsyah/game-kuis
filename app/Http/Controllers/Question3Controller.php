<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\QuizDetail;
use App\Models\Answer;

class Question3Controller extends Controller
{
  public function index(Request $request, $id)
  {
    $item = Question::with([
      'answer'
    ])->inRandomOrder()
      ->first();

    $quiz = Quiz::with([
      'details'
    ])->findOrFail($id);

    $data['quiz_id'] = $id;
    $data['question_id'] = $item->id;
    $data['question_number'] = 3;

    QuizDetail::create($data);

    $data = QuizDetail::latest()->skip(1)->first();

    return view('pages.question-3.question3', [
      'item' => $item,
      'quiz' => $quiz,
      'data' => $data
    ]);
  }
  
  public function store(Request $request, $id)
  {
    $data = QuizDetail::latest()->first();
    $data['answer_id'] = $request->input('answer');
    $data['time'] = $request->input('time');
    $data['is_answer'] = 1;
    $correct = Answer::find($data['answer_id']);
    if ($correct->is_correct == 1) {
      $time = 10 - $request->input('time');
      $time = $time * 459;
      $data['score'] = 9999 - $time;
    }
    else {
      $data['score'] = 9999 * 0;
    }

    $data->save();
    
    $quiz = Quiz::find($id);
    $quiz->score += $data['score'];
    $quiz->save();

    return redirect()->route('question-3-result', $data->id);
  }

  public function process(Request $request, $id)
  {
    $item = QuizDetail::with([
      'quiz', 'answer', 'question'
    ])->latest()->first();

    $answer = Answer::with([
      'question'
    ])->where('question_id', $item->question_id)->get();

    return view('pages.question-3.question3-result', [
      'item' => $item,
      'question' => $item->question_id,
      'quiz_name' => $item->question->name,
      'answers' => $answer
    ]);
  }

  public function notime(Request $request, $id)
  {
    $item = QuizDetail::with([
      'quiz', 'answer', 'question'
    ])->latest()->first();

    $answer = Answer::with([
      'question'
    ])->where('question_id', $item->question_id)->get();

    $quiz = Quiz::find($id);

    return view('pages.question-3.question3-notime', [
      'quiz' => $quiz,
      'item' => $item,
      'question' => $item->question_id,
      'quiz_name' => $item->question->name,
      'answers' => $answer
    ]);
  }
}
