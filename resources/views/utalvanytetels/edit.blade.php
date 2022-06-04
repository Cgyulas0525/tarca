@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Utalvány tétel
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($utalvanytetel, ['route' => ['utalvanytetels.update', $utalvanytetel->id], 'method' => 'patch']) !!}

                        @include('utalvanytetels.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection
