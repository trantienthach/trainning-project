<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Validation\ChangePasswordRequest;
use App\Http\Requests\Validation\LoginRequest;
use App\Http\Requests\Validation\RegisterRequest;
use App\Http\Requests\Validation\UserRequest;
use App\Models\PasswordReset;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class AuthController extends Controller
{

    private $userModel;

    public function __construct(User $userModel)
    {
        $this->userModel = $userModel;
    }

    /**
     * Handle user login
     * @param App\Http\Requests\Validations\LoginRequest $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request) {

        try {

            $request = $request->only('email','password');
            $token = Auth::attempt($request);

            if(!($token)) {
                return response()->json([
                    'status' => 'error',
                    'message' => trans('auth.failed'),
                ], 401);
            }

            $user = Auth::user();

            return response()->json([
                'status' => 'success',
                'user'   => $user,
                'token'  => $token

            ]);

        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()]);
        }

    }

    /**
     * Handle user register
     * @param App\Http\Requests\Validations\RegisterRequest $request
     * @return JsonResponse
     */
    public function register(RegisterRequest $request) {

        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'code'     => Str::random(10),
                'sex'      => $request->sex,
                'birthday' => $request->birthday,
                'phone'    => $request->phone,
                'avatar'   => $request->avatar ?? $request->avatar
            ]);

            $token = Auth::login($user);
            return response()->json([
                'status' => 'success',
                'users'  => Auth::user(),
                'authorization' => [
                    'token'     => $token,
                    'type'      => 'bearer',
                ]
            ]);

        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()]);
        }

    }

    /**
     * Handle user change password
     * @param App\Http\Requests\Validations\ChangePasswordRequest $request
     * @return JsonResponse
     */
    public function changePassword(ChangePasswordRequest $request) {

        try {
            $user = Auth::user();

            if(!(Hash::check($request->currentPassword,$user->password))) {
                return response()->json([
                    'status' => 'error',
                    'message'  => trans('auth.password'),
                ]);
            }

            $user = User::find($user->id);
            $user->password = Hash::make($request->newPassword);
            $user->save();

            return response()->json([
                'status' => 'success',
                'message'  => 'Password was changed',
            ]);

        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()]);
        }
    }

    /**
     * Handle get user login
     * @return JsonResponse
     */
    public function getUserAuth() {
        try {
            $user = Auth::getUser();
            return response()->json($user);

        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()]);
        }
    }

    /**
     * Handle get user logout
     * @return JsonResponse
     */
    public function logout() {

        try {
            Auth::logout();
            return response()->json([
                    'status'  => 'success',
                    'message' => 'You has been logout',
            ]);

        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()]);
        }
    }


}
