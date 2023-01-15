#!/bin/bash
#SBATCH CODE GOES HERE

date	#optional, prints out timestamp at the start of the job in stdout file

########################
#Change these parameters
SPECIES1=maize
SPECIES2=arabidopsis
BASE_DIR=/90daydata/maizegdb/carson/alphafold_test/FASSO/
########################
PDB_DIR=${BASE_DIR}alignments/fasta_files/${SPECIES1}PDB_list.txt
php ${BASE_DIR}php/make_pairwise_annotations.php ${SPECIES1} ${SPECIES2} ${PDB_DIR} ${BASE_DIR}

PDB_DIR=${BASE_DIR}alignments/fasta_files/${SPECIES2}PDB_list.txt
php ${BASE_DIR}php/make_pairwise_annotations.php ${SPECIES2} ${SPECIES1} ${PDB_DIR} ${BASE_DIR}

date                          #optional, prints out timestamp when the job ends
#End of file
