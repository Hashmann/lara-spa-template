<?php

namespace App\Http\Resources\V1\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class PermissionResource extends JsonResource
{
  /**
   * Transform the resource into an array.
   *
   * @param \Illuminate\Http\Request $request
   * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
   */
//    public function toArray($request)
//    {
//        return parent::toArray($request);
//    }

  public function toArray($request)
  {
    $defaultData = parent::toArray($request);

    $additionalData = [
//      'roles'=> $this->roles,
      'permissions' => $this->permissions->pluck('name'),
    ];

    return array_merge($defaultData, $additionalData);


  }
}
