@extends('layout')



@section('pageSpecificStylesheet')
<link rel="stylesheet" type="text/css" href="{{ asset('css/play.css')}}" />
@endsection

<!-- <script src="https://vjs.zencdn.net/ie8/1.1.2/videojs-ie8.min.js" defer></script> -->

@section('pageSpecificScript')
<script src="{{ asset('js/play.js') }}" defer></script>
@endsection




@section('title')
<title>{{ $video->title }}</title>
@endsection


@section('section')

<form action="">
    @csrf
</form>
<div class="container-fluid play-body" style="padding:0px 200px; padding-top:50px;">
    <div class="row justify-content-center mt-5">
        <div class="col-lg-12 col-md-12">
            <div class="row justify-content-between">
                <div class="col-lg-8 col-sm-12">
                    <video src="{{ url($video->videoPath) }}" poster="{{ url($video->thumbnail) }}" id="my-video" data-id="{{ $video->id }}" class="shadow-lg video-js" controls preload="auto" width="100%" height="auto" data-setup="{}">
                        <p class="vjs-no-js">
                            To view this video please enable JavaScript, and consider upgrading to a
                            web browser that
                            <a href="https://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
                        </p>
                    </video>
                    <div class="row py-3 rounded">
                        <div class="col-lg-12">
                            <div class="card rounded shadow-sm">
                                <div class="card-body rounded p-3 bg-light">
                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 col-sm-3" style="">
                                            <img src="{{ asset($video->thumbnail) }}" width="160px; height:180px;" class="card-img-left mr-2" alt="...">
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                            <h6>
                                                {{ $video->title }}
                                            </h6>
                                            <small>
                                                Director: {{ $video->director }}
                                            </small> <br>
                                            <small>
                                                Released on {{ $video->release_date }}
                                            </small> <br>
                                            <span class="tag">
                                                <a href="{{ route('search',['q'=>$video->genre]) }}&type=genre">
                                                    {{ $video->genre }}
                                                </a>
                                            </span>
                                        </div>

                                        <div class="col-lg-3 pl-0 text-right like-box" style="position: relative">
                                            <div class="likebar my-1">
                                                <div class="like d-inline-block bg-success" style="width:{{ $video->likeCount() }}%"></div>
                                                <div class="dislike d-inline-block bg-danger" style="width:{{ 100-$video->likeCount() }}%"></div>
                                            </div>
                                            @auth()
                                            <button class="btn btn-sm border p-1 px-2 rounded border-success text-success {{ $liked ? 'liked' : '' }}" onclick="likeVideo({{$video->id}},this)">like</button>
                                            <button class="btn btn-sm border p-1 rounded border-danger text-danger {{ $disliked ? 'disliked' : '' }}" onclick="dislikeVideo({{$video->id}},this)">dislike</button>
                                            @endauth
                                            <div class="views" style="position: absolute; bottom:5px;right:15px">
                                                @auth()
                                                <i class="fas fa-heart pr-3 saveButton {{ $isSaved ? 'saved' : '' }}" title="Save" style="color:#ccc;cursor:pointer" onclick="savevideo({{ $video->id }}, this)"></i>
                                                @endauth
                                                <!-- <i class="fas fa-eye"></i> 1,928,918 -->
                                            </div>
                                        </div>
                                    </div>
                                    @can( "userCanEditThisVideo", $video->id )
                                    <div class="row mt-2 pt-3 pl-2" style="border-top:1px solid #ddd;">
                                        <button class="btn btn-secondary">
                                            Edit
                                            <i class="fas fa-pen ml-2" style="font-size:16px"></i>
                                        </button>
                                        <button class="btn btn-info">
                                            Stats
                                            <i class="fas fa-poll ml-2" style="font-size:16px"></i>
                                        </button>
                                    </div>
                                    @endcan
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Comments Section -->
                    <div class="row comment-section">
                        <div class="col-lg-12">
                            <div class="card shadow-sm">
                                <div class="card-body pt-2">
                                    Comments
                                    <i class="fas fa-egg ml-1" style="font-size: 1px"></i>
                                    <strong class="ml-1 comment-count" data-count="{{ $video->comments->count() }}">{{ $video->comments->count() }}</strong>
                                    <div class="form-group my-2 commentor-box">
                                        @csrf
                                        <textarea name="comment" id="commentBox" placeholder="Share Your Opinion..." class="form-control bg-light"></textarea>
                                        <div class="text-right">
                                            <input type="button" value="Shoot" class="btn btn-dark btn-sm d-inline mt-2 px-5 pull-right" onclick="shoot(this)">
                                        </div>
                                    </div>
                                    <div class="card mt-5" style="border:unset;">
                                        <div class="card-body p-1 comment-list">
                                            @foreach($video->comments as $comment)
                                            <!-- Single Comment -->
                                            <div class="card" data-id="{{ $comment->id }}">
                                                <div class="card-body p-2 py-4 rounded comment" style="font-size: 14px; line-height:17px;">
                                                    <div class="row m-0 p-0">
                                                        <div class="col-lg-9 border rounded m-0 p-2 shadow comment-side ">
                                                            {{ $comment->content }}
                                                            @if( Auth::check() && auth()->user()->id )
                                                            <i class="fas fa-bars text-dark" style="position:absolute;right:5px;top:5px;"></i>
                                                            @endif
                                                        </div>
                                                        <div class="col-lg-3 m-0 p-0 text-center commentor-side">
                                                            <span class="d-inline-block py-2 rounded border border-secondary">
                                                                @if( $comment->user->profilepic )
                                                                <img src="../../{{ $comment->user->profilepic }}" class="img img-round rounded shadow d-inline-block" alt="..." style="border-radius: 50%;width: 50px;height: 50px;">
                                                                @else
                                                                <i class="fas fa-user"></i>
                                                                @endif
                                                                <div class="caption d-inline-block w-100" style="max-height:20px;overflow:hidden">{{ $comment->user->name }}</div>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /Single Comment -->
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Comments /Section -->
                </div>

                <!-- Recommended Videos -->
                <div class="col-lg-4 col-md-4 col-sm-12 bg-light rc-videos">
                    <h6 class="pt-3" style="color:#6a3">
                        <i class="fas fa-laptop mr-2"></i>
                        Recommended for you
                    </h6>
                    <hr>
                    @foreach($rvideos as $rvideo)
                    <div class="card my-2 shadow">
                        <div class="card-body p-0" style="max-height: 150px; overflow:hidden;">
                            <div class="row m-0 p-0">
                                <div class="col-lg-5 m-0 p-0">
                                    <a href="{{ route('playvideo') }}/{{ $rvideo->slug }}">
                                        <img src="{{ url($rvideo->thumbnail) }}" style="width: 153px;height:92px;" class="card-img-left mr-2" alt="...">
                                        <span class="duration" style="opacity:.8;position: absolute;top:5px;left:5px;z-index:10101;font-size:14px;color:white;text-shadow:0px 0px 5px #aaa;">
                                            10:10
                                        </span>
                                    </a>
                                </div>
                                <div class="col-lg-7 m-0 p-0 p-2" style="line-height: 1px">
                                    <a href="{{ route('playvideo') }}/{{ $rvideo->slug }}">
                                        <strong class="text-dark" style="font-size: 15px;line-height: 1.22857;">
                                            {{ substr($rvideo->title,0,42) }}{{ strlen($rvideo->title) > 42 ? "....." : "" }}
                                        </strong>
                                    </a>
                                    <br>
                                    <br>
                                    @auth()
                                    <small style="position:absolute;bottom:3px;right:0px; font-size: 13px;line-height: 1.42857;">
                                        <i class="fas fa-heart pr-3 saveButton {{ $rvideo->issaved ? 'saved' : '' }}" title="Save" style="color:#ccc;cursor:pointer" onclick="savevideo({{ $rvideo->id }}, this)"></i>
                                    </small>
                                    @endauth
                                    <small style="position:absolute;bottom:3px; left:10px; font-size: 13px;line-height: 1.42857;">
                                        {{ $rvideo->views }}
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <!-- /Recommended Videos -->

            </div>
        </div>
    </div>
</div>






@endsection('section')
