<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->fullName,
            'phone' => $this->phoneWithMask,
            'image' => $this->image->getPath(['w:275']),
            'email' => $this->email,
            'position' => $this->position->name,
            'position_id' => $this->position_id,
            'created_at' => $this->created_at->format('d.m.Y'),
        ];
    }
}
