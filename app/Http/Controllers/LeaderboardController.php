<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;


class LeaderboardController extends Controller
{
  public function index(Request $request)
  {

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


    return view('pages.leaderboard', [
      'quizs' => $ranking,
      'ranking1' => $ranking1,
      'ranking2' => $ranking2,
      'ranking3' => $ranking3
    ]);
  }
}
