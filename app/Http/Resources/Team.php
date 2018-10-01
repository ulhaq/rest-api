<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Team extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
          'id' => $this->id,
          'owner_id' => $this->owner_id,
          'title' => $this->title,
          'created_at' => (string) $this->created_at,
          'updated_at' => (string) $this->updated_at,
          
          'users' => $this->users,
        ];
    }
}
