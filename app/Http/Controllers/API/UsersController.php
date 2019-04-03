<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Mail\SignupActivate;
use App\Mail\SignupActivated;
use App\User;
use App\UserPreferences;
use Carbon\Carbon;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Validator;

class UsersController extends Controller
{
    public function signup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string',
            'c_password' => 'required|string|same:password',
            'country_id' => 'required|numeric|exists:countries,id',
            'phone' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()], 400);
        }

        $input = $request->all();
        $input['active'] = 1;
        $input['verified'] = 0;
        $input['password'] = bcrypt($input['password']);
        $input['email_verification_code'] = rand(100001, 999999);
        $input['email_expired_at'] = Carbon::now()->addDays(3);

        $user = User::create($input);
        Mail::to($user->email)->send(new SignupActivate($user));
        return response()->json(['message' => __('global.signed_up_successfully')], 201);
    }

    public function verify_account(Request $request)
    {
        $user = User::where([
            ['email', $request->input('email')],
            ['email_verification_code', $request->input('verification_code')],
            ['active', '1'],
            ['verified', '0'],
        ])->first();

        if (!$user) {
            return response()->json(['message' => __('global.this_email_or_verification_code_are_invalid')], 400);
        }

        if (Carbon::parse($user->email_expired_at)->isPast()) {
            return response()->json(['message' => __('global.this_activation_token_is_expired')], 400);
        }

        $user->verified = 1;
        $user->email_verification_code = null;
        $user->email_expired_at = null;
        $user->email_verified_at = Carbon::now();
        $user->save();
        // @todo initialize default user preferences
        UserPreferences::initializeDefaultPreferences($user);
        Mail::to($user->email)->send(new SignupActivated($user));
        return response()->json(['message' => __('global.verified_successfully')], 200);
    }

    public function resend_verification_code(Request $request)
    {
        $user = User::where([['email', $request->input('email')]])->first();
        if (!$user) {
            return response()->json(['message' => __('global.this_email_does_not_match_our_records')], 400);
        }
        if ($user->verified) {
            return response()->json(['message' => __('global.this_account_is_verified')], 400);
        }
        $user->email_verification_code = rand(100001, 999999);
        $user->email_expired_at = Carbon::now()->addDays(3);
        $user->save();
        Mail::to($user->email)->send(new SignupActivate($user));
        return response()->json(['message' => __('global.verification_code_has_been_sent_successfully')], 200);
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json(['message' => __('global.logged_out_successfully')], 200);
    }

    public function show(Request $request)
    {
        $request->user()->avatar = asset('storage/avatars/users') . '/' . $request->user()->avatar;
        return response()->json([
            'data' => User::where('id', $request->user()->id)->with('country')->get(),
        ], 200);
    }

    public function change_password(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'new_password' => 'required|different:current_password',
            'c_new_password' => 'required|same:new_password',
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()], 400);
        }
        if (!Hash::check($request->input('current_password'), $request->user()->password)) {
            return response()->json(['message' => __('global.incorrect_password')], 400);
        }
        $request->user()->password = bcrypt($request->input('new_password'));
        $request->user()->save();
        return response()->json(['message' => __('global.changed_successfully')], 200);
    }

    public function update_profile(Request $request)
    {
        $user = $request->user();
        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|required|max:255',
            'email' => 'sometimes|required|email|unique:users,email,' . $user->id,
            'avatar' => 'sometimes|required|file|image|dimensions:min_width=200,min_height=200',
            'country_id' => 'sometimes|required|numeric|exists:countries,id',
            'phone' => 'sometimes|required|string',
            'bank_account' => 'sometimes|string',
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()], 400);
        }
        $post_data = $request->all();
        if ($request->hasFile('avatar')) {
            $manager = new ImageManager();
            $image = $request->file('avatar');
            $post_data['avatar'] = time() . '.' . $image->getClientOriginalExtension();
            $img = $manager->make($image->getRealPath());
            $img->resize(250, 250, function ($constraint) {
                $constraint->aspectRatio();
            })->save(storage_path('app') . '/public/avatars/users/' . $post_data['avatar']);
            strpos($user->avatar, 'user_silhouette.png') === false ? Storage::disk('local')->delete('avatars/users/' . $user->avatar) : null;
        }
        $user->update($post_data);
        return response()->json(['message' => __('global.updated_successfully')], 200);
    }

    public function update(Request $request, $user_id)
    {
        $user = User::findOrFail($user_id);
        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|required|max:255',
            'email' => 'sometimes|required|email|unique:users,email,' . $user->id,
            'avatar' => 'sometimes|required|file|image|dimensions:min_width=200,min_height=200',
            'country_id' => 'sometimes|required|numeric|exists:countries,id',
            'phone' => 'sometimes|required|string',
            'bank_account' => 'sometimes|string',
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()], 400);
        }
        $post_data = $request->all();
        if ($request->hasFile('avatar')) {
            $manager = new ImageManager();
            $image = $request->file('avatar');
            $post_data['avatar'] = time() . '.' . $image->getClientOriginalExtension();
            $img = $manager->make($image->getRealPath());
            $img->resize(250, 250, function ($constraint) {
                $constraint->aspectRatio();
            })->save(storage_path('app') . '/public/avatars/users/' . $post_data['avatar']);
            strpos($user->avatar, 'user_silhouette.png') === false ? Storage::disk('local')->delete('avatars/users/' . $user->avatar) : null;
        }
        $user->update($post_data);
        return response()->json(['message' => __('global.updated_successfully')], 200);
    }

    public function deactivate(Request $request)
    {
        $user = $request->user();
        $user->active = '0';
        $user->save();
        $message = __('global.account_has_been_deactivated_successfully', ['name' => $user->name]);
        $this->revoke_user_tokens($user);
        return response()->json(['message' => $message], 200);
    }

    public function reset_password(Request $request)
    {
        $user = $request->user();
        $new_password = str_random(10);
        $user->password = bcrypt($new_password);
        $user->save();
        $this->revoke_user_tokens($user);
        return response()->json([
            'message' => __('global.password_has_been_reset_successfully'),
            'data' => [
                'user' => $user->name,
                'new_password' => $new_password,
            ],
        ], 200);
    }

    private function revoke_user_tokens($user)
    {
        $userTokens = $user->tokens();
        foreach ($userTokens as $token) {
            $token->revoke();
        }
    }
}
