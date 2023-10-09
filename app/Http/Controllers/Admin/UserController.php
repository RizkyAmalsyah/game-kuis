<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Quiz;
use App\Models\QuizDetail;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
  public function index(Request $request)
  {
    $ranking = User::select('users.*', DB::raw('SUM(quizzes.score) AS total_score'))
    ->leftJoin('quizzes', 'users.id', '=', 'quizzes.user_id')
    ->groupBy('users.id')
    ->orderBy('total_score', 'desc')
    ->get();

    return view('pages.admin.akun.index', [
      'items' => $ranking,
    ]);
  }

  public function destroy($id)
  {
    $item = User::findorFail($id);
    $item->delete();
    $quiz = Quiz::with([
      'user'
    ])->where('user_id', $id);
    $quiz->delete();
    return redirect()->route('user.index')->with('status', 'Akun Berhasil Dihapus!');
  }
}
