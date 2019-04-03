<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Project;
use App\UserPreferences;
use http\Client\Curl\User;
use Illuminate\Http\Request;
use Validator;

class ProjectController extends Controller
{

    public function save(ProjectRequest $request)
    {
        $valid = $request->validated();

        if ($request->user()) {
            Project::create([
                'user_id' => $request->user()->id,
                'title' => $request->input('title')], [
                'summary' => $request->input('summary'),
                'goal' => $request->input('goal'),
                'category_id' => $request->input('category_id'),
            ]);
        } else {
            $user = \App\User::create($request->input());

            Project::create([
                'user_id' => $user->id,
                'title' => $request->input('title')], [
                'summary' => $request->input('summary'),
                'goal' => $request->input('goal'),
                'category_id' => $request->input('category_id'),
            ]);
        }

        return response()->json(['message' => 'Saved successfully'], 200);
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return response()->json(['message' => 'Deleted successfully'], 200);
    }
}
