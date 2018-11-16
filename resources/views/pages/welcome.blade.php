@extends('layouts.app')
@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 ">
                <h2 class="display-4 text-center mt-5"> A single platform to share all universtiy resourses</h2>
                <div class="d-flex justify-content-center">
                    <a href="{{ url('/select/') }}" class="mdl-button rounded-button mdl-js-button mdl-button--raised mdl-js-ripple-effect my-5 w-50">
                    <b>Go to Dashboard</b>
                    </a>
                </div>

                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="mt-5">
                                <div class="w-100 mdl-card mdl-shadow--2dp my-3">
                                    <div class="mdl-card__title mdl-card--expand d-flex justify-content-between">
                                        <p class="display-3 mx-5">Total Universities</p>
                                        <p class="display-1 mx-5">{{$university_count}}</p> 
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="mt-5">
                                <div class="w-100 mdl-card mdl-shadow--2dp my-3">
                                    <div class="mdl-card__title mdl-card--expand d-flex justify-content-between">
                                        <p class="display-3 mx-5">Total Departments</p>
                                        <p class="display-1 mx-5">{{$department_count}}</p> 
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="mt-5">
                                <div class="w-100 mdl-card mdl-shadow--2dp my-3">
                                    <div class="mdl-card__title mdl-card--expand d-flex justify-content-between">
                                        <p class="display-3 mx-5">Total Courses</p>
                                        <p class="display-1 mx-5">{{$course_count}}</p> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            {{-- col --}}
        </div>
        {{-- row --}}
        <div class="mt-5"></div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2 class="display-4 text-center mt-5"> Featured Posts </h2>
                <hr>
                @foreach ($recent_posts as $r_post)
                    <div class="w-100 mdl-card mdl-shadow--2dp my-3">
                        <div class="mdl-card__title mdl-card--expand">
                            <h2 class="mdl-card__title-text">{{$r_post->title}}</h2>
                        </div>
                        <div class="mdl-card__supporting-text">
                            {{$r_post->description}}
                        </div>
                    </div>
                @endforeach 
            </div>
            <div class="col-md-4">
                <div class="wrapper__admin_leaderboard" style="top:15vh !important; margin-top: 1 rem">
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
                                        <span class="header">{{ $user->username }}</span>
                                    </div>
                                    <div class="point">
                                        <span class="stat">{{ $user->points }}</span>
                                    </div>
                                </li>
                            </ul>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- container --}}

@endsection


