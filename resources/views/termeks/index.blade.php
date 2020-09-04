@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="public/css/app.css">
    <link rel="stylesheet" href="public/css/datatables.css">
    <link rel="stylesheet" href="public/css/Highcharts.css">
    @include('layouts.costumcss')
@endsection

@section('content')
    <div class="content">
        <div class="clearfix"></div>
        <div class="box box-primary" >
            <div class="box-body">
                <div class="col-lg-12 col-md-12 col-xs-12">
                    <section class="content-header">
                        <h1><img src="public/img/menu/products_40.png"> Termék</h1>
                        <ol class="breadcrumb">
                        <li><a href="{{ route('home') }}"><img src="public/img/menu/dashboard_25.png"> Főoldal</a></li>
                        <li class="active"><img src="public/img/menu/keszlet_25.png"> Készlet</li>
                        <li class="active"><img src="public/img/menu/products_25.png"> Termék</li>
                        </ol>
                        <form id="header-form" class="form-inline" >
                            <h3 class="pull-right" style="margin-top: -2px;">
                                <a class="btn btn-primary pull-right" title="Felvitel" href="{!! route('termeks.create') !!}" style="margin-left: 5px;"><i class="fa fa-plus-square"></i></a>
                            </h3>
                        </form>
                    </section>
                    @include('flash::message')
                    <div class="clearfix"></div>
                    <div class="panel-body">
                        <form id="search-form" class="form-inline">
                            <div class="form-group text-center"  style="margin-top: -60px;">
                                <label style="height:30px;font-weight: bold;font-size:15px; font-family: 'Palatino, URW Palladio L, serif'" for="title">Csoport:</label>
                                {!! Form::select('tipus', [""] + \App\Models\termekcsoport::orderBy('nev')->pluck('nev', 'nev')->toArray(), null,['class'=>'select2 form-control', 'id' => 'tipus', 'style=height:30px;width:150px;font-size:12px;']) !!}
                            </div>
                        </form>
                    </div>
                    <div class="box box-primary">
                        <div class="box-body"  >
                              <table class="table table-hover table-bordered partners-table"></table>
                          </div>
                    </div>
                    <div class="text-center"></div>
                </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @include('layouts.datatables_js')
    @include('layouts.RowCallBack_js')
    @include('layouts.highcharts_js')

    <script type="text/javascript">
        $(function () {

          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });

          var table = $('.partners-table').DataTable({
              serverSide: true,
              scrollY: 475,
              order: [[1, 'asc']],
              ajax: "{{ route('termeks.index') }}",
              columns: [
                  {title: 'Akció', data: 'action', sClass: "text-center", name: 'action', width:'100px', orderable: false, searchable: false},
                  {title: 'Név', data: 'nev', width:'250px', name: 'nev'},
                  {title: 'Csoport', data: 'csnev', width:'120px', name: 'csnev'},
                  {title: 'Cikkszám', data: 'cikkszam', width:'120px', name: 'cikkszam'},
                  {title: 'Mennyiségi egység', data: 'menev', sClass: "text-center", name: 'menev'},
                  {title: 'Megjegyzés', data: 'megjegyzes', name: 'megjegyzes'},
              ]
            });

            $('#tipus').change(function(e){
                var tipus = $('#tipus').val();
                console.log(tipus)
                if (tipus != '0'){
                    table.column(2).search(tipus).draw();
                }else{
                    table.column(2).search("").draw();
                }
                e.preventDefault();
            });

        });

    </script>
@endsection
