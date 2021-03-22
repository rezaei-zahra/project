<?php

namespace App\Http\Controllers;

use App\Http\Requests\Doctor\changeInfoDoctorRequest;
use App\Http\Requests\User\VisitRequest;
use App\Models\DayOfWeek;
use App\Models\ListSick;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use phpDocumentor\Reflection\Type;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }


    public function search(Request $request)
    {
        try {

            $name = $request->name;
            $city = $request->city;
            $specialty = $request->specialty;

            if (!empty($name)) {
                $search = User::with('dayofweeks')->where('role','doctor')
                    ->where('firstName','like',"%{$name}%")->get();
            }

            else if (!empty($city)) {
                $search = User::with('dayofweeks')->where('role','doctor')
                    ->where('city','like',"%{$city}%")->get();
            }

            else if (!empty($specialty)) {
                $search = User::with('dayofweeks')->where('role','doctor')
                    ->where('specialty','like',"%{$specialty}%")->get();
            }
            return $search;
        }
        catch (\Exception $e) {
            return response(['message' => 'An error has occurred'], 500);
        }
    }

    public function listAllDoctor(Request $request)
    {
        try {
            $name = $request->name;
            $city = $request->ity;
            $specialty = $request->specialty;

            if (!empty($name))
            {
                $list = User::where(['role'=>'doctor','firstName'=>$request->name])->get();
            }

            else if (!empty($city))
            {
                $list = User::where(['role'=>'doctor','city'=>$request->city])->get();
            }

            else if (!empty($specialty))
            {
                $list = User::where(['role'=>'doctor','specialty'=>$request->specialty])->get();
            }

            else if ($name=="null" && $city=="null" && $specialty=="null")
            {
                dd($name);
                $list = User::where('role','doctor')->get();
            }
            return $list;
        }
        catch (\Exception $e) {
            return response(['message' => 'An error has occurred'], 500);
        }
    }

    public function visitRequest(VisitRequest $request){
        try {
            DB::beginTransaction();
            $user = $request->user();
            $user2 = User::where('id',$request->id)->first();
            if (!$user2){
                return response(['message' => 'پزشکی یافت نشد!'],200);
            }
            ListSick::create([
                'visit' => $request->day,
                'user_id1' => $user->id,
                'user_id2' => $user2->id,
            ]);
            return response(['message' => 'با موفقیت انجام شد'],200);
        } catch (\Exception $exception) {
            dd($exception);
            Db::rollBack();
            return response(['message' => 'خطایی رخ داده است'], 500);
        }
    }

    public function changeInfoDoctor(changeInfoDoctorRequest $request){
        try {
            DB::beginTransaction();
            $user = auth()->user();

            $user->city = $request->city;
            $user->address = $request->address;
            $user->phoneNumber = $request->phoneNumber;

            $user->save();
            DB::commit();
            return response(['message' => 'تغییرات با موفقیت انجام شد'], 200);
        } catch (\Exception $exception) {
            dd($exception);
            Db::rollBack();
            return response(['message' => 'خطایی رخ داده است'], 500);
        }
    }

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
            dd($exception);
            Db::rollBack();
            return response(['message' => 'خطایی رخ داده است'], 500);
        }
    }



}
