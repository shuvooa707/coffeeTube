@extends('layout')


@section('pageSpecificStylesheet')
<link rel="stylesheet" type="text/css" href="{{ asset('css/editsection.css')}}" />
@endsection

@section('pageSpecificScript')
<script src="{{ asset('js/editsection.js') }}" defer></script>
@endsection


@section('title')
<title>Edit Section</title>
@endsection



@section('section')

<form action="{{ route('section.update.save') }}" method="post">
    @csrf
    <div class="container pt-3 mt-5">
        <div class="row my-3">
            <div class="col-lg-12 text-right">
                <button class="btn btn-success shadow d-inline-block px-5" type="submit">Update</button>
                <button class="btn btn-danger ml-4 shadow d-inline-block px-5" onclick="window.event.preventDefault();history.back()">Cancel</button>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 bg-light p-3 shadow">
                <div class="form-group">
                    <label for="">Title</label>
                    <input type="text" name="name" class="form-control" value="{{ $section->name }}">
                </div>
                <div class="form-group">
                    <label for="">Description</label>
                    <textarea name="description" id="description" class="form-control">
                    {{ $section->description }}
                    </textarea>
                </div>
            </div>
        </div>
        <div class="row">
            <input type="hidden" name="videos" value='{{ json_encode($section->getAllSectionVideoIds()) }}'>
            <input type="hidden" name="sid" value='{{ $section->id }}'>
            <div class="col-lg-12 p-0 bg-dark">
                <div class="card" style="border-radius: unset!important">
                    <div class="card-header bg-secondary text-light w-100">
                        Add Video
                    </div>
                    <div class="card-body bg-light text-light">
                        <div class="form-group">
                            <input type="text" class="form-control search-field" oninput="find(this.value)" placeholder="Search Video">
                            <div class="search-result hide shadow">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="card" style="border-radius: unset!important">
                    <div class="card-body bg-dark seleted-video-list">
                        @foreach($section->videos as $video)
                        <div class='selected' data-id="{{ $video->id }}">
                            <div class="row m-0 p-0">
                                <div class="col-lg-1 px-0">
                                    <span class="badge badge-secondary text-white">1</span>
                                </div>
                                <div class="col-lg-3  pl-0">
                                    {{ $video->title }}
                                </div>

                                <div class="col-lg-2  px-0">
                                    {{ $video->genre }}
                                </div>

                                <div class="col-lg-2  px-0">
                                    {{ $video->length }}
                                </div>

                                <div class="col-lg-2  px-0">
                                    {{ $video->producer }}
                                </div>

                                <div class="col-lg-1  px-0">
                                    {{ $video->director }}
                                </div>
                                <div class="col-lg-1  px-0">
                                    <a href="{{ route('video.edit',['vid'=>$video->id])}}" targer="_blank">
                                        <i class='fas fa-pen text-dark' style='posistion:absolute;right:15px;'></i>
                                    </a>
                                    <i class='fas fa-trash mx-3 text-danger' style='posistion:absolute;right:15px;' onclick="unselect(this.parentElement.parentElement.parentElement, {{ $video->id }})"></i>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
