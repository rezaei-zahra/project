<?php

namespace App\Policies;

use App\Models\Favourite;
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

    public function seeListSicks(User $user,User $otherUser = null)
    {
        return true;
    }

    public function favourite(User $user1 , User $user2)
    {
        if ($user2->role == 'doctor'){
            $conditions =[
                'user_id1' => $user1->id,
                'user_id2' => $user2->id
            ];
            return Favourite::where($conditions)->count() == 0;//countیعنی اگر تونست این را پیدا کند یعنی من ققبلا جزو علاقه مندیها قرار دادم
        }
       //یعنی شما قبلا این پزشک را جزو علاقه مندیها قرار دادین
        return false;
    }

    public function delete_from_favourite(User $user1 = null, User $user2 = null)
    {
        $conditions =[
            'user_id1' => $user1->id,
            'user_id2' => $user2->id
        ];
        return Favourite::where($conditions)->count();
    }
}
