<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginUserRequest;
use App\Http\Requests\Auth\RegisterNewUserRequest;
use App\Models\Page;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function login(LoginUserRequest $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (auth()->attempt($credentials)) {
            $token = auth()->user()->createToken('Token' . auth()->id())->accessToken;
            $user = Auth::user();
            return response()->json(['token' => $token, 'user' => $user], 200);
        } else {
            return response(['message' => 'ایمیل و رمز عبور مطابقت ندارد!'], 401);
        }
    }



    public function register(RegisterNewUserRequest $request)
    {
        try {
            DB::beginTransaction();
            $user = User::create([
                'firstName' => $request->firstName,
                'lastName' => $request->lastName,
                'phoneNumber' => $request->phoneNumber,
                'specialty' => $request->specialty,
                'systemNumber' => $request->systemNumber,
                'degree' => $request->degree,
                'role' => $request->role,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            $token = $user->createToken('Token' . $user->id)->accessToken;
            //------------------------------ sending email ----------------------------
//            $email = $request->email;
//            $details = [
//                'title' => 'Verification Code',
//                'body' => 'Your verification code is ' . $code
//            ];
//            Mail::to($email)->send(new PasswordMail($details));
            //-------------------------------------------------------------------------
            DB::commit();
            return response()->json(['user' => $user, 'message' => 'ثبت نام با موفقیت انجام شد', 'token' => $token], 200);
        } catch (\Exception $exception) {
            DB::rollBack();
            return response(['message' => $exception->getMessage()], 500);
        }
    }

    public function logout(Request $request)
    {
        $request->user()->
        token()->delete();
        return response()->json('شما با موفقیت خارج شدید', 200);
    }
}
