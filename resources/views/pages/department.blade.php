@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 ">

                <div class="w-100"> 
                <button id="drop-down" class="mdl-button mdl-js-button mdl-button--raised w-100 text-left" value="">
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
                    data-mdl-for="drop-down">
                    @foreach ($universities as $university)
                    <a href="{{url('admin/'.$university->id.'/department')}}"><li class="mdl-menu__item">{{$university->name}}</li></a>
                    @endforeach
                </ul>


                <form action="{{url('admin/'.$selected_university.'/adddepartment')}}" method="post" class="" >
                @csrf
             

                    
                    <div class="mdl-textfield mdl-js-textfield w-100 ">
                        <input name="department_name" class="mdl-textfield__input" type="text" id="sample1">
                        <label class="mdl-textfield__label" for="sample1">Department Name</label>
                    </div>
                    <div class="mdl-textfield mdl-js-textfield w-100 ">
                        <input name="deptshort_name" class="mdl-textfield__input" type="text" id="sample2">
                        <label class="mdl-textfield__label" for="sample2">Short Name</label>
                    </div>

                    <div class="row justify-content-center"> 
                        <input type="submit" id="drop-down" class="mdl-button mdl-js-button mdl-button--raised" value="Add Department">
                            
                        
                    </div>
                </form>


                <div class="mdl-card mdl-shadow--2dp w-100 my-5">
                    <div class="mdl-card__title">
                        <h2 class="mdl-card__title-text w-100 m-3">Current department</h2>
                    </div>
                    <div class="mdl-card__supporting-text w-100">

                

                    <ul class="demo-list-item mdl-list">
                        @foreach ($departments as $department)
                        
                        @if ($department->university_id == $selected_university)
                        <hr>
                        <li class="mdl-list__item">
                            <span class="mdl-list__item-primary-content">
                            {{$department->name}}
                            </span>
                            <span class="mdl-list__item-primary-content justify-content-end">
                            {{$department->short_name}}
                            </span>

                            <a class="mdl-button mdl-js-button mdl-button--fab mx-5" href="{{ action('AdminController@deleteDepartment',$department->id) }}">
                                <i class="material-icons">delete_outline</i>
                            </a>

                        </li>
                        @endif
                        @endforeach
                    </ul>                
                    </div>
                </div>


        </div>
    </div>
</div>        



@endsection