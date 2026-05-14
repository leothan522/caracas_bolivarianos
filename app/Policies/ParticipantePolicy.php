<?php

namespace App\Policies;

use App\Models\Participante;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ParticipantePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        $id_nivel = $user->id_nivel ?? null;
        $is_root = $user->is_root ?? null;
        return verPage('PARTICIPANTES_VER', 'PARTICIPANTES_HASTA') || $id_nivel == 1 || $is_root;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Participante $participante): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->id_nivel != 6;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Participante $participante): bool
    {
        return $user->id_nivel != 6;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Participante $participante): bool
    {
        return $user->id_nivel != 6;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Participante $participante): bool
    {
        return $user->is_root || $user->is_admin;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Participante $participante): bool
    {
        return $user->is_root || $user->is_admin;
    }
}
