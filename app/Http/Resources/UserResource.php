<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'job_function' => $this->job_function,

            // Critical for Visitor Identity
            'badge_code' => $this->badge_code,

            // Role Helper (returns 'visitor', 'exhibitor', or 'admin')
            'role' => $this->roles->first()?->slug ?? 'visitor',

            // Critical for Exhibitor Logic (Unlock Booth Features)
            'company_id' => $this->company_id,
            'company_name' => $this->company->name ?? null,

            'created_at' => $this->created_at->format('Y-m-d H:i'),
        ];
    }
}
