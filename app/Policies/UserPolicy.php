<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function visitRequest(User $user, User $otherUser)
    {
        //یوزری که میخوام درخواست بدم حتما نقشش پزشک باشه و یک پزشک به خودش نتونه درخواست ویزیت بده
        return ($user->id != $otherUser->id) && ($otherUser->role == 'doctor');
    }
}
