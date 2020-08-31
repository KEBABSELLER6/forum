<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function update(User $user, User $model)
    {
        if($user->id===$model->id){
            return true;
        }else return false;
    }

    public function grantModerator(User $user){
        return $user->isAdmin();
    }

    public function revokeModerator(User $user){
        return $user->isAdmin();
    }

}
