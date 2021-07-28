@extends('layout')


@section('pageSpecificStylesheet')
<link rel="stylesheet" type="text/css" href="{{ asset('css/dashboard.css')}}" />
@endsection

@section('pageSpecificScript')
<script src="{{ asset('js/dashboard.js') }}" defer></script>
@endsection


@section('title')
<title>Dashboard</title>
@endsection

@section('section')

<div class="container-fluid mt-4 mb-5">
    <div class="row justify-content-around px-lg-5 px-md-0 px-sm-0">
        <div class="col-lg-12 col-md-12 mt-5 bordered" style="position: relative; min-width:1600px">
            <aside class="dashboard-menu" style="position:fixed; left:100px; min-width:200px; width:250px;">
                <ul class="list-group">
                    <a href="{{ route('dashboard') }}">
                        <li class="list-group-item  text-light  @if($pageOn == 'studio') {{ 'bg-success disabled' }} @else {{  'bg-dark' }} @endif " data-tabname="studio">
                            <i class="fas fa-video mr-2"></i>
                            Create New
                        </li>
                    </a>


                    <a href="{{ route('sections') }}">
                        <li class="list-group-item text-light @if($pageOn == 'section') {{ 'bg-success disabled' }} @else {{  'bg-dark' }} @endif" data-tabname="section">
                            <i class="fas fa-cloud mr-2"></i>
                            Section
                        </li>
                    </a>



                    <a href="{{ route('videogalary') }}">
                        <li class="list-group-item  text-light  @if($pageOn == 'galary') {{ 'bg-success disabled' }} @else {{  'bg-dark' }} @endif" data-tabname="galary">
                            <i class="fas fa-film mr-2"></i>
                            Gallary
                        </li>
                    </a>
                    <a href="{{ route('comments') }}">
                        <li class="list-group-item  text-light  @if($pageOn == 'comments') {{ 'bg-success disabled' }} @else {{  'bg-dark' }} @endif" data-tabname="comments">
                            <i class="fas fa-comment mr-2"></i>
                            Comments
                        </li>
                    </a>
                    <a href="{{ route('analytics') }}">
                        <li class="list-group-item  text-light  @if($pageOn == 'analytics') {{ 'bg-success disabled' }} @else {{  'bg-dark' }} @endif" data-tabname="analytics">
                            <i class="fas fa-ruler-combined mr-2"></i>
                            Analytics
                        </li>
                    </a>
                    <a href="{{ route('reports') }}">
                        <li class="list-group-item text-light  @if($pageOn == 'reports') {{ 'bg-success disabled' }} @else {{  'bg-dark' }} @endif" data-tabname="report">
                            <i class="fas fa-comment-slash mr-2"></i>
                            Report
                        </li>
                    </a>

                    <a href="{{ route('administration') }}">
                        <li class="list-group-item text-light @if($pageOn == 'administration') {{ 'bg-success disabled' }} @else {{  'bg-dark' }} @endif" data-tabname="administration">
                            <i class="fas fa-cogs mr-2"></i>
                            Administration
                        </li>
                    </a>

                </ul>
            </aside>
            <main style="min-width: 1000px; width:1200px; position:absolute;right:0px;" class="mb-5">
                @yield('main')
            </main>
        </div>
    </div>
</div>
@endsection
