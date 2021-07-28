@extends('layout')


@section('pageSpecificStylesheet')
<link rel="stylesheet" type="text/css" href="{{ asset('css/register.css')}}" />
@endsection

@section('pageSpecificScript')
<script src="{{ asset('js/register.js') }}" defer></script>
@endsection


@section('title')
<title>Register</title>
@endsection



@section("section")
<div class="container pt-5 mt-5">
    <div class="row justify-content-around">
        <div class="col-lg-6">
            <div class="card shadow-lg">
                <div class="card-header">Register</div>
                <div class="card-body pt-0">
                    <div class="col-lg-12">
                        <form action="{{ route('saveNewUserRegistration') }}" class="form" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12 text-center pt-0 thumc" style="font-size: 180px;cursor:pointer;">
                                    <label for="profileThum">
                                        <i class="fas fa-user-circle" style="cursor:pointer;"></i>
                                    </label>
                                    <input type="file" class="hide" name="profileThum" id="profileThum">
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-lg-6">
                                    <div class="from-group">
                                        <label for="#firstname" class="mb-1">First Name : </label>
                                        <input value="{{ old('firstname') }}" type="text" id="firstname" name="firstname" placeholder="Enter First Name" class="form-control form-control-sm">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="from-group">
                                        <label for="#lastname" class="mb-1">First Name : </label>
                                        <input type="text" id="lastname" name="lastname" placeholder="Enter Last Name" class="form-control form-control-sm">
                                    </div>
                                </div>
                            </div>


                            <div class="row mt-3">
                                <div class="col-lg-12">
                                    <div class="from-group">
                                        <label for="username" class="mb-1">User Name : </label>
                                        <input type="text" id="username" name="username" placeholder="Choose A Username" class="form-control form-control-sm">
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="#age" class="mb-1">Age</label>
                                        <input type="number" name="age" id="age" class="form-control form-control-sm">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label for="#gender" class="mb-1">Genger</label>
                                    <select id="gender" name="gender" class="form-control form-control-sm">
                                        <option>Choose...</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="#email" class="mb-1">Email</label>
                                        <input type="email" name="email" id="email" class="form-control form-control-sm">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="#password" class="mb-1">Password</label>
                                        <input type="password" name="password" id="password" class="form-control form-control-sm">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="#repassword" class="mb-1">ReType Password</label>
                                        <input type="password" name="repassword" id="repassword" class="form-control form-control-sm">
                                    </div>
                                </div>
                            </div>

                            <input type="submit" value="Register" class="btn btn-info btn-sm d-block w-100">
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow-lg">
                <div class="card-header bg-light">
                    Login
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="#username">User Name</label>
                            <input type="text" class="form-control form-control-sm" name="username" id="username" placeholder="@Username">
                        </div>
                        <div class="form-group">
                            <label for="#password">Password</label>
                            <input type="password" class="form-control form-control-sm" name="password" id="password" placeholder="password">
                        </div>
                        <input type="submit" class="btn btn-success btn-sm d-block w-100 " value="Login">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
