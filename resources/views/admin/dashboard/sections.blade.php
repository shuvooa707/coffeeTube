@extends("admin.dashboard")


@section('pageSpecificStylesheet')
<link rel="stylesheet" type="text/css" href="{{ asset('css/section.css')}}" />
@endsection

@section('pageSpecificScript')
<script src="{{ asset('js/sections.js') }}" defer></script>
@endsection


@section('title')
<title>Sections</title>
@endsection



@section('main')
<!-- Section -->
<div class="card section">
    <div class="card-header bg-dark text-white d-flex justify-content-between">
        Section
        <a href="{{ route('section.create') }}" class="btn btn-primary btn-sm pull-right">Create new</a>
    </div>

    <!----------- Pagination Links ------------->
    <div class="row mt-2 ml-5">
        <div class="col-lg-12 m-0">
            {{ $sections->links() }}
        </div>
    </div>

    <div class="card-body d-flex mt-0 pt-0 justify-content-center">

        @csrf
        <table class="table border border-dark table-stripped">
            <thead class="bg-dark text-light">
                <tr>
                    <!-- <th class="marker">
                        <input type="checkbox" class="" onclick="selectAll(this)">
                    </th> -->
                    <th>
                        <i class="fas fa-hashtag"></i>
                    </th>
                    <th>Name</th>
                    <th class="videos-tag" style="cursor: pointer;" title="Click to Sort By Video Count">
                        Videos
                        <i class="fas fa-video ml-1"></i>
                    </th>
                    <th>
                        Created
                        <i class="fas fa-clock ml-1"></i>
                    </th>
                    <th>
                        Tools
                        <i class="fas fa-tools ml-1"></i>
                    </th>
                    <th class="position-tag" style="cursor: pointer;" title="Click to Sort By Position">
                        Position
                        <i class="fas fa-sort ml-2"></i>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($sections as $section)
                <tr data-id="{{ $section->id }}">
                    <!-- <td class="marker">
                        <input type="checkbox" class="">
                    </td> -->
                    <td>{{ $section->id }}</td>
                    <td style="max-width:250px;">
                        <a href="{{ route('section', ['sid' => $section->id]) }}">
                            {{ $section->name }}
                        </a>
                    </td>
                    <td class="video-count" data-id="{{ $section->videos->count() }}">
                        {{ $section->videos->count() }}
                    </td>
                    <td>
                        {{ $section->time() }}
                    </td>
                    <td class="text-left">
                        <a href="{{ route('section.edit', ['sid'=>$section->id]) }}" class="btn btn-sm">
                            <i class="fas fa-pen text-secondary"></i>
                        </a>
                        <a href="{{ route('section.delete', ['sid'=>$section->id]) }}" class="btn btn-sm">
                            <i class="fas fa-trash  text-secondary"></i>
                        </a>
                        @if(!$section->locked)
                        <button class="btn btn-sm" onclick="lock({{ $section->id }}, this.dataset.locked, this)" data-locked="{{ $section->locked }}">
                            <i class="fas fa-eye  text-secondary"></i>
                        </button>
                        @else
                        <button class="btn btn-sm" onclick="lock({{ $section->id }}, this.dataset.locked, this)" data-locked="{{ $section->locked }}">
                            <i class="fas fa-eye-slash text-secondary"></i>
                        </button>
                        @endif
                    </td>
                    <td style="position: relative;" class="position" data-sid="{{ $section->id }}" data-id="{{ $section->position }}">
                        <span class="section-order">
                            {{ $section->position }}
                        </span>
                        <input style="width:80px;" type='number' min="1" class="form-control change-order hide" value='{{$section->id}}'>
                        <div class="d-inline-block pull-right" style="cursor:pointer; position:absolute; top:20px; right:20px;">
                            <i class="fas fa-pen text-dark " onclick="changeOrder(this.parentElement.parentElement); this.classList.add('hide')"></i>
                            <i class="fas fa-save text-dark change-order-save hide" onclick="changeOrderSave(this.parentElement.parentElement, {{$section->id}})"></i>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<!-- /Section -->
@endsection
