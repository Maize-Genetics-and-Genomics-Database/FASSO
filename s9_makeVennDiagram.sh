#!/bin/bash
#SBATCH CODE GOES HERE

date	#optional, prints out timestamp at the start of the job in stdout file

########################
#Change these parameters
SPECIES1=maize
SPECIES2=arabidopsis
SPECIES1_PROTEOME_SIZE=39,299
SPECIES2_PROTEOME_SIZE=27,434
BASE_DIR=~/FASSO/
########################

pip install matplotlib
pip install scipy

echo "python ${BASE_DIR}/python/make_venn_image.py ${SPECIES1} ${SPECIES2} ${SPECIES1_PROTEOME_SIZE} ${BASE_DIR}/venn/ ${BASE_DIR}/venn/"
python ${BASE_DIR}/python/make_venn_image.py ${SPECIES1} ${SPECIES2} ${SPECIES1_PROTEOME_SIZE} ${BASE_DIR}/venn/ ${BASE_DIR}/venn/

echo "python ${BASE_DIR}/python/make_venn_image.py ${SPECIES2} ${SPECIES1} ${SPECIES2_PROTEOME_SIZE} ${BASE_DIR}/venn/ ${BASE_DIR}/venn/"
python ${BASE_DIR}/python/make_venn_image.py ${SPECIES2} ${SPECIES1} ${SPECIES2_PROTEOME_SIZE} ${BASE_DIR}/venn/ ${BASE_DIR}/venn/
date                          #optional, prints out timestamp when the job ends
#End of file
