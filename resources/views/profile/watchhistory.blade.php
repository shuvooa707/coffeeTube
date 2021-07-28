@extends('layout')


@section('pageSpecificStylesheet')
<link rel="stylesheet" type="text/css" href="{{ asset('css/history.css')}}" />
@endsection

@section('pageSpecificScript')
<script src="{{ asset('js/favorites.js') }}" defer></script>
@endsection


@section('title')
<title>Watch History </title>
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
                    History
                </strong>
            </li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-header bg-success text-light">
            <i class="fas fa-tv pr-2" style="font-size:24px"></i>
            History
        </div>
        <div class="card-body">
            @foreach($hvideos as $hvideo)
            <div class="row p-2 my-2 shadow-sm hvideo">
                <div class="col-lg-2 ">
                    <img src="{{ url($hvideo->thumbnail) }}" class="img-thumbnail" alt="">
                </div>
                <div class="col-lg-9 text-dark" style="position: relative">
                    <a href="{{ route('playvideo') }}/{{ $hvideo->slug }}" class="text-dark d-block">
                        {{ $hvideo->title }}
                    </a>
                    <span class="tag border border-primary">
                        <a href="{{ route('search',['q'=>$hvideo->genre]) }}&type=genre">
                            {{ $hvideo->genre }}
                        </a>
                    </span>

                    <span class="tag border border-primary">
                        <a href="">
                            {{ $hvideo->director }}
                        </a>
                    </span>

                    <span class="tag border border-primary">
                        <a href="">
                            {{ $hvideo->producer }}
                        </a>
                    </span>

                    <span class="tag border border-primary">
                        <a href="">
                            {{ $hvideo->rating }}
                            <i class="fas fa-star" style="color: gold;"></i>
                        </a>
                    </span>

                    <div class="card-body p-0 pt-2 mt-2 text-secondary">
                        <kbd class="mx-2">
                            Watched At :
                        </kbd>
                        <kbd>
                            {{ $hvideo->created_at }}
                        </kbd>
                    </div>
                </div>
                <div class="col-lg-1 text-center">
                    <i class="fas fa-trash d-inline-block" title="Remove" style="cursor:pointer;" onclick="remove({{ $hvideo->id }}, this.parentElement.parentElement)"></i>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
