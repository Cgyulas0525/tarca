<div class="row" style="margin-top: 10px;">
    <div class="col-lg-4 col-md-8 col-xs-12" style="margin-top: 10px;">
        <!-- small box -->
        <div class="box box-widget widget-user-2">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header" id="header1"></div>
            <div class="panel-footer" style="background-color: white;">
                <ul class="nav nav-stacked">
                    <li><a href="{!! route('szamlas.index') !!}">{{ $ev }} Költség
                        <span class="pull-right badge bg-aqua"> {{ number_format( App\Classes\SzamlaClass::aktualisEvOsszKoltseg(), 0, ",", "." ) }} Ft</span></a></li>
                    <li><a href="{!! route('zaras.index') !!}">{{ $ev }} myPos
                        <span class="pull-right badge bg-green">{{ number_format(Zaras::aktualisEvBankkartyaOsszesen(), 0, ",", "." ) }} Ft</span></a></li>
                    <li><a href="{!! route('zaras.index') !!}">{{ $ev }} SZÉP kártya
                        <span class="pull-right badge bg-green">{{ number_format(Zaras::aktualisEvSZEPkartyaOsszesen(), 0, ",", "." ) }} Ft</span></a></li>
                    <li><a href="{!! route('zaras.index') !!}">{{ $ev }} Készpénz
                        <span class="pull-right badge bg-green">{{ number_format(Zaras::aktualisEvKeszpenzOsszesen(), 0, ",", "." ) }} Ft</span></a></li>
                    <li><a href="{!! route('zaras.index') !!}">{{ $ev }} Árbevétel
                        <span class="pull-right badge bg-green">{{ number_format(Zaras::aktualisEvSumArbevetel(), 0, ",", "." ) }} Ft</span></a></li>
                    <li><a href="{!! route('szamlas.index') !!}">{{ $ev }} Egyenleg
                        <span class="pull-right badge bg-red">{{ number_format((Zaras::aktualisEvSumArbevetel() - App\Classes\SzamlaClass::aktualisEvOsszKoltseg()), 0, ",", "." ) }} Ft</span></a></li>
                    <li><a href="{!! route('szamlas.index') !!}">{{ $ev }} Napi átlag bevétel
                            <span class="pull-right badge bg-red">{{ number_format((App\Models\Zaras::whereBetween('datum', [date('Y-m-d', strtotime('first day of january this year')),
                                                               date('Y-m-d', strtotime('last day of december this year'))])->get()->sum('osszeg') / App\Models\Zaras::whereBetween('datum', [date('Y-m-d', strtotime('first day of january this year')),
                                                               date('Y-m-d', strtotime('last day of december this year'))])->count()), 0, ",", "." ) }} Ft</span></a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-8 col-xs-12" style="margin-top: 10px;">
        <!-- small box -->
        <div class="box box-widget widget-user-2">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header">
                <a href="{!! route('szamlas.index') !!}"><img src={{ URL::asset('/public/img/menu/szamla.jpg')}} class="penztarkep" ></a>
            </div>
            <div class="panel-footer">
                <ul class="nav nav-stacked">
                    <li><a href="{!! route('szamlas.index') !!}">{{ $ev - 1 }} Költség
                            <span class="pull-right badge bg-aqua"> {{ number_format( App\Classes\SzamlaClass::idoszakEvOsszKoltseg(
                                                               date('Y-m-d', strtotime('first day of january last year')),
                                                               date('Y-m-d', strtotime('last day of december last year'))
                                 ), 0, ",", "." ) }} Ft
                            </span></a></li>
                    <li><a href="{!! route('zaras.index') !!}">{{ $ev - 1 }} myPos
                            <span class="pull-right badge bg-green">{{ number_format(Zaras::idoszakBankkartyaOsszesen(
                                                               date('Y-m-d', strtotime('first day of january last year')),
                                                               date('Y-m-d', strtotime('last day of december last year')),
                                                               'kartya'
                                 ), 0, ",", "." ) }} Ft
                            </span></a></li>
                    <li><a href="{!! route('zaras.index') !!}">{{ $ev - 1 }} SZÉP kártya
                            <span class="pull-right badge bg-green">{{ number_format(Zaras::idoszakBankkartyaOsszesen(
                                                               date('Y-m-d', strtotime('first day of january last  year')),
                                                               date('Y-m-d', strtotime('last day of december last year')),
                                                               'szep'
                                 ), 0, ",", "." ) }} Ft
                            </span></a></li>
                    <li><a href="{!! route('zaras.index') !!}">{{ $ev - 1 }} Készpénz
                            <span class="pull-right badge bg-green">{{ number_format(Zaras::idoszakKeszpenzOsszesen(
                                                               date('Y-m-d', strtotime('first day of january last year')),
                                                               date('Y-m-d', strtotime('last day of december last year'))
                                ), 0, ",", "." ) }} Ft</span></a></li>
                    <li><a href="{!! route('zaras.index') !!}">{{ $ev - 1 }} Árbevétel
                            <span class="pull-right badge bg-green">{{ number_format(Zaras::idoszakArbevetel(
                                                               date('Y-m-d', strtotime('first day of january last year')),
                                                               date('Y-m-d', strtotime('last day of december last year'))
                                ), 0, ",", "." ) }} Ft</span></a></li>
                    <li><a href="{!! route('szamlas.index') !!}">{{ $ev - 1 }} Egyenleg
                            <span class="pull-right badge bg-red">{{ number_format((Zaras::idoszakArbevetel(
                                                               date('Y-m-d', strtotime('first day of january last year')),
                                                               date('Y-m-d', strtotime('last day of december last year'))
                                ) - App\Classes\SzamlaClass::idoszakEvOsszKoltseg(
                                                               date('Y-m-d', strtotime('first day of january last year')),
                                                               date('Y-m-d', strtotime('last day of december last year'))
                                 )), 0, ",", "." ) }} Ft</span></a></li>
                    <li><a href="{!! route('szamlas.index') !!}">{{ $ev - 1 }} Napi átlag bevétel
                            <span class="pull-right badge bg-red">{{ number_format((App\Models\Zaras::whereBetween('datum', [date('Y-m-d', strtotime('first day of january last year')),
                                                               date('Y-m-d', strtotime('last day of december last year'))])->get()->sum('osszeg') / App\Models\Zaras::whereBetween('datum', [date('Y-m-d', strtotime('first day of january last year')),
                                                               date('Y-m-d', strtotime('last day of december last year'))])->count()), 0, ",", "." ) }} Ft</span></a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-8 col-xs-12" style="margin-top: 10px;">
        <!-- small box -->
        <div class="box box-widget widget-user-2">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header">
                <a href="{!! route('penztarIndit') !!}"><img src={{ URL::asset('/public/img/menu/penztar.png')}} class="penztarkep" ></a>
            </div>
            <div class="panel-footer">
                <ul class="nav nav-stacked">
                    <li><a href="{!! route('szamlas.index') !!}">Össz Költség
                            <span class="pull-right badge bg-aqua"> {{ number_format( App\Classes\SzamlaClass::idoszakEvOsszKoltseg(
                                                               date('Y-m-d', strtotime('first day of january 2021')),
                                                               date('Y-m-d', strtotime('last day of december this year'))
                                 ), 0, ",", "." ) }} Ft
                            </span></a></li>
                    <li><a href="{!! route('zaras.index') !!}">Össz myPos
                            <span class="pull-right badge bg-green">{{ number_format(Zaras::idoszakBankkartyaOsszesen(
                                                               date('Y-m-d', strtotime('first day of january 2021')),
                                                               date('Y-m-d', strtotime('last day of december this year')),
                                                               'kartya'
                                 ), 0, ",", "." ) }} Ft
                            </span></a></li>
                    <li><a href="{!! route('zaras.index') !!}">Össz SZÉP kártya
                            <span class="pull-right badge bg-green">{{ number_format(Zaras::idoszakBankkartyaOsszesen(
                                                               date('Y-m-d', strtotime('first day of january 2021')),
                                                               date('Y-m-d', strtotime('last day of december this year')),
                                                               'szep'
                                 ), 0, ",", "." ) }} Ft
                            </span></a></li>
                    <li><a href="{!! route('zaras.index') !!}">Össz Készpénz
                            <span class="pull-right badge bg-green">{{ number_format(Zaras::idoszakKeszpenzOsszesen(
                                                               date('Y-m-d', strtotime('first day of january 2021')),
                                                               date('Y-m-d', strtotime('last day of december this year'))
                                ), 0, ",", "." ) }} Ft</span></a></li>
                    <li><a href="{!! route('zaras.index') !!}">Össz Árbevétel
                            <span class="pull-right badge bg-green">{{ number_format(Zaras::idoszakArbevetel(
                                                               date('Y-m-d', strtotime('first day of january 2021')),
                                                               date('Y-m-d', strtotime('last day of december this year'))
                                ), 0, ",", "." ) }} Ft</span></a></li>
                    <li><a href="{!! route('szamlas.index') !!}">Össz Egyenleg
                            <span class="pull-right badge bg-red">{{ number_format((Zaras::idoszakArbevetel(
                                                               date('Y-m-d', strtotime('first day of january 2021')),
                                                               date('Y-m-d', strtotime('last day of december this year'))
                                ) - App\Classes\SzamlaClass::idoszakEvOsszKoltseg(
                                                               date('Y-m-d', strtotime('first day of january 2021')),
                                                               date('Y-m-d', strtotime('last day of december this year'))
                                 )), 0, ",", "." ) }} Ft</span></a></li>
                    <li><a href="{!! route('szamlas.index') !!}">Napi átlag bevétel
                            <span class="pull-right badge bg-red">{{ number_format((App\Models\Zaras::whereBetween('datum', [date('Y-m-d', strtotime('first day of january 2021')),
                                                               date('Y-m-d', strtotime('last day of december this year'))])->get()->sum('osszeg') / App\Models\Zaras::whereBetween('datum', [date('Y-m-d', strtotime('first day of january 2021')),
                                                               date('Y-m-d', strtotime('last day of december this year'))])->count()), 0, ",", "." ) }} Ft</span></a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-6 col-md-6 col-xs-12">
        @include('zaras.zarasTable')
        <p style="margin-top: 100px;"></p>
        @include('zaras.zarasNapiArbevetelMegoszlas')
    </div>
    <div class="col-lg-6 col-md-8 col-xs-12" style="position: relative;">
        <div class="col-lg-12">
            <div class="nav-tabs-custom" id="tabs">
                <!-- Tabs within a box -->
                <ul class="nav nav-tabs pull-right">
                    <li class="nav-item" id="fmod"><a href="#fmod-chart" data-toggle="tab">Fizetési mód</a></li>
                    <li class="nav-item" id="bk"><a href="#bk-chart" data-toggle="tab">Kiadás</a></li>
                    <li class="nav-item" id="havi"><a href="#havi-chart" data-toggle="tab">Havi</a></li>
                    <li class="nav-item" id="heti"><a href="#heti-chart" data-toggle="tab">Heti</a></li>
                    <li class="nav-item" id="napi"><a href="#napi-chart" data-toggle="tab">Napi</a></li>
                    <li class="pull-left header"><img src="public/img/menu/zaras_25.jpg"> Árbevétel</li>
                </ul>
                <div class="tab-content no-padding">
                    <div id="napi-chart" class="tab-pane active" style="position: relative; height: 400px;">
                        @include('zaras.zarasNapiArbevetel')
                    </div>
                    <div id="heti-chart" class="tab-pane fade in" style="position: relative; height: 400px;">
                        @include('zaras.zarasHetiArbevetelMegoszlas')
                    </div>
                    <div id="havi-chart" class="tab-pane fade in" style="position: relative; height: 400px;">
                        @include('zaras.HaviArbevetel')
                    </div>
                    <div id="bk-chart" class="tab-pane fade in" style="position: relative; height: 400px;">
                        @include('dashboard.haviBevetelKiadas')
                    </div>
                    <div id="fmod-chart" class="tab-pane fade in" style="position: relative; height: 400px;">
                        @include('dashboard.fizetesiMod')
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12" style="margin-top: 40px;">
            @include('zaras.atlagNapiArbevetelMegoszlas')
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-6 col-md-8 col-xs-12" style="position: relative; height: 450px; margin-top:20px;">
        <div id="koltsegcsoport-chart" class="tab-pane fade in active" style="position: relative; height: 400px;">
            <figure class="highcharts-figure">
                <div id="koltsegcsoport"></div>
                <div id="button-bar">
                    <a class="route-button" title="Számlák" href="{!! route('szamlas.index') !!}"><img src={{config('chartbuttontablazat')}}></a>
                </div>
            </figure>
        </div>
    </div>

    <div class="col-lg-6 col-md-8 col-xs-12" style="position: relative; height: 450px; margin-top:20px;">
        <div class="nav-tabs-custom" id="tabs">
            <!-- Tabs within a box -->
            <ul class="nav nav-tabs pull-right">
                <li class="nav-item" id="beszt"><a href="#besz-tab" data-toggle="tab">Beszerzések</a></li>
                <li class="nav-item" id="hetit"><a href="#hetibk-tab" data-toggle="tab">Bevétel / Kiadás heti</a></li>
                <li class="nav-item" id="havit"><a href="#havibk-tab" data-toggle="tab">Bevétel / Kiadás havi</a></li>
            </ul>
            <div class="tab-content no-padding" id="atab">
                <div id="besz-tab" class="tab-pane fade in" style="position: relative; height: 400px;">
                    @include('dashboard.beszerzesekTable')
                </div>
                <div id="hetibk-tab" class="tab-pane fade in" style="position: relative; height: 400px;">
                    <div class="box-body">
                        <table class="table table-hover table-bordered heti-table" style="width: 100%;"></table>
                    </div>
                </div>
                <div id="havibk-tab" class="tab-pane active" style="position: relative; height: 400px;">
                    <div class="box-body">
                        <table class="table table-hover table-bordered havi-table" style="width: 100%;"></table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-8 col-md-12 col-xs-12" style="position: relative; height: 450px; margin-top:20px;">
        @include('dashboard.sparkline.szamlaSparkline')
    </div>
    <div class="col-lg-4 col-md-12 col-xs-12" style="position: relative; height: 450px; margin-top:20px;">
        <h4 style="font-weight: bold; text-align: center;">Beszerzések negyedévenként</h4>
        <h4 style="font-weight: bold; text-align: center;">Időszak:  - </h4>
        <figure class="highcharts-figure">
            <div id="container"></div>
            <p class="highcharts-description">
                Demonstrating a basic area chart, also known as a mountain chart.
                Area charts are similar to line charts, but commonly used to visualize
                volumes.
            </p>
        </figure>
    </div>
</div>

