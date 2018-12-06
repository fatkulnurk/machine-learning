<?php
	
	$fh = fopen("data.txt", "r");
	
	$o = 1;
	while (!feof($fh)) {
	    $line[$o] = fgets($fh);
	    // echo $line;
	    $o++;
	}
	fclose($fh);
	// print_r($line[1]);
	$jml1 = count($line);

	for ($i=0; $i < $jml1; $i++) { 
		$anu[$i] = explode(",", $line[$i+1]);
	}
	// print_r($anu);

	$jml_anu = count($anu);
	// print_r($jml_anu);
	// echo $jml_anu;
	$jml_anu2 = count($anu[1]);
	// print_r($jml_anu2);
	$cek = end($anu[0]);
	$ll = 0;
	for ($g=0; $g < $jml_anu; $g++) { 
		if (end($anu[$g]) != $cek) {
			for ($k=0; $k < $jml_anu2; $k++) { 
				$data2[$ll][$k] = $anu[$g][$k];
				
			}	
			$ll++;
		}
		else {
			for ($k=0; $k < $jml_anu2; $k++) { 
				$data[$g][$k] = $anu[$g][$k];
			}
			
		}
		
	}
	// echo end($data[1]);
	// print_r($data);
	// echo "<br><br>";
	// print_r($data2);
?>