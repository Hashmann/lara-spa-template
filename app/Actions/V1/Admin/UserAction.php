<?php

namespace App\Actions\V1\Admin;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserAction
{
  public function run($request)
  {
    $user = User::create([
      'name' => $request['name'],
      'email' => $request['email'],
      'password' => Hash::make($request['password']),
      'status' => 'not confirmed',
      'gender' => '0',
    ]);
    $user->assignRole('user');
    return $user;
  }
}
