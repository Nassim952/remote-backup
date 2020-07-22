<head>
    <title>Statistiques</title>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="https://momentjs.com/downloads/moment.min.js"></script>
</head>
<script type="text/javascript">
    var totalReservationArray = <?php echo json_encode($datas) ?>;
</script>

<div class="site-content">
    <div id="head-title">
        <h2 style="font-size:32px;">Statistiques</h2>
    </div>
    <div id="separation-bar"></div>
    

    <div class="graph-container">
        <select id="chartType">
            <option value="annee">Année</option>
            <option value="mois">Mois</option>
        </select>
        <canvas id="graph1"></canvas>
        <script>
        var dataMap;
        var currentChart;
        var options;
        var ctx = document.getElementById("graph1").getContext('2d');
        datachart();
        
        </script>
    </div>
</div>