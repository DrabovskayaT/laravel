<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Auth;

class LogoutController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
    Auth::user()->token()->revoke();
        return response()->json([
            'message' => 'You are successfully logged out',
        ]);
    }
}
