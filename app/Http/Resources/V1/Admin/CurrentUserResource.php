<?php

namespace App\Http\Resources\V1\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class CurrentUserResource extends JsonResource
{
  /**
   * Transform the resource into an array.
   *
   * @param \Illuminate\Http\Request $request
   * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
   */
  public function toArray($request)
  {
//    $defaultData = parent::toArray($request);

    $additionalData = [
      'id' => $this->id,
      'email' => $this->email,
      'password' => $this->password,
      'role' => $this->roles->pluck('name'),
      'permissions' => $this->getAllPermissions()->pluck('name'),
      'name' => $this->name,
      'surname' => $this->surname,
      'status' => $this->status,
      'avatar' => $this->avatar,
      'theme' =>$this->theme,
      'locale' => $this->locale,
      'ban' => $this->ban,
      'logout' => $this->logout,
      'currency' => $this->currency,
    ];

//    return array_merge($defaultData, $additionalData);
    return $additionalData;
  }
}
