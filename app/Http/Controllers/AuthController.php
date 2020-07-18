<?php

namespace App\Http\Controllers;

use App\Http\StatusCode;
use App\Http\SuccessResponses;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    use SuccessResponses;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Register new user
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function register(Request $request)
    {
        $this->validate($request, [
            'username' => 'required | email | unique:users',
            'password' => 'required | confirmed | min:8',
            'password_confirmation' => 'required',
            'name' => 'required',
        ]);

        $user = new User();
        $user->username = $request->input('username');
        $user->password = app('hash')->make($request->input('password'));
        $user->name = $request->input('name');
        $user->address = $request->input('address');
        $user->phone = $request->input('phone');
        $user->save();

        return $this->successResponse(__('messages.success'), $user);
    }

    /**
     * Login Function to get JWT
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
    {
        //validate incoming request
        $this->validate($request, [
            'username' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only(['username', 'password']);

        if (! $token = Auth::attempt($credentials)) {
            return response()->json(['message' => 'Unauthorized'], StatusCode::UNAUTHORIZED);
        }

        return $this->respondWithToken($token);
    }

}
