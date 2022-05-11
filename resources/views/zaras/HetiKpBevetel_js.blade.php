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

        var chart_hetiKpBevetel = highchartLine( 'hetiKpBevetel', 'line', 450, LineChartKategoria(<?php echo $hetiKpBevetel; ?>), LineChartData(<?php echo $hetiKpBevetel; ?>, ''), 'Heti készpénz bevétel', 'heti bontás', 'forint');

    });

</script>
