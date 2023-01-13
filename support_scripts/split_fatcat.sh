#!/bin/bash
#SBATCH CODE GOES HERE

date                          #optional, prints out timestamp at the start of the job in stdout file

SPECIES1=$1
SPECIES2=$2
QUERY_FILE=$3
OUTPUT_DIR=$4

	echo "perl ./FATCATQue.pl timeused ${QUERY_FILE} ${SPECIES1} ${SPECIES2} -i ./ -m -t -ac > ${OUTPUT_DIR}"
	perl ./fatcat/FATCATQue.pl timeused ${QUERY_FILE} ${SPECIES1} ${SPECIES2} -i ./ -m -t -ac > ${OUTPUT_DIR}

date                          #optional, prints out timestamp when the job ends
#End of file
