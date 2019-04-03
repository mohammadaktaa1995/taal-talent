<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\InterestRate;
use App\Transaction;
use App\UserPreferences;
use Illuminate\Http\Request;
use Validator;

class UserPreferencesController extends Controller
{
    public function get_all(Request $request)
    {
        $user_preferences = UserPreferences::select('key_name', 'key_value')->where('user_id', $request->user()->id)->get()->groupBy('key_name');
        return response()->json(['data' => $user_preferences], 200);
    }

    public function get_all_by_user($user_id)
    {
        $user_preferences = UserPreferences::select('key_name', 'key_value')->where('user_id', $user_id)->get()->groupBy('key_name');
        return response()->json(['data' => $user_preferences], 200);
    }

    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'key_name' => 'required',
            'key_value' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()], 400);
        }
        $update_interest_rate = false;
        $post_data = $request->all();
        if (is_array($post_data['key_name']) && is_array($post_data['key_value'])) {
            foreach ($post_data['key_name'] as $key => $key_name) {
                if (in_array($key_name, ['product_1_breakdown', 'product_2_breakdown'])) {
                    $update_interest_rate = true;
                }
                UserPreferences::updateOrCreate([
                    'user_id' => $request->user()->id,
                    'key_name' => $key_name], [
                    'key_value' => $post_data['key_value'][$key],
                ]);
            }
            if ($update_interest_rate) {
                InterestRate::create([
                    'user_id' => $request->user()->id,
                    'interest' => Transaction::currentGrowthPercentageBy($request->user()->id),
                ]);
            }
            return response()->json(['message' => 'Saved successfully'], 200);
        }

        UserPreferences::updateOrCreate([
            'user_id' => $request->user()->id,
            'key_name' => $request->input('key_name')], [
            'key_value' => $request->input('key_value'),
        ]);
        return response()->json(['message' => 'Saved successfully'], 200);
    }

    public function get_by_key(Request $request, $keyName)
    {
        return response()->json(['data' => [$keyName => UserPreferences::getByKey($request, $keyName)]], 200);
    }

    public function get_by_user_by_key($user_id, $keyName)
    {
        return response()->json(['data' => [$keyName => UserPreferences::getByKeyByUser($user_id, $keyName)]], 200);
    }
}
