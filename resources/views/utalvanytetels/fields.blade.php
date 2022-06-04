<!-- Utalvany Id Field -->
<div class="form-group col-sm-2">
    {!! Form::label('utalvany_id', 'Utalvány:') !!}
    @if (isset($utalvany))
        {!! Form::text('utalvany_sorszam', $utalvany->sorszam, ['style' => 'cursor: not-allowed', 'class' => 'form-control', 'readonly' => 'true']) !!}
        {!! Form::hidden('utalvany_id', $utalvany->id, ['class' => 'form-control']) !!}
    @else
        {!! Form::text('utalvany_sorszam', App\Models\Utalvany::find($utalvanytetel->utalvany_id)->sorszam, ['style' => 'cursor: not-allowed', 'class' => 'form-control', 'readonly' => 'true']) !!}
        {!! Form::hidden('utalvany_id', $utalvanytetel->utalvany_id, ['class' => 'form-control']) !!}
    @endif
</div>

<!-- Osszeg Field -->
<div class="form-group col-sm-2">
    {!! Form::label('osszeg', 'Összeg:') !!}
    @if (isset($utalvany))
        {!! Form::number('osszeg', $utalvany->felhasznalhato, ['class' => 'form-control text-right', 'id' => 'osszeg']) !!}
    @else
        {!! Form::number('osszeg', $utalvanytetel->osszeg, ['class' => 'form-control text-right', 'id' => 'osszeg']) !!}
    @endif
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Ment', ['class' => 'btn btn-primary']) !!}
    @if (isset($utalvany))
        <a href="{!! route('utalvanies.edit', $utalvany->id) !!}" class="btn btn-default">Kilép</a>
    @else
        <a href="{!! route('utalvanies.edit', $utalvanytetel->utalvany_id) !!}" class="btn btn-default">Kilép</a>
    @endif
</div>
