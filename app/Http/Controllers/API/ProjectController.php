<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    public function index(){

        $projectList = Project::all();
        return response()->json([
            "success" => "true",
            "data" => $projectList,
        ]);
    }
}
