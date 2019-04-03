<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Notifications\PasswordResetRequest;
use App\Notifications\PasswordResetSuccess;
use App\PasswordReset;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Validator;

class ForgotPasswordController extends Controller
{
    public function create(Request $request)
    {
        $user = User::where('email', $request->input('email'))->first();
        if (!$user) {
            return response()->json(['message' => __('global.this_email_does_not_match_our_records')], 400);
        }
        $passwordReset = PasswordReset::updateOrCreate(['email' => $user->email], [
            'email' => $user->email,
            'token' => rand(100001, 999999),
            'created_at' => Carbon::now(),
        ]);
        if ($passwordReset) {
            $passwordReset->notify(new PasswordResetRequest($passwordReset));
        }
        return response()->json(['message' => __('global.password_reset_code_has_been_sent_successfully')], 201);
    }

    public function check(Request $request)
    {
        $passwordReset = PasswordReset::where([['email', $request->email], ['token', $request->reset_code]])->first();
        if (!$passwordReset) {
            return response()->json(['message' => __('global.this_email_or_password_reset_code_are_invalid')], 400);
        }
        if (Carbon::parse($passwordReset->created_at)->addMinutes(720)->isPast()) {
            $passwordReset->delete();
            return response()->json(['message' => __('global.this_password_reset_code_is_expired')], 400);
        }
        return response()->json(['message' => __('global.this_password_reset_code_is_valid_till', ['date' => Carbon::parse($passwordReset->created_at)->addMinutes(720)])], 200);
    }

    public function reset(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'new_password' => 'required|string',
            'c_new_password' => 'required|same:new_password',
            'reset_code' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()], 400);
        }
        
        $passwordReset = PasswordReset::where([
            ['email', $request->email],
            ['token', $request->reset_code],
        ])->first();
        if (!$passwordReset) {
            return response()->json(['message' => __('global.this_email_or_password_reset_code_are_invalid')], 400);
        }
        
        if (Carbon::parse($passwordReset->created_at)->addMinutes(720)->isPast()) {
            $passwordReset->delete();
            return response()->json(['message' => __('global.this_password_reset_code_is_expired')], 400);
        }
        $user = User::where('email', $passwordReset->email)->first();
        
        if (!$user) {
            return response()->json(['message' => __('global.this_email_does_not_match_our_records')], 400);
        }
        
        $user->password = bcrypt($request->new_password);
        $user->save();
        $passwordReset->delete();
        $user->notify(new PasswordResetSuccess($passwordReset));
        return response()->json(['message' => __('global.password_has_been_reset_successfully')], 200);
    }
}
