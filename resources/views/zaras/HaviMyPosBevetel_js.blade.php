<script type="text/javascript">
    $(function () {

        function LineChartKategoria(data){
            kategoria = [];
            for (i = 0; i < data.length; i++){
                kategoria.push(data[i].nev);
            }
            return kategoria;
        }

        function LineChartData(data, mi){
            chartdata = [];
            cdata = [];
            for (i = 0; i < data.length; i++){
                cdata.push(parseInt(data[i].osszeg));
            }
            chartdata.push({name: mi, data: cdata});
            return chartdata;
        }

        var chart_haviMyPosBevetel = highchartLine( 'haviMyPosBevetel', 'line', 450, LineChartKategoria(<?php echo $haviMyPosBevetel; ?>), LineChartData(<?php echo $haviMyPosBevetel; ?>, ''), 'Havi MyPOS bevétel', 'havi bontás', 'forint');

    });

</script>
