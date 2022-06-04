<!-- Sorszam Field -->
@section('css')
    <link rel="stylesheet" href="http://tarca.priestago.hu/public/css/app.css">
    <link rel="stylesheet" href="http://tarca.priestago.hu/public/css/datatables.css">
    @include('layouts.costumcss')
@endsection


<div class="form-group col-sm-2">
    {!! Form::label('sorszam', 'Sorszám:') !!}
    {!! Form::text('sorszam', isset($utalvany) ? $utalvany->sorszam : App\Classes\UtalvanyClass::kovetkezoUtalvany(), ['style' => 'cursor: not-allowed', 'class' => 'form-control', 'readonly' => 'true']) !!}
</div>

<!-- Osszeg Field -->
<div class="form-group col-sm-6">
    @if (isset($utalvany))
        @if ($utalvany->felhasznalt > 0)
            <div class="form-group col-sm-4">
                {!! Form::label('osszeg', 'Összeg:') !!}
                {!! Form::number('osszeg', null, ['style' => 'cursor: not-allowed', 'class' => 'form-control', 'readonly' => 'true']) !!}
            </div>
            <div class="form-group col-sm-4">
                {!! Form::label('felhasznalt', 'Felhasznált:') !!}
                {!! Form::number('osszeg1', $utalvany->felhasznalt, ['style' => 'cursor: not-allowed', 'class' => 'form-control', 'readonly' => 'true', 'id' => 'felhasznalt']) !!}
            </div>
            <div class="form-group col-sm-4">
                {!! Form::label('felhasznalhato', 'Felhasználható:') !!}
                {!! Form::number('osszeg2', $utalvany->felhasznalhato, ['style' => 'cursor: not-allowed', 'class' => 'form-control', 'readonly' => 'true', 'id' => 'felhasznalhato']) !!}
            </div>
        @else
            {!! Form::label('osszeg', 'Összeg:') !!}
            {!! Form::number('osszeg', null, ['class' => 'form-control']) !!}
        @endif
    @else
        {!! Form::label('osszeg', 'Összeg:') !!}
        {!! Form::number('osszeg', null, ['class' => 'form-control']) !!}
    @endif
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Ment', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('utalvanies.index') !!}" class="btn btn-default">Kilép</a>
</div>

@if (isset($utalvany))
    <div class="col-lg-12 col-md-12 col-xs-12">

        <section class="content-header">
            <h1 class="pull-left">Tétel</h1>
        </section>
        <div class="content">
            <div class="clearfix"></div>

            @include('flash::message')

            <div class="clearfix"></div>
            <div class="box box-primary">
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered tetel-table" style="width: 100%;"></table>
                    </div>
                </div>
            </div>
            <div class="text-center">

            </div>
        </div>
    </div>
@endif

@section('scripts')
    @include('layouts.datatables_js')

    <script type="text/javascript">
        $(function () {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var oTable = $('.tetel-table').DataTable({
                serverSide: true,
                scrollY: 250,
                colReorder: true,
                paging: false,
                buttons: [],
                dom: '<"clear">',
                order: [0, 'desc'],
                ajax: "{{ route('utalvanyTetelIndex', isset($utalvany) ? $utalvany->id : -99999) }}",
                columns: [
                    {title: 'Dátum', data: 'created_at', render: function (data, type, row) { return data ? moment(data).format('YYYY.MM.DD') : ''; }, sClass: "text-center", width:'150px', name: 'created_at'},
                    {title: 'Összeg', data: 'osszeg', render: $.fn.dataTable.render.number( '.', ',', 0), sClass: "text-right", name: 'osszeg'},
                    {title: '<a class="btn btn-primary" title="Felvitel" href="{!! route('utalvanyCreate', isset($utalvany) ? $utalvany->id : -99999) !!}"><i class="fa fa-plus-square"></i></a>',
                        data: 'action', sClass: "text-center", name: 'action', orderable: false, searchable: false},
                ],
            });

        });
    </script>
    <!--
    /*    <script type="text/javascript">
            var submitButton = document.querySelector('.form-group .btn.btn-primary');
            submitButton.addEventListener('click', function(ev) {
                ev.preventDefault();
                alert('baszki ez működik');
            })
        </script>*/
    -->
@endsection
