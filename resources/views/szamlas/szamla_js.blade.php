<script type="text/javascript">

    var SITEURL = "{{url('/')}}";

    function datumAllitas(){
        var null_date = new Date(0);
        let fizetesiMod = $('#fizitesimod').val();
        let kelt = $('#kelt').val();
        if ( fizetesiMod != 0 && kelt != 0){
            if ( fizetesiMod == 2058 || fizetesiMod == 2060){
                $('#teljesites').val(kelt);
                $('#fizetesihatarido').val(kelt);
            }else{
                $('#teljesites').val(kelt);
                $('#fizetesihatarido').val(null_date);
            }
        }else{
            $('#teljesites').val(null_date);
            $('#fizetesihatarido').val(null_date);
        }
    }

    $('#fizitesimod').change(function(){
        datumAllitas();
    });

    $('#kelt').change(function(){
        datumAllitas();
    });

    $('#teljesites').change(function(){
    });

    $('#fizetesihatarido').change(function(){
    });

    RequiredBackgroundModify('.form-control')

</script>
