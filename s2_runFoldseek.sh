#!/bin/bash
#SBATCH CODE GOES HERE

date	#optional, prints out timestamp at the start of the job in stdout file

########################
#Change these parameters
SPECIES1=maize
SPECIES2=arabidopsis
BASE_DIR=~/FASSO/
########################

TARGET_DB=${SPECIES2}DB
QUERY_DIR=${BASE_DIR}/pdb/${SPECIES1}/
NAME=${SPECIES1}_${SPECIES2}
TARGET_DIR=${BASE_DIR}foldseek/db/${TARGET_DB}
SPLIT_DIR=${BASE_DIR}alignments/splits/${SPECIES1}/
OUT_DIR=${BASE_DIR}alignments/${NAME}/foldseek/

mkdir ${BASE_DIR}alignments/${NAME}
mkdir ${OUT_DIR}

filelist=$(ls ${SPLIT_DIR})

for filename_path in $filelist; do
	filename=$(basename "$filename_path")
	echo "sbatch ${BASE_DIR}support_scripts/foldseek_split_alignments.sh ${SPLIT_DIR}${filename} ${QUERY_DIR} ${TARGET_DIR} ${OUT_DIR}"
	sbatch ${BASE_DIR}support_scripts/foldseek_split_alignments.sh ${SPLIT_DIR}${filename} ${QUERY_DIR} ${TARGET_DIR} ${OUT_DIR}
done

TARGET_DB=${SPECIES1}DB
QUERY_DIR=${BASE_DIR}/pdb/${SPECIES2}/
NAME=${SPECIES2}_${SPECIES1}
TARGET_DIR=${BASE_DIR}foldseek/db/${TARGET_DB}
SPLIT_DIR=${BASE_DIR}alignments/splits/${SPECIES2}/
OUT_DIR=${BASE_DIR}alignments/${NAME}/foldseek/

mkdir ${BASE_DIR}alignments/${NAME}
mkdir ${OUT_DIR}

filelist=$(ls ${SPLIT_DIR})

for filename_path in $filelist; do
	filename=$(basename "$filename_path")
	echo "sbatch ${BASE_DIR}support_scripts/foldseek_split_alignments.sh ${SPLIT_DIR}${filename} ${QUERY_DIR} ${TARGET_DIR} ${OUT_DIR}"
	sbatch ${BASE_DIR}support_scripts/foldseek_split_alignments.sh ${SPLIT_DIR}${filename} ${QUERY_DIR} ${TARGET_DIR} ${OUT_DIR}
done

date                          #optional, prints out timestamp when the job ends
#End of file
