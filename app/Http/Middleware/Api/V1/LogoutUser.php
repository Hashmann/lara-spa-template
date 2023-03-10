<?php

namespace App\Http\Middleware\Api\V1;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
      $user = Auth::user();

      // You might want to create a method on your model to
      // prevent direct access to the `logout` property. Something
      // like `markedForLogout()` maybe.
      if (! empty($user->logout)) {
        // Not for the next time!
        // Maybe a `unmarkForLogout()` method is appropriate here.
        $user->logout = false;
        $user->save();

        // Log her out
        session()->invalidate();
//        Auth::logout();

//        return redirect()->route('login');
      }

      return $next($request);
    }
}
