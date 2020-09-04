<script>

function RCB( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
    if ( aData.jelzo == 1990 )
    {
        $('td', nRow).css('background-color', 'red' );
    }
    else if ( aData.jelzo == 1989 )
    {
        $('td', nRow).css('background-color', 'lightgreen');
    }
    else if ( aData.jelzo == 1991 )
    {
        $('td', nRow).css('background-color', 'lightblue');
    }
    else if ( aData.jelzo == 1992 )
    {
        $('td', nRow).css('background-color', 'cadetblue');
    }
    else if ( aData.jelzo == 2034 )
    {
        $('td', nRow).css('background-color', 'crimson');
    }
    else if ( aData.jelzo == 2035 )
    {
        $('td', nRow).css('background-color', 'deeppink');
    }
}

</script>
