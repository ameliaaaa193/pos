<?php

namespace App\Policies;

use App\Models\Jenis;
use App\Models\User;

class JenisPolicy
{
    public function viewAny(User $user)
    {
        return $user->role->name === 'admin';
    }

    public function view(User $user, Jenis $jenis)
    {
        return $user->role->name === 'admin';
    }

    public function create(User $user)
    {
        return $user->role->name === 'admin';
    }

    public function update(User $user, Jenis $jenis)
    {
        return $user->role->name === 'admin';
    }

    public function delete(User $user, Jenis $jenis)
    {
        return $user->role->name === 'admin';
    }
}