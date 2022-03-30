<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Verified;
use \FFI\Exception;

/**
 * Controllen for configuration verification
 */
class VerificationApiController extends Controller
{
    use VerifiesEmails;

    /**
     * Show the email verification notice.
     *
     */
    public function show()
    {
        //
    }

    /**
     * Mark the authenticated user’s email address as verified.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function verify(Request $request)
    {
        try {
            $userID = $request['id'];
            $user = User::findOrFail($userID);
            $date = date('Y-m-d g:i:s');
            $user->email_verified_at = $date; // to enable the “email_verified_at field of that user be a current time stamp by mimicing the must verify email feature
            $user->save();
            return response()->json('Email verified!');
        } catch (Exception $e) {
            return $e->getMessage();
        }
       
    }

    /**
     * Resend the email verification notification.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function resend(Request $request)
    {
        try {
            if ($request->user()->hasVerifiedEmail()) {
                return response()->json('User already have verified email!', 422);
            }
            $request->user()->sendEmailVerificationNotification();
            return response()->json('The notification has been resubmitted');
        } catch (Exception $e) {
            return $e->getMessage();
        }
      
    }
}
