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
        $uploader_id = Auth::user()->id;
        $uploader_posts = DB::table('post')->where('uploader_id', '=', $uploader_id)->get();
        $translated_posts = DB::table('translated_posts')->get();

        return view('pages/dashboard')->with(
            [
                'users'=> $users, 
                'posts'=> $posts,
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
        $destination_path = storage_path('uploads');
        $file = $request->file('fileToUpload');

      
        $validator = Validator::make(
            [
                'fileToUpload' => $file,
                'extension' => Str::lower($file->getClientOriginalExtension()),
            ],
            [
                'fileToUpload' => 'required|max:100000',
                'extension' => 'required|in:jpg,jpeg,bmp,png,doc,docx,zip,rar,pdf,rtf,xlsx,xls,txt, csv'
            ]
        );

        if($validator->passes()){
            $filename = $file->getClientOriginalName();
            $upload_success = $file->move($destination_path, $filename);
            // if ($upload_success) {
            //         #if needed, save to your table
            //         $attach = new attachments();
            //         $attach->file_name = $filename;
            //         $attach->mime = $file->getClientMimeType();
            //         $attach->save();
            // }
        }


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
    public function get_file(Request $request, $filename)
    {
        
        $filename = $file->getClientOriginalName();
    

        $file_path = storage_path('uploads') . '/'. $filename ;
        return Response::download($file_path);
    }


}
