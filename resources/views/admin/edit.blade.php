@extends('layout')


@section('pageSpecificStylesheet')
<link rel="stylesheet" type="text/css" href="{{ asset('css/create.css')}}" />
@endsection


@section('pageSpecificScript')
<script src="{{ asset('js/edit.js') }}" defer></script>
@endsection


@section('section')

<div class="container mt-5 pt-4">
    <form action="{{ route('video.saveedited') }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{ $video->id }}">
        <div class="row">
            <div class="col-lg-12">
                <div class="card w-100 shadow-lg">
                    <div class="card-header bg-danger text-light shadow-sm pb-1 d-flex justify-content-between">Create New Video
                        <button class="btn btn-warning btn-sm pull-right cancel-button" type="button" onclick="cancel()">cancel</button>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-4 left-side" style="font-size:124px;text-align:center;border-right: 1px solid #aaa">
                                <video style="width:320px; height:240px; outline:none;" controls="" src="../{{ $video->videoPath }}"></video>
                            </div>

                            <div class="col-lg-8 right-side">
                                <h6 class="video-title">

                                </h6>
                                <h6 class="video-size">

                                </h6>
                                <h6 class="video-format">

                                </h6>
                                <h6 class="video-duration">

                                </h6>
                                <h6 class="video-dimention">

                                </h6>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>



        <div class="row mt-2">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body w-100">
                        <div class="form-group">
                            <label for="thumbnail"> Select Video Thumbnail</label>
                            <input type="file" name="thumbnail" class="form-control-file" id="thumbnail">
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="card shadow-lg">
                    <div class="card-body">
                        <input type="hidden" name="id" value="{{ $video->id }}">
                        <div class="form-group">
                            <label for="video-title">Video Title</label>
                            <input type="text" name="title" id="video-title" value="{{ $video->title }}" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="video-description">Write A short Description</label>
                            <textarea name="description" class="form-control" id="video-description" cols="30" rows="7" required>
                            {{ $video->description }}
                            </textarea>

                        </div>
                        <div class="form-group">
                            <label for="video-producer">Producer</label>
                            <input type="text" value="{{ $video->producer }}" id="producer" class="form-control" required>

                        </div>
                        <div class="form-group">
                            <label for="video-director">Director</label>
                            <input type="text" value="{{ $video->director }}" id="video-director" name="director" class="form-control" required>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="video-genre">Genre</label>
                                    <select name="genre" id="genre" class="form-control" required>
                                        <option value="">Choose...</option>
                                        @foreach( ["action","comedy","thriller","romance"] as $genre )
                                        @if( $genre == $video->genre )
                                        <option value="{{ $video->genre }}" selected>{{ ucfirst($video->genre) }}</option>
                                        @else
                                        <option value="{{ $video->genre }}">{{ ucfirst($video->genre) }}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="video-genre">Type</label>
                                    <select name="type" id="type" class="form-control" required>
                                        <option value="">Choose</option>
                                        @foreach( ["movie","natok","telefilm","webseries"] as $type )
                                        @if( $type == $video->type )
                                        <option value="{{ $type }}" selected>{{ ucfirst($type) }}</option>
                                        @else
                                        <option value="{{ $type }}">{{ ucfirst($type) }}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-2 ">
                                <div class="form-group ">
                                    <label for="">Status</label>
                                    <div class="custom-control custom-checkbox mr-sm-2 mt-2 ml-4 ">
                                        <input type="checkbox" name="public" class="custom-control-input" id="public" @if($video->public) {{ 'checked' }} @endif>
                                        <label class="custom-control-label" for="public"><span class="text-@if($video->public){{ 'success' }}@else{{'danger'}} @endif p-p"> @if($video->public) {{ 'Public' }} @else {{'Private'}} @endif</span></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 border shadow text-light " style="">Update</button>
                    </div>
                </div>
            </div>
        </div>
</div>
</form>
</div>

@endsection
