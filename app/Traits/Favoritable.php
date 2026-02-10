<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait Favoritable
{
    /**
     * Get all users who favorited this entity.
     */
    public function favoritedBy(): MorphToMany
    {
        return $this->morphToMany(User::class, 'favoritable', 'favorites');
    }

    /**
     * Check if a specific user has favorited this.
     */
    public function isFavoritedBy(?User $user): bool
    {
        if (!$user) return false;

        return $this->favoritedBy()
            ->where('user_id', $user->id)
            ->exists();
    }
}
