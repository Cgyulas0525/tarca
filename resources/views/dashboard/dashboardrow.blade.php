<p>
<div class="row" style="margin-top: 10px;">
    <div class="col-lg-4 col-md-8 col-xs-12" style="margin-top: 10px;">
        <!-- small box -->
        <div class="box box-widget widget-user-2">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header" id="header1"></div>
            <div class="panel-footer" style="background-color: white;">
                <ul class="nav nav-stacked">
                    <li><a href="{!! route('partners.index') !!}">Partnerek összesen <span class="pull-right badge bg-blue"> {{$partnerDb}} db </span></a></li>
                    <li><a href="{!! route('szamlas.index') !!}">{{ $ev }} Költség <span class="pull-right badge bg-aqua"> {{$osszkoltseg}} Ft</span></a></li>
                    <li><a href="{!! route('szamlas.index') !!}">{{ $ev }} Árbevétel <span class="pull-right badge bg-green">{{$arbevetel}} Ft</span></a></li>
                    <li><a href="{!! route('szamlas.index') !!}">{{ $ev }} Egyenleg <span class="pull-right badge bg-red">{{$egyenleg}} Ft</span></a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-8 col-xs-12" style="margin-top: 10px;">
        <!-- small box -->
        <div class="box box-widget widget-user-2">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header" id="header2"></div>
            <div class="panel-footer">
                <ul class="nav nav-stacked">
                    <li><a href="{!! route('termekfocsoports.index') !!}">Termék főcsoport <span class="pull-right badge bg-aqua"> {{$termekfocsoportDb}} db</span></a></li>
                    <li><a href="{!! route('termekfocsoports.index') !!}">Termék csoport <span class="pull-right badge bg-green"> {{$termekcsoportDb}} db</span></a></li>
                    <li><a href="{!! route('termeks.index') !!}">Termékek összesen <span class="pull-right badge bg-blue"> {{$termekDb}} db </span></a></li>
                    <li><a href="{!! route('termeks.index') !!}">Vegán termékek <span class="pull-right badge bg-red"> 0 db</span></a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-8 col-xs-12" style="margin-top: 10px;">
        <!-- small box -->
        <div class="box box-widget widget-user-2">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header" id="header3"></div>
            <div class="panel-footer">
                <h3 class="m-t-0" style="text-align: center;">Vác Piac 7 számú üzlet</h3>
                <h3 class="m-t-0">Nyitva tartás:</h3>
                <h4 class="m-t-0">Hétfő - Péntek: 7.00 - 16.00</h4>
                <h4 class="m-t-0">Szombat: 7.00 - 13.00</h4>
            </div>
        </div>
    </div>

    <div class="col-lg-6 col-md-6 col-xs-12">
        <section class="content-header">
            <h1><img src="public/img/menu/todo_25.png"> Feladat</h1>
        </section>
        @include('flash::message')
        <div class="clearfix"></div>
        <div class="box box-primary" id="mitis">
            <div class="box-body">
                  <table class="table table-hover table-bordered table"></table>
              </div>
        </div>
        <div class="text-center"></div>
    </div>
    <div class="col-lg-6 col-md-6 col-xs-12">
        <section class="content-header">
            <h1><img src="public/img/menu/ktgfocsoport_25.png"> Az elmúlt 12 hét költség alalkulsása </h1>
        </section>
        <figure class="highcharts-figure">
            <div id="evhonapKoltseg"></div>
        </figure>
    </div>
</div>
<p>
<div class="row">
    <div class="col-lg-6 col-md-8 col-xs-12" style="position: relative; height: 450px; margin-top:20px;">
        <div class="nav-tabs-custom" >
        <!-- Tabs within a box -->
            <ul class="nav nav-tabs pull-right">
                <li class="active"><a href="#koltsegcsoport-chart" data-toggle="tab">Csoportonként</a></li>
                <li><a href="#koltsegfocsoport-chart" data-toggle="tab">Főcsoportonként</a></li>
                <li class="pull-left header"><img src="public/img/menu/ktgfocsoport_25.png"> Költségek</li>
            </ul>
            <div class="tab-content no-padding">
                <div id="koltsegcsoport-chart" class="tab-pane fade in active" style="position: relative; height: 400px;">
                    <figure class="highcharts-figure">
                        <div id="koltsegcsoport"></div>
                        <div id="button-bar">
                            <a class="route-button" title="Számlák" href="{!! route('szamlas.index') !!}"><img src={{config('chartbuttontablazat')}}></a>
                        </div>
                    </figure>
                </div>
                <div id="koltsegfocsoport-chart" class="tab-pane fade in" style="position: relative; height: 400px;">
                    <figure class="highcharts-figure">
                        <div id="koltsegfocsoport"></div>
                        <div id="button-bar">
                            <a class="route-button" title="Számlák" href="{!! route('szamlas.index') !!}"><img src={{config('chartbuttontablazat')}}></a>
                        </div>
                    </figure>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-md-8 col-xs-12" style="position: relative; height: 450px; margin-top:20px;">
        <div class="nav-tabs-custom" >
        <!-- Tabs within a box -->
            <ul class="nav nav-tabs pull-right">
                <li class="active"><a href="#termek-chart" data-toggle="tab">Termékenként</a></li>
                <li><a href="#termekcsoport-chart" data-toggle="tab">Csoportonként</a></li>
                <li><a href="#termekfocsoport-chart" data-toggle="tab">Főcsoportonként</a></li>
                <li class="pull-left header"><img src="public/img/menu/ktgfocsoport_25.png"> Termék beszerzés</li>
            </ul>
            <div class="tab-content no-padding">
                <div id="termek-chart" class="tab-pane fade in active" style="position: relative; height: 400px;">
                    <figure class="highcharts-figure">
                        <div id="termek"></div>
                        <div id="button-bar">
                            <a class="route-button" title="Számlák" href="{!! route('szamlas.index') !!}"><img src={{config('chartbuttontablazat')}}></a>
                        </div>
                    </figure>
                </div>
                <div id="termekcsoport-chart" class="tab-pane fade in" style="position: relative; height: 400px;">
                    <figure class="highcharts-figure">
                        <div id="termekcsoport"></div>
                        <div id="button-bar">
                            <a class="route-button" title="Számlák" href="{!! route('szamlas.index') !!}"><img src={{config('chartbuttontablazat')}}></a>
                        </div>
                    </figure>
                </div>
                <div id="termekfocsoport-chart" class="tab-pane fade in" style="position: relative; height: 400px;">
                    <figure class="highcharts-figure">
                        <div id="termekfocsoport"></div>
                        <div id="button-bar">
                            <a class="route-button" title="Számlák" href="{!! route('szamlas.index') !!}"><img src={{config('chartbuttontablazat')}}></a>
                        </div>
                    </figure>
                </div>
            </div>
        </div>
    </div>
</div>
