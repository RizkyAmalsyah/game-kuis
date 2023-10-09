<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Question;
use App\Models\Quiz;
use Carbon\Carbon;

class DashboardController extends Controller
{
  public function index(Request $request)
  {

    return view('pages.admin.dashboard', [
      'user' => User::count(),
      'question' => Question::count(),
      'quiz' => Quiz::count(),
      'quiz_week' => Quiz::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count()
    ]);
  }
}
