@extends('layout')

@section("section")

<div class="container mt-5 pt-5">
    <div class="row">
        <div class="col-lg-12 bg-light border p-4">
            <form action="" method="post">
                @csrf

                <div class="form-group">
                    <label for="name">Name : </label>
                    <input type="text" name="name" class="form-control {{ old('name')?'border-danger' : '' }}" id="name" value="{{ old('name') }}">
                    @error('name')
                    <div class="invalid-feedback" style="display: block;font-weight:bold;transform:translate(5px,-5px);">
                        Name Not Valid
                    </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="age">Age : </label>
                    <input type="text" name="age" class="form-control" id="age" value="{{ old('age') }}">
                    @error('age')
                    <div class="invalid-feedback" style="display: block;font-weight:bold;transform:translate(5px,-5px);">
                        Age Not Valid
                    </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="name">Gender : </label>
                    <select name="gender" class="form-control" id="gender">
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-primary form-control" value="test">
                </div>
            </form>
        </div>
    </div>
</div>



@endsection










<!--  -->
