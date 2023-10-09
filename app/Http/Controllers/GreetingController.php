<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quiz;
use Illuminate\Support\Facades\Auth;

class GreetingController extends Controller
{
  public function index(Request $request)
  {
    return view('pages.greeting');
  }

  public function store(Request $request)
  {
    $quiz = Quiz::create([
      'user_id' => Auth::user()->id,
      'score' => 0
    ]);

    return redirect()->route('question-1', $quiz->id);
  }

  public function process(Request $request)
  {
    return view('pages.already-login');
  }
}
