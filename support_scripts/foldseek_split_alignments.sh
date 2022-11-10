#!/bin/bash
#SBATCH CODE GOES HERE

date	#optional, prints out timestamp at the start of the job in stdout file

########################
QUERY_FILE=$1
QUERY_DIR=$2
TARGET_DB=$3
OUTPUT_DIR=$4

while IFS= read -r file
do
	echo "/90daydata/maizegdb/carson/FOLDSEEK/foldseek/bin/foldseek easy-search ${QUERY_DIR}${file} ${TARGET_DB} ${OUTPUT_DIR}${file}.m8 ./foldseek/tmp/${file}"
	/90daydata/maizegdb/carson/FOLDSEEK/foldseek/bin/foldseek easy-search ${QUERY_DIR}${file} ${TARGET_DB} ${OUTPUT_DIR}${file}.m8 ./foldseek/tmp/${file}
done < "${QUERY_FILE}"


date                          #optional, prints out timestamp when the job ends
#End of file
