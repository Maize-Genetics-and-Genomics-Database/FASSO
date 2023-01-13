# FASSO
Functional Annotations using Sequence and Structure Orthology

# What does FASSO do?
FASSO generates structure-based orthologs by combining three methods (Diamond, FoldSeek, and Fatcat) and assigns UniProt function annotations.

# Citation
Andorf, Carson M., Shatabdi Sen, Rita K. Hayford, John L. Portwood, Ethalinda K. Cannon, Lisa C. Harper, Jack M. Gardiner, Taner Z. Sen, and Margaret R. Woodhouse. 2022. “FASSO: An AlphaFold Based Method to Assign Functional Annotations by Combining Sequence and Structure Orthology.” bioRxiv. https://doi.org/10.1101/2022.11.10.516002. 

# FASSO directory structure

```bash
FASSO/
├── alignments
    ├── fasta_files
    ├── flag
    ├── lists
    ├── matrix
    └── splits
├── annotations
    └── uniprot
├── diamond
    ├── data
    └── db
├── fasta  
├── fatcat
    └── out
├── foldseek
    ├── bin
    ├── db
    └── tmp
├── pdb
├── pdb2fasta
├── php
├── python
├── structure_orthologs
├── supplementary_data
├── support_scripts
├── top_hits
└── venn
```

# Running FASSO

## FASSO requirements
 - Install [Diamond](https://github.com/bbuchfink/diamond) into BASE_DIR/diamond
 - Install [Fatcat](https://github.com/GodzikLab/FATCAT-dist) into BASE_DIR/fatcat
 - Install [FoldSeek](https://github.com/steineggerlab/foldseek) into BASE_DIR/foldseek
 - Install [PDB2FASTA](https://github.com/kad-ecoli/pdb2fasta) into BASE_DIR/pdb2fasta

## FASSO optional programs and files
  -  Annotation file from [UniProtKB](https://www.uniprot.org/uniprotkb?query=*)
  -  Choose 'Entry' and 'Protein name' for a given taxonomy ID.  
  -  Download as TSV and name ./annotations/uniprot/SPECIES_uniprot.tsv

## FASSO parameters
Each bash script has a small set of parameters that need to be updated before each run.  Here is a list of the paramters with descriptions and sample values.
```bash
########################
#Bash script parameters
SPECIES1=maize                              #Name for Proteome A
SPECIES2=arabidopsis                        #Name for Proteome B
SPECIES1_GENOME_SIZE=39299                  #Count of proteins in Proteome A
SPECIES2_GENOME_SIZE=27434                  #Count of proteins in Proteome B
BASE_DIR=/home/maizegdb/RBSSH/              #Path to the RBSSH directory
N=30                                        #The number of files to split the data into for time intensive steps
########################
 ```

## Data preperation
Step 0 : Download PDB structures from EBI Alphafold database, create FASTA files, and create DIAMOND, Foldseek databases for a given proteome.  This step is only need for the first time use of a proteome. 
 ```bash
 mkdir SPECIES
 wget https://ftp.ebi.ac.uk/pub/databases/alphafold/latest/UP000007305_4577_MAIZE_v3.tar
 s0_prepareData.sh
 ```

## FASSO steps

 Step 1 : Run Diamond with 2 Proteomes and create alignemnt files.  This step will align both (Proteome A vs Proteome B) and (Proteome B vs Proteome A). It creates two output files - all Diamond hits and Top 10 Diamond hits.
 ```bash
 s1_runDiamond.sh
 ```
 Step 2 : Run Foldseek with 2 proteomes and create alignemnt files. This step will create alignemnt files for both  (Proteome A vs Proteome B) and (Proteome B vs Proteome A).  (Calls foldseek_split_alignments.sh to run in parallel)
 ```bash
 s2_runFoldseek.sh 
 ```
 Step 3 : Combine Foldseek results and creates two output files - all Diamond hits and Top 10 Diamond hits. Make an alignment file based on the top 10 hits from Diamond and FoldSeek to be used as input to FoldSeek.
 ```bash
 s3_mergeFoldseekAlignments.sh
 ```
 Step 4 : Run Fatcat with 2 proteomes and create aligned PDB files.  This step will align both (Proteome A vs Proteome B) and (Proteome B vs Proteome A). (Calls split_fatcat.sh to run in parallel)
 ```bash
 s4_runFatcat.sh 
 ```
 Step 5 : Merge FatCat alignments and compare against Diamond and FoldSeek alignments. It creates multiple output files - all Fatcat hits, Top 10 Fatcat hits, heatmap matrices, and flagged annotations.
 ```bash
 s5_mergeFatcatAlignments.sh
 ```
 Step 6 : Make top hits. Create output files showing the top hit for each protein for each of the 3 methods.
 ```bash
 s6_makeTophits.sh 
 ```
 Step 7 : Make reciprocal best hits.  Create output files showing the recprical best hits for each protein for each of the 3 methods.
 ```bash
 s7_makeRBH.sh 
 ```
 Step 8 : Make reciprocal best sequence and structure hits by combining the recprical best hits from Diamond, FoldSeek, and Fatcat.  Label protein pairs as platinum, gold, or silver. Also creates a Venn diagram output file.
 ```bash
 s8_makeFASSO.sh 
 ```
 Step 9 : Create PNG image of the Venn Diagram for the FASSO outputs. Need proteome sizes.  
 ```bash
  s9_makeVennDiagram.sh p
 ```
  Step 10 : Assign Target Proteome annotations to Query proteome based on FASSO structual orthologs.  Tab-delimited annotations need to be in directory ./annotations/uniprot
 ```bash
  s10_annotation.sh 
 ```
