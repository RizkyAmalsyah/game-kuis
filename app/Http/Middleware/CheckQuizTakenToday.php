<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Quiz; // Replace with your actual quiz model
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class CheckQuizTakenToday
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
      // Check if the user is authenticated
      if (Auth::check()) {
        $user = Auth::user();
        $today = Carbon::today();

        // Check if the user has taken a quiz today
        $quizTakenToday = Quiz::where('user_id', $user->id)
            ->whereDate('created_at', $today)
            ->count();

        if ($quizTakenToday < 2) {
            // The user hasn't taken the quiz today, allow the request to proceed
            return $next($request);
        }

        // The user has already taken the quiz today, you can redirect the user or return a response
        return redirect('/already-login'); // Replace with your route or response logic
    }

    // If the user is not authenticated, allow the request to proceed
    return $next($request);
    }
}
