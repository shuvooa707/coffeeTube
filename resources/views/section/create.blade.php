@extends('layout')


@section('pageSpecificStylesheet')
<link rel="stylesheet" type="text/css" href="{{ asset('css/createsection.css')}}" />
@endsection

@section('pageSpecificScript')
<script src="{{ asset('js/createsection.js') }}" defer></script>
@endsection


@section('title')
<title>Edit Section</title>
@endsection



@section('section')

<form action="{{ route('section.create.save') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="container pt-3 mt-5">
        <div class="row my-3">
            <div class="col-lg-12 text-right">
                <button class="btn btn-success shadow d-inline-block px-5" type="submit">Create</button>
                <a href="{{ route('sections') }}" class="btn btn-danger ml-4 shadow d-inline-block px-5">
                    Cancel
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 bg-light p-3 shadow">
                <div class="form-group">
                    <label for="">Title</label>
                    <input type="text" name="name" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Description</label>
                    <textarea name="description" id="description" class="form-control"></textarea>
                </div>
            </div>
        </div>
        <div class="row">
            <input type="hidden" name="videos" value="[]">
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

                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
