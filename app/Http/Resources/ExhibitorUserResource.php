<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ExhibitorUserResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'        => $this->id,
            'name'      => trim($this->name . ' ' . $this->last_name),
            'job_title' => $this->job_title,
            'avatar'    => $this->avatar ? asset($this->avatar) : null,
            'bio'       => $this->bio,
        ];
    }
}
