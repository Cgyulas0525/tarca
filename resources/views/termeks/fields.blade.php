<!-- Nev Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nev', 'Név:') !!}
    {!! Form::text('nev', null, ['class' => 'form-control', 'required' => 'true']) !!}
    {!! Form::label('csoport', 'Csoport:') !!}
    {!! Form::select('csoport', [" "] + \App\Models\termekcsoport::orderBy('nev')->pluck('nev', 'id')->toArray(), null,['class'=>'select2 form-control', 'required' => 'true', 'id' => 'csoport']) !!}
</div>
<!-- Me Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cikkszam', 'Cikkszám:') !!}
    {!! Form::text('cikkszam', null, ['style' => 'cursor: not-allowed', 'class' => 'form-control']) !!}
    {!! Form::label('me', 'Mennyiségi egység:') !!}
    {!! Form::select('me', [" "] + \App\Models\Dictionary::where('tipus', '=', '26')->orderBy('nev')->pluck('nev', 'id')->toArray(), null,['class'=>'select2 form-control', 'id' => 'me']) !!}
</div>
<!-- Megjegyzes Field -->
<div class="form-group col-sm-12">
    {!! Form::label('megjegyzes', 'Megjegyzés:') !!}
    {!! Form::textarea('megjegyzes', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Ment', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('termeks.index') !!}" class="btn btn-default">Kilép</a>
</div>

@section('scripts')
    @include('functions.required_js')
    <script type="text/javascript">

        var SITEURL = "{{url('/')}}";
        var CIKKSZAM = " ";

        RequiredBackgroundModify('.form-control')

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function getKovetkezoSzolgaltatasCikkszam(){
            $.ajax({
                type: "POST",
                url: SITEURL + '/api/getMaxSzolgaltatasCikkszam',
                data: "&betu=S",
                success: function (response) {
                    CIKKSZAM = response.original[0].cikkszam_max;
                    var ertek = parseInt(CIKKSZAM.substr(2,7)) + 1;
                    ertek = ertek.toString();
                    CIKKSZAM = 'S-' + ertek.padStart(7, '0')
                    $('#cikkszam').val(CIKKSZAM);
                },
                error: function (response) {
                    console.log('Error:', response);
                }
            });
        }

        function getKovetekezoTermekCikkszam(ertek){
            $.ajax({
                type: "POST",
                url: SITEURL + '/api/getMaxTermekCikkszam',
                data: "&csoport=" + ertek,
                success: function (response) {
                    CIKKSZAM = response;
                    var ertek = "";
                    if (isNaN(CIKKSZAM)){
                        CIKKSZAM = response[0].cikkszam_max;
                        var ertek = parseInt(CIKKSZAM.substr(2,7)) + 1;
                    }else{
                        var ertek = parseInt(CIKKSZAM) + 1;
                    }
                    ertek = ertek.toString();
                    CIKKSZAM = 'T-' + ertek
                    $('#cikkszam').val(CIKKSZAM);
                },
                error: function (response) {
                    console.log('Error:', response);
                }
            });
        }

        $('#csoport').change(function(){
            var ertek = $('#csoport').val();
            if (ertek != 0) {
                $.ajax({
                    type: "POST",
                    url: SITEURL + '/api/getFocsoportFromCsoport',
                    data: "&id=" + ertek,
                    success: function (response) {
                        let resp = parseInt(response[0].tsz);
                        if ( resp == 2071 ){
                            // Termék
                            getKovetekezoTermekCikkszam(ertek);
                        }else if ( resp == 2072){
                            // Szolgáltatás
                            getKovetkezoSzolgaltatasCikkszam();
                        }
                    },
                    error: function (response) {
                        console.log('Error:', response);
                    }

                });
            }else{
                $('#cikkszam').val(" ");
            }
        });

    </script>
@endsection
