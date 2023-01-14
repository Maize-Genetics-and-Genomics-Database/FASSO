<?PHP
  error_reporting(E_ERROR | E_PARSE);

  $species1 = $argv[1];
  $species2 = $argv[2];
  $pass = $argv[3];
  $alignment_file= $argv[4];
  $out_dir = $argv[5];
  $matrix_dir = $argv[6];
  $flag_dir = $argv[7];
  $dm_dir = $argv[8];

  //$species = $argv[1];
  //$pass = $argv[2];
  //$sort_arg = "score";
  //$species1 = $argv[4];
  //$species2 = $argv[5];
  //$species2U = $argv[6];
  //$in_dir = $argv[7];
  //$out_dir = $argv[8];
  //$dm_dir = $argv[9];
  //$alt_dir = $argv[10];

   $file0 = $alignment_file;   //$in_dir . $species1 . "_" . $species2U . "_alignments.tsv"; //maize_Arab_alignments.tsv
   $handle0 = fopen($file0, 'r');

   $file1 = $out_dir . $species1 . "_" . $species2 . "_fatcat_foldseek_top10.txt";
   $handle1 = fopen($file1, 'w');

   $file2 = $flag_dir . $species1 . "_" . $species2 . "_fatcat_foldseek_flagged.txt";
   $handle2 = fopen($file2, 'w');

   $fileM = $matrix_dir . $species1 . "_" . $species2 . "_fatcat_foldseek_matrix" . ".txt";
   $handleM = fopen($fileM, 'w');

  $Data0 = trim(fgets($handle0, 4096));

 for ($i=1; $i < 11; $i++) {
	 for ($q=1; $q < 11; $q++) {
			$score_arr[$i][$q] = 0;
	 }
 }

 $prev = "";
 $first = true;
  while (!feof($handle0))
 {
    $r1 =  strtok($Data0, "\t");
    $r2 =  strtok("\t");
    $n3 =  strtok("\t");
    $n4 =  strtok("\t");
    $n5 =  strtok("\t");
    $n6 =  strtok("\t");
    $n7 =  strtok("\t");
    $n8 =  strtok("\t");
    $n9 =  strtok("\t");
    $n10 =  strtok("\t");
    $n11 =  strtok("\t");
    $n12 =  strtok("\t");

	$n1 =  strtok($r1, ".");
	$n2 =  strtok($r2, ".");

	//echo $Data0 . " " . $n1 . " " . $n2 . "\n";
	$count_check[$n1]++;
	if($count_check[$n1] < 11)
	{

	if($prev != $n1 && !$first)
	{
		$esort2 = array_orderby($esort, 'score', SORT_DESC, 'eval', SORT_ASC);
		$psort2 = array_orderby($psort, 'score', SORT_DESC, 'pval', SORT_ASC);

		$n = 1;
		$save_p = 0;
		$save_e = 0;
		foreach ($psort2 as $key => $value)
	    {
			$prank[$key] = $n;
			if($n == 1)
			{
					$save_p = $value["score"];
					$save_n = $key;
			}
			$n++;
		}

		$n = 1;
		foreach ($esort2 as $key => $value)
		{
			$rrank[$key] = $n;

			//echo $key . " " . $value . "\n";
			$ostring = $step1[$key] . "\t" . $step2[$key] . "\t" . $n . "\t" . $prank[$key] . "\t" . $n . $prank[$key] . "\n";
			fwrite($handle1 , $ostring);

			if($n == 1)
			{
				$diff_p = $save_p - $psort[$key]["score"];
				$ostring2 = $prev . "\t" . $save_n . "\t" . $key . "\t" . $save_p . "\t" . $psort[$key]["score"] . "\t" . $diff_p . "\n";
				fwrite($handle2 , $ostring2);
			}

			$score_arr[$n][$prank[$key]]++;
			$n++;
		}
		$step1 = array();
		$step2 = array();
		$prank = array();
		$psort = array();
		$psort2 = array();
		$esort = array();
		$esort2 = array();
	}

	$step1[$n2] = $Data0;
	$esort[$n2]["score"] = $n12;
	$esort[$n2]["eval"] = $n11;

	if($pass == "first")
	{
		$fileALN =  $n2 . "." . $n1 . ".aln";
		$filepath = $dm_dir . $fileALN;
		if(!file_exists($filepath))
		{
			$fileALN =  $n1 . "." . $n2 . ".aln";
			$filepath = $dm_dir . $fileALN;
		}


	} else {
		$fileALN =  $n1 . "." . $n2 . ".aln";
		$filepath = $dm_dir . $fileALN;
		if(!file_exists($filepath))
		{
			$fileALN =  $n2 . "." . $n1 . ".aln";
			$filepath = $dm_dir . $fileALN;
		}
	}

if(file_exists($filepath))
	{

    $handleALN = fopen($filepath, 'r');
	$DataA = trim(fgets($handleALN, 4096));
	$DataA = trim(fgets($handleALN, 4096));

	$aa1 =  strtok($DataA, " \t");
	$aa2 =  strtok(" \t");
	$aa3 =  strtok(" \t");
	$aa4 =  strtok(" \t");
	$aa5 =  strtok(" \t");
	$aa6 =  strtok(" \t");
	$aa7 =  strtok(" \t");
	$aa8 =  strtok(" \t");
	$aa9 =  strtok(" \t");
	$aa10 =  strtok(" \t");
	$aa11 =  strtok(" \t");
	$aa12 =  strtok(" \t");
	$aa13 =  strtok(" \t");
	$score =  strtok(" \t");

	if(!$score)
	{
		echo "No score for: " . $filepath . "\n";
	}

	$DataA = trim(fgets($handleALN, 4096));

	//echo $DataA . "\n";

	$a1 =  strtok($DataA, " \t");
	$pvalue =  strtok(" \t");
	$a3 =  strtok(" \t");
	$a4 =  strtok(" \t");
	$a5 =  strtok(" \t");
	$ident =  strtok(" \t");
	$a7 =  strtok(" \t");
	$sim =  strtok(" \t");
	//$DataA = trim(fgets($handleALN, 4096));

	$step2[$n2] = $pvalue . "\t" .  $ident . "\t" . $sim . "\t" . $score;
	//$psort[$n2] = $score;
	$psort[$n2]["score"] = $score;
	$psort[$n2]["pval"] = $pvalue;

	$prev = $n1;
	$first = false;

	} else {
	//$filepath = "/90daydata/maizegdb/carson/alphafold/" . $species . "_BLAST3/" . $fileALN;
	echo "Cannot find: " . $filepath . "\n";
	//echo "Cannot find: " . $dm_dir . $fileALN . "\n";
	}

	}

    $Data0 = trim(fgets($handle0, 4096));
 }

 	$esort2 = array_orderby($esort, 'score', SORT_DESC, 'eval', SORT_ASC);
 	$psort2 = array_orderby($psort, 'score', SORT_DESC, 'pval', SORT_ASC);

	 $n = 1;
	 foreach ($psort2 as $key => $value)
	 {
		 $prank[$key] = $n;
		 if($n == 1)
		 {
				 $save_p = $value["score"];
				 $save_n = $key;
		 }
		 $n++;
	 }

	 $n = 1;
	 foreach ($esort2 as $key => $value)
	 {
		 $rrank[$key] = $n;

		 $ostring = $step1[$key] . "\t" . $step2[$key] . "\t" . $n . "\t" . $prank[$key] . "\t" . $n . $prank[$key] . "\n";
		 fwrite($handle1 , $ostring);
		 if($n == 1)
		 {
			 $diff_p = $save_p - $psort[$key]["score"];
			 $ostring2 = $prev . "\t" . $save_n . "\t" . $key . "\t" . $save_p . "\t" . $psort[$key]["score"] . "\t" . $diff_p . "\n";
			 fwrite($handle2 , $ostring2);
		 }
		 $score_arr[$n][$prank[$key]]++;
		 $n++;
	 }

	 $ostring = $sort_arg . "\t" . "1" . "\t" . "2" . "\t" . "3" . "\t" . "4" . "\t" . "5" . "\t" . "6" . "\t" . "7" . "\t" . "8" . "\t" . "9" . "\t" . "10" . "\n";
	 fwrite($handleM , $ostring);
	 for ($i=1; $i < 11; $i++) {
		 //echo $i;
		 fwrite($handleM , $i);
		 for ($q=1; $q < 11; $q++) {
		 		$ostring =  "\t" . $score_arr[$i][$q];
				fwrite($handleM , $ostring);
		 }
		 //echo "\n";
		 fwrite($handleM , "\n");
	 }

	 function array_orderby()
{
    $args = func_get_args();
    $data = array_shift($args);
    foreach ($args as $n => $field) {
        if (is_string($field)) {
            $tmp = array();
            foreach ($data as $key => $row)
                $tmp[$key] = $row[$field];
            $args[$n] = $tmp;
            }
    }
    $args[] = &$data;
    call_user_func_array('array_multisort', $args);
    return array_pop($args);
}

 ?>
