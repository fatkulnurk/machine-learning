<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="variance.php" method="post">
        <label for="k">Masukkan nilai k</label>
        <input type="number" name="k">
        <input type="submit" value="Submit" name="btnsubmit">
    </form>
</body>
</html>
<?php
    require_once __DIR__ . '/vendor/autoload.php';

    use Phpml\Dataset\Demo\IrisDataset;
    use Phpml\Math\Distance\Euclidean;
    
    if(isset($_POST['btnsubmit'])) {
        if(isset($_POST['k'])) {
            $K = $_POST['k'];
        }
        $data = new IrisDataset();
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
        $centroid=hitungCentroid($clusters);
        $sse=SSE($centroid,$clusters);

        echo $sse;
        echo'<pre>';
        print_r($centroid);
        echo'<pre';

    }
    function hitungCentroid($clusters){
        for($i=0;$i<count($clusters);$i++) {
            for($m=0; $m<count($clusters[$i][0]); $m++) {
                $temp[$i][$m] = 0;
            }
            for($j=0;$j<count($clusters[$i]);$j++) {
                for($k=0;$k<count($clusters[$i][$j]);$k++) {
                    $temp[$i][$k]+=$clusters[$i][$j][$k];
                }
            }
            for($l=0;$l<count($clusters[$i][0]);$l++){
                $centroid[$i][$l]=$temp[$i][$l]/count($clusters[$i]);
            }
        }
        return $centroid;
    }
    function SSE($centroid,$clusters) {
        $distance = 0;
        $n = 0;
        $jarak = new Euclidean();
        for($i=0;$i<count($clusters);$i++) {
            $n += count($clusters[$i]);
            for($j=0;$j<count($clusters[$i]);$j++) {
                $distance += $jarak->distance($clusters[$i][$j], $centroid[$i]);
            }
        }
        $sse=$distance / $n;
        return $sse;
        echo $distance;
    }
?>
