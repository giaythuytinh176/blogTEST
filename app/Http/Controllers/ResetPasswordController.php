<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResetRequest;
use App\Models\PasswordReset;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ResetPasswordController extends Controller
{
    public function sendMail(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if (empty($user)) {
            return view('backend.user.auth-password-social', ['message' => 'Your email doesn\'t exist!']);
        }
        $rand = Str::random(60);
        $passwordReset = PasswordReset::updateOrCreate([
            'email' => $user->email,
        ], [
            'token' => $rand,
        ]);
        if ($passwordReset) {
            $user->notify(new ResetPassword($passwordReset->token));
        }
        return view('backend.user.auth-password-social', ['success' => 'We have e-mailed your password reset link!']);
    }

    public function resetForm($token)
    {
        $passwordReset = PasswordReset::where('token', $token)->first();
        if (empty($passwordReset)) {
            return view('backend.user.auth-password-reset', ['message' => 'Token is not valid or has expired.']);
        }
        return view('backend.user.auth-password-reset', ['token' => $token]);
    }

    public function reset(ResetRequest $request, $token)
    {
        $passwordReset = PasswordReset::where('token', $token)->firstOrFail();
        if (Carbon::parse($passwordReset->updated_at)->addMinutes(720)->isPast()) {
            $passwordReset->delete();
            return view('backend.user.auth-password-reset', ['message' => 'This password reset token is invalid.']);
        }
        $user = User::where('email', $passwordReset->email)->firstOrFail();
        $password = [
            'password' => Hash::make($request->password)
        ];
        $updatePasswordUser = $user->update($password);
        $passwordReset->delete();

        return view('backend.user.auth-password-reset', ['success' => 'Your Password has been changed!']);
    }
}
