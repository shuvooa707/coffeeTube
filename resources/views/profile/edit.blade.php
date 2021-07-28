@extends('layout')


@section('pageSpecificStylesheet')
<link rel="stylesheet" type="text/css" href="{{ asset('css/editprofile.css')}}" />
@endsection

@section('pageSpecificScript')
<script src="{{ asset('js/editprofile.js') }}" defer></script>
@endsection


@section('title')
<title>Edit Profile</title>
@endsection

@section('section')

<form action="{{ route('profile.edit.save') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="container mt-5 pt-5">
        <div class="row">
            <div class="col-lg-4 mb-md-2">
                <div class="card">
                    <div class="card-body text-center propic" style="font-weight: 48px">
                        <label for="profilepic" class="finput">
                            @if( $user->profilepic )
                            <img src="../../{{ $user->profilepic }}" class="w-100" alt="">
                            @else
                            <i class="fas fa-camera-retro avatar" style="font-weight: 48px"></i>
                            @endif
                        </label>
                        <input type="file" name="profilepic" class="form-control-file hide" id="profilepic" />
                    </div>
                </div>
                <div class="card mt-3">
                    <div class="card-body py-2">
                        <button type="submit" title="Edit Profile" class="btn btn-success border px-4">
                            Save <i class="fas fa-save text-light pl-2"></i>
                        </button>
                        <a href="" title="Delete Profile" class="btn btn-danger border px-4">
                            Cancel <i class="fas fa-trash-alt text-light pl-1"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">

                        <div class="input-group mb-3 mr-sm-2 ">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Full Name</div>
                            </div>
                            <input type="text" name="name" value="{{ $user->name }}" class="form-control" id="name" placeholder="Full Name">
                        </div>


                        <div class="input-group mb-3 mr-sm-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Age</div>
                            </div>
                            <input type="text" name="age" value="{{ $user->age }}" class="form-control" id="age" placeholder="Age">
                        </div>

                        <div class="input-group mb-3 mr-sm-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Username</div>
                            </div>
                            <input type="text" name="username" value="{{ $user->username }}" class="form-control" id="username" placeholder="username">
                        </div>


                        <div class="input-group mb-3 mr-sm-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Email</div>
                            </div>
                            <input type="text" name="email" value="{{ $user->email }}" class="form-control" id="email" placeholder="Email">
                        </div>

                        <div class="input-group mb-3 mr-sm-2">
                            <select class="custom-select my-1 mr-sm-2" name="gender" id="gender">
                                @if( $user->gender == "male" )
                                <option value="male" selected>Male</option>
                                <option value="female">Female</option>
                                @else
                                <option value="male">Male</option>
                                <option value="female" selected>Female</option>
                                @endif

                            </select>
                        </div>

                        <div class="input-group mb-3 mr-sm-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Passowrd</div>
                            </div>
                            <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</form>

@endsection
