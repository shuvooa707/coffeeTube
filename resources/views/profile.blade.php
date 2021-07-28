@extends('layout')


@section('pageSpecificStylesheet')
<link rel="stylesheet" type="text/css" href="{{ asset('css/profile.css')}}" />
@endsection

@section('pageSpecificScript')
<script src="{{ asset('js/profile.js') }}" defer></script>
@endsection


@section('title')
<title>{{ auth()->user()->name }}</title>
@endsection

@section('section')
<div class="container mt-5">
    @if( $user->profilepic )
    <div class="picshow hide">
        <i class="fas fa-window-close text-light"></i>
        <img src="../{{ $user->profilepic }}" alt="">
    </div>
    @endif

    <div class="row pt-5">
        <div class="col-lg-3 mb-md-2">
            <div class="card" style="background: none;border: none;">
                <div class="card-body text-center" style="font-weight: 48px">
                    @if( $user->profilepic )
                    <img src="../{{ $user->profilepic }}" class="propic" alt="" style="width:190px;height:190px;border-radius: 10px!important;box-shadow: 0px 0px 10px #ccc;">
                    @else
                    <i class="fas fa-user-circle avatar" style="font-weight: 48px"></i>
                    @endif
                </div>
            </div>
            <div class="card mt-3" style="border: none;background:none;">
                <div class="card-body py-2" style="background: transparent; text-align:center">
                    <a href="{{ route('profile.edit',['pid'=> $user->id ]) }}" title="Edit Profile" class="btn btn-sm border " style="background:white;">
                        <i class="fas fa-edit text-primary"></i>
                    </a>
                    <a href="{{ route('profile.delete',['pid'=> $user->id ]) }}" title="Delete Profile" class="btn btn-sm border" style="background:white;">
                        <i class="fas fa-trash-alt text-danger"></i>
                    </a>
                    <a href="{{ route('profile.lock',['pid'=> $user->id ]) }}" title="Lock Profile" class="btn btn-sm border" style="background:white;">
                        <i class="fas fa-unlock text-success"></i>
                    </a>
                </div>
            </div>
            <div class="card saved-videos">
                <div class="card-body px-2 py-2 bg-light">
                    <a href="{{ route('videos.favorites') }}" class="d-block pl-2 py-2 text-dark" style="border-bottom: 1px dotted #ccc;">
                        <i class="fas fa-heart mr-2" style="color:gold;cursor:pointer;"></i>
                        Favorites
                    </a>
                    <a href="{{ route('videos.history') }}" class="d-block pl-2 py-2 text-dark">
                        <i class="fas fa-video mr-2" style="color:lightcoral;cursor:pointer;"></i>
                        Watch History
                    </a>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <div class="alert bg-light py-1 border border-success">
                        <strong>Name</strong> : {{ $user->name }}
                    </div>
                    <div class="alert bg-light py-1 border border-success">
                        <strong>Age</strong> : {{ $user->age }}
                    </div>
                    <div class="alert bg-light py-1 border border-success">
                        <strong>ID</strong> : {{ $user->id }}
                    </div>
                    <div class="alert bg-light py-1 border border-success">
                        <strong>Username</strong> : {{ $user->username }}
                    </div>
                    <div class="alert bg-light py-1 border border-success">
                        <strong>Email</strong> : {{ $user->email }}
                    </div>
                    <div class="alert bg-light py-1 border border-success">
                        <strong>Gender</strong> : {{ $user->gender }}
                    </div>
                    <div class="alert bg-light py-1 border border-success">
                        <strong>Joined</strong> At : {{ $user->joined }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
