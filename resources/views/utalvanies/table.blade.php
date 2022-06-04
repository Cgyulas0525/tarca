<div class="table-responsive">
    <table class="table" id="utalvanies-table">
        <thead>
            <tr>
                <th>Sorszam</th>
        <th>Osszeg</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($utalvanies as $utalvany)
            <tr>
                <td>{!! $utalvany->sorszam !!}</td>
            <td>{!! $utalvany->osszeg !!}</td>
                <td>
                    {!! Form::open(['route' => ['utalvanies.destroy', $utalvany->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('utalvanies.show', [$utalvany->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{!! route('utalvanies.edit', [$utalvany->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
