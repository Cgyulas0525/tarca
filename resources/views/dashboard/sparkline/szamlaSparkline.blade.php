@section('css')
    @include('layouts.sparklinecss')
@endsection

<?php
    $partner = NULL;
    $tol = (new DateTime('first day of -' . (((date('n') - 1) % 3) + 12) . ' month'))->format('Y-m-d'); # first day of previous quarter
    $ig = (new DateTime('last day of -' . (((date('n') - 1) % 3) + 1) . ' month'))->format('Y-m-d'); # last day of previous quarter
    $partners = SzamlaClass::szamlakPartnerIdoszakOsszesen($partner, $tol, $ig);
?>

<div id="result"></div>
<h4 style="font-weight: bold; text-align: center;">Beszerzések negyedévenként</h4>
<h4 style="font-weight: bold; text-align: center;">Időszak: {{ $tol }} - {{ $ig }}</h4>
<table class="table table-hover table-bordered table-sparkline" style="width: 100%;">

    <thead>
    <tr>
        <th style="width: 25%;">Partner</th>
        <th style="width: 5%; text-align: right;">Összesen</th>
        <th style="width: 30%; text-align: center;">Forgalom / negyedév</th>
        <th style="width: 30%; text-align: center;">Forgalom / negyedév</th>
    </tr>
    </thead>
    <tbody id="tbody-sparkline">
        @foreach( $partners as $partner)
            <?php
                $dataSparkline = App\Classes\SzamlaSparklineClass::sparklineData($partner, $tol, $ig);
            ?>
            <tr>
                <th style="width: 25%;">{{ $partner->partner }}</th>
                <td style="width: 5%; text-align: right;">{{ number_format($partner->osszeg, 0, ",", "." )  }}</td>
                <td data-sparkline="{{ $dataSparkline }}" style="width: 30%;">
                <td data-sparkline="{{ $dataSparkline }} ; column" style="width: 30%;">
            </td>
            </tr>
        @endforeach
    </tbody>
</table>

