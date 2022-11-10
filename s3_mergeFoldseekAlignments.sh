#!/bin/bash
#SBATCH CODE GOES HERE

date	#optional, prints out timestamp at the start of the job in stdout file

########################
#Change these parameters
SPECIES1=maize
SPECIES2=arabidopsis
BASE_DIR=~/FASSO/
N=30 #Number of files to split alignment list for parellel running of Fatcat
########################

FOLDSEEK_DIR=${BASE_DIR}alignments/${SPECIES1}_${SPECIES2}/foldseek/
OUT_TMP=${BASE_DIR}top_hits/${SPECIES1}_${SPECIES2}/${SPECIES1}_${SPECIES2}_foldseek_temp.txt
OUT_ALL=${BASE_DIR}top_hits/${SPECIES1}_${SPECIES2}/${SPECIES1}_${SPECIES2}_foldseek_allhits.txt
OUT_TOP=${BASE_DIR}top_hits/${SPECIES1}_${SPECIES2}/${SPECIES1}_${SPECIES2}_foldseek_top10.txt
#format data and save top ten hits
cat ${FOLDSEEK_DIR}* > ${OUT_TMP}
sed 's/.pdb//g' ${OUT_TMP} > ${OUT_ALL}
rm ${OUT_TMP}
awk 'word!=$1{count=1;word=$1} count<=10{print; count++}' ${OUT_ALL} > ${OUT_TOP}

FOLDSEEK_DIR=${BASE_DIR}alignments/${SPECIES2}_${SPECIES1}/foldseek/
OUT_TMP=${BASE_DIR}top_hits/${SPECIES1}_${SPECIES2}/${SPECIES2}_${SPECIES1}_foldseek_temp.txt
OUT_ALL=${BASE_DIR}top_hits/${SPECIES2}_${SPECIES1}/${SPECIES2}_${SPECIES1}_foldseek_allhits.txt
OUT_TOP=${BASE_DIR}top_hits/${SPECIES2}_${SPECIES1}/${SPECIES2}_${SPECIES1}_foldseek_top10.txt
#format data and save top ten hits
cat ${FOLDSEEK_DIR}* > ${OUT_TMP}
sed 's/.pdb//g' ${OUT_TMP} > ${OUT_ALL}
rm ${OUT_TMP}
awk 'word!=$1{count=1;word=$1} count<=10{print; count++}' ${OUT_ALL} > ${OUT_TOP}

########################
DIAMOND_CHECK1=${BASE_DIR}top_hits/${SPECIES1}_${SPECIES2}/${SPECIES1}_${SPECIES2}_diamond_top10.txt
DIAMOND_CHECK2=${BASE_DIR}top_hits/${SPECIES2}_${SPECIES1}/${SPECIES2}_${SPECIES1}_diamond_top10.txt
FOLDSEEK_CHECK1=${BASE_DIR}top_hits/${SPECIES1}_${SPECIES2}/${SPECIES1}_${SPECIES2}_foldseek_top10.txt
FOLDSEEK_CHECK2=${BASE_DIR}top_hits/${SPECIES2}_${SPECIES1}/${SPECIES2}_${SPECIES1}_foldseek_top10.txt

SPLIT_FILE=${BASE_DIR}alignments/lists/${SPECIES1}_${SPECIES2}.txt
SPLIT_DIR1=${BASE_DIR}alignments/splits/${SPECIES1}_${SPECIES2}/
SPLIT_DIR2=${BASE_DIR}alignments/splits/${SPECIES2}_${SPECIES1}

mkdir ${SPLIT_DIR1}
ln -s ${SPLIT_DIR1} ${SPLIT_DIR2}

php ${BASE_DIR}php/makeAlignment_list.php  ${DIAMOND_CHECK1} ${DIAMOND_CHECK2} ${FOLDSEEK_CHECK1} ${FOLDSEEK_CHECK2} > ${SPLIT_FILE}

split --number=l/${N} ${SPLIT_FILE} ${SPLIT_DIR1}/splt.

date                          #optional, prints out timestamp when the job ends
#End of file
