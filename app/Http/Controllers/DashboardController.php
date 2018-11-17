<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;
use Illuminate\Contracts\Filesystem\Factory;

use Auth;

class DashboardController extends Controller
{

    public function index($university_id, $department_id, $course_id)
    {
        $posts =  DB::table('post')->where('course_id', '=', $course_id)->get();
        $users = DB::table('users')->where('points', '>', 0)->orderBy('points', 'desc')->limit(10)->get();
        if(Auth::check())
        {
            $uploader_id = Auth::user()->id;
            $uploader_posts = DB::table('post')->where('uploader_id', '=', $uploader_id)->get();
        }
        else 
        {
            $uploader_id = null;
            $uploader_posts = null;
        }
        
        
        $translated_posts = DB::table('translated_posts')->get();

        return view('pages/dashboard')->with(
            [
                'users'=> $users, 
                'posts'=> $posts,
                'universities' => $universities,
                'uploader_posts'=> $uploader_posts, 
                'selected_university'=>$university_id,
                'selected_department'=>$department_id, 
                'selected_course'=> $course_id,
                'translated_posts' => $translated_posts
            ]
        );
    }

    // public function UploadPost(Request $request, $university_id, $department_id, $course_id)
    // {
    //     $uploader_id = Auth::user()->id;
    //     $request->validate([
    //         'fileToUpload' => 'required|file|max:1024',
    //     ]);

    //     $fileName = "post".time().'.'.request()->fileToUpload->getClientOriginalExtension();

    //     $request->fileToUpload->storeAs('postfiles',$fileName);

    //     $userPoint = DB::table('users')->where('id', $uploader_id)->value('points');

    //     DB::table('post')->insert(
    //         [
    //         'title' => $request->input('title'), 
    //         'description' => $request->input('description'), 
    //         'course_id' => $course_id , 
    //         'status_code' => 1, 
    //         'url' => $fileName,
    //         'uploader_id' => $uploader_id
    //         ]
    //     );

    //     DB::table('users')->where('id', $uploader_id)->update(
    //         [
    //             'points' => $userPoint + 5,
    //         ]
    //     );

    //     return redirect('select/'.$university_id.'/'.$department_id.'/'.$course_id.'/dashboard');
    // }

    public function UploadTranslationPost(Request $request, $university_id, $department_id, $course_id, $post_id)
    {
        $uploader_id = Auth::user()->id;
        $request->validate([
            'translationFileToUpload' => 'required|file|max:1024',
        ]);

        $fileName = "translation_post".time().'.'.request()->translationFileToUpload->getClientOriginalExtension();
        $request->translationFileToUpload->storeAs('translation_postfiles',$fileName);

        $userPoint = DB::table('users')->where('id', $uploader_id)->value('points');

        DB::table('translated_posts')->insert(
            [
            'post_id' => $post_id,
            'url' => $fileName,
            'uploader_id' => $uploader_id
            ]
        );

        DB::table('users')->where('id', $uploader_id)->update(
            [
                'points' => $userPoint + 10,
            ]
        );

        return redirect('select/'.$university_id.'/'.$department_id.'/'.$course_id.'/dashboard');
    }

    public function UploadPost(Request $request, $university_id, $department_id, $course_id) {
        $uploader_id = Auth::user()->id;
        $userPoint = DB::table('users')->where('id', $uploader_id)->value('points');   

        $request->validate([
                    'fileToUpload' => 'required|file|max:100000',
                ]);
        $filename = "post".time().'.'.request()->fileToUpload->getClientOriginalExtension();
        $request->fileToUpload->storeAs('postfiles',$filename);

    


        DB::table('post')->insert(
            [
            'title' => $request->input('title'), 
            'description' => $request->input('description'), 
            'course_id' => $course_id , 
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

        return redirect('select/'.$university_id.'/'.$department_id.'/'.$course_id.'/dashboard');
    }

    /**
     * Download file
    **/
    public function getFile(Request $request)
    {   
        
        $file_path = storage_path('app\public\postfiles') . '/'. $request->filename ;
        
        return Response::download($file_path);
    }

    public function deletePost( $post_id)
    {
        DB::table('post')->where('id', '=', $post_id)->delete();

        return redirect('select/'.$university_id.'/'.$department_id.'/'.$course_id.'/dashboard');
    }


}
