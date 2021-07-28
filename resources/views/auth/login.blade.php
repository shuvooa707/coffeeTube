@extends('layout')

@section('title')
<title>Login</title>
@endsection


@section("section")

<div class="container mt-5">
    <div class="row mt-5">
        <div class="col-lg-5 mt-5">
            <div class="card shadow-lg">
                <div class="card-header bg-success text-light">
                    Login
                    <i class="fas fa-key ml-2"></i>
                </div>
                <div class="card-body">
                    <form action="{{ route('attemptLogin') }}" method="post">
                        @csrf
                        <!-- <input type="hidden" name="redirectToPage" value="" > -->
                        <div class="form-group">
                            <label for="#username">User Name</label>
                            <input type="text" class="form-control form-control-sm" name="username" id="username" placeholder="@Username">
                        </div>
                        <div class="form-group">
                            <label for="#password">Password</label>
                            <input type="password" class="form-control form-control-sm" name="password" id="password" placeholder="password">
                        </div>
                        <button type="submit" class="btn btn-success btn-sm d-block w-100 ">
                            <i class="fas fa-sign-in-alt mr-2 py-2"></i>
                            Loign
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-6 mt-5">
            <div class="card">
                <div class="card-body shadow text-center text-muted">
                    <h3 class="py-4 border-bottom">
                        <i class="fas fa-users mb-2 text-dark " style="font-size: 97px"></i>
                        <br>
                        ...be a <strong class="text-info font-italic" style="font-family: Segoe Script;">Member</strong>
                    </h3>
                    <br>
                    <a href="{{ route('register') }}">
                        <button class="btn btn-info py-2 d-block w-100">
                            <i class="fas fa-users"></i>
                            Sign Up
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
