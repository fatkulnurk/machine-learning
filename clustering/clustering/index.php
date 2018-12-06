<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Average Linkage</title>
    <link rel="stylesheet" href="../../bulma.min.css">
</head>
<body>

<div class="hero is-light is-fullwidth">
    <div class="hero-body">
        <div class="container">
            <form action="index.php" method="post">
                <div class="field">
                    <label for="k" class="label">Nilai k</label>
                    <input class="input is-info" type="number" name="k">
                </div>
                <div class="field">
                    <input class="is-danger button" type="submit" value="Submit" name="btnsubmit">
                </div>
            </form>
        </div>
        <hr>
        Average Linkage
    </div>
<!--</div>-->
<!--<form action="index.php" method="post">-->
<!--        <label for="k">Masukkan nilai k</label>-->
<!--        <input type="number" name="k">-->
<!--        <input type="submit" value="Submit" name="btnsubmit">-->
<!--    </form>-->
<!--    <hr>-->
<!--    Average linkage-->
<!--    <hr>-->
    <div id="chartContainer" style="height: 540px; width: 100%;"></div>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

<?php
    require_once __DIR__ . '/vendor/autoload.php';

    use Phpml\Dataset\Demo\RuspiniSamplesDataset;
    use Phpml\Math\Distance\Euclidean;
    
    if(isset($_POST['btnsubmit'])) {
        if(isset($_POST['k'])) {
            $K = $_POST['k'];
        }
        $data = new RuspiniSamplesDataset();
        $samples = $data->getSamples();
        $clusters = array();

        for($i=0;$i<count($samples);$i++) {
            $clusters[$i][0]=$samples[$i];
        }
        $lc = count($clusters);

        while($lc>$K) {
            $tempdstnc = array();
            $minKey = array();
            $results = array();
            $euclidean = new Euclidean();

            for($i=0; $i<count($clusters);$i++){
                for($j=$i+1; $j<count($clusters);$j++) {
                    $tempdstnc[$i][$j]=0;
                    for($k=0; $k<count($clusters[$i]);$k++) {
                        for($l=0; $l<count($clusters[$j]);$l++) {
                            $tempdstnc[$i][$j] += $euclidean->distance($clusters[$i][$k], $clusters[$j][$l]); 
                        }
                        $m = $l;
                    }
                    $n = $k;
                    $tempdstnc[$i][$j]=$tempdstnc[$i][$j]/($n*$m);
                }
            }
            for($i=0; $i<count($tempdstnc); $i++) {
                asort($tempdstnc[$i]);
            }

            for($i=0; $i<count($tempdstnc); $i++) {
                $minKey = array_keys($tempdstnc[$i], min($tempdstnc[$i]));
                array_push($results, array(
                    'cluster1' => $i,
                    'cluster2' => $minKey[0],
                    'distance' => min($tempdstnc[$i])
                ));
                
            }
            $minDistance = min(array_column($results, "distance"));
            $minKey = array_search($minDistance, array_column($results, "distance"));
            $nearestCluster = $results[$minKey]["cluster2"];
            $nextKey = count($clusters[$minKey]);
            for($i=0; $i<count($clusters[$nearestCluster]); $i++) {
                $clusters[$minKey][$nextKey]=$clusters[$nearestCluster][$i];
                $nextKey++;
            }
            unset($clusters[$nearestCluster]);
            unset($tempdstnc);
            unset($min);
            unset($minKey);
            unset($results);
            $clusters = array_values($clusters);
            $lc--;
        }
        
    }
?>
<script>
window.onload = function () {
var dataPoints = [];
var colors = [
"red","green","blue","black","yellow"
];
var chart = new CanvasJS.Chart("chartContainer", {
animationEnabled: true,
theme: "light2",
title: {
text: "Visualisasi"
},
axisY: {
title: "y",
includeZero: false
},
data: [{
type: "scatter",
markerType: "circle",
markerSize: 10,
toolTipContent: "y: {y}<br>x: {x}",
dataPoints: dataPoints
}]
});

for(var i=0; i< <?php echo count($clusters)?>; i++) {
data = <?php echo json_encode($clusters, JSON_NUMERIC_CHECK); ?>;
for (var j = 0; j < data[i].length; j++) {
dataPoints.push({
x: parseFloat(data[i][j][0]),
y: parseFloat(data[i][j][1]),
color: colors[i]
});
}
}
chart.render();
}
</script>
