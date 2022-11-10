#!/usr/bin/perl -w

#program for runing FATCAT on a list of structure pairs
#Y.Y, latest update 09/06/03
#note: the input file lists the code (not pdb file name), pdb file is in code.pdb format
##Updated 10/2/22 C.Andorf for the RSBHH, file needs to be in BASE_DIR/fatcat/
#it requires FATCAT environment variate

my $fatcat;

my $prog = "./fatcat/FATCAT-dist/FATCATMain/FATCAT";

my $begtime = time();

die "FATCATQue.pl logfile listfile species1 species2 parameters..\n" unless (@ARGV >= 1);
my $logfile = shift;
my $listfile = shift;
my $species1 = shift;
my $species2 = shift;
my @para = @ARGV;

open(LOG, ">$logfile") || die "can't open file $logfile\n";

my $curr = `pwd`;
open($IN, $listfile) || die "open $listfile error in FATCATQue, curr-dir $curr\n";

my ($code1, $code2, $pdb1, $pdb2);
my $n = 0;
while(<$IN>)	{
    if(/^\#/)	{ next; }
    ($code1, $code2) = split;

    $command = $prog;
    if($code1 =~ s/^([^:]+):(\d+)\+(\d+)/$1/)	{
	$command = "$command -s1 $2 -l1 $3";
    } # define beginning and ending positions for protein 1

    $pdb1 = "./pdb/$species1/$code1.pdb";
    $command = "$command -p1 $pdb1";

    if($code2 =~ s/^([^:]+):(\d+)\+(\d+)/$1/)	{
	$command = "$command -s2 $2 -l2 $3";
    } # define beginning and ending positions for protein 2

    $pdb2 = "./pdb/$species2/$code2.pdb";
    $command = "$command -p2 $pdb2";

	$dm_string = join( "_", $species1, $species2);

    $command = "$command -o ./alignments/$dm_string/fatcat/$code1.$code2 @para";

    print "command: $command\n";
    system($command);
	if($n == 200)
	{
		$n = 0;
		$command2 = "rm ./alignments/$dm_string/fatcat/*.ps;rm ./alignments/$dm_string/fatcat/*.script;rm ./alignments/$dm_string/fatcat/*.ini.*";
		system($command2);
	}
	$n++;
}
$command2 = "rm ./alignments/$dm_string/fatcat/*.ps;rm ./alignments/$dm_string/fatcat/*.script;rm ./alignments/$dm_string/fatcat/*.ini.*";
system($command2);
close($IN);

my $endtime = time();
my $timeuse = ($endtime - $begtime);
my $unit = "mins";
if($timeuse > 3600)	{
    $timeuse /= 3600; $unit = "hours";
} else	{
    $timeuse /= 60; $unit = "mins";
}
my $timeused = sprintf("#Time used %.2f $unit\n", $timeuse);
print LOG $timeused;
close(LOG);
