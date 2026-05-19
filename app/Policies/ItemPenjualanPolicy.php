<?php

namespace App\Policies;

use App\Models\ItemPenjualan;
use App\Models\User;

class ItemPenjualanPolicy
{
   public function delete(User $user, $itempenjualan): bool
   {
    return $user->role->name === 'admin';
   }
}
