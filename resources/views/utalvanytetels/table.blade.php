<div class="table-responsive">
    <table class="table" id="utalvanytetels-table">
        <thead>
            <tr>
                <th>Utalvany Id</th>
        <th>Osszeg</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($utalvanytetels as $utalvanytetel)
            <tr>
                <td>{!! $utalvanytetel->utalvany_id !!}</td>
            <td>{!! $utalvanytetel->osszeg !!}</td>
                <td>
                    {!! Form::open(['route' => ['utalvanytetels.destroy', $utalvanytetel->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('utalvanytetels.show', [$utalvanytetel->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{!! route('utalvanytetels.edit', [$utalvanytetel->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
