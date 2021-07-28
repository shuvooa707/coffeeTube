@extends('layout')


@section('pageSpecificStylesheet')
<link rel="stylesheet" type="text/css" href="{{ asset('css/videolist.css')}}" />
@endsection


@section('pageSpecificScript')
<script src="{{ asset('js/videolist.js') }}" defer></script>
@endsection


@section('title')
<title>{{ request()->get('what') }}</title>
@endsection



@section('section')
<div class="container mt-5 pt-5 px-0">

    <nav aria-label="breadcrumb mb-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="/">
                    Home
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                <a href="{{ route('sections') }}">
                    Sections
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                {{ $section->name }}
            </li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-lg-3">
            <div class="card">
                <div class="card-header p-3 bg-success text-light">
                    {{ $section->name }}
                </div>
                <div class="card-body p-3">
                    {{ $section->description }}
                </div>
            </div>
        </div>
        <div class="col-lg-9">
            <div class="row bg-light py-4 border justify-content-around">
                @foreach($videos as $video)
                <div class="col-lg-3 m-1 p-0 border mb-3">
                    <a href="{{ route('playvideo') }}/{{$video->slug}}">
                        <div class="card w-100 " style="border:none;">
                            <img src="../{{ $video->thumbnail }}" class="card-img-top" alt="..." height="150px">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <a href="{{ route('playvideo') }}/{{$video->slug}}">{{ $video->title }}</a>
                                </h5>
                                <h6 class="badge badge-warning text-dark">{{ $video->rating }}</h6>
                                <p class="">{{ $video->description }}</p>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>

</div>
@endsection
