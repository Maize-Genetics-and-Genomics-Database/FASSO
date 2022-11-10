#!/bin/bash
#SBATCH CODE GOES HERE

date	#optional, prints out timestamp at the start of the job in stdout file

########################
#Change these parameters
SPECIES1=maize
SPECIES2=arabidopsis
BASE_DIR=~/FASSO/
########################

NAME1=${SPECIES1}_${SPECIES2}
NAME2=${SPECIES2}_${SPECIES1}
INDIR1=${BASE_DIR}top_hits/${NAME1}/
INDIR2=${BASE_DIR}top_hits/${NAME2}/
OUTDIR=${BASE_DIR}structure_orthologs/

TYPE=diamond
echo "php createRBHlist.php ${INDIR1}${NAME1}_${TYPE}_tophit.txt ${INDIR2}${NAME2}_${TYPE}_tophit.txt ${OUTDIR}${NAME1}_orthologs_${TYPE}.txt ${OUTDIR}${NAME2}_orthologs_${TYPE}.txt ${SPECIES1} ${SPECIES2} ${TYPE}"
php ${BASE_DIR}/php/createRBHlist.php ${INDIR1}${NAME1}_${TYPE}_tophit.txt ${INDIR2}${NAME2}_${TYPE}_tophit.txt ${OUTDIR}${NAME1}_orthologs_${TYPE}.txt ${OUTDIR}${NAME2}_orthologs_${TYPE}.txt ${SPECIES1} ${SPECIES2} ${TYPE}

TYPE=foldseek
echo "php createRBHlist.php ${INDIR1}${NAME1}_${TYPE}_tophit.txt ${INDIR2}${NAME2}_${TYPE}_tophit.txt ${OUTDIR}${NAME1}_orthologs_${TYPE}.txt ${OUTDIR}${NAME2}_orthologs_${TYPE}.txt ${SPECIES1} ${SPECIES2} ${TYPE}"
php ${BASE_DIR}/php/createRBHlist.php ${INDIR1}${NAME1}_${TYPE}_tophit.txt ${INDIR2}${NAME2}_${TYPE}_tophit.txt ${OUTDIR}${NAME1}_orthologs_${TYPE}.txt ${OUTDIR}${NAME2}_orthologs_${TYPE}.txt ${SPECIES1} ${SPECIES2} ${TYPE}

TYPE=fatcat
echo "php createRBHlist.php ${INDIR1}${NAME1}_${TYPE}_tophit.txt ${INDIR2}${NAME2}_${TYPE}_tophit.txt ${OUTDIR}${NAME1}_orthologs_${TYPE}.txt ${OUTDIR}${NAME2}_orthologs_${TYPE}.txt ${SPECIES1} ${SPECIES2} ${TYPE}"
php ${BASE_DIR}/php/createRBHlist.php ${INDIR1}${NAME1}_${TYPE}_tophit.txt ${INDIR2}${NAME2}_${TYPE}_tophit.txt ${OUTDIR}${NAME1}_orthologs_${TYPE}.txt ${OUTDIR}${NAME2}_orthologs_${TYPE}.txt ${SPECIES1} ${SPECIES2} ${TYPE}

date                          #optional, prints out timestamp when the job ends
#End of file
