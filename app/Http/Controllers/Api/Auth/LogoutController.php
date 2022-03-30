<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Auth;
/**
 * Logout class
 */
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
        try {
            Auth::user()->token()->revoke();
            return response()->json([
                'message' => 'You are successfully logged out',
            ]);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
