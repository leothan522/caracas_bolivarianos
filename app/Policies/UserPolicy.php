<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;

class UserPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->id_nivel == 1 || $user->is_root;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, User $model): bool
    {
        return $user->id_nivel == 1 || $user->is_root;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->id_nivel == 1 || $user->is_root;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, User $model): bool
    {
        return $model->id != Auth::id() && !$model->is_root && ($user->id_nivel == 1 || $user->is_root);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, User $model): bool
    {
        return $model->id != Auth::id() && !$model->is_root && ($user->id_nivel == 1 || $user->is_root);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, User $model): bool
    {
        return $user->id_nivel == 1 || $user->is_root;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, User $model): bool
    {
        return $model->id != Auth::id() && !$model->is_root && ($user->id_nivel == 1 || $user->is_root);
    }
}
