@extends('layout')


@section('pageSpecificStylesheet')
<link rel="stylesheet" type="text/css" href="{{ asset('css/create.css')}}" />
@endsection


@section('pageSpecificScript')
<script src="{{ asset('js/create.js') }}" defer></script>
@endsection

@section('title')
<title>Studio</title>
@endsection

@section('section')

<div class="container mt-5">
    <form action="{{ route('video.generate') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-lg-12 mt-4">
                <div class="card w-100 shadow-lg">
                    <div class="card-header bg-danger text-light shadow-sm pb-1 d-flex justify-content-between">Create New Video
                        <button class="btn btn-warning btn-sm pull-right cancel-button" type="button">Cancel</button>
                    </div>
                    <div class="card-body">
                        <button class="change btn btn-secondary btn-sm my-2 hide" onclick="">Change</button>
                        <div class="row">
                            <div class="col-lg-4 left-side" style="font-size:124px;text-align:center;border-right: 1px solid #aaa">
                                <label for="upload">
                                    <span class="uploader-tools">
                                        <i class="fas fa-upload"></i>
                                        <div style="font-size:20px;text-align:center; transform:translateY(-10px)">Choose a Video</div>
                                        <input type="file" name="video" id="upload" style="display: none;">
                                    </span>
                                </label>
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
                    <div class="card-body w-100 thum">
                        <div class="form-group finput">
                            <label for="thumbnail"> Select Video Thumbnail</label>
                            <input type="file" name="thumbnail[]" class="form-control-file" id="thumbnail" multiple>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="card shadow-lg">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="video-title">Video Title</label>
                            <input type="text" name="title" id="video_title" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="video-description">Write A short Description</label>
                            <textarea name="description" class="form-control" id="video-description" cols="30" rows="7" required></textarea>

                        </div>
                        <div class="form-group">
                            <label for="video-producer">Producer</label>
                            <input type="text" id="video-producer" name="producer" class="form-control" required>

                        </div>
                        <div class="form-group">
                            <label for="video-director">Director</label>
                            <input type="text" id="video-director" id="director" class="form-control" required>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="video-genre">Genre</label>
                                    <select name="genre" id="genre" class="form-control" required>
                                        <option value="">Choose</option>
                                        <option value="action">Action</option>
                                        <option value="comedy">Comedy</option>
                                        <option value="thriller">Thriller</option>
                                        <option value="romance">Romance</option>
                                        <option value="instructory">Instructory</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="video-genre">Type</label>
                                    <select name="type" id="type" class="form-control" required>
                                        <option value="">Choose</option>
                                        <option value="movie">Movie</option>
                                        <option value="clip">Clip</option>
                                        <option value="natok">Natok</option>
                                        <option value="telefilm">Telefilm</option>
                                        <option value="webseries">Web Series</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-2 ">
                                <div class="form-group ">
                                    <label for="">Status</label>
                                    <div class="custom-control custom-checkbox mr-sm-2 mt-2 ml-4 ">
                                        <input type="checkbox" name="public" class="custom-control-input" id="public" checked>
                                        <label class="custom-control-label" for="public"><span class="text-success p-p">Public</span></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-warning w-100 border shadow">Create</button>
                    </div>
                </div>
            </div>
        </div>
</div>
</form>
</div>

@endsection
