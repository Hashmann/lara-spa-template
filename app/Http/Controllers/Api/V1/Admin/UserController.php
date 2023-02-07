<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Actions\V1\Admin\UserAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Admin\UserEditRequest;
use App\Http\Requests\V1\Admin\UserRequest;
use App\Http\Resources\V1\Admin\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Nette\Utils\Image;

class UserController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
   */
  public function index()
  {
    return UserResource::collection(User::all()->whereNotIn('id', 1));
//    return new UserResource(Cache::remember('users', 60*60*24, function () {
//      return UserResource::collection(User::all()->whereNotIn('id', 1));
//    }));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    // в api нет такого
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param \Illuminate\Http\Request $request
   * @return \Illuminate\Http\JsonResponse
   */
  public function store(UserRequest $request, UserAction $userAction)
  {
    $user = $userAction->run($request->all());

    if (isset($request['avatar'])) {
      $request['avatar'] = Storage::disk('public')->put('/images', $request['avatar']);
    }

    if ($request->has('role')) {
      $user->assignRole($request->input('role'));
    }

    if (!$user) {
      return response()->json(['success' => false, 'message' => 'Save user failed'], 500);
    }

    return response()->json(['success' => true, 'message' => 'Save user succeeded']);
  }

  /**
   * Display the specified resource.
   *
   * @param int $id
   * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
   */
  public function show($id)
  {
    //TODO чтобы первый айдишник не приходил

    return UserResource::collection(User::all()->where('id', $id));

//    $user = UserResource::collection(User::all()->where('id', $id));
//    $userRole = UserResource::collection(User::all()->where('id', $id)->roles->pluck('name'));

//    return [
//      $user,
//      $userRole
//    ];


//    return User::all()->where('id', $id);
//    return User::find($id);

  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param int $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    // в api нет такого
  }

  /**
   * Update the specified resource in storage.
   *
   * @param \Illuminate\Http\Request $request
   * @param int $id
   * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
   */
  public function update(UserEditRequest $request, User $user)
  {
//    $user->update($request->validated());
//    return new UserResource($user);

//    $user = User::all()->where('id', $id);
//    $user = UserResource::collection(User::all()->where('id', $id));

//    $data = $request->validated(); 11111111111

//    if (isset($data['avatar'])) {
//    $data->file->storeAs('uploads', uniqid('img_') . $data->file->getClientOriginalName());
//    $data->file->Storage::disk('public')->put('/images', $data['avatar']);
//      $data['avatar'] = Storage::disk('public')->put('/images', $data['avatar']);
//    $data->avatar = Storage::disk('public')->putFileAs('/images/', $data->avatar);
//    }
//    $user->update($request->validated());


//    if($request->avatar) {
//      if($user->avatar) {
//        unlink(public_path('images/avatars' . $user->avatar));
//      }
//      $avatar = time() . '.' . explode('/', explode(':', substr($request->avatar, 0, strpos($request->avatar, ';')))[1])[1];
//
//      Image::make($request->avatar)->save(public_path('images/avatar/' . $avatar));
//    }else{
//      $user->avatar = $user->file;
//    }





    $user->update($request->validated());

//    foreach ($request->input('role') as $role) {
//      $user->assignRole($role);
//    }
//      $user->assignRole([$request['role']]);



    return response(['message'=>'User Updated', 'user'=>$user]);





//    $user->update($data); 11111111

//    $user->update($request->validated());

//    $user->syncRoles($request->input('role'));

//    if ($request->has('role')) {
//
//    }
//    foreach ($request->input('role') as $role) {
//      $user->assignRole($role);
//    }

//    return $request;
//    if ($request->has('role')) {
//      $user->assignRole($request->input('role'));
//    }
//
//    if ($request->has('permissions')) {
//      $user->givePermissionTo(collect($request->permissions)->pluck('id')->toArray());
//    }

//    return response(['message'=>'User Updated', 'user'=>$user]);

//    return $user;
//    dd($user);
//    if ($request->has('role')) {
//      $user->syncRoles($request->input('role'));
//    }

//    return response(['message'=>'User Updated', 'user'=>$user]);

//    return new UserResource($user);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param int $id
   * @return \Illuminate\Http\Response
   */
  public function destroy(User $user)
  {
    $user->delete();
  }

  public function role(User $user)
  {
    return $user->role;
  }

  public function updateRole(Request $request, $id)
  {
    $user = User::find($id);
    $user->syncRoles($request->role);

    return $request;
  }

  public function logoutUser($id)
  {
    $user = User::find($id);
//    User::all()->where('id', $id)
    $user->update(['logout' => true]);
//    $user->logout = true;

//    $users = session()->getID();
//    $users = session()->all();
//    session()->getHandler()->destroy($users);

//    session()->invalidate();
//    session()->getHandler()->destroy($user->id);

//    $user->currentAccessToken()->delete();
//    $user->tokens()->delete();
//    return $users;
  }
}
