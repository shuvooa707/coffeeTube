@extends('layout')


@section('pageSpecificStylesheet')
<link rel="stylesheet" type="text/css" href="{{ asset('css/sectionshow.css')}}" />
@endsection

@section('pageSpecificScript')
<script src="{{ asset('js/sectionshow.js') }}" defer></script>
@endsection


@section('title')
<title>{{ $section->name }}</title>
@endsection



@section('section')

<div class="container pt-5 mt-5">
    <form>
        @csrf
    </form>
    @can('viewAny',App\User::class)
    <nav aria-label="breadcrumb mb-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="/" class="text-success">
                    Home
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                <a href="{{ route('dashboard') }}" class="text-success">
                    Dashboard
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                <a href="{{ route('sections') }}" class="text-success">
                    Sections
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                {{ $section->name }}
            </li>
        </ol>
    </nav>
    @endcan

    <div class="row">
        <div class="col-lg-12 p-3 shadow">
            @can('viewAny',App\User::class)
            <a href="{{ route('section.edit', ['sid'=>$section->id]) }}" class="edit" style="position: absolute; top:5px; right:5px;">
                <i class="fas fa-edit ml-2" style="font-size: 24px"></i>
            </a>
            @endcan
            <h2>
                {{ $section->name }}
            </h2>
            <h6 class="ml-2">
                Total @if(count($section->videos)>1) Videos @else Video @endif : <span class="" style="color: #aaa;">{{ count($section->videos) }}</span>
            </h6>
            <h6 class="ml-2">
                Creator : <a href="{{ route('user') }}/{{$section->creator()->id}}" class="" style="">{{ $section->creator()->name }}</a>
            </h6>
            <h6 class="ml-2">
                Created At : <span class="" style="color: #aaa;">{{ $section->time() }}</span>
            </h6>
        </div>
    </div>
    <div class="row mt-5 p-0">
        @foreach($section->videos as $rvideo )
        <div class="col-lg-4">
            <div class="card my-2 shadow">
                <div class="card-body p-0" style="max-height: 150px; overflow:hidden;">
                    <div class="row m-0 p-0">
                        <div class="col-lg-5 m-0 p-0">
                            <a href="{{ route('playvideo') }}/{{ $rvideo->slug }}">
                                <img src="{{ url($rvideo->thumbnail) }}" style="width: 153px;height:92px;" class="card-img-left mr-2" alt="...">
                                <span class="duration" style="opacity:.8;position: absolute;top:5px;left:5px;z-index:10101;font-size:14px;color:white;text-shadow:0px 0px 5px #aaa;">
                                    10:10
                                </span>
                            </a>
                        </div>
                        <div class="col-lg-7 m-0 p-2 pl-3" style="line-height: 1px">
                            <a href="{{ route('playvideo') }}/{{ $rvideo->slug }}">
                                <strong class="text-dark" style="font-size: 15px;line-height: 1.22857;">
                                    {{ substr($rvideo->title,0,42) }}{{ strlen($rvideo->title) > 42 ? "....." : "" }}
                                </strong>
                            </a>
                            <br>
                            <br>
                            @auth()
                            <small style="position:absolute;bottom:3px;right:0px; font-size: 13px;line-height: 1.42857;">
                                <i class="fas fa-heart pr-3 saveButton {{ $rvideo->issaved ? 'saved' : '' }}" title="Save" style="color:#ccc;cursor:pointer" onclick="savevideo({{ $rvideo->id }}, this)"></i>
                            </small>
                            @endauth
                            <small style="position:absolute;bottom:3px; left:15px; font-size: 13px;line-height: 1.42857;">
                                {{ $rvideo->views }}
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection
