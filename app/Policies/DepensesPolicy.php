<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Depense;


class DepensesPolicy
{
    /**
     * Create a new policy instance.
     */
    
        public function update(User $user, Depense $depenses)
        {
            return $user->id === $depenses->user_id;
        }
    
        public function delete(User $user, Depense $depenses)
        {
            return $user->id === $depenses->user_id;
        }
    
}
