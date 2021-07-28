@extends('layout')


@section('pageSpecificScript')
<script src="{{ asset('js/index.js') }}" defer></script>
<script src="{{ asset('js/slider.js') }}" defer></script>
@endsection



@section('pageSpecificStylesheet')
<link rel="stylesheet" type="text/css" href="{{ asset('css/slider.css')}}" />
@endsection



@section('title')
<title>BlueTube</title>
@endsection


@section('section')


<!-- ---------------------Carousel---------------------- -->
{{-- <div class="container-fluid m-0 p-0">
    <div class="row m-0 p-0">
        <div class="col-lg-12 p-0">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators corosol-indicator-pill">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner" style="max-height: 600px;">
                    <div class="carousel-item active ">
                        <img src="img/slide1.jpeg" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item ">
                        <img src="img/slide2.jpeg" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="img/slide3.jpeg" class="d-block w-100" alt="...">
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div> --}}
    <!-- ---------------------/Carousel---------------------- -->

    <!-- ---------------------Slider---------------------- -->

    <div class="container-fluid justify-content-center tv-channel-container">
        <div class="row justify-content-center overflow-hidden">
            <div class="col-lg-10">
                <i class="fas fa-angle-left prev"></i>
                <i class="fas fa-angle-right next"></i>
                <div class="tv-channels-slider">
                    @foreach($upperSlider as $usvideo)
                    <div class="silk-item f-button">
                        <span class="flash"></span>
                        <a href="{{ route('playvideo') }}/{{ $usvideo->slug }}">
                            <img data-src='../{{$usvideo->thumbnail}}' src="{{ URl('storage\img\placeholderImage.PNG') }}" alt="">
                            <div class="" style="width:100%;height:25px; font-size:14px;color:black;">
                                <p class="text-center">{{ $usvideo->title }}</p>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- ---------------------/Slider---------------------- -->

    <!-- ---------------------Most Popular---------------------- -->
    <div class="container-fluid home-body">
        @foreach($topFiveSections as $section)
        <section class="section mt-3" data-section-id="{{ $section->id }}">
            <div class="slider-container">
                <div class="left-nav">
                    <i class="fas fa-angle-left" style=""></i>
                </div>
                <div class="item-holder">
                    @foreach($section->videos as $video)
                    <a href="{{ route('playvideo') }}/{{ $video->slug }}" class="item">
                        <img src="{{$video->thumbnail}}" width="100%" height="100%" alt="">
                        <div class="item-overlay">
                            <strong class="video-title">{{ $video->title }}</strong>
                            <small class="badge border border-success">
                                {{ $video->genre}}
                            </small>
                            <br>
                            <small class="badge border border-danger">
                                {{ $video->rating}}
                                <i class="fas fa-star text-warning"></i>
                            </small>
                            <br>
                            <small class="badge border border-info">
                                {{ $video->views}}
                                <i class="fas fa-eye"></i>
                            </small>
                        </div>
                    </a>
                    @endforeach
                </div>
                <div class="right-nav">
                    <i class="fas fa-angle-right" style=""></i>
                </div>
            </div>
        </section>
        @endforeach

        <div class="load-more-section-spinner hide">
            <div class="spinner-border" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
    </div>




    @endsection
