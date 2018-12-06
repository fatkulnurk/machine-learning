<!DOCTYPE html>
<html>
<head>
    <title>Hayo Bisa main apa gk</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./asset/bulma-0.7.1/css/bulma.min.css" media="all">
</head>
<body>
<div class="hero is-link is-bold is-is-medium fullwidth">
    <div class="hero-body">
        <div class="container has-text-centered">
            <p></p>
            <br>
            <h1 class="title">Hasil Perhitungan</h1>
        </div>
    </div>
</div>
<?php

?>
<?php
	error_reporting(E_ERROR | E_PARSE);
	function pya() {
		include "data.php";

		$jml_ya = count($data);
		$jml_ya2 = count($data[0]);
		$jml_tidak = count($data2);
		$tot = $jml_ya+$jml_tidak;

		$jmlcerah = 0;
		$jmltemp = 0;
		$jmlangen = 0;

        $cuaca      = $_POST['cuaca'];
        $temperatur = $_POST['temperatur'];
//$kecepatan  = $_POST['kecepatan'];
        $angen  = $_POST['angen'];
        $kecepatan = $angen;

        echo '
<div class="container has-text-centered">
<span>-- Keyword --</span>
<p>
        Cuaca '.$cuaca.' - Temperatur '.$temperatur.' - Kecepatan '.$kecepatan.'
</p>
</div>
';
//		$cuaca = $_POST['cuaca'];
//		$temperatur = $_POST['temperatur'];
//		$angen = $_POST['angen'];
		$o = 0;
		// echo $jml_ya;
		if ($cuaca != "") {
			for ($i=0; $i <= $jml_ya; $i++) { 
				if ($data[$i][0] == $cuaca) {
					$jmlcerah++;
				}
			}
			$hasil[$o] = (($jmlcerah/$tot)/($jml_ya/$tot));
			$o++;
		}

		if ($temperatur != "") {
			for ($i=0; $i <= $jml_ya; $i++) { 
				if ($data[$i][1] == $temperatur) {
					$jmltemp++;
				}
			}
			$hasil[$o] = (($jmltemp/$tot)/($jml_ya/$tot));
			$o++;
		}

		if ($angen != "") {
			for ($i=0; $i <= $jml_ya; $i++) { 
				if ($data[$i][2] == $angen) {
					$jmlangen++;
				}
			}
			$hasil[$o] = (($jmlangen/$tot)/($jml_ya/$tot));
			$o++;
		}

		$horee = count($hasil);
		$hasilbanget = 1;
		for ($t=0; $t < $horee; $t++) { 
			if ($hasil[$t] >= 0) {
				if (!isset($hasilbanget)) {
					$hasil[$t];
				}
				else {
					$hasilbanget = $hasilbanget * $hasil[$t];	
				}
			}
		}
		// print_r($hasil);
		$hasilya = $hasilbanget * ($jml_ya/$tot);
		ptidak($hasilya);
	}

	function ptidak($hasilya) {
		include "data.php";

		$jml_ya = count($data);
		$jml_ya2 = count($data[0]);
		$jml_tidak = count($data2);
		$tot = $jml_ya+$jml_tidak;

		$jmlcerah = 0;
		$jmltemp = 0;
		$jmlangen = 0;

		$cuaca = $_POST['cuaca'];
		$temperatur = $_POST['temperatur'];
		$angen = $_POST['angen'];
		$o = 0;
		// echo $jml_ya;
		if ($cuaca != "") {
			for ($i=0; $i <= $jml_tidak; $i++) { 
				if ($data2[$i][0] == $cuaca) {
					$jmlcerah++;
				}
			}
			$hasil[$o] = (($jmlcerah/$tot)/($jml_tidak/$tot));
			$o++;
		}

		if ($temperatur != "") {
			for ($i=0; $i <= $jml_tidak; $i++) { 
				if ($data2[$i][1] == $temperatur) {
					$jmltemp++;
				}
			}
			$hasil[$o] = (($jmltemp/$tot)/($jml_tidak/$tot));
			$o++;
		}

		if ($angen != "") {
			for ($i=0; $i <= $jml_tidak; $i++) { 
				if ($data2[$i][2] == $angen) {
					$jmlangen++;
				}
			}
			$hasil[$o] = (($jmlangen/$tot)/($jml_tidak/$tot));
			$o++;
		}

		$horee = count($hasil);
		$hasilbanget2 = 1;
		for ($t=0; $t < $horee; $t++) { 
			if ($hasil[$t] >= 0) {
				if (!isset($hasilbanget2)) {
					$hasil[$t];
				}
				else {
					$hasilbanget2 = $hasilbanget2 * $hasil[$t];	
				}
			}
		}
		//print_r($hasil);

		// print_r($hasil);
		$hasiltidak = $hasilbanget2 * ($jml_tidak/$tot);

		echo '
<div class="section">
    <div class="columns">
        <div class="column is-4 is-offset-4 box">
        Nilai Perhitungan :<br/>';
		echo "ya : " . $hasilya . "<br>" . "tidak : " . $hasiltidak . "<br>";
		echo '<hr>Jawaban :<br/>';
		if ($hasilya > $hasiltidak) {
//			echo "YA";

            echo '<h1 class="title">YA - bisa main golf</h1>';
		}
		else {
//			echo "TIDAK";

            echo '<h1 class="title">Tidak bisa main golf</h1>';
		}
	}

	pya();

?>

</div>
</div>
</div>
</body></html>
