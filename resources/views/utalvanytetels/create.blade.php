@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Utalvány tétel, összege: {{ number_format($utalvany->osszeg, 0, ",", "." ) }} ft. Felhasználható: {{  number_format($utalvany->felhasznalhato, 0, ",", "." ) }} ft.
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'utalvanytetels.store']) !!}

                        @include('utalvanytetels.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
