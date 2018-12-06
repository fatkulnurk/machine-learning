<?php
error_reporting(0);

// bias
$input = array(
				array('1','0','0'),
				array('1','0','1'),
				array('1','1','0'),
				array('1','1','1'),
		);

echo "Input: <br/>";
print_r($input);
echo "<hr>";

//$w = array('-0.3','0.5','-0.4');

//yang pengen dicapai
$target = array(0,1,1,1);

echo "Target: <br>";
echo var_dump($target)."<hr>";
//
$threshold=0;

// miu di deklarasikan [range 0-1]
$miu=0.1;

// jumlah iterasi [setiap epoch jumlah baris data (kalau pengen pasti 100)]
$epoch=0;

// mengacak w (
 for ($i = 0; $i<3; $i++) 
         {
             $w[$i] = mt_rand (0*10, 1*10) / 10;
         }	
echo "Nilai W hasil random: <br>";
 print_r($w);
 echo "<hr>";
$hasil[0]=0;

do{

    // i , j looping untuk baris kolom
    for ($i = 0; $i<4; $i++){
        $sum=0;
        for ($j = 0; $j<3; $j++)
            {
                // menghitung summation
                $sum += ($input[$i][$j]*$w[$j]);
            }

        // cek apakah melebihi threshold, kalau kurang maka 0 kalau lebih dari thresold maka 1
        if($sum>=$threshold)
                $hasil[$i]=1;

         else
                $hasil[$i]=0;

         var_dump($hasil);

    //    print_r($hasil);

        // ketika hasil pengurangan sama dengan 0 (tidak update w) maka lanjut tapi kalau tidak masuk ke if
        $output[$i]=$target[$i]-$hasil[$i];

        if($output[$i]!=0){
            for($k=0;$k<3;$k++){
                // update w = w lama * miu * input pada saat eror * eror pada saat tidak sesuai target
                $w[$k]=$w[$k]+($miu*$input[$i][$k]*$output[$i]);
            }
            //print_r($w);
        }
        echo "<br>";
    }
    $epoch++;
}while($epoch<100);
echo "Jumlah epoch : ".$epoch;
?>
