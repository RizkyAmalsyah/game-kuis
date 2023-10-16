<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Feedback;

class FeedbackController extends Controller
{
  public function index(Request $request)
  {
    $items = Feedback::with([
      'user'
    ])->orderByDesc('id')
    ->get();

    return view('pages.admin.feedback.index', [
      'items' => $items,
    ]);
  }
}
