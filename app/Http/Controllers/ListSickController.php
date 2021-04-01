<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\ShowListSicksRequest;
use App\Http\Requests\User\VisitRequest;
use App\Models\ListSick;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ListSickController extends Controller
{
    public function visitRequest(VisitRequest $request){
        try {
            DB::beginTransaction();
            $user = $request->user();
            $user2 = User::where('id',$request->id)->first();

            ListSick::create([
                'date' => $request->date,
                'user_id' => $user->id,
                'user_id2' => $user2->id,
            ]);
            return response(['message' => 'با موفقیت انجام شد'],200);
        } catch (\Exception $exception) {
            Db::rollBack();
            return response(['message' => 'خطایی رخ داده است'], 500);
        }
    }


    public function ShowListSicks(ShowListSicksRequest $request){
        return $request->user()
            ->listsicks()->whereDate('date','>',now())->get();
    }
}
