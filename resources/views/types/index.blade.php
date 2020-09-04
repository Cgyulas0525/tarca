@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="http://priestago.hu/tarca/public/css/app.css">
    <link rel="stylesheet" href="http://priestago.hu/tarca/public/css/datatables.css">
    @include('layouts.costumcss')
@endsection

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Típus</h1>
        <h1 class="pull-right">
           <a class="btn btn-primary pull-right" title="Felvitel" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('types.create') !!}"><i class="fa fa-plus-square"></i></a>
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                @include('types.table')
            </div>
        </div>
        <div class="text-center">

        </div>
    </div>
@endsection

@section('scripts')
    @include('layouts.datatables_js')
    @include('layouts.main_dt_js')
@endsection
