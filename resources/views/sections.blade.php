@extends('layout')



@section('section')
<div class="container mt-5 pt-5">
    <div class="row">
        <div class="col-lg-12 p-0 bg-light">
            <div class="card">
                <div class="card-header py-2 bg-success text-light d-flex justify-content-between">
                    <span class="d-inline-block">
                        All Sections
                    </span>
                    <a href="{{ route('section.create') }}" class="d-inline-block btn btn-primary py-1 px-2 border">
                        Create new
                        <i class="fas fa-plus text-light ml-2"></i>
                    </a>
                </div>

                <div class="card-body">

                </div>
            </div>
        </div>
    </div>

    <script>
        var fixHelperModified = function(e, tr) {
                var $originals = tr.children();
                var $helper = tr.clone();
                $helper.children().each(function(index) {
                    $(this).width($originals.eq(index).width())
                });
                return $helper;
            },
            updateIndex = function(e, ui) {
                $('td.index', ui.item.parent()).each(function(i) {
                    $(this).html(i + 1);
                });
                $('input[type=text]', ui.item.parent()).each(function(i) {
                    $(this).val(i + 1);
                });
            };

        $("table tbody").sortable({
            helper: fixHelperModified,
            stop: updateIndex
        }).disableSelection();

        $("tbody").sortable({
            distance: 5,
            delay: 100,
            opacity: 0.6,
            cursor: 'move',
            update: function() {}
        });
    </script>
    @endsection
