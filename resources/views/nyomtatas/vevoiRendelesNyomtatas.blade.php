@extends('layouts.app')

<body onload="window.print();">
@section('content')

    <section class="content-header">
        Vevői megrendelések
        <h1>
            <a href="{!! route('vevoirendelesfejs.index') !!}" class="btn btn-default" style="border: 2px solid gray; box-shadow: 0px 8px 15px rgba(0,0,0,0.1); font-size: 15px; margin-bottom: 2px;">Kilép</a>
        </h1>
    </section>
    @include('nyomtatas.vevoiRendelesNyomtatasBody')
@endsection
</body>
