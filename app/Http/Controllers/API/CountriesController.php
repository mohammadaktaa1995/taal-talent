<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\Country;

class CountriesController extends Controller
{
    public function get_all()
    {
        $countries = Country::orderBy('country_name')->get();
        return response()->json(['data' => $countries], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), ['country_name' => 'required|max:255']);
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()], 400);
        }
        $input = $request->all();
        $country_id = Country::create($input)->id;
        return response()->json(['message' => 'Created successfully', 'data' => ['country_id' => $country_id]], 201);
    }

    public function update(Request $request, $country_id)
    {
        $country = Country::findOrFail($country_id);
        $validator = Validator::make($request->all(), ['country_name' => 'required|max:255']);
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()], 400);
        }
        $input = $request->all();
        $country->update($input);
        return response()->json(['message' => 'Updated successfully'], 200);
    }

    public function delete($country_id)
    {
        $country = Country::find($country_id);
        try {
            $country->delete($country_id);
            return response()->json(['message' => 'Deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Cannot delete parent country row: you are trying to delete the "parent" record and cannot due to the "child" record attached to it'], 400);
        }
    }
}
