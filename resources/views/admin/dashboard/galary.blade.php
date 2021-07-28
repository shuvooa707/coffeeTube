@extends("admin.dashboard")




@section('pageSpecificStylesheet')
<link rel="stylesheet" type="text/css" href="{{ asset('css/galary.css')}}" />
@endsection

@section('pageSpecificScript')
<script src="{{ asset('js/galary.js') }}" defer></script>
@endsection




@section('main')
<!-- Video Galary -->
<div class="card galary">
    <div class="card-header bg-dark text-white">
        Gallary
    </div>
    <div class="card-body px-2" style=" overflow:auto;">
        <table class="table border text-left">
            <thead class="bg-dark text-light shadow-sm">
                <tr>
                    <th scope="col" style="width: 50px">#</th>
                    <th scope="col" style="width: 150px">Thumbnail</th>
                    <th scope="col" class="pl-4">
                        Title
                        <a href="{{ route('deleteall') }}" class="fa fa-trash p-1 px-2 badge rounded bg-danger text-light" style="position: absolute; right:15px;"> Delete All</a>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($videos as $video)
                <tr>
                    <th scope="row" class="pt-4">
                        <span class="badge border rounded border-success">
                            {{ $video->id }}
                        </span>
                    </th>
                    <td class="py-1">
                        <img data-src="../{{ $video->thumbnail }}" src="{{ URl('storage\img\placeholderImage.PNG') }}" class="img-thumbnail rounded shadow" style="width:130px; border:unset; padding:0px;" alt="">
                    </td>
                    <td class="pt-2 pl-4 text-left" style=" ">
                        <div class="title-box">
                            <a href="/play/{{ $video->slug }}">
                                {{ $video->title }}
                            </a>
                        </div>
                        <div class="details-box text-small" style="font-size: 16px;font-weight: bold;text-indent: 10px;padding-top: 6px;color: #5d5d5d;">
                            <a href="{{ route('video.edit', ['vid'=>$video->id]) }}" class="fas fa-pen text-dark"></a>
                            <a href="{{ route('video.delete', ['vid'=>$video->id]) }}" class="fas fa-trash pr-2 text-danger"></a>
                            {{ $video->rating }}<i class="fas fa-star text-warning" style="font-size: 12px;margin-left: -5px;"></i> <span style="color:#aaa;padding-right:5px"> - </span>
                            {{ $video->genre }}<span style="color:#aaa;padding-right:5px"> - </span>
                            {{ $video->director }}<span style="color:#aaa;padding-right:5px"> - </span>
                            <i class="fas fa-comment text-success"></i> {{ count($video->comments) }}<span style="color:black;padding-right:5px"> </span>
                        </div>
                    </td>
                    <!-- tools menu -->
                    <!-- <td class="pt-4">
                        <span class="text-dark tool-menu">
                            <i class="fas fa-bars mr-2 tool-ham-icon"></i>
                            <div class="menu-container">
                                <span class="tool-circle-close-icon">
                                    <i class="fas fa-times"></i>
                                </span>
                                <a href="#" class="text-secondary">
                                    <span class="icon">
                                        <i class="fas fa-edit inside"></i>
                                    </span>
                                </a>
                                <span class="icon">
                                    <i class="fas fa-trash inside" onclick="deleteVideo('/video/{{$video->id}}')">
                                    </i>
                                </span>
                                <span class="icon">
                                    <i class="fas fa-unlock inside">
                                    </i>
                                </span>
                                <span class="icon">
                                    <i class="fas fa-air-freshener inside">
                                    </i>
                                </span>
                                <span class="icon">
                                    <i class="fas fa-apple-alt inside">
                                    </i>
                                </span>
                                <span class="icon">
                                    <i class="fas fa-video inside">
                                    </i>
                                </span>
                            </div>
                        </span>
                    </td> -->
                    <!-- /tools menu -->
                </tr>
                @endforeach
                <div class="d-flex justify-content-between">
                    <div class="form-group col-md-2 py-1 px-2 d-flex justify-content-between">
                        <label for="howManyPerPage" style="font-size: 15px">Per Page</label>
                        <select name="howManyPerPage" class="form-control py-1" id="howManyPerPage" onchange="perPage(this)">
                            <option value="7" @if($perPage==7) {{'selected disabled'}} @endif>7</option>
                            @if( $totalvideos > 20 )
                            <option value="20" @if($perPage==20) {{'selected disabled'}} @endif>20</option>
                            @endif
                            @if( $totalvideos > 50 )
                            <option value="50" @if($perPage==50) {{'selected disabled'}} @endif>50</option>
                            @endif
                            <option value="{{ $totalvideos }}" @if($perPage> 50) {{'selected disabled'}} @endif >{{ $totalvideos }}+</option>
                        </select>
                    </div>
                    {{ $videos->links() }}

                </div>
            </tbody>
        </table>
    </div>
</div>
<!-- /Video Galary -->
@endsection
