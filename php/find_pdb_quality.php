<?PHP
  error_reporting(E_ERROR | E_PARSE);

  $species = $argv[1];
  $pdb_dir = $argv[2];
  $out_file = $argv[3];

$good = 0;
$bad = 0;
$gb_total = 0;
$gb_avg = 0;

  $handle_out_score = fopen($out_file, 'w');

	$cmd = 'ls ' . $pdb_dir;

  $output = shell_exec($cmd );

  $tokfile = strtok($output, " \n\t");

while ($tokfile !== false) {
	//echo $tokfile . "\n";
	$file_arr[] = $tokfile;
	$tokfile = strtok(" \n\t");
}

foreach ($file_arr as $keyF => $fileF)
{

   $file1 = $fileF;
   $handle1 = fopen($pdb_dir . $file1, 'r');
   //echo $pdb_dir . $file1 . "\n";
	//echo "./data/" . $file1 . "\n";
  // $file1 = "AF-A0A0A0US36-F1-model_v1.pdb";
   //$handle1 = fopen($file1, 'r');
//echo "./" . $species ."/" . $file1;

$t1 =  strtok($file1, "-");
$uni_name =   strtok("-");

$score_arr = null;
$amino_acid_arr = null;
$letter_arr = null;

  $string_out = "";
  $Data1 = trim(fgets($handle1, 4096));
 // $Data1 = trim(fgets($handle1, 4096));
 $n1 =  strtok($Data1, " \t");
 while ($n1 != "ATOM" && !feof($handle1))
 {
	 $Data1 = trim(fgets($handle1, 4096));
	 $n1 =  strtok($Data1, " \t");
 }

$acount = 1;
 while ($n1 == "ATOM")
 {
	 $n1 =  strtok($Data1, " \n\t");
	 $pos = substr($Data1, 22, 4);
	 $aa = substr($Data1, 17, 3);
	 $score = substr($Data1, 61, 5);
	 if(!$amino_acid_arr[$pos])
	 {
	 	$amino_acid_arr[$pos] = $aa;
	 	$score_arr[$pos] = $score;
		$atom_score[$acount] = $atom_score[$acount] + $score;
		$atom_count[$acount]++;
		$acount++;
 	}
	 $Data1 = trim(fgets($handle1, 4096));
 }
 fclose($handle1);

$count = 0;
$total = 0;
$average = 0;
 foreach ($score_arr as $key => $value)
 {
	if($value < 70)
	{
		$bad++;
	} else {
		$good++;
	}

	$gb_total++;
	$count++;
	$total = $total + $value;

 }
 	$averge = $total / $count;
	fwrite($handle_out_score, $uni_name . "\t" . $averge . "\n");


	$big_total = $big_total + $averge;
	$big_cout++;
	$avg_protein = $big_total / $big_cout;

	$good_avg = $good / $gb_total;
	$bad_avg = $bad / $gb_total;


}
	fclose($handle_out_score);

	echo "High-confidence residue count = " . $good . " (" . $good_avg . ")" . "\n";
	echo "Low-confidence residue count = " . $bad . " (" . $bad_avg . ")" . "\n";

	echo "Average score per protein: " . $avg_protein . "\n\n";
	foreach ($atom_score as $key => $value)
	{
		$avg =  $atom_score[$key] / $atom_count[$key];
		echo $key . "\t" . $atom_score[$key] . "\t" . $atom_count[$key] . "\t" . $avg . "\n";
	}

//# of good residues, # of  bad residues, avg score per residue, avg score per protein


 ?>
