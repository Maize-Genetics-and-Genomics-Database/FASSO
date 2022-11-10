<?PHP
  error_reporting(E_ERROR | E_WARNING | E_PARSE);

  $file1 = $argv[1];
  if(!file_exists($file1))
	  {
		  echo "File 1 does not exist" . "\n";
	  } else {
  $handle1 = fopen($file1, 'r');
  $Data1 = trim(fgets($handle1, 4096));
  // $Data1 = trim(fgets($handle1, 4096));
  while (!feof($handle1))
  {
    $n1 =  strtok($Data1, "\t");
    $n2 =   strtok("\t");
	$tval =   strtok("\t");
	$tscore =   strtok("\t");
	$fval =   strtok("\t");
	$fscore =   strtok("\t");

	$f1 =  strtok($n1, "-");
	$f2 =   strtok("-");

	$s1 =  strtok($n2, "-");
	$s2 =   strtok("-");

	$target1[$n1][$n2] = $f2 . "\t" . $s2 . "\t" . $n1 . "\t" . $n2 . "\t" . $tval . "\t" . $tscore . "\t" . $fval . "\t" . $fscore;
	$target2[$n2][$n1] = $s2 . "\t" . $f2 . "\t" . $n2 . "\t" . $n1 . "\t" . $tval . "\t" . $tscore . "\t" . $fval . "\t" . $fscore;
    //$target_check[$n1][$n2] = 1;
	//$target_check[$n2][$n1] = 1;

	//echo "check: " . $f2 . "\t" . $s2 . "\t" . $n1 . "\t" . $n2 . "\t" . $tval . "\n";

    $Data1 = trim(fgets($handle1, 4096));
  }
  fclose($handle1);
 }

  $file1 = $argv[2];
  if(!file_exists($file1))
	  {
		  echo "File 2 does not exist" . "\n";
	  } else {
  $handle1 = fopen($file1, 'r');
  $Data1 = trim(fgets($handle1, 4096));
  // $Data1 = trim(fgets($handle1, 4096));
  while (!feof($handle1))
  {
	$n1 =  strtok($Data1, "\t");
	$n2 =   strtok("\t");
  $tval =   strtok("\t");
  $tscore =   strtok("\t");
  $fval =   strtok("\t");
  $fscore =   strtok("\t");


  $f1 =  strtok($n1, "-");
  $f2 =   strtok("-");

  $s1 =  strtok($n2, "-");
  $s2 =   strtok("-");

  //$query[$n2] = $f2 . "\t" . $s2 . "\t" . $n1 . "\t" . $n2 . "\t" . $tval . "\t" . $tscore . "\t" . $fval . "\t" . $fscore;
  $query_check[$n2][$n1] = 1;
  $query_check[$n1][$n2] = 1;

  $Data1 = trim(fgets($handle1, 4096));
  }
  fclose($handle1);

  $fileM1 = $argv[3];
  $handleOut1 = fopen($fileM1, 'w');

  $fileM2 = $argv[4];
  $handleOut2 = fopen($fileM2, 'w');

  $qs= $argv[5];
  $ts = $argv[6];
  $type = $argv[7];

  $outstr1 = "Uniprot_" . $qs . "\t" . "Uniprot_" . $ts . "\t" . "AlphaFold_" . $qs . "\t" . "AlphaFold_" . $ts . "\t" . $type . "_value" . "\t" . $type . "_score" . "\t" . "fatcat" . "_value" . "\t" . "fatcat" . "_score";
  fwrite($handleOut1, $outstr1 . "\n");

  $outstr2 = "Uniprot_" . $ts . "\t" . "Uniprot_" . $qs . "\t" . "AlphaFold_" . $ts . "\t" . "AlphaFold_" . $qs . "\t" . $type . "_value" . "\t" . $type . "_score" . "\t" . "fatcat" . "_value" . "\t" . "fatcat" . "_score";
  fwrite($handleOut2, $outstr2 . "\n");

  ksort($target1);
  ksort($target2);

  foreach ($target1 as $key1 => $value1) {
	  foreach ($value1 as $key2 => $value2) {
		  	if($query_check[$key1][$key2])
			{
				//echo "HIT " . $key1 . " : " . $key2 . " : " .  $target1[$key1] . "\n";
				fwrite($handleOut1, $target1[$key1][$key2] . "\n");
			}
      }
  }

    foreach ($target2 as $key1 => $value1) {
  	  foreach ($value1 as $key2 => $value2) {
  		  	if($query_check[$key1][$key2])
  			{
  				fwrite($handleOut2, $target2[$key1][$key2] . "\n");
  			}
        }
    }
    fclose($handleOut1);
    fclose($handleOut2);
}

  ?>
