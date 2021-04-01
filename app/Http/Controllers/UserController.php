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
            $degree = $request->degree;

            if (!empty($name)) {
                return User::with('dayofweeks')
                    ->where('role','doctor')
                    ->where('firstName','like',"%{$name}%")
                    ->get();
            }

            else if (!empty($city)) {
                return User::with('dayofweeks')
                    ->where('role','doctor')
                    ->where('city','like',"%{$city}%")
                    ->get();
            }

            else if (!empty($specialty)) {
                return User::with('dayofweeks')
                    ->where('role','doctor')
                    ->where('specialty','like',"%{$specialty}%")
                    ->get();
            }

            else if (!empty($degree)) {
                return User::with('dayofweeks')
                    ->where('role','doctor')
                    ->where('degree','like',"%{$degree}%")
                    ->get();
            }

        }
        catch (\Exception $e) {
            return response(['message' => 'خطایی رخ داده است.'], 500);
        }
    }

    public function listAllDoctor(Request $request){
        try {
            $name = $request->name;
            $city = $request->city;
            $specialty = $request->specialty;
            $degree = $request->degree;

            if (empty($degree) && empty($specialty) && empty($specialty) && empty($name) && empty($city))
            {
                return User::with('dayofweeks')
                    ->where('role','doctor')
                    ->get();
            }

            else if (!empty($name)) {
                return User::with('dayofweeks')
                    ->where('role','doctor')
                    ->where('firstName',$name)
                    ->get();
            }

            else if (!empty($city)) {
                return User::with('dayofweeks')
                    ->where('role','doctor')
                    ->where('city',$city)
                    ->get();
            }

            else if (!empty($specialty)) {
                return User::with('dayofweeks')
                    ->where('role','doctor')
                    ->where('specialty',$specialty)
                    ->get();
            }

            else if (!empty($degree)) {
               return User::with('dayofweeks')
                    ->where('role','doctor')
                    ->where('degree',$degree)
                    ->get();
            }

        }
        catch (\Exception $e) {
            return response(['message' => 'خطایی رخ داده است.'], 500);
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

    public function changeInfoSick(Request $request){
        try {
            DB::beginTransaction();
            $user = auth()->user();

            $user->firstName = $request->firstName;
            $user->lastName = $request->lastName;
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
