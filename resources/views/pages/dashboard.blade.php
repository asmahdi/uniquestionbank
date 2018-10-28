@extends('layouts.app')

@section('content')
<div class="container">

    @if (Auth::check())
        <form action="{{url('/'.$selected_university.'/'.$selected_department.'/'.$selected_course.'/dashboard/upload')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mdl-card mdl-shadow--2dp my-3 w-100">
                    <div class="mdl-card__title mdl-card--expand">
                        <div class="mdl-textfield mdl-js-textfield w-100">
                            <input name="title" class="mdl-textfield__input" type="text" id="title">
                            <label class="mdl-textfield__label m-0" for="sample1">Title</label>
                        </div>
                    </div>
                    <div class="mdl-card__title mdl-card--expand">
                            <div class="mdl-textfield mdl-js-textfield w-100">
                                <input name="description" class="mdl-textfield__input" type="text" id="description">
                                <label class="mdl-textfield__label m-0" for="description">Description</label>
                            </div>
                    </div>

                    <div class="mdl-card__title mdl-card--expand  d-flex justify-content-between">
                        <h5 class="text-muted">Upload a pdf</h5>
                        <input type="file" class="mdl-button mdl-js-button " name="fileToUpload" id="postInputFile" aria-describedby="fileHelp">

                        
                    </div>
                    
                    <div class="mdl-card__actions mdl-card--border">
                        <button type="submit" class="mdl-button rounded-button mdl-js-button mdl-js-ripple-effect float-right">
                        <b>Submit</b>
                        </button>
                    </div>
                </div>
        </form>
    @endif    
               
               <div class="text-line"> <span class="display-4">All Posts</span>  </div> 

            @foreach ($posts as $post)
                <div class="w-100 mdl-card mdl-shadow--2dp my-3">
                <div class="mdl-card__title mdl-card--expand">
                    <h2 class="mdl-card__title-text">{{$post->title}}</h2>
                </div>
                <div class="mdl-card__supporting-text">
                    {{$post->description}}
                </div>
                <div class="mdl-card__actions mdl-card--border">
                    <a href="{{url('storage/postfiles/'.$post->url)}}" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect float-right">
                    <b>View</b>
                    </a>
                    
                </div>
                </div>
            @endforeach

</div>            


@endsection