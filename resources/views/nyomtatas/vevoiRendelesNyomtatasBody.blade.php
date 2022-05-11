@section('css')
    @include('layouts.costumcss')
@endsection()

<div class="content">
    <div class="row">
        <div class="col-xs-12">
            <h2 style="text-align: center;">
                Vevői rendelések
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
                        <th style="text-align: center;">Megrendelés szám</th>
                        <th style="text-align: center;">Partner</th>
                        <th style="text-align: center;">Státusz</th>
                        <th style="text-align: center;">Mikor</th>
                        <th style="width: 100px; text-align: center;">Mikorra</th>
                        <th style="width: 100px; text-align: right;">Mennyiség</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($vevoirendelesek as $key => $vevoirendeles)
                        <tr id="sor">
                            <td>{{ $vevoirendeles->megrendelesszam }}</td>
                            <td>{{ $vevoirendeles->partnernev }}</td>
                            <td>{{ $vevoirendeles->statusznev }}</td>
                            <td style="text-align: center;">{{ date('Y.m.d', strtotime($vevoirendeles->mikor)) }}</td>
                            <td style="text-align: center;">{{ date('Y.m.d', strtotime($vevoirendeles->mikorra)) }}</td>
                            <td style="width: 100px; text-align: right;"></td>
                        </tr>
                        @foreach (App\Models\Vevoirendelestetel::where('vevoirendelesfej_id', $vevoirendeles->id)
                                                               ->whereNull('deleted_at')
                                                               ->get()
                                 as $key => $vevoirendelestetel)
                            <tr id="sor">
                                <td colspan="5">{{ $vevoirendelestetel->termeknev }}</td>
                                <td style="width: 100px; text-align: right;">{{ number_format($vevoirendelestetel->mennyiseg, 0, ",", ".") }}</td>
                            </tr>
                        @endforeach
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

