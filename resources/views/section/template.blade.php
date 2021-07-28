<!-- ---------------------Most Popular---------------------- -->
@foreach($sections as $section)
<section class="section mt-3 ">
    <div class="row justify-content-center">
        <div class="col-lg-10 bg-light border shadow-sm rounded text-center" style="min-height: 300px;">
            <div class="row">
                <div class="col-lg-12 mt-1 text-success text-left">
                    <h5>{{ $section->name }}</h5>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <i class="fas fa-angle-left most-popular-slider-prev"></i>
                    <i class="fas fa-angle-right most-popular-slider-next"></i>
                    <div class="most-popular-slider mt-3">
                        @foreach($section->videos() as $video )
                        <div class="silk-item">
                            <a href="/play/{{ $video->slug }}">
                                <img src="{{ $video->thumbnail }}" alt="">
                                <div class="" style="width:100%;height:25px; font-size:14px;color:black;">
                                    <p class="text-center">{{ $video->title }}</p>
                                </div>
                                <div class=" most-popular-item-detail-overlay">
                                    <h6>{{ $video->title }}</h6>
                                    <h6 class="badge badge-warning text-dark">{{ $video->rating }} <i class="fas fa-star"></i> </h6>
                                    <h6>{{ $video->genre }}</h6>
                                    <h6>{{ $video->director }}</h6>
                                </div>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="row my-2">
                <div class="col-lg-12 text-right">
                    <a href="{{ route('videolist',['what'=>$section->name,'duration'=>'thisweek']) }}" class="mt-1 badge px-3 border border-success text-success bg-light py-1">See All</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endforeach
<!-- ---------------------/Most Popular---------------------- -->
