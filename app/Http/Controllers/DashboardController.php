<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

use Auth;

class DashboardController extends Controller
{

    public function index($university_id, $department_id, $course_id)
    {
       $posts =  DB::table('post')->where('course_id', '=', $course_id)->get();
        return view('pages/dashboard')->with(['posts'=> $posts, 'selected_university'=>$university_id,'selected_department'=>$department_id, 'selected_course'=> $course_id]);
    }

    public function UploadPost(Request $request, $university_id, $department_id, $course_id)
    {
        $uploader_id = Auth::user()->id;
        $request->validate([
            'fileToUpload' => 'required|file|max:1024',
        ]);

        $fileName = "post".time().'.'.request()->fileToUpload->getClientOriginalExtension();

        $request->fileToUpload->storeAs('postfiles',$fileName);
        DB::table('post')->insert(
            [
            'title' => $request->input('title'), 
            'description' => $request->input('description'), 
            'course_id' => $course_id , 
            'status_code' => 1, 
            'url' => $fileName,
            'uploader_id' => $uploader_id


            ]
        );

        return redirect('select/'.$university_id.'/'.$department_id.'/'.$course_id.'/dashboard');
    }
}
