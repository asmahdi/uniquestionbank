<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class APIController extends Controller
{
    public function getUniversities()
    {
       return response()->json($universities = DB::table('university')->get());
    }
    public function getDepartments(Request $request)
    {
       return response()->json($departments = DB::table('department')->where('university_id','=',$request->uni_id)->get());
    }
    public function getCourses(Request $request)
    {
        return response()->json($courses = DB::table('course')->where('department_id','=',$request->dept_id)->get());
    }

    public function getResources(Request $request)
    {
        return response()->json($posts =  DB::table('post')->where('course_id', '=', $request->course_id)->get());
    }
}
