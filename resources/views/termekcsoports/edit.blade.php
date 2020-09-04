@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Termék csoport
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($termekcsoport, ['route' => ['termekcsoports.update', $termekcsoport->id], 'method' => 'patch']) !!}

                        @include('termekcsoports.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection
