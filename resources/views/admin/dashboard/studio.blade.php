@extends("admin.dashboard")

@section('main')
<!-- Studio -->
<div class="card studio show">
    <div class="card-header bg-dark text-white">
        Create New Video
    </div>
    <div class="card-body d-flex justify-content-center" style=" overflow:auto;">
        <a href="{{ route('video.create') }} " class="btn btn-lg px-5 text-light bg-danger">
            <i class="fas fa-video mr-2"></i>
            CREATE
        </a>

    </div>
</div>
<!-- /Studio -->
@endsection
