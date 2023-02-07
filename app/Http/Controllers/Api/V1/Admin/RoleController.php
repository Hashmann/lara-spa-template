<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\Admin\RoleResource;
use App\Http\Resources\V1\Admin\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
  private $role;

  function __construct(Role $role)
  {
    $this->role = $role;
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
   */
  public function index()
  {
    return Role::all()->whereNotIn('id', 1)->pluck('name')->toArray();
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param \Illuminate\Http\Request $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $request->validate([
      'name' => 'required',
    ]);
    $role = $this->role->create([
      'name' => $request->name,
    ]);
//        activity()
//            ->performedOn(new Role())
//            ->causedBy(auth()->user())
//            ->withProperties([
//                'name' => $request->name
//            ])
//            ->log('created');
    if ($request->has('permissions')) {
      $role->givePermissionTo(collect($request->permissions)->pluck('id')->toArray());
    }
    return response(['message' => 'Role created']);
  }

  /**
   * Display the specified resource.
   *
   * @param int $id
   * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
   */
  public function show($id)
  {
    return UserResource::collection(User::all()->where('id', $id)->roles->pluck('name'));

//      return User::all()->where('id', $id)->roles->pluck('name');
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param int $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param \Illuminate\Http\Request $request
   * @param int $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Role $role)
  {
    $request->validate([
      'name' => 'required',
    ]);
    $role->update([
      'name' => $request->name,
    ]);
//        activity()
//            ->performedOn(new Role())
//            ->causedBy(auth()->user())
//            ->withProperties([
//                'name' => $request->name
//            ])
//            ->log('updated');
    if ($request->has('permissions')) {
      $role->givePermissionTo(collect($request->permissions)->pluck('id')->toArray());
    }
    return response(['message' => 'Role updated']);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param int $id
   * @return \Illuminate\Http\Response
   */
  public function destroy(Role $role)
  {
    $role->delete();
  }


  public function updateRolePermissions(Request $request, $id)
  {
    $role = Role::find($id);
    $role->syncPermissions($request->permissions);

    return $request;
  }
}
