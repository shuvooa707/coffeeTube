@extends('layout')


@section('pageSpecificStylesheet')
<link rel="stylesheet" type="text/css" href="{{ asset('css/profile.css')}}" />
@endsection

@section('pageSpecificScript')
<script src="{{ asset('js/profile.js') }}" defer></script>
@endsection


@section('title')
<title>{{ auth()->user()->name }}</title>
@endsection

@section('section')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-10 p-2 mt-5 bg-light">
            <table class="table table-stripped">
                <thead class="bg-primary text-light">
                    <tr>
                        <th>Notification</th>
                    </tr>
                </thead>
                <tbody class="mt-2">
                    <tr>
                        <td class="py-2">
                            dflgj osdfjg oidfjgjsdfjgsdjfg j
                        </td>
                    </tr>
                    <tr>
                        <td class="py-2">
                            dflgj osdfjg oidfjgjsdfjgsdjfg j
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
