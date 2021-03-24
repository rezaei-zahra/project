<?php

namespace App\Http\Controllers;

use App\Http\Requests\Doctor\changeInfoDoctorRequest;
use App\Models\DayOfWeek;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DayOfWeekController extends Controller
{
    public function changeWorkDay(changeInfoDoctorRequest $request){
        try {
            DB::beginTransaction();
            $user = DayOfWeek::where('user_id',auth()->user()->id)->first();
            if (!$user){
                $Comment = DayOfWeek::create([
                    'user_id' => auth()->user()->id,
                    'Saturday'=>$request->Saturday,
                    'Sunday'=>$request->Sunday,
                    'Monday'=>$request->Monday,
                    'Tuesday'=>$request->Tuesday,
                    'Wednesday'=>$request->Wednesday,
                    'Thursday'=>$request->Thursday,
                    'Friday'=>$request->Friday,
                ]);
            }
            else{
                $user->user_id = auth()->user()->id;
                $user->Saturday = $request->Saturday;
                $user->Sunday = $request->Sunday;
                $user->Monday = $request->Monday;
                $user->Tuesday = $request->Tuesday;
                $user->Wednesday = $request->Wednesday;
                $user->Thursday = $request->Thursday;
                $user->Friday = $request->Friday;
                $user->save();
            }
            DB::commit();
            return response(['message' => 'تغییرات با موفقیت انجام شد'], 200);
        } catch (\Exception $exception) {
            Db::rollBack();
            return response(['message' => 'خطایی رخ داده است'], 500);
        }
    }

}
