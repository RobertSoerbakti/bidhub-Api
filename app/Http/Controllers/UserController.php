<?php

namespace App\Http\Controllers;

use App\Http\SuccessResponses;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    use SuccessResponses;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function profile()
    {
        return $this->successResponse(__('messages.success'), Auth::user());
    }
}
