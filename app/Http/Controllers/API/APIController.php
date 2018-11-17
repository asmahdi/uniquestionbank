<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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


    public function uploadPost(Request $request) {
        $uploader_id = Auth::user()->id;
        $userPoint = DB::table('users')->where('id', $uploader_id)->value('points');   

        $request->validate([
                    'fileToUpload' => 'required|file|max:100000',
                ]);
        $filename = "post".time().'.'.request()->fileToUpload->getClientOriginalExtension();
        $request->fileToUpload->storeAs('postfiles',$filename);

    


        DB::table('post')->insert(
            [
            'title' => $request->title, 
            'description' => $request->description, 
            'course_id' => $request->course_id,
            'status_code' => 1,
            'url' => $filename,
            'uploader_id' => $uploader_id
            ]
        );

        DB::table('users')->where('id', $uploader_id)->update(
            [
                'points' => $userPoint + 5,
            ]
        );

        return response()->json([ 
            'message' => 'Post has been uploaded'
            ]);
    }

    public function getFile(Request $request)
    {   
        $file_path = storage_path('app\public\postfiles') . '/'. $request->filename ;
        return Response::download($file_path);
    }
    public function getUsers()
    {
        return response()->json(DB::table('users')->orderBy('points', 'desc')->limit(10)->get());
    }
}
