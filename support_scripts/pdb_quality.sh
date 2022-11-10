#!/bin/bash
#SBATCH CODE GOES HERE

date	#optional, prints out timestamp at the start of the job in stdout file

########################
#Change these parameters
QUERY=maize
BASE_DIR=~/FASSSO/
########################

PDB_DIR=${BASE_DIR}pdb/${QUERY}/
OUT_DIR=${BASE_DIR}pdb/${QUERY}_scores.txt
SUMMARY_DIR=${BASE_DIR}pdb/${QUERY}_summary.txt

echo "./php/find_pdb_quality.php ${QUERY} ${PDB_DIR} ${OUT_DIR}"
php ./php/find_pdb_quality.php ${QUERY} ${PDB_DIR} ${OUT_DIR} > ${SUMMARY_DIR}

date                          #optional, prints out timestamp when the job ends
#End of file
