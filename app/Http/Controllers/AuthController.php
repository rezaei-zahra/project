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
        try {
//            $field = $request->has('email') ? 'email' : 'phoneNumber';
//            $value = $request->input($field);
            $credentials = [
//                $field => $value,
                'email' => $request->email,
                'password' => $request->password
            ];
            if (auth()->attempt($credentials)) {
                if (auth()->user()->verify_code == null) {
                    $token = auth()->user()->createToken('Token' . auth()->id())->accessToken;
                    $user = Auth::user();
                    return response()->json(['token' => $token, 'user' => $user], 200);
                } else {
                    return response(['message' => 'You are not a verified user yet!', 'user' => auth()->user()->userId], 400);
                }
            }
        } catch (\Exception $exception) {
            return response(['message' => $exception->getMessage()], 400);
        }
        return response(['message' => 'Invalid Username or Password'], 401);
    }

    public function register(RegisterNewUserRequest $request)
    {
        try {
            DB::beginTransaction();
            $email = $request->email;
            if ($email) {
                $user = User::where('email', $email)->first();
                if ($user) {
                    if ($user->verify_at) {
                        return response(['message' => 'Email or phone number already registered, please enter another one!'], 400);
                    } else {
                        return response(['message' => 'The verification code has been sent, please check your email!'], 406);
                    }
                }
            }

//            $code = random_verification_code();
            $user = User::create([
                'firstName' => $request->firstName,
                'lastName' => $request->lastName,
                'phoneNumber' => $request->phoneNumber,
                'role' => $request->role,
                'email' => $request->email,
//                'verify_code' => $code,
                'password' => Hash::make($request->password),
            ]);

            if ($user->role == 'پزشک'){
                $page = new Page(['user_id'=>$user->id]);
            }
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
            return response()->json(['user' => $user, 'message' => 'You are registered successfully! The verification code is sent to your email.', 'token' => $token], 200);
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
