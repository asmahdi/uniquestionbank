@extends('layouts.app')


@section('content')


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 ">

                <h2 class="display-4 text-center mt-5"> ADD </h2>
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

                <div id="carouselUsersCount" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselUsersCount" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselUsersCount" data-slide-to="1"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="mt-5">
                                <div class="w-100 mdl-card mdl-shadow--2dp my-3">
                                    <div class="mdl-card__title mdl-card--expand d-flex justify-content-between">
                                        <p class="display-3 pl-5">Total Users</p>
                                        <p class="display-2 mx-5">{{ DB::table('users')->where('is_admin', '!=', 1)->count() }}</p> 
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="mt-5">
                                <div class="w-100 mdl-card mdl-shadow--2dp my-3">
                                    <div class="mdl-card__title mdl-card--expand d-flex justify-content-between">
                                        <p class="display-3 pl-5">Total Posts</p>
                                        <p class="display-2 mx-5">{{ DB::table('post')->count() }}</p> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- carosal --}}
            </div>
            {{-- col --}}    
        </div>
        {{-- row --}}

        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2 class="display-4 text-center mt-4 p-4" style="background-color: #3aafa933"> Statistics </h2>
                <div class="mdl-card mdl-shadow--2dp my-3 w-100">
                    <div class="mdl-textfield mdl-js-textfield w-100">
                        <h4 class="text-center mt-5">Total Users : {{ DB::table('users')->where('is_admin', '!=', 1)->count() }}</h4>
                        <h4 class="text-center mt-5">Total Posts : {{ DB::table('post')->count() }}</h4>
                        <h4 class="text-center mt-5">Total Universities : {{ DB::table('university')->count() }}</h4>
                        <h4 class="text-center mt-5">Total Departments : {{ DB::table('department')->count() }}</h4>
                        <h4 class="text-center mt-5">Total Courses : {{ DB::table('course')->count() }}</h4>
                    </div>
                    
                </div> 
            </div>
            <div class="col-md-4">
                <div class="wrapper__admin_leaderboard" style="margin-top: 1 rem">
                    <div class="wrapper__header">
                        <div class="b_caption">
                            <p>Leaderboard</p>
                        </div>
                    </div>
                    <div class="wrapper__content">
                        @foreach ($users->where('is_admin', '!=', 1) as $user)
                            <ul>
                                <li>
                                    <div class="name">
                                        <span class="header">{{ $user->name }}</span>
                                    </div>
                                    <div class="point">
                                        <span class="stat">{{ $user->points }}</span>
                                    </div>
                                </li>
                            </ul>
                        @endforeach
                    </div>
                </div>
                <h2 class="display-4 text-center mt-5">  </h2>
            </div>
        </div>
    </div>        


@endsection