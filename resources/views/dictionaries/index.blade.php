
@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="http://priestago.hu/tarca/public/css/app.css">
    <link rel="stylesheet" href="http://priestago.hu/tarca/public/css/datatables.css">
    @include('layouts.costumcss')
@endsection

@section('content')
<div class="col-lg-6 col-md-6 col-xs-12">
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
                <div class="table-responsive">
                    <table class="table table-hover table-bordered type-table">
                        <thead>
                            <tr>
                                <th>Név</th>
                                <th>Leírás</th>
                                <th>Akció</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                            <tr>
                              <th>Név</th>
                              <th>Leírás</th>
                              <th>Akció</th>
                            </tr>
                        </tfoot>

                    </table>
                </div>
            </div>
        </div>
        <div class="text-center">

        </div>
    </div>
</div>

<div class="col-lg-6 col-md-6 col-xs-12">

    <section class="content-header">
        <h1 class="pull-left">Szótár</h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
              <div class="table-responsive">
                  <table class="table table-hover table-bordered dictionaries-table">
                      <thead>
                          <tr>
                              <th>Típus</th>
                              <th>Név</th>
                              <th>Leírás</th>
                              <th>Akció</th>
                          </tr>
                      </thead>
                      <tbody>
                      </tbody>
                      <tfoot>
                          <tr>
                            <th>Típus</th>
                            <th>Név</th>
                            <th>Leírás</th>
                            <th>Akció</th>
                          </tr>
                      </tfoot>

                  </table>
              </div>
            </div>
        </div>
        <div class="text-center">

        </div>
    </div>
</div>
@endsection

@section('scripts')
    @include('layouts.datatables_js')

    <script type="text/javascript">

        $(function () {

          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });

          var oTable = $('.dictionaries-table').DataTable({
              serverSide: true,
              order: [[0, 'asc'], [1, 'asc']],
              ajax: "{{ route('dictionaries.index') }}",
              columns: [
                  {data: 'tnev', name: 'tnev'},
                  {data: 'nev', name: 'nev'},
                  {data: 'leiras', name: 'leiras'},
                  {data: 'action', sClass: "text-center", name: 'action', orderable: false, searchable: false},
              ],
              columnDefs: [
                    {
                    visible: false,
                    targets: [0]
                    },
                ],
            });

            var tTable = $('.type-table').DataTable({
                serverSide: true,
                order: [[0, 'asc']],
                ajax: "{{ route('types.index') }}",
                columns: [
                    {data: 'nev', name: 'nev'},
                    {data: 'leiras', name: 'leiras'},
                    {data: 'action', sClass: "text-center", name: 'action', orderable: false, searchable: false},
                ],
              });


            $('#tipus').on('change', function(e) {
                var tipus = $('#tipus').val();
                oTable.column(0).search(tipus).draw();
                e.preventDefault();
            });

            $("#tipus").change();

            var nev = 'XXX';

            tTable.on( 'select', function () {
                var selected = tTable.row( { selected: true } );
                 if ( selected.any() ) {
                     nev = selected.data().nev;
                 }

                oTable.column(0).search(nev).draw();
                e.preventDefault();
            } );

            tTable.on( 'deselect', function () {
                nev = 'XXX';
                oTable.column(0).search(nev).draw();
                e.preventDefault();
            } );

            oTable.column(0).search(nev).draw();

        });
    </script>
@endsection
