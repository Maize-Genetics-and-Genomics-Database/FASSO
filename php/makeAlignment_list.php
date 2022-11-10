<?PHP
  error_reporting(E_ERROR | E_WARNING | E_PARSE);

  ini_set('memory_limit', '1024M'); 

   ////Rec list 1
   $file1 = $argv[1];
   $handle1 = fopen($file1, 'r');

   ///Rec list 2
   $file2 = $argv[2];
   $handle2 = fopen($file2, 'r');

   ////Rec list 1
   $file3 = $argv[3];
   $handle3 = fopen($file3, 'r');

   ///Rec list 2
   $file4 = $argv[4];
   $handle4 = fopen($file4, 'r');

  $Data1 = trim(fgets($handle1, 4096));
  while (!feof($handle1))
  {
	$n1 =  strtok($Data1, "\t");
	$n2 =   strtok("\t");

	$s1 =  strtok($n1, ":");
	$s2 =  strtok($n2, ":");

	if($ex[$s1][$s2] == 1)
	{

	} else {
		$out[] =  $s1 . "\t" . $s2 . "\n";
		$ex[$s1][$s2] = 1;
		$ex[$s2][$s1] = 1;
	}

	$Data1 = trim(fgets($handle1, 4096));
  }
  fclose($handle1);

  $Data2 = trim(fgets($handle2, 4096));
  while (!feof($handle2))
  {
	$n1 =  strtok($Data2, "\t");
	$n2 =   strtok("\t");

	$s1 =  strtok($n1, ":");
	$s2 =  strtok($n2, ":");

	if($ex[$s1][$s2] == 1)
	{

	} else{
		$out[] = $s2 . "\t" . $s1 . "\n";
		$ex[$s1][$s2] = 1;
		$ex[$s2][$s1] = 1;
	}

	$Data2 = trim(fgets($handle2, 4096));
  }
  fclose($handle2);

    $Data3 = trim(fgets($handle3, 4096));
    while (!feof($handle3))
    {
  	$n1 =  strtok($Data3, "\t");
  	$n2 =   strtok("\t");

  	$s1 =  strtok($n1, ":");
  	$s2 =  strtok($n2, ":");

  	if($ex[$s1][$s2] == 1)
  	{

  	} else {
  		$out[] =  $s1 . "\t" . $s2 . "\n";
  		$ex[$s1][$s2] = 1;
  		$ex[$s2][$s1] = 1;
  	}

  	$Data3 = trim(fgets($handle3, 4096));
    }
    fclose($handle3);

    $Data4 = trim(fgets($handle4, 4096));
    while (!feof($handle4))
    {
  	$n1 =  strtok($Data4, "\t");
  	$n2 =   strtok("\t");

  	$s1 =  strtok($n1, ":");
  	$s2 =  strtok($n2, ":");

  	if($ex[$s1][$s2] == 1)
  	{

  	} else{
  		$out[] = $s2 . "\t" . $s1 . "\n";
  		$ex[$s1][$s2] = 1;
  		$ex[$s2][$s1] = 1;
  	}

  	$Data4 = trim(fgets($handle4, 4096));
    }
    fclose($handle4);

	foreach ($out as $key => $value)
	{
		echo $value;
	}

  ?>
