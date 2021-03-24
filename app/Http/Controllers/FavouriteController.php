<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\favouriteRequest;
use App\Models\Favourite;
use App\Models\User;
use App\Post;
use App\PostFavourite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FavouriteController extends Controller
{
    public function createFavourite(favouriteRequest $request)
    {
        Favourite::create([
            'user_id1' => $request->user()->id,
            'user_id2' => $request->id,
        ]);
        return response(['massage'=>'با موفقیت انجام شد'],200);
    }

    public function deleteFavourite(Request $request)
    {
        $conditions = [
            'user_id1' => $request->user()->id,
            'user_id2' => $request->id,
        ];
        Favourite::where($conditions)->delete();
        return response(['massage'=>'با موفقیت انجام شد'],200);
    }

    public function showFavourites(Request $request)
    {
        return $request->user()
            ->favourites()->get();
    }

}
