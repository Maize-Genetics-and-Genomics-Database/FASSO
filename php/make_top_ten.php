<?PHP
  error_reporting(E_ERROR | E_WARNING | E_PARSE);

	////Input: Diamond output file between two proteomes
	////Output: The top hits from the file, chain information removed from name

   ////Inout file sorted by first position
   $file1 = $argv[1];
   $handle1 = fopen($file1, 'r');

  $Data1 = trim(fgets($handle1, 4096));
  // Loop through file and outputs top 10 hits
  while (!feof($handle1))
  {
    $n1 =  strtok($Data1, "\t");

	$count[$n1]++;

	if($count[$n1] <= 10)
	{
		//clean up the formatting to remove chain information
		$out = str_replace(":A", "", trim($Data1));
		echo $out . "\n";
	}

    $Data1 = trim(fgets($handle1, 4096));
  }

  ?>
