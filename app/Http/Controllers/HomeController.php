<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       // $this->middleware('auth');
    }

    public function index()
    {
        $universitY_count = DB::table('university')->count();
        $department_count = DB::table('department')->count();
        $course_count = DB::table('course')->count();
        return view('pages/welcome')->with(['university_count'=> $universitY_count, 'department_count'=> $department_count, 'course_count'=>$course_count]);
    }

  
    public function select($university_id = null, $department_id = null,$course_id = null)
    {
        $universities = DB::table('university')->get();
        $department = DB::table('department')->get();
        $course = DB::table('course')->get();
        return view('pages/home')->with(['universities'=> $universities,
                                         'departments'=> $department,
                                         'courses'=> $course,
                                         'selected_university'=> $university_id, 
                                         'selected_department' =>$department_id,
                                         'selected_course' => $course_id]);
    }


}
