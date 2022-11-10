<?PHP
  error_reporting(E_ERROR | E_WARNING | E_PARSE);

  $file1 = $argv[1];  // /90daydata/maizegdb/carson/zAlphaFoldMerge/tables/maize_arab_top10_table_score.txt
  $file2 = $argv[2];  // /90daydata/maizegdb/carson/RSBH/maize_arab/output/maize_arab_top10_table_score.txt
  $species1 = $argv[3];
  $species2 = $argv[4];
  $outdir = $argv[5];

  $fileDM = $outdir . $species1 . "_" . $species2 . "_diamond_tophit.txt";
  $fileFS = $outdir . $species1 . "_" . $species2 . "_foldseek_tophit.txt";
  $fileFC = $outdir . $species1 . "_" . $species2 . "_fatcat_tophit.txt";

  $handleDM = fopen($fileDM, 'w');
  $handleFS = fopen($fileFS, 'w');
  $handleFC = fopen($fileFC, 'w');

	if(file_exists($file1))
	{
  		$handle1 = fopen($file1, 'r');

  		$Data1 = trim(fgets($handle1, 4096));

  		while (!feof($handle1))
  		{
	  		$arr = explode("\t", $Data1);

			$sp1t = $arr[0];
			$sp2t = $arr[1];

			$sp1w = strtok($sp1t, ".");
			$sp2w = strtok($sp2t, ".");

			$sp1 = str_replace("v2", "v3", $sp1w);
			$sp2 = str_replace("v2", "v3", $sp2w);

			$fs_val = $arr[10];
			$fs_score = $arr[11];
			$fc_val = $arr[12];
			$fc_score = $arr[15];

			$fs_rank = $arr[16];
			$fc_rank = $arr[17];

			if($fs_rank == 1)
			{
				$ostring = $sp1 . "\t" . $sp2 . "\t" . $fs_val  . "\t" . $fs_score . "\t" . $fc_val  . "\t" . $fc_score;
				fwrite($handleFS , $ostring . "\n");
			}

			if($fc_rank == 1)
			{
				$ostring = $sp1 . "\t" . $sp2 . "\t" . $fc_val  . "\t" . $fc_score . "\t" . $fc_val  . "\t" . $fc_score;
				$fc_save_str[$sp1] = $ostring;
				$fc_save_score[$sp1] = $fc_score;
			}

	$Data1 = trim(fgets($handle1, 4096));
  }
  fclose($handle1);
} else {
	fwrite(STDERR, "File 1 not found" . PHP_EOL);
}

  if(file_exists($file2))
  {
	  $handle1 = fopen($file2, 'r');

	  $Data1 = trim(fgets($handle1, 4096));

	  while (!feof($handle1))
	  {
		  $arr = explode("\t", $Data1);

		  $sp1t = $arr[0];
		  $sp2t = $arr[1];

		  $sp1w = strtok($sp1t, ".");
		  $sp2w = strtok($sp2t, ".");

		  $sp1 = str_replace("v2", "v3", $sp1w);
		  $sp2 = str_replace("v2", "v3", $sp2w);

		  $fs_val = $arr[10];
		  $fs_score = $arr[11];
		  $fc_val = $arr[12];
		  $fc_score = $arr[15];

		  $fs_rank = $arr[16];
		  $fc_rank = $arr[17];

		  if($fs_rank == 1)
		  {
			  $ostring = $sp1 . "\t" . $sp2 . "\t" . $fs_val  . "\t" . $fs_score . "\t" . $fc_val  . "\t" . $fc_score;
			  fwrite($handleDM , $ostring.  "\n");
		  }

		  if($fc_rank == 1)
		  {
			  $ostring = $sp1 . "\t" . $sp2 . "\t" . $fc_val  . "\t" . $fc_score . "\t" . $fc_val  . "\t" . $fc_score;
			  if($fc_save_str[$sp1])
			  {
				  if($fc_score > $fc_save_score[$sp1])
				  {
					  $fc_save_str[$sp1] = $ostring;
					  $fc_save_score[$sp1] = $fc_score;
				  }

			  } else {
				  $fc_save_str[$sp1] = $ostring;
				  $fc_save_score[$sp1] = $fc_score;
			  }

		  }

  $Data1 = trim(fgets($handle1, 4096));
}
fclose($handle1);

foreach ($fc_save_str as $key1 => $ostring) {
	//foreach ($fc_save_str[$key1] as $key2 => $ostring) {
		fwrite($handleFC , $ostring . "\n");
	//}
}

} else {
  fwrite(STDERR, "File 2 not found" . PHP_EOL);
}

  ?>
