<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Support\Facades\Log;

class ProjectController extends Controller
{
   


public function index()
{
    try {
        Log::info('Fetching all projects');
        $projects = Project::all();
        Log::info('Projects retrieved successfully', ['count' => $projects->count()]);
        return response()->json($projects);
    } catch (\Exception $e) {
        Log::error('Error fetching projects: ' . $e->getMessage());
        return response()->json(['error' => 'Something went wrong'], 500);
    }
}

}


