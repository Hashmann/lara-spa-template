<?php

namespace App\Http\Resources\V1\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
//        return [
//          'name' => $this->name,
//          'surname' => $this->surname,
//          'patronymic' => $this->patronymic,
//          'email' => $this->email,
//          'password' => $this->password,
//          'role' => $this->role,
//          'status' => $this->status,
//          'gender' => $this->gender,
//          'birth_date' => $this->birth_date,
//          'avatar' => $this->avatar,
//        ];

      $defaultData = parent::toArray($request);

      $additionalData = [
//        'role' => $this->role->first(),
        'role' => $this->roles->pluck('name'),
        'permissions' => $this->getAllPermissions()->pluck('name'),
        'name' => $this->name,
        'surname' => $this->surname,
        'patronymic' => $this->patronymic,
        'email' => $this->email,
//        'password' => $this->password,
        'status' => $this->status,
        'gender' => $this->gender,
        'birth_date' => $this->birth_date,
        'avatar' => $this->avatar,
//        'file' => $this->file,
      ];

      return array_merge($defaultData, $additionalData);
    }
}
