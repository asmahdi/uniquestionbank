@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 ">

             <div class="w-100"> 
                <button id="drop-down-uni" class="mdl-button mdl-js-button mdl-button--raised w-100 text-left" value="">
                <i class="material-icons">arrow_drop_down </i> <span>
                    @if($selected_university == 0)
                    Select University
                    @endif
                     @foreach ($universities as $university)
                            @if ($university->id == $selected_university)
                                {{$university->name}}
                            @endif
                        @endforeach
                    </span>
                </button>
                
                </div>
            

                <ul class="mdl-menu mdl-menu--bottom-left mdl-js-menu mdl-js-ripple-effect"
                    data-mdl-for="drop-down-uni">
                    @foreach ($universities as $university)
                    <a href="{{url('/select/'.$university->id)}}"><li class="mdl-menu__item">{{$university->name}}</li></a>
                    @endforeach
                </ul>



                
                 <div class="w-100 mt-5" > 
                    @if($selected_university > 0)
                    <button id="drop-down-dept" class="mdl-button mdl-js-button mdl-button--raised w-100 text-left" value="">
                    <i class="material-icons">arrow_drop_down </i> <span>
                        @if($selected_department == 0)
                        Select Department
                        @endif
                        @foreach ($departments as $department)
                            @if ($department->id == $selected_department)
                                {{$department->name}}
                            @endif
                        @endforeach
                        </span>
                    </button>
                    @endif
                </div>
            

                <ul class="mdl-menu mdl-menu--bottom-left mdl-js-menu mdl-js-ripple-effect"
                    data-mdl-for="drop-down-dept">
                    @foreach ($departments as $department)
                    @if($department->university_id == $selected_university)
                    <a href="{{url('/select/'.$selected_university.'/'.$department->id)}}"><li class="mdl-menu__item">{{$department->name}}</li></a>
                    @endif
                    @endforeach
                </ul>


                <div class="w-100 mt-5" > 
                    @if($selected_department > 0)
                    <button id="drop-down-course" class="mdl-button mdl-js-button mdl-button--raised w-100 text-left" value="">
                    <i class="material-icons">arrow_drop_down </i> <span>
                        @if($selected_course == 0)
                        Select Course
                        @endif
                        @foreach ($courses as $course)
                            @if ($course->id == $selected_course)
                                {{$course->name}}
                            @endif
                        @endforeach
                        </span>
                    </button>
                    @endif
                </div>
            

                <ul class="mdl-menu mdl-menu--bottom-left mdl-js-menu mdl-js-ripple-effect"
                    data-mdl-for="drop-down-course">
                    @foreach ($courses as $course)
                    @if($course->department_id == $selected_department)
                    <a href="{{url('/select/'.$selected_university.'/'.$course->department_id.'/'.$course->id)}}"><li class="mdl-menu__item">{{$course->name}}</li></a>
                    @endif
                    @endforeach
                </ul>

                <div class="d-flex justify-content-center mt-5">
                @if($selected_course >0)
                    <a href="{{url('/select/'.$selected_university.'/'.$selected_department.'/'.$selected_course.'/dashboard')}}" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect" >
                        Go
                    </a>
                @endif    
                </div>

        </div>
    </div>
</div>
@endsection
