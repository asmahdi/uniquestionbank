@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 ">

                <form action="{{route('adduniversity')}}" method="post" class="" >
                @csrf

                    <div class="mdl-textfield mdl-js-textfield w-100 ">
                        <input name="university_name" class="mdl-textfield__input" type="text" id="sample1">
                        <label class="mdl-textfield__label" for="sample1">University Name</label>
                    </div>
                    <div class="mdl-textfield mdl-js-textfield w-100 ">
                        <input name="unishort_name" class="mdl-textfield__input" type="text" id="sample2">
                        <label class="mdl-textfield__label" for="sample2">Short Name</label>
                    </div>

                    <div class="row justify-content-center"> 
                        <input type="submit" id="drop-down" class="mdl-button mdl-js-button mdl-button--raised" value="Add University">
                            
                        
                    </div>
                </form>


                <div class="mdl-card mdl-shadow--2dp w-100 my-5">
                    <div class="mdl-card__title">
                        <h2 class="mdl-card__title-text w-100 m-3">Current Universities</h2>
                    </div>
                    <div class="mdl-card__supporting-text w-100">

                

                    <ul class="demo-list-item mdl-list">
                        @foreach ($universities as $university)
                        <hr>
                        <li class="mdl-list__item">
                            <span class="mdl-list__item-primary-content">
                            {{$university->name}}
                            </span>
                            <span class="mdl-list__item-primary-content justify-content-end">
                            {{$university->short_name}}
                            </span>

                            <a class="mdl-button mdl-js-button mdl-button--fab mx-5" href="{{ action('AdminController@deleteUniversity',$university->id) }}">
                                <i class="material-icons">delete_outline</i>
                            </a>

                        </li>
                        
                        @endforeach
                    </ul>                
                    </div>
                </div>


        </div>
    </div>
</div>        



@endsection