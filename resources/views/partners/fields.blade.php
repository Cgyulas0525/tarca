<!-- Nev Field -->
<div class="form-group col-sm-4">
    {!! Form::label('nev', 'Név:') !!}
    {!! Form::text('nev', null, ['class' => 'form-control', 'required' => 'true'] ) !!}
    {!! Form::label('adoszam', 'Adószám:') !!}
    {!! Form::text('adoszam', null, ['class' => 'form-control', 'required' => 'true']) !!}
    {!! Form::label('bankszamla', 'Bankszámla:') !!}
    {!! Form::text('bankszamla', null, ['class' => 'form-control']) !!}
</div>

<!-- Isz Field -->
<div class="form-group col-sm-4">
    {!! Form::label('isz', 'Isz:') !!}
    {!! Form::select('isz', [" "] + \App\Models\Telepules::orderBy('iranyitoszam')->pluck('iranyitoszam', 'iranyitoszam')->toArray(), null,['class'=>'select2 form-control', 'id' => 'isz']) !!}
    {!! Form::label('telepules', 'Település:') !!}
    {!! Form::select('telepules', [" "] + \App\Models\Telepules::orderBy('telepules')->pluck('telepules', 'id')->toArray(), null,['class'=>'select2 form-control', 'id' => 'telepules']) !!}
    {!! Form::label('cim', 'Cím:') !!}
    {!! Form::text('cim', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-4">
    {!! Form::label('tipus', 'Típus:') !!}
    {!! Form::select('tipus', [" "] + \App\Models\Dictionary::where('tipus', '=', '24')->orderBy('nev')->pluck('nev', 'id')->toArray(), null,['class'=>'select2 form-control', 'required' => 'true', 'id' => 'tipus']) !!}
    {!! Form::label('email', 'Email:') !!}
    {!! Form::email('email', null, ['class' => 'form-control']) !!}
    {!! Form::label('telefonszam', 'Telefonszám:') !!}
    {!! Form::text('telefonszam', null, ['class' => 'form-control']) !!}
</div>
<!-- Email Field -->
<div class="form-group col-sm-12">
    {!! Form::label('megjegyzes', 'Megjegyzés:') !!}
    {!! Form::textarea('megjegyzes', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Ment', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('partners.index') !!}" class="btn btn-default">Kilép</a>
</div>

@section('scripts')
    @include('functions.required_js')
    <script type="text/javascript">

        RequiredBackgroundModify('.form-control')
        var SITEURL = "{{url('/')}}";

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#isz').change(function(){
            var countryID = $('#isz').val();
            if(countryID){
                $.ajax({
                   type:"POST",
                   url: SITEURL + '/api/getTelepulesList',
                   data: "&id=" + countryID,
                   success:function(res){
                    if(res){
                        $("#telepules").empty();
                        $("#telepules").append('<option></option>');
                        $.each(res,function(key,value){
                            var option = "<option value='"+value.id+"'>"+value.telepules+"</option>";
                            $("#telepules").append(option);
                        });
                        $('#telepules').val(res[0].id);
                    }else{
                       $("#telepules").empty();
                    }
                   }
                });
            }else{
                $("#telepules").empty();
            }
        });
    </script>
@endsection
