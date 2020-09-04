<?php
use App\Models\Partner;
use App\Models\termek;
use App\Models\termekcsoport;
use App\Models\termekfocsoport;
use App\Models\szamla;
use App\Models\Koltsegfocsoport;
use App\Models\Koltsegcsoport;
use App\Classes\Koltseg;

$evhonapKoltseg = Koltseg::getEvHetKoltseg();
$ev = date("Y");
$partnerDb = Partner::PartnerCount();
$termekDb = termek::TermekCount();
$termekcsoportDb = termekcsoport::TermekCsoportCount();
$termekfocsoportDb = termekfocsoport::TermekFoCsoportCount();
$osszkoltseg = szamla::OsszKoltseg();
$arbevetel = 0;
$egyenleg = $arbevetel - $osszkoltseg;
$osszkoltseg = number_format($osszkoltseg, 0, ",", "." );
$arbevetel = number_format($arbevetel, 0, ",", "." );
$egyenleg = number_format($egyenleg, 0, ",", "." );

$kezdo = date('Y-m-d', strtotime('first day of january this year'));
$veg   = date('Y-m-d', strtotime('last day of december this year'));
$KoltsegFoCsoportOsszesen = Koltsegfocsoport::KoltsegFoCsoportOsszesen($kezdo, $veg, NULL);
$KoltsegCsoportOsszesen = Koltsegcsoport::KoltsegCsoportOsszesen($kezdo, $veg, NULL);

$termekOsszesen = termek::TermekOsszesen($kezdo, $veg, NULL);
$termekCsoportOsszesen = termekcsoport::TermekCsoportOsszesen($kezdo, $veg, NULL);
$termekFoCsoportOsszesen = termekfocsoport::TermekFoCsoportOsszesen($kezdo, $veg, NULL);
 ?>

@extends('layouts.app')

@section('css')

    <link rel="stylesheet" href="public/css/app.css">
    <link rel="stylesheet" href="public/css/datatables.css">
    <link rel="stylesheet" href="public/css/Highcharts.css">
    @include('layouts.costumcss')

@endsection

@section('content')
    @include('layouts.header')
    <!-- Main content -->
    <section class="content">
        @include('dashboard.dashboardrow')
    </section>
@endsection

@section('scripts')
    @include('layouts.datatables_js')
    @include('layouts.RowCallBack_js')
    @include('layouts.highcharts_js')

    <script src="public/js/hcc.js"></script>
    <script src="public/js/hscolumn.js"></script>
    <script src="public/js/hspielegend.js"></script>
    <script src="public/js/hsarea.js"></script>
    <script src="public/js/hccarea.js"></script>
    <script src="public/js/hsline.js"></script>
    <script src="public/js/combinatedClick.js"></script>
    <script src="public/js/jarulektipus.js"></script>
    <script src="public/js/chartupdate.js"></script>
    <script type="text/javascript">
    $(function () {

        function csoportfeltolt(data_viewer) {
            var v_kategoria = [];
            for (i = 0; i < data_viewer.length; i++ ){
                v_kategoria.push(data_viewer[i].nev);
            }
            return v_kategoria;
        }

        function csoportPieData(data){
          var pieData = [];
          var sum = 0;
          for (i = 0; i < data.length; i++){
              pieData.push({name: data[i].nev, y: parseInt(Math.round(data[i].osszeg).toFixed(0))});
          }
          return pieData;
        }

        var kategoria = csoportfeltolt(<?php echo $KoltsegCsoportOsszesen; ?>);
        var pie_data = csoportPieData(<?php echo $KoltsegCsoportOsszesen; ?>);
        var chart_koltsegcsoport = HighChartPie( 'koltsegcsoport', 'pie', 350, kategoria, pie_data, 'Költségek', 'Csoportonként', 'Csoport', 200, true, true, '40%');

        var fokategoria = csoportfeltolt(<?php echo $KoltsegFoCsoportOsszesen; ?>);
        var fopie_data = csoportPieData(<?php echo $KoltsegFoCsoportOsszesen; ?>);
        var chart_koltsegfocsoport = HighChartPie( 'koltsegfocsoport', 'pie', 350, fokategoria, fopie_data, 'Költségek', 'Főcsoportonként', 'Főcsoport', 200, true, true, '0%');

        kategoria = [];
        pie_data = [];
        kategoria = csoportfeltolt(<?php echo $termekOsszesen; ?>);
        pie_data = csoportPieData(<?php echo $termekOsszesen; ?>);
        var chart_termek = HighChartPie( 'termek', 'pie', 350, kategoria, pie_data, 'Termék beszerzés', 'Termékenként', 'Termék', 200, true, true, '0%');

        kategoria = [];
        pie_data = [];
        var kategoria = csoportfeltolt(<?php echo $termekCsoportOsszesen; ?>);
        var pie_data = csoportPieData(<?php echo $termekCsoportOsszesen; ?>);
        var chart_termekcsoport = HighChartPie( 'termekcsoport', 'pie', 350, kategoria, pie_data, 'Termék beszerzés', 'Termék csoportonként', 'Termék csoport', 200, true, true, '0%');

        kategoria = [];
        pie_data = [];
        var kategoria = csoportfeltolt(<?php echo $termekFoCsoportOsszesen; ?>);
        var pie_data = csoportPieData(<?php echo $termekFoCsoportOsszesen; ?>);
        var chart_termekfocsoport = HighChartPie( 'termekfocsoport', 'pie', 350, kategoria, pie_data, 'Termék beszerzés', 'Termék főcsoportonként', 'Termék főcsoport', 200, true, true, '0%');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var table = $('.table').DataTable({
            serverSide: true,
            scrollY: 150,
            buttons: [],
            order: [[2, 'desc'],[3, 'asc']],
            paging: false,
            ajax: "{{ route('todos.index') }}",
            columns: [
                {title: 'Felhasznaló', data: 'nev', name: 'nev'},
                {title: 'Mit', data: 'mit', name: 'mit'},
                {title: 'Mikorra', data: 'mikorra', render: function (data, type, row) { return data ? moment(data).format('YYYY.MM.DD') : ''; }, sClass: "text-center", width:'150px', name: 'mikorra'},
                {title: 'Vége', data: 'vege', render: function (data, type, row) { return data ? moment(data).format('YYYY.MM.DD') : ''; }, sClass: "text-center", width:'150px', name: 'vege'},
            ],
            columnDefs: [
               {
                   targets: [3],
                   visible: false,
                   searchable: true
               }
            ],
        });

        table.columns(3).search('^$',true,false).draw();

        function LineChartKategoria(data){
            kategoria = [];
            for (i = 0; i < data.length; i++){
                kategoria.push(data[i].honap);
            }
            return kategoria;
        }

        function LineChartData(data, mi){
            chartdata = [];
            cdata = [];
            for (i = 0; i < data.length; i++){
                cdata.push(parseInt(data[i].db));
            }
            chartdata.push({name: mi, data: cdata});
            return chartdata;
        }

        var chart_havikotes = highchartLine( 'evhonapKoltseg', 'line', 262, LineChartKategoria(<?php echo $evhonapKoltseg; ?>), LineChartData(<?php echo $evhonapKoltseg; ?>, ''), 'Költségek', 'heti bontás', 'forint');
  });
  </script>

@endsection
