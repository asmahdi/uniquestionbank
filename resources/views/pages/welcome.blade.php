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
    </div>
    {{-- container --}}

@endsection


