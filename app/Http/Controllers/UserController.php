<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
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
                $search = User::where('role','doctor')
                    ->where('firstName','like',"%{$name}%")->get();
            }

            else if (!empty($city)) {
                $search = User::where('role','doctor')
                    ->where('city','like',"%{$city}%")->get();
            }

            else if (!empty($specialty)) {
                $search = User::where('role','doctor')
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



}
