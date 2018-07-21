<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\University;


class UniversityController extends Controller
{
    //
    public function index(){
        return view('university');
    }

    public function create(){

    }
}
