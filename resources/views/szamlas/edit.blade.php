@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Szamla
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($szamla, ['route' => ['szamlas.update', $szamla->id], 'method' => 'patch']) !!}

                        @include('szamlas.edit_fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection
