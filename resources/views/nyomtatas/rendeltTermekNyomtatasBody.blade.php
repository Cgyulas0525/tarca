@section('css')
    @include('layouts.costumcss')
@endsection()

<div class="content">
    <div class="row">
        <div class="col-xs-12">
            <h2 style="text-align: center;">
                {{ date('Y.m.d', strtotime($mikorra)) }} rendelt tételek
            </h2>
        </div>
        <!-- /.col -->
    </div>

    <!-- Table row -->
    <div class="row">
        <div class="col-xs-12 table-responsive">
            <table class="table table-hover table-bordered">
                <thead>
                <tr>
                    <th>Termék</th>
                    <th style="text-align: right;">Darab</th>
                    <th style="text-align: right;">Ár</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($termekek as $key => $termek)
                    <tr id="sor">
                        <td>{{ $termek->termek }}</td>
                        <td style="text-align: right;">{{ number_format($termek->darab, 0, ",", ".") }}</td>
                        <td style="text-align: right;">{{ number_format($termek->ar, 0, ",", ".") }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <p class="lead">Készült: {{ date('Y.m.d', strtotime(\Carbon\Carbon::now())) }}</p>
        </div>
    </div>
</div>

@section('scripts')

    <script type="text/javascript">
        $(function () {


        });
    </script>

@endsection

