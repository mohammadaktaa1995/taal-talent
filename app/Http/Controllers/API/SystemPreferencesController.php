<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\SystemPreferences;
use App\Country;

class SystemPreferencesController extends Controller {

    public function get_all() {
        $data['system_preferences_values'] = SystemPreferences::all()->groupBy('key_name');
        $data['countries'] = Country::pluck('country_name', 'id');
        return response()->json(['data' => $data], 200);
    }

    public function get_by_key($key) {
        $system_preference = SystemPreferences::getValue($key);
        if (empty($system_preference)) {
            return response()->json(['message' => 'Invalid system preferences key'], 400);
        }
        return response()->json(['data' => $system_preference->key_value ?: ''], 200);
    }

    public function save(Request $request) {
        $input = $request->all();
        foreach ($input['key_name'] as $index => $key_name) {
            $system_preference = SystemPreferences::where('key_name', $key_name)->first();
            if (!empty($system_preference)) {
                $system_preference->key_value = empty($input['key_value'][$index]) ? '' : $input['key_value'][$index];
                $system_preference->save();
            }
        }
        return response()->json(['message' => 'Saved successfully'], 200);
    }

}
