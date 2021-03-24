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
                $list = User::where('role','doctor')->get();
            }
            return $list;
        }
        catch (\Exception $e) {
            return response(['message' => 'An error has occurred'], 500);
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
            Db::rollBack();
            return response(['message' => 'خطایی رخ داده است'], 500);
        }
    }




}
