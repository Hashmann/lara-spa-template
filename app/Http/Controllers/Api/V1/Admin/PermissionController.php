<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\Admin\PermissionResource;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
  private $permission;
  function __construct(Permission $permission)
  {
    $this->permission = $permission;
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
//    return PermissionResource::collection($this->permission->all());

//    return PermissionResource::collection(Role::all()->permissions->pluck('name'));

//    return Permission::all()->pluck('name')->toArray();

//    return Role::with('permissions')->get();

    return PermissionResource::collection(Role::all()->whereNotIn('id', '1'));

//    return Role::with(['permissions' => function ($query) {
//      $query->pluck('name')->toArray();
//    }])->get();
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
    $this->permission->create([
      'name' => $request->name,
    ]);

    return response(['message'=>'Permission created']);
  }

  /**
   * Display the specified resource.
   *
   * @param int $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    //
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
  public function update(Request $request, Permission $permission)
  {
    $request->validate([
      'name' => 'required',
    ]);
    $permission->update([
      'name' => $request->name,
    ]);
    return response(['message'=>'Permission updated']);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param int $id
   * @return \Illuminate\Http\Response
   */
  public function destroy(Permission $permission)
  {
    $permission->delete();
  }


  public function getAllPermissions()
  {
    return Permission::all()->pluck('name')->toArray();
  }
}
