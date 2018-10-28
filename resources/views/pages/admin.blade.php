@extends('layouts.app')


@section('content')


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 ">

                <div class="row justify-content-center"> 
                    <button onclick="location.href='{{ url('admin/university') }}'"  class="mdl-button mdl-js-button mdl-button--raised m-5" style="height:200px;width:200px">
                    <strong>University</strong>
                    </button>
                    <button onclick="location.href='{{ url('admin/0/department') }}'" class="mdl-button mdl-js-button mdl-button--raised m-5" style="height:200px;width:200px">
                    <strong>Department</strong>
                    </button>  
                    <button onclick="location.href='{{ url('admin/0/0/course') }}'"  class="mdl-button mdl-js-button mdl-button--raised m-5" style="height:200px;width:200px">
                    <strong> Course</strong>
                    </button>  

                </div>
            </div>
        </div>
    </div>        


@endsection