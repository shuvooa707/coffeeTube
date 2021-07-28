@extends('layout')


@section('pageSpecificStylesheet')
<link rel="stylesheet" type="text/css" href="{{ asset('css/favorites.css')}}" />
@endsection

@section('pageSpecificScript')
<script src="{{ asset('js/favorites.js') }}" defer></script>
@endsection


@section('title')
<title>♡ Favorites </title>
@endsection

@section('section')
<div class="container mt-5 pt-5">
    <form action="">
        @csrf
    </form>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">
                <a href="{{ route('profile') }}">Profile</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                <strong>
                    Favorites
                </strong>
            </li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-header bg-success text-light">
            <i class="fas fa-heart pr-2" style="font-size:24px"></i>
            Favorites
        </div>
        <div class="card-body">
            @if( $fvideos->count() )
            <div class="card">
                <div class="card-body py-2 d-flex justify-content-between" style="">
                    <strong class="badge p-2 text-secondary" style="font-size: 20px">
                        Total 
                        <i class="fas fa-egg px-1" style="font-size: 5px"></i>
                        {{ $fvideos->count() }}
                    </strong>
                    <a class="btn border-danger py-1 my-2" onclick="removeAll({{ '\'' . route('remove.favorites.all') . '\'' }})">Remove All</a>
                </div>
            </div>
            @endif
            <br>
            @foreach($fvideos as $fvideo)
            <div class="row p-2 my-2 shadow-sm fvideo">
                <div class="col-lg-2 ">
                    <img src="{{ url($fvideo->thumbnail) }}" class="img-thumbnail" alt="">
                </div>
                <div class="col-lg-9 text-dark" style="position: relative">
                    <a href="{{ route('playvideo') }}/{{ $fvideo->slug }}" class="text-dark">
                        {{ $fvideo->title }}
                    </a>
                    <div class="card-body p-0 pt-2 mt-2 text-secondary">
                        Saved At :
                        {{ $fvideo->created_at }}
                    </div>
                </div>
                <div class="col-lg-1 text-center">
                    <i class="fas fa-trash d-inline-block" title="Remove" style="cursor:pointer;" onclick="remove({{ $fvideo->id }}, this.parentElement.parentElement)"></i>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
