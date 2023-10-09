<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Answer;

class QuestionController extends Controller
{
  public function index(Request $request)
  {
    $items = Question::with([
      'answer'
    ])->get();

    return view('pages.admin.question.index', [
      'items' => $items,
    ]);
  }

  public function store(Request $request)
  {
    $request->validate([
      'name' => 'required|min:5',
      'photo_path' => 'image|mimes:jpeg,png,jpg,gif,svg',
      'answer1' => 'required',
      'answer2' => 'required',
      'answer3' => 'required',
      'answer4' => 'required',
  ]);
  
  $file = $request->file('photo_path');
  if ($file) {
    $fileName = $file->hashName();
    $destinationPath = public_path('/images');
    $file->move($destinationPath, $fileName);

    $question = new Question();
  
    $question->name = $request->input('name');
    $question->photo_path = $fileName;
    $question->save();

    $answers = [
      ['name' => $request->input('answer1'), 'is_correct'=> $request->input('is_correct1'), 'question_id'=>$question->id],
      ['name' => $request->input('answer2'), 'is_correct'=> $request->input('is_correct2'), 'question_id'=>$question->id],
      ['name' => $request->input('answer3'), 'is_correct'=> $request->input('is_correct3'), 'question_id'=>$question->id],
      ['name' => $request->input('answer4'), 'is_correct'=> $request->input('is_correct4'), 'question_id'=>$question->id],
    ];

    Answer::insert($answers);
  }

  if (!$file){
    $question = new Question();
    $question->name = $request->input('name');
    $question->save();

    $answers = [
      ['name' => $request->input('answer1'), 'is_correct'=> $request->input('is_correct1'), 'question_id'=>$question->id],
      ['name' => $request->input('answer2'), 'is_correct'=> $request->input('is_correct2'), 'question_id'=>$question->id],
      ['name' => $request->input('answer3'), 'is_correct'=> $request->input('is_correct3'), 'question_id'=>$question->id],
      ['name' => $request->input('answer4'), 'is_correct'=> $request->input('is_correct4'), 'question_id'=>$question->id],
    ];

    Answer::insert($answers);
  }
  

    return redirect()->route('question.index')->with('status', 'Pertanyaan Berhasil Ditambahkan!');
  }

  public function show($id)
  {
    $question = Question::with([
      'answer'
    ])->findorFail($id);
    return view('pages.admin.question.edit', [
      'question' => $question
    ]);
  }

  public function destroy($id)
  {
    $item = Question::findorFail($id);
    $item->delete();
    $answer = Answer::with([
      'question'
    ])->where('question_id', $id);
    $answer->delete();
    return redirect()->route('question.index')->with('status', 'Question Berhasil Dihapus!');
  }

}
