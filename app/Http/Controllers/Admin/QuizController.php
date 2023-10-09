<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\QuizDetail;

class QuizController extends Controller
{
  public function index(Request $request)
  {
    $items = Quiz::with([
      'user'
    ])->orderByDesc('id')
    ->get();

    return view('pages.admin.quiz.index', [
      'items' => $items,
    ]);
  }

  public function destroy($id)
  {
    $item = Quiz::findorFail($id);
    $item->delete();
    $quiz_detail = QuizDetail::with([
      'question'
    ])->where('quiz_id', $id);
    $quiz_detail->delete();
    return redirect()->route('quiz.index')->with('status', 'Quiz Berhasil Dihapus!');
  }

  public function destroys(Request $request)
  {
      $request->validate([
          'firstdate' => ['required'],
          'lastdate' => ['required'],
      ]);
  
      $first = $request->input('firstdate');
      $last = $request->input('lastdate');
  
      // Menggunakan query builder untuk menghapus item yang sesuai dengan rentang tanggal.
      Quiz::whereBetween('created_at', [$first, $last])->delete();
  
      return redirect()->route('quiz.index')->with('status', 'Quiz Berhasil Dihapus!');
  }
}
