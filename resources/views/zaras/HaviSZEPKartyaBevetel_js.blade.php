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

        var chart_haviSZEPKartyaBevetel = highchartLine( 'haviSZEPKartyaBevetel', 'line', 450, LineChartKategoria(<?php echo $haviSZEPKartyaBevetel; ?>), LineChartData(<?php echo $haviSZEPKartyaBevetel; ?>, ''), 'Havi SZÉP kártya bevétel', 'havi bontás', 'forint');

    });

</script>
