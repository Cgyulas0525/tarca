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
            bevdata = [];
            kiaddata = [];
            for (i = 0; i < data.length; i++){
                bevdata.push(parseInt(data[i].utalas));
                kiaddata.push(parseInt(data[i].kp))
            }
            chartdata.push({name: 'Utalás', data: bevdata});
            chartdata.push({name: 'Kp/Kártya', data: kiaddata});
            return chartdata;
        }

        var chart_haviFizetesiMod = highchartLine( 'haviFizetesiMod', 'line', 450, LineChartKategoria(<?php echo $haviFizetesiMod; ?>), LineChartData(<?php echo $haviFizetesiMod; ?>, ''), 'Havi fizetésimód', 'havi bontás', 'forint');

    });

</script>


