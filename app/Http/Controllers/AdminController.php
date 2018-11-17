<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Auth;

class AdminController extends Controller
{

    public $admin_selected_uni ;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $users = DB::table('users')->where('points', '>', 0)->orderBy('points', 'desc')->limit(10)->get();
        if($user->is_admin == 1)
        {    
            return view('pages/admin')->with(['users' => $users]);
        }
        else {
            return redirect('/');
        }
        
    }

    public function university()
    {
        $universities = DB::table('university')->get();
        return view('pages/university')->with(['universities'=> $universities]);
    }


    public function addUniversity(Request $request)
    {
        DB::table('university')->insert(
            ['name' => $request->input('university_name'), 'short_name' => $request->input('unishort_name')]
        );
        return redirect()->action('AdminController@university');
    }

    public function deleteUniversity($id)
    {
        
        DB::table('university')->where('id', '=', $id)->delete();
        return redirect()->action('AdminController@university');
    }



    public function department($university_id)
    {
        $universities = DB::table('university')->get();
        $department = DB::table('department')->get();
        return view('pages/department')->with(['universities'=> $universities,'departments'=> $department,'selected_university'=>$university_id]);
    }

    
    public function addDepartment(Request $request, $university_id)
    {
        DB::table('department')->insert(
            ['name' => $request->input('department_name'), 'short_name' => $request->input('deptshort_name'), 'university_id' => $university_id ]
        );
        return redirect('admin/'.$university_id.'/department');
    }

    public function deleteDepartment($id)
    {   
        $university_id = DB::table('department')->where('id', '=', $id)->first();
        DB::table('department')->where('id', '=', $id)->delete();
        return redirect('admin/'.$university_id->university_id.'/department');
    }

    public function course($university_id,$department_id)
    {
        $universities = DB::table('university')->get();
        $departments = DB::table('department')->get();
        $courses = DB::table('course')->get();
        return view('pages/course')->with(['courses'=>$courses,'universities'=> $universities,'departments'=> $departments,'selected_university'=>$university_id,'selected_department'=>$department_id]);
    }

    public function addCourse(Request $request,$university_id, $department_id)
    {
        DB::table('course')->insert(
            ['name' => $request->input('course_name'), 'short_name' => $request->input('courseshort_name'), 'department_id' => $department_id ]
        );
        return redirect('admin/'.$university_id.'/'.$department_id.'/course');
    }

    public function deleteCourse($id)
    {   
        $course = DB::table('course')->where('id', '=', $id)->first();
        $university = DB::table('department')->where('id', '=', $course->department_id)->first();
        DB::table('course')->where('id', '=', $id)->delete();
        return redirect('admin/'.$university->university_id.'/'.$course->department_id.'/course');
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
