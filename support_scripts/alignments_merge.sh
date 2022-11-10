#!/bin/bash
#SBATCH CODE GOES HERE

date	#optional, prints out timestamp at the start of the job in stdout file

########################
SPECIES1=$1
SPECIES2=$2
PASS=$3
BASE_DIR=$4

DIAMOND=${BASE_DIR}/top_hits/${SPECIES1}_${SPECIES2}/${SPECIES1}_${SPECIES2}_diamond_top10.txt
FOLDSEEK=${BASE_DIR}/top_hits/${SPECIES1}_${SPECIES2}/${SPECIES1}_${SPECIES2}_foldseek_top10.txt
OUTPUT_DIR=${BASE_DIR}/top_hits/${SPECIES1}_${SPECIES2}/
FATCAT_DIR=${BASE_DIR}/alignments/${SPECIES1}_${SPECIES2}/fatcat/
MATRIX_DIR=${BASE_DIR}alignments/matrix/${SPECIES1}_${SPECIES2}/
FLAG_DIR=${BASE_DIR}alignments/flag/${SPECIES1}_${SPECIES2}/
echo "php ${BASE_DIR}/php/merge_fatcat_diamond.php ${SPECIES1} ${SPECIES2} ${PASS} ${DIAMOND} ${OUTPUT_DIR} ${MATRIX_DIR} ${FLAG_DIR} ${FATCAT_DIR}"
php ${BASE_DIR}/php/merge_fatcat_diamond.php ${SPECIES1} ${SPECIES2} ${PASS} ${DIAMOND} ${OUTPUT_DIR} ${MATRIX_DIR} ${FLAG_DIR} ${FATCAT_DIR}
echo "php ${BASE_DIR}/php/merge_fatcat_diamond.php ${SPECIES1} ${SPECIES2} ${PASS} ${DIAMOND} ${OUTPUT_DIR} ${MATRIX_DIR} ${FLAG_DIR} ${FATCAT_DIR}"
php ${BASE_DIR}/php/merge_fatcat_foldseek.php ${SPECIES1} ${SPECIES2} ${PASS} ${FOLDSEEK} ${OUTPUT_DIR} ${MATRIX_DIR} ${FLAG_DIR} ${FATCAT_DIR}
#php merge_foldseek_alignments.php ${SPECIES1} ${PASS} ${TYPE} ${SPECIES1_SM} ${SPECIES2_SM} ${SPECIES2_UP} ${INPUT_DIR} ${OUTPUT_DIR} ${FOLDSEEK_DIR} ${DIAMOND_DIR}

date                          #optional, prints out timestamp when the job ends
#End of file
