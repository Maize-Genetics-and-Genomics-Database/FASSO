# FASSO supplementary data

## Description
Dataset #1 -Diamond, FoldSeek, and FATCAT orthologs and annotations. 
The dataset contains two directories. The “orthologs” directory has the best reciprocal hits from Diamond, FoldSeek, and FATCAT for every pairwise combination of proteomes. The “annotations” directory contains a merged tab-separated file showing the UniProt annotations from the predicted orthologs from Diamond, FoldSeek, and FATCAT. The data is in the GitHub repository under /published_data/Dataset_1_diamond_foldseek_fatcat_annotations/. 

Dataset #2 - Diamond, FoldSeek, and FATCAT top 10 ortholog predictions.
The dataset contains the top 10 hits from Diamond, FoldSeek, and FATCAT for every pairwise combination of proteomes. The data is in the GitHub repository under /published_data/Dataset_2_top_ten_hits/. 

Dataset #3 - Diamond, FoldSeek, and FATCAT heat maps.
The dataset contains the heat maps that compare the top 10 ranked hits between Diamond/FATCAT, FoldSeek/FATCAT, and Diamond/FoldSeek. The data is in the GitHub repository under /published_data/Dataset_5_heat_maps/. 

Dataset #4 -FASSO structural orthologs.
The dataset contains the FASSO orthologs, working sets, and Venn diagram data file for every pairwise combination of proteomes. The data is in the GitHub repository under /published_data/Dataset_2_FASSO_orthologs/. 

Dataset #5 - FASSO functional annotations. 
The dataset contains the FASSO UniProt annotations assigned to the proteins in each proteome. The data is in the GitHub repository under /published_data/Dataset_3_FASSO_annotations/. 

Dataset #6 - Venn diagrams of the confidence labels of the FASSO ortholog predictions. 
The dataset contains Venn diagram images showing the composition of the confidence labels for the FASSO ortholog predictions for each proteome. The data is in the GitHub repository under /published_data/Dataset_6_venn_diagrams/. 

Dataset #7 - FASSO annotations of the uncharacterized maize proteins.
The dataset contains the FASSO annotations for the maize proteins with “uncharacterized protein” annotations in UniProt. The data is in the GitHub repository under /published_data/Dataset_7_FASSO_uncharacterized_annotations/. 

Dataset #8 - Maize orthologs and functional annotations available at MaizeGDB.
The dataset contains all the maize datasets from this paper including FASSO orthologs, FASSO annotations, Venn diagrams, FASSO annotations for uncharacterized proteins, Diamond, FoldSeek, and FASTCAT top hits, orthologs, and annotations. An additional file shows FASSO annotations for the maize uncharacterized proteins with gene expression levels for each protein. The data is in the GitHub repository under /published_data/Dataset_8_maize_annotations/. 

Dataset #8 is also available at the MaizeGDB downloads page: https://download.maizegdb.org/GeneFunction_and_Expression/FASSO_AlphaFold_Orthologs/. 


# FASSO supplementary data directory structure

```bash
FASSO/
├──supplementary_data
    ├── alignments
        ├── fasta_files
        ├── flag
        ├── lists
           ├── matrix
        └── splits
    ├── annotations
        └── uniprot
    └── venn
```

# Running FASSO
