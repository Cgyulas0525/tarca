<div class="content">
    <table class="table table-hover table-bordered">
        <thead>
        <tr>
            <th style="text-align: center;">Termek</th>
            <th style="text-align: center;">Mennyiség</th>
            <th style="text-align: center;">Átadott</th>
        </tr>
        </thead>
        <tbody>
        @foreach (App\Models\Vevoirendelestetel::where('vevoirendelesfej_id', $vevoirendeles->id)->whereNull('deleted_at')->get()
                 as $key => $vevoirendelestetel)
            <tr id="sor">
                <td>{{ $vevoirendelestetel->termeknev }}</td>
                <td style="width: 100px; text-align: right;">{{ number_format($vevoirendelestetel->mennyiseg, 0, ",", ".") }}</td>
                <td style="width: 100px; text-align: right;">{{ number_format($vevoirendelestetel->atadott, 0, ",", ".") }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
