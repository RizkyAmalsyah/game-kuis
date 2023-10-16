<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\QuizDetail;
use App\Models\User;
use App\Models\Feedback;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class FinishController extends Controller
{
  public function index(Request $request, $id)
  {
    $quiz = Quiz::with([
      'details'
    ])->findOrFail($id);

    $soal = QuizDetail::where('quiz_id', $id)->where('is_answer', 1)->count();
    
    return view('pages.finish',[
      'poin' => $quiz->score,
      'soal' => $soal,
      'quiz' => $quiz
    ]);
  }

  public function process(Request $request, $id)
  {
    $ere = Quiz::where('user_id',  Auth::user()->id)->sum('score');
    $nowscore = Quiz::with([
      'details'
    ])->findOrFail($id);
    $erescore = $ere - $nowscore->score;
    $totalscore = $erescore + $nowscore->score;

    $ranking = User::select('users.*', DB::raw('SUM(quizzes.score) AS total_score'))
    ->leftJoin('quizzes', 'users.id', '=', 'quizzes.user_id')
    ->groupBy('users.id')
    ->orderBy('total_score', 'desc')
    ->take(7)
    ->skip(3)
    ->get();

    $ranking1 = User::select('users.*', DB::raw('SUM(quizzes.score) AS total_score'))
    ->leftJoin('quizzes', 'users.id', '=', 'quizzes.user_id')
    ->groupBy('users.id')
    ->orderBy('total_score', 'desc')
    ->take(1)
    ->get();

    $ranking2 = User::select('users.*', DB::raw('SUM(quizzes.score) AS total_score'))
    ->leftJoin('quizzes', 'users.id', '=', 'quizzes.user_id')
    ->groupBy('users.id')
    ->orderBy('total_score', 'desc')
    ->take(1)
    ->skip(1)
    ->get();

    $ranking3 = User::select('users.*', DB::raw('SUM(quizzes.score) AS total_score'))
    ->leftJoin('quizzes', 'users.id', '=', 'quizzes.user_id')
    ->groupBy('users.id')
    ->orderBy('total_score', 'desc')
    ->take(1)
    ->skip(2)
    ->get();

    $user_id = Auth::user()->id;

    $rankingu = User::select('users.*', DB::raw('SUM(quizzes.score) AS total_score'))
        ->leftJoin('quizzes', 'users.id', '=', 'quizzes.user_id')
        ->groupBy('users.id')
        ->orderByDesc('total_score')
        // ->take(1)
        ->where('user_id', $user_id)
        ->get();

    $number_rank = User::select('users.*', DB::raw('SUM(quizzes.score) AS total_score'))
        ->leftJoin('quizzes', 'users.id', '=', 'quizzes.user_id')
        ->groupBy('users.id')
        ->orderByDesc('total_score')
        // ->take(1)
        // ->where('user_id', $user_id)
        ->get();
    
        $user_ranking = $number_rank->search(function ($user) use ($user_id) {
          return $user->id === $user_id;
      });

      if ($user_ranking !== false) {
        // Add 1 to the rank since indexing starts from 0
        $user_ranking += 1;
    }

    $quiz = Quiz::with([
      'details'
    ])->findOrFail($id);
  
    return view('pages.finish-end', [
      'erescore' => $erescore,
      'nowscore' => $nowscore->score,
      'totalscore' => $totalscore,
      'quizs' => $ranking,
      'ranking1' => $ranking1,
      'ranking2' => $ranking2,
      'ranking3' => $ranking3,
      'rankingu' => $rankingu,
      'userranking' => $user_ranking,
      'quiz' => $quiz
    ]);
  }

  public function store(Request $request, $id)
  {
    $request->validate([
      'rating' => 'required',
    ]);

    Feedback::create([
      'quiz_id' => $id,
      'user_id' => Auth::user()->id,
      'rating' => $request->input('rating')
    ]);

    Auth::guard('web')->logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect('/');
  }
  
}
