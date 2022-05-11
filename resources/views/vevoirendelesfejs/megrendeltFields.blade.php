@section('css')
    <link rel="stylesheet" href="public/css/app.css">
    <link rel="stylesheet" href="public/css/datatables.css">
    <link rel="stylesheet" href="public/css/Highcharts.css">
    @include('layouts.costumcss')
@endsection

<?php
    $modul = 'Rendelt tételek';
?>


<div class="content">

    <div class="form-group  col-sm-12">
        <div class="mylabel col-sm-3">
            {!! Form::label('mikorra', 'Dátum:') !!}
        </div>
        <div class="col-sm-3">
            {!! Form::date('mikorra', empty($_COOKIE['RendeltTermek']) ? date('Y-m-d', strtotime('today + 10 days')) : $_COOKIE['RendeltTermek'],
                            ['class' => 'form-control','id'=>'mikorra']) !!}
        </div>
        <div class="col-sm-3">
            <a href="#" class="btn btn-warning vevoirendelesgomb szures" title="Szűrés"><i class="glyphicon glyphicon-filter"></i></a>
            <a href="#" class="btn btn-warning vevoirendelesgomb nyomtat" title="Nyomtatás"><i class="glyphicon glyphicon-print"></i></a>
        </div>
    </div>

    @include('flash::message')
    <div class="clearfix"></div>
    <div class="box box-primary"  style="margin-top: 10px;">
        <div class="box-body"  >
            <table class="table table-hover table-bordered partners-table" style="width: 100%;"></table>
        </div>
    </div>
    <div class="text-center"></div>


    <!-- Submit Field -->
    <div class="form-group col-sm-12">
        <a href="{!! route('vevoirendelesfejs.index') !!}" class="btn btn-default">Kilép</a>
    </div>
</div>

@section('scripts')
    @include('layouts.datatables_js')
    @include('layouts.RowCallBack_js')
    @include('layouts.highcharts_js')
    @include('functions.lista.modulChange_js')
    @include('functions.cookiesFunctions_js')

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
                order: [[0, 'asc']],
                ajax: "{{ route('rendelttermek') }}",
                columns: [
                    {title: 'Termék', data: 'termek', width:'250px', name: 'termek'},
                    {title: 'Darab', data: 'darab', render: $.fn.dataTable.render.number( '.', ',', 0), sClass: "text-right", width:'75px', name: 'darab'},
                    {title: 'Ár', data: 'ar', render: $.fn.dataTable.render.number( '.', ',', 0), sClass: "text-right", width:'75px', name: 'ar'},
                ]
            });

            function szures() {
                let mikorra = $('#mikorra').val();
                createCookie('RendeltTermek', mikorra, '30');

                if (mikorra != 0) {
                    let url = '{{ route('megrendeltTermekDarab', [":veg"]) }}';
                    urlChange(table, url.replace(':veg', mikorra));
                }
            }

            $('.szures').click(function () {
                szures();
            });

            $('.nyomtat').click(function () {
                let mikorra = $('#mikorra').val();
                createCookie('RendeltTermek', mikorra, '30');

                if (mikorra != 0) {
                    let SITEURL = "{{url('/')}}";
                    let modul = '/rendelttermek.rendeltTermekNyomtatas/'
                    window.location.href = SITEURL + modul + mikorra;
                }
            });

            szures();

        });
    </script>

@endsection
