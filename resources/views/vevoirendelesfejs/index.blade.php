@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="public/css/app.css">
    <link rel="stylesheet" href="public/css/datatables.css">
    <link rel="stylesheet" href="public/css/Highcharts.css">
    @include('layouts.costumcss')
@endsection

@section('content')
    <?php
        $modul = 'Vevői rendelések';
    ?>

    <div class="content">
        <div class="clearfix"></div>
        <div class="box box-primary" >
            <div class="box-body">
                <div class="col-lg-12 col-md-12 col-xs-12">
                    <section class="content-header">
                        <h4 class="oldalcim"><img src={{ URL::asset('/public/img/menu/order_40.png')}}><a id="fejszoveg"> Vevői rendelés</a></h4>
                        <h4>
                            <div class="col-sm-12">
                                <div class="col-sm-3">
                                    <div class="mylabel col-sm-3">
                                        {!! Form::label('statusz', 'Státusz:') !!}
                                    </div>
                                    <div class="col-sm-9">
                                        {!! Form::select('statusz', [""] + \App\Models\Dictionary::where('tipus', 38)->orderBy('nev')->pluck('nev', 'id')->toArray(),
                                                          empty($_COOKIE['vevoiRendelesStatusz']) ? null : $_COOKIE['vevoiRendelesStatusz'],
                                                          ['class'=>'select2 form-control', 'id' => 'statusz']) !!}
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <a href="#" class="btn btn-warning vevoirendelesgomb szures" title="Szűrés"><i class="glyphicon glyphicon-filter"></i></a>
                                    <a href="#" class="btn btn-default vevoirendelesgomb mind" title="Minden tétel"><i class="glyphicon glyphicon-remove"></i></a>
                                </div>
                                <div class="col-sm-3">
                                    <div class="mylabel col-sm-3">
                                        {!! Form::label('modul_id', 'Lista:') !!}
                                    </div>
                                    <div class="col-sm-9">
                                        {!! Form::select('modul_id', DDW::listaDdw($modul), null,['class'=>'select2 form-control', 'required' => 'true', 'id' => 'modul_id']) !!}
                                    </div>
                                </div>
                                <div class="mylabel3 col-sm-3">
                                </div>
                                <div class="col-sm-3" style="text-align: right">
                                    <a href="{!! route('rendelttermek') !!}" class="btn btn-warning vevoirendelesgomb tetel" title="Megrendelés tétel"><i class="glyphicon glyphicon-modal-window"></i></a>
                                </div>
                            </div>
                        </h4>
                        <ol class="breadcrumb" style="float:right;">
                            <li><a href="{{ route('home') }}"><img src="public/img/menu/dashboard_25.png"> Főoldal</a></li>
                            <li class="active"><img src="public/img/menu/order_25.png"> Vevői rendelés</li>
                        </ol>
                    </section>
                    @include('flash::message')
                    <div class="clearfix"></div>
                    <div class="box box-primary"  style="margin-top: 10px;">
                        <div class="box-body"  >
                            <table class="table table-hover table-bordered partners-table" style="width: 100%;"></table>
                        </div>
                    </div>
                    <div class="text-center"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @include('layouts.datatables_js')
    @include('layouts.RowCallBack_js')
    @include('layouts.highcharts_js')
    @include('functions.cookiesFunctions_js')
    @include('functions.lista.modulChange_js')

    <script type="text/javascript">
        $(function () {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var table = $('.partners-table').DataTable({
                serverSide: true,
                scrollY: 390,
                scrollX: true,
                order: [[3, 'asc'], [1, 'asc']],
                ajax: "{{ route('vevoirendelesfejs.index') }}",
                columns: [
                    {title: '<a class="btn btn-primary" title="Felvitel" href="{!! route('vevoirendelesfejs.create') !!}"><i class="fa fa-plus-square"></i></a>',
                        data: 'action', sClass: "text-center", width: '150px', name: 'action', orderable: false, searchable: false},
                    {title: 'Megrendelés szám', data: 'megrendelesszam', name: 'megrendelesszam'},
                    {title: 'Partner', data: 'pnev', width:'250px', name: 'pnev'},
                    {title: 'Státusz', data: 'snev', width:'150px', name: 'snev'},
                    {title: 'Mikor', data: 'mikor', render: function (data, type, row) { return data ? moment(data).format('YYYY.MM.DD') : ''; }, sClass: "text-center", width:'150px', name: 'mikor'},
                    {title: 'Mikorra', data: 'mikorra', render: function (data, type, row) { return data ? moment(data).format('YYYY.MM.DD') : ''; }, sClass: "text-center", width:'150px', name: 'mikorra'},
                    {title: 'Tétel', data: 'tetelszam', render: $.fn.dataTable.render.number( '.', ',', 0), sClass: "text-right", width:'75px', name: 'tetelszam'},
                ]
            });

            function mindGomb() {
                $('#fejszoveg').text('Minden vevői rendelés');
                let url = '{{ route('vevoirendelesfejs.index') }}';
                urlChange(table, url);
            }

            $('.mind').click(function () {
                mindGomb();
            });

            function szures() {
                let statusz = $('#statusz').val();
                let szoveg = '';
                createCookie('vevoiRendelesStatusz', statusz, '30');

                if (statusz != 0) {

                    if ( statusz == 2112 ) {
                        szoveg = ' Megrendelt vevői rendelések';
                    }
                    if ( statusz == 2113 ) {
                        szoveg = ' Részteljesített vevői rendelések';
                    }
                    if ( statusz == 2114 ) {
                        szoveg = ' Teljesített vevői rendelések';
                    }

                    $('#fejszoveg').text(szoveg);
                    let url = '{{ route('vevoiRendelesSzurt', [":melyik"]) }}';
                    urlChange(table, url.replace(':melyik', statusz));

                } else {
                    mindGomb();
                }
            }

            $('.szures').click(function () {
                szures();
            });

            modulChange();

            szures();

        });
    </script>
@endsection


