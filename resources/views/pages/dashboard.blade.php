@extends('layouts.app')

@section('content')
<div class="container">
    <ul class="nav nav-pills mb-3 justify-content-center" id="pills-tab" role="tablist">
        <li class="nav-item mx-3">
            <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true"><div class="display-4"> All Posts </div> </a>
        </li>
        @if(Auth::check())
            <li class="nav-item mx-3">
                <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false"><div class="display-4"> Profile </div></a>
            </li>
        @endif
    </ul>

    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
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
    
            @foreach ($posts as $post)
                <div class="w-100 mdl-card mdl-shadow--2dp my-3">
                    <div class="mdl-card__title mdl-card--expand">
                        <h2 class="mdl-card__title-text">{{$post->title}}</h2>
                    </div>
                    <div class="mdl-card__supporting-text">
                        {{$post->description}}
                    </div>
                    <div class="mdl-card__actions mdl-card--border">
                        <a href="{{url('/'.$selected_university.'/'.$selected_department.'/'.$selected_course.'/dashboard/download/'.$post->url)}}" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect float-right">
                            {{-- {!! link_to( route('getFile', $attach->filename) . '/' . $attach->file_name, $attach->file_name) !!} --}}
                            <b>View</b>
                        </a>
                        <div>
                            <a href="#" class="btn btn-xs btn-warning like">{{ Auth::user()->likes()->where('post_id', $post->id)->first() ? Auth::user()->likes()->where('post_id', $post->id)->first()->like == 1 ? 'You like this post' : 'Like' : 'Like'  }} </a>  |
                            <a href="#" class="btn btn-xs btn-danger like">{{ Auth::user()->likes()->where('post_id', $post->id)->first() ? Auth::user()->likes()->where('post_id', $post->id)->first()->like == 0 ? 'You dont like this post' : 'Dislike' : 'Dislike'  }} </a>
                        </div>
                    </div>
                </div>
            @endforeach 
        </div>

        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <h2 class="display-4 text-center mt-4 p-4" style="background-color: #3aafa933"> Detail </h2>
                    <div class="mdl-card mdl-shadow--2dp my-3 w-100">
                        <div class="mdl-textfield mdl-js-textfield w-100">
                            <h4 class="text-center mt-5">Username : {{ Auth::user()->name }}</h4>
                            <h4 class="text-center mt-5">University : {{ Auth::user()->university }}</h4>
                            <h4 class="text-center mt-5">Post Submitted : {{ DB::table('post')->where('uploader_id', Auth::user()->id)->count() }}</h4>
                            <h4 class="text-center mt-5">Points Earned : {{ Auth::user()->points }}</h4>
                        </div>
                        
                    </div>

                    @foreach ($uploader_posts as $cu_post)
                        <div class="w-100 mdl-card mdl-shadow--2dp my-3">
                        <div class="mdl-card__title mdl-card--expand">
                            <h2 class="mdl-card__title-text">{{$cu_post->title}}</h2>
                        </div>
                        <div class="mdl-card__supporting-text">
                            {{$cu_post->description}}
                        </div>
                        <div class="mdl-card__actions mdl-card--border">
                            <a href="{{url('storage/postfiles/'.$cu_post->url)}}" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect float-right">
                            <b>View</b>
                            </a>
                            
                        </div>
                        </div>
                    @endforeach 

                </div>
                <div class="col-md-4 justify-content-start">
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
                    <h2 class="display-4 text-center mt-5">  </h2>
                </div>
            </div>
        </div>
    </div>

</div>            


@endsection