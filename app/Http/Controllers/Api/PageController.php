<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function projects(){

        $projects = Project::with('type', 'technologies')->paginate(12);

        return response()->json($projects);
    }

    public function technologies(){

        $technologies = Technology::with('projects')->get();

        return response()->json($technologies);
    }

    public function types(){

        $types = Type::with('projects')->get();

        return response()->json($types);
    }
}
