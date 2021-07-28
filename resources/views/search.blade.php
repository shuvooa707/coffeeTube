@extends('layout')


@section('title')
<title>
    Search
</title>
@endsection


@section('pageSpecificScript')
<script src="{{ asset('js/search.js') }}" defer></script>
@endsection


@section('section')

<div class="container pt-3 mt-5">
    <form action="{{ route('search') }}" method="get">
        <div class="row bg-light my-4 border border-success pt-2">
            <div class="col-lg-6 col-md-6 col-sm-8">
                <div class="form-group">
                    <label for="search">Keyword</label>
                    <input type="text" value="{{ request('q') }}" name="q" class="form-control" id="search" aria-describedby="emailHelp" placeholder="Search">
                </div>
            </div>

            <!-- @if( request()->type == 'genre' ) <h1> {{request()->type}} </h1>  @endif -->
            <div class="col-lg-3 col-md-3 col-sm-4">
                <div class="form-group">
                    <label for="type">Searching For </label>
                    <select class="form-control" name="type" id="type">
                        <option value="genre" @if( request()->type == 'genre' ) {{ 'selected' }} @endif>Genre</option>
                        <option value="title" @if( request()->type == 'title' ) {{ 'selected' }} @endif>Title</option>
                        <option value="any" @if( request()->type == 'any' ) {{ 'selected' }} @endif>Any</option>
                    </select>
                </div>
            </div>

            <div class="col-lg-3 col-md-3 col-sm-12">
                <div class="form-group">
                    <label for="submit">Search</label>
                    <button type="submit" id="submit" class="btn btn-success form-control">Search</button>
                </div>
            </div>

        </div>
    </form>

    <div class="row bg-light my-4 py-3  border border-success">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <span class="text-success">Query</span> = {{ $query }} | <span class="text-primary">Type</span> = {{ $type }}
                </div>
                <div class="card-body">
                    @foreach( $searchResult as $video )
                    <div class="card my-2">
                        <div class="card-body py-2">
                            <a href="{{ route('playvideo') }}/{{ $video->slug }}">
                                {{ $video->title }}
                            </a>
                            <small class="form-text text-dark  text-decoration-none">
                                @can('viewAny',App\User::class)
                                <a href="{{ route('video.edit', ['vid'=>$video->id]) }}" class="fas fa-pen text-dark"></a>
                                <a href="{{ route('video.delete', ['vid'=>$video->id]) }}" class="fas fa-trash px-2 text-danger"></a>
                                @endcan
                                <span class="font-weight-bold">Genre :</span> {{ $video->genre }} | <span class="font-weight-bold">Released At :</span> {{ $video->release_date }}
                            </small>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@endsection('section')
