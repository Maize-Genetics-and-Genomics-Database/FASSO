<?PHP
  error_reporting(E_ERROR | E_WARNING | E_PARSE);

   ////First position is sorted
	$fileR = $argv[4];
	$handleR = fopen($fileR, 'w');

	$fileW = $argv[5];
	$handleW = fopen($fileW, 'w');

   $file1 = $argv[1];
   $handle1 = fopen($file1, 'r');

$Data1 = trim(fgets($handle1, 4096));
   while (!feof($handle1))
   {
     $n1 =  strtok($Data1, "\t");
	 $n2 =  strtok("\t");
	 $n3 =   strtok("\t");
	 $n4 =   strtok("\t");
	 $n5 =   strtok("\t");
	 $n6 =   strtok("\t");
     $n7 =   strtok("\t");
     $n8 =   strtok("\t");

	 $check[$n1][$n2] = $n1 . "\t" . $n2 . "\t" . $n3 . "\t" . $n4;
	 $verify[$n1] = $n2;
	 $verify[$n2] = $n1;

	 if($n6 < $n8)
	 {
		 $eval = $n5;
		 $score = $n6;
	 } else
	 {
		 $eval = $n7;
		 $score = $n8;
	 }

	 $data[$n1][$n2]["diamond"] = $eval . "\t" . $score;

	 $Data1 = trim(fgets($handle1, 4096));
	 }

	fclose($handle1);

	 $file1 = $argv[2];
	 $handle1 = fopen($file1, 'r');

	 while (!feof($handle1))
	 {
	   $n1 =  strtok($Data1, "\t");
	   $n2 =  strtok("\t");
	   $n3 =   strtok("\t");
	   $n4 =   strtok("\t");
	   $n5 =   strtok("\t");
	   $n6 =   strtok("\t");

	  $check[$n1][$n2] = $n1 . "\t" . $n2 . "\t" . $n3 . "\t" . $n4;

	  if($verify[$n1])
	  {
		  if($verify[$n1] != $n2)
		  {
			  $flag[$n1] = true;
		  }
	  }

	  if($verify[$n2])
	  {
		  if($verify[$n2] != $n1)
		  {
			  $flag[$n2] = true;
		  }
	  }
	  	$verify[$n1] = $n2;
	  	$verify[$n2] = $n1;

		$eval = $n5;
		$score = $n6;

	  $data[$n1][$n2]["fatcat"] = $eval . "\t" . $score;

	  $Data1 = trim(fgets($handle1, 4096));
	  }

	  fclose($handle1);

	  	 $file1 = $argv[3];
	  	 $handle1 = fopen($file1, 'r');

	  	 while (!feof($handle1))
	  	 {
	  	   $n1 =  strtok($Data1, "\t");
	  	   $n2 =  strtok("\t");
	  	   $n3 =   strtok("\t");
	  	   $n4 =   strtok("\t");
	  	   $n5 =   strtok("\t");
	  	   $n6 =   strtok("\t");

	  	  $check[$n1][$n2] = $n1 . "\t" . $n2 . "\t" . $n3 . "\t" . $n4;

	  	  if($verify[$n1])
	  	  {
	  		  if($verify[$n1] != $n2)
	  		  {
	  			  $flag[$n1] = true;
	  		  }
	  	  }

	  	  if($verify[$n2])
	  	  {
	  		  if($verify[$n2] != $n1)
	  		  {
	  			  $flag[$n2] = true;
	  		  }
	  	  }
	  	  	$verify[$n1] = $n2;
	  	  	$verify[$n2] = $n1;

	  		$eval = $n5;
	  		$score = $n6;

	  	  $data[$n1][$n2]["foldseek"] = $eval . "\t" . $score;

	  	  $Data1 = trim(fgets($handle1, 4096));
	  	  }

	  	  fclose($handle1);

		  $blank = "NA" . "\t" . "NA";
		  $silver2 = 0;
		  $silver3 = 0;
		  $gold3 = 0;
		  $silver1 = 0;
		  $gold1 = 0;
		  $gold2 = 0;
		  $plat = 0;

		  foreach ($check as $n1 => $check2)
		  {
			  foreach ($check2 as $n2 => $header)
			 {
				 if($data[$n1][$n2]["diamond"] && $data[$n1][$n2]["fatcat"] && $data[$n1][$n2]["foldseek"])
				 {
					 $ostring = $header . "\t" . $data[$n1][$n2]["diamond"] . "\t" . $data[$n1][$n2]["fatcat"] . "\t" . $data[$n1][$n2]["foldseek"];
					 $type = "platinum";
					 $plat++;
					// echo "HERE " . $n1 . "-" . $n2 . "\n";
					 if($flag[$n1] || $flag[$n2])
 					{
						$plat_m++;
					}
				 } else if($data[$n1][$n2]["diamond"] && $data[$n1][$n2]["fatcat"])
 				 {
 					 $ostring = $header . "\t" . $data[$n1][$n2]["diamond"] . "\t" . $data[$n1][$n2]["fatcat"] . "\t" . $blank;
					 $type = "gold";
					 $gold1++;
					 if($flag[$n1] || $flag[$n2])
  					{
 						$gold1_m++;
 					}
 				 } else if($data[$n1][$n2]["diamond"] && $data[$n1][$n2]["foldseek"])
 				 {
 					 $ostring = $header . "\t" . $data[$n1][$n2]["diamond"] . "\t" . $blank . "\t" . $data[$n1][$n2]["foldseek"];
					 $type = "gold";
					 $gold2++;
					 if($flag[$n1] || $flag[$n2])
  					{
 						$gold2_m++;
 					}
 				 } else if($data[$n1][$n2]["fatcat"] && $data[$n1][$n2]["foldseek"])
 				 {
 					 $ostring = $header . "\t" . $blank . "\t" . $data[$n1][$n2]["fatcat"] . "\t" . $data[$n1][$n2]["foldseek"];
					 $type = "gold";
					 $gold3++;
					 if($flag[$n1] || $flag[$n2])
  					{
 						$gold3_m++;
 					}
 				 } else if($data[$n1][$n2]["diamond"] )
 				 {
 					 $ostring = $header . "\t" . $data[$n1][$n2]["diamond"] . "\t" . $blank . "\t" . $blank;
					 $type = "silver";
					 $silver1++;
					 if($flag[$n1] || $flag[$n2])
  					{
 						$silver1_m++;
 					}
 				 } else if($data[$n1][$n2]["fatcat"])
 				 {
 					 $ostring = $header . "\t" . $blank . "\t" . $data[$n1][$n2]["fatcat"] . "\t" . $blank;
					 $type = "silver";
					 $silver2++;
					 if($flag[$n1] || $flag[$n2])
  					{
 						$silver2_m++;
 					}
 				 } else if($data[$n1][$n2]["foldseek"])
 				 {
 					 $ostring = $header . "\t" . $blank . "\t" . $blank . "\t" . $data[$n1][$n2]["foldseek"];
					 $type = "silver";
					 $silver3++;
					 if($flag[$n1] || $flag[$n2])
  					{
 						$silver3_m++;
 					}
 				 }

				 	if($flag[$n1] || $flag[$n2])
					{
						$type = "working";
						$working++;
						fwrite($handleW, $ostring . "\t" . $type . "\n");
					} else if($n1){
						fwrite($handleR, $ostring . "\t" . $type . "\n");
					}


			 }
		  }

		  echo "Venn diagram data:" . "\n";
		  echo "($silver2,$silver3,$gold3,$silver1,$gold1,$gold2,$plat)" . "\n";
		  echo "(" . ($silver2 - $silver2_m) . "," . ($silver3 - $silver3_m) . "," . ($gold3 - $gold3_m) . "," . ($silver1 - $silver1_m) . "," . ($gold1 - $gold1_m) . "," .
		  ($gold2 - $gold2_m) . "," . ($plat - $plat_m) . ")" . "\n";
		  $added = $silver2 + $silver3 + $gold3;
		  $diamond_count = $plat + $gold1 + $gold2 + $silver1;
		  $foldseek_count = $plat + $gold2 + $gold3 + $silver3;
		  $fatcat_count = $plat + $gold1 + $gold3 + $silver2;

		  $diamond_remove = $gold1_m + $gold2_m + $silver1_m;
		  $foldseek_remove = $gold2_m + $gold3_m + $silver3_m;
		  $fatcat_remove = $gold1_m + $gold3_m + $silver2_m;

		  $total = $plat + $gold1 + $gold2 + $gold3 + $silver1 + $silver2 + $silver3;
		  $remove_total = $gold1_m + $gold2_m + $gold3_m + $silver1_m + $silver2_m + $silver3_m;
		  $sub_total = $total - $remove_total;

		  echo "Diamond count: " . $diamond_count . "\n";
		  echo "FoldSeek count: " . $foldseek_count . "\n";
		  echo "FatCat count: " . $fatcat_count . "\n";
		  echo "Total: " . $total . "\n";
		  echo "SubTotal: " . $sub_total  . "\n";

		  echo "Added orthologs: " . $added  . "\n";
		  echo "Diamond removed orthologs: " . $diamond_remove  . "\n";
		  echo "FoldSeek removed orthologs: " . $foldseek_remove  . "\n";
		  echo "FatCat removed orthologs: " . $fatcat_remove  . "\n";
		  echo "Working proteins: " . $working . "\n";

  ?>
