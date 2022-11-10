#!/bin/bash
#SBATCH CODE GOES HERE

date	#optional, prints out timestamp at the start of the job in stdout file

########################
#Change these parameters
SPECIES1=maize
SPECIES2=arabidopsis
BASE_DIR=~/FASSO/
########################

mkdir ${BASE_DIR}alignments/flag/${SPECIES1}_${SPECIES2}
mkdir ${BASE_DIR}alignments/flag/${SPECIES2}_${SPECIES1}

mkdir ${BASE_DIR}alignments/matrix/${SPECIES1}_${SPECIES2}
mkdir ${BASE_DIR}alignments/matrix/${SPECIES2}_${SPECIES1}


if [ "$SPECIES1" = "$SPECIES2" ]
then
	sbatch ${BASE_DIR}support_scripts/alignments_merge.sh ${SPECIES1} ${SPECIES2} second ${BASE_DIR}
fi

if [ "$SPECIES1" != "$SPECIES2" ]
then
	sbatch ${BASE_DIR}support_scripts/alignments_merge.sh ${SPECIES2} ${SPECIES1} first  ${BASE_DIR}
	sbatch ${BASE_DIR}support_scripts/alignments_merge.sh ${SPECIES1} ${SPECIES2} second ${BASE_DIR}
fi
date                          #optional, prints out timestamp when the job ends
#End of file
