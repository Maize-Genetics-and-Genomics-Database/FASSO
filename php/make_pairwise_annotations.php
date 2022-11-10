<?PHP
  error_reporting(E_ERROR | E_WARNING | E_PARSE);
   ini_set('memory_limit', '1G');

   $query = $argv[1];
   $target = $argv[2];
   $pdb_file = $argv[3];
   $base_dir = $argv[4];

  $no_count = 0;

  $out_file1 = $output_dir . "annotations/" . $query . "_" . $target . "_annotation.txt";
  $handleOut1 = fopen($out_file1, 'w');

  $filenames[$query] = $base_dir . "annotations/uniprot/" . $query . "_uniprot.tsv";
  $filenames[$target] = $base_dir . "annotations/uniprot/" . $target . "_uniprot.tsv";

  $fc_inputs[$target] = $base_dir . "top_hits/" . $query . "_" . $target . "/" . $query . "_" . $target . "_fatcat_tophit.txt";

  $fs_inputs[$target] = $base_dir . "top_hits/" . $query . "_" . $target . "/" . $query . "_" . $target . "_foldseek_tophit.txt";

  $d_inputs[$target] = $base_dir . "top_hits/" . $query . "_" . $target . "/" . $query . "_" . $target . "_diamond_tophit.txt";

  $FASSO[$target] = $base_dir . "structure_orthologs/" . $query . "_" . $target . "_FASSO.tsv";

  $seq_file = $pdb_file;
  $handle1 = fopen($seq_file, 'r');

 $Data1 = trim(fgets($handle1, 4096));
 while (!feof($handle1))
 {
	 $n1 =  strtok($Data1, "-");
     $n2 =   strtok("-");

	 $proteins[$n2] = $n2;

	 $Data1 = trim(fgets($handle1, 4096));
 }
fclose($handle1);

foreach ($filenames as $key => $value)
{
	$handle1 = fopen($value, 'r');
	$Data1 = trim(fgets($handle1, 4096));

	while (!feof($handle1))
	{
	 $n1 =  strtok($Data1, "\t");
	 $n2 =   strtok("\t");

	 $xref[$n1] = $n2;

	 $Data1 = trim(fgets($handle1, 4096));
	}
	fclose($handle1);
}

 $handle1 = fopen($seq_file, 'r');

$Data1 = trim(fgets($handle1, 4096));
while (!feof($handle1))
{
	$n1 =  strtok($Data1, "-");
	$n2 =   strtok("-");

   if(!$xref[$n2])
   {
	   	$proteins_unmapped[$n2] = $n2;
   }

	$Data1 = trim(fgets($handle1, 4096));
}
fclose($handle1);

foreach ($fc_inputs as $key => $value)
{
	$handle1 = fopen($value, 'r');
	$Data1 = trim(fgets($handle1, 4096));

	while (!feof($handle1))
	{
	 $n1 =  strtok($Data1, "\t");
	 $n2 =   strtok("\t");
	 $n3 =   strtok("\t");
	 $n4 =   strtok("\t");
	 $n5 =   strtok("\t");
	 $n6 =   strtok("\t");

	  $n0 =  strtok($n1, "-");
	  $query_model =   strtok("-");

	  $n00 =  strtok($n2, "-");
	  $target_model =   strtok("-");

	 $fat_score[$query_model][$target_model] = $n6;

	 $Data1 = trim(fgets($handle1, 4096));
	}
	fclose($handle1);
}

foreach ($d_inputs as $key => $value)
{
	$handle1 = fopen($value, 'r');
	$Data1 = trim(fgets($handle1, 4096));

	while (!feof($handle1))
	{
	 $n1 =  strtok($Data1, "\t");
	 $n2 =   strtok("\t");
	 $n3 =   strtok("\t");
	 $n4 =   strtok("\t");
	 $n5 =   strtok("\t");
	 $n6 =   strtok("\t");

	  $n0 =  strtok($n1, "-");
	  $query_model =   strtok("-");

	  $n00 =  strtok($n2, "-");
	  $target_model =   strtok("-");

	 $fat_score[$query_model][$target_model] = $n6;

	 $Data1 = trim(fgets($handle1, 4096));
	}
	fclose($handle1);
}

foreach ($fs_inputs as $key => $value)
{
	$handle1 = fopen($value, 'r');
	$Data1 = trim(fgets($handle1, 4096));

	while (!feof($handle1))
	{
	 $n1 =  strtok($Data1, "\t");
	 $n2 =   strtok("\t");
	 $n3 =   strtok("\t");
	 $n4 =   strtok("\t");
	 $n5 =   strtok("\t");
	 $n6 =   strtok("\t");

	  $n0 =  strtok($n1, "-");
	  $query_model =   strtok("-");

	  $n00 =  strtok($n2, "-");
	  $target_model =   strtok("-");

	 $fat_score[$query_model][$target_model] = $n6;

	 $Data1 = trim(fgets($handle1, 4096));
	}
	fclose($handle1);
}

////////////////

foreach ($FASSO as $key => $value)
{
	if($query != $key)
	{
		$file0 = $value;
		$handle0 = fopen($file0, 'r');

		$Data0 = trim(fgets($handle0, 4096));
		$previous = "XX";
		$first = true;

		while (!feof($handle0))
		{
		 $n1 =  strtok($Data0, "\t");
		 $n2 =  strtok("\t");
		 $n3 =  strtok("\t");
		 $n4 =  strtok("\t");
		 $n5 =  strtok("\t");
		 $n6 =  strtok("\t");
		 $n7 =  strtok("\t");
		 $n8 =  strtok("\t");
		 $n9 =  strtok("\t");
		 $n10 =  strtok("\t");
		 $n11 =  strtok("\t");

		 $query_model =  $n1;
		 $target_model =  $n2;

		if($proteins_unmapped[$query_model])
		{
			 $xref[$query_model] = "No annotation";
		}

		if(!$query_string[$query_model])
		{
			$query_string[$query_model] = $query_model . "\t" . $xref[$query_model];
		}

			if(!$check_fold[$query_model][$key] && $xref[$target_model])
			{
				$FASSO_string[$query_model][$key] =  $target_model . "\t" . $xref[$target_model];
				$FASSO_ann[$query_model][$key] =  $xref[$target_model];
				$FASSO_score[$query_model][$key] = $fat_score[$query_model][$target_model];
				$FASSO_type[$query_model][$key] = $n11;
				$check_fold[$query_model][$key] = true;
			}
		 $Data0 = trim(fgets($handle0, 4096));
		}

		fclose($handle0);
	}
}

	foreach ($query_string as $key => $value)
	{
		fwrite($handleOut1, $value);

		foreach ($FASSO as $species => $value2)
		{
			if($query != $species)
			{
				if($FASSO_string[$key][$species])
				{
					fwrite($handleOut1,  "\t" . $FASSO_string[$key][$species] . " \t" . $FASSO_score[$key][$species] . " \t" . $FASSO_type[$key][$species]);
				} else {
					fwrite($handleOut1,  " \t" . "N/A" . " \t" . "N/A" . " \t" . "N/A");
				}
			}
		}
		fwrite($handleOut1, "\n");
	}

  ?>
