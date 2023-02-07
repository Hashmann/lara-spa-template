<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Admin\UserEditFreeRequest;
use App\Http\Resources\V1\Admin\CurrentUserResource;
use App\Http\Resources\V1\Admin\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CurrentUser extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
   */
  public function index()
  {
//    return UserResource::collection(Auth::user());
//    return Auth::user();

//    $user = UserResource::collection(User::all()->whereNotIn('id', 1));

    if (Auth::check()) {
//      $user = Auth::user()->with('roles')->findOrFail(Auth::user()->id); //INFO работает

//      $user = Auth::user()->load(['roles' => function ($query) {
//        return $query->pluck('id');
//      }]);

      $user = CurrentUserResource::collection(User::all()->where('id', Auth::user()->id))->first();
//      $user = Auth::user();
      return $user;
    }


//    $user = auth()->user();
//    $user = Auth::user();
//    return $user;

//    if (Auth::check()) {
//      /**
//       * После проверки уже можешь получать любое свойство модели
//       * пользователя через фасад Auth, например id
//       */
//      $user = Auth::user();
//      return $user;
//    }

  }

  public function currentRole()
  {
    $role = Auth::user()->roles->pluck('name');
    return $role;
  }

  public function updateCurrentUser(UserEditFreeRequest $request)
  {
    $user = Auth::user();
    $user->update($request->validated());
//    return response(['message' => 'User Updated', 'user' => $user]);
    return $user;
  }
}
