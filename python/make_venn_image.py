from matplotlib import pyplot as plt
import numpy as np
import re
from matplotlib_venn import venn3, venn3_circles, venn3_unweighted
import sys

query_species = sys.argv[1]
target_species = sys.argv[2]
protein_ct = int(sys.argv[3])
base_dir = sys.argv[4]
venn_dir = sys.argv[5]

font = {'family' : 'normal',
        'weight' : 'bold',
        'size'   : 22}

figure, axes = plt.subplots(2, 1)
figure.set_size_inches(15, 25)


axes[0].set_title('Venn Diagram Key' + '\n' + query_species.capitalize() + ' (' + "{:,}".format(protein_ct) + ' proteins)', fontsize=30)
vk = venn3_unweighted(subsets=(3,1331,8,0,338,0,1113), set_labels = ('FATCAT', 'Foldseek', 'Diamond'), ax=axes[0])

for text in vk.set_labels:
    text.set_fontsize(25)

for x in range(len(vk.subset_labels)):
	if vk.subset_labels[x] is not None:
		vk.subset_labels[x].set_fontsize(25)

vk.get_patch_by_id('100').set_alpha(0.5)
vk.get_patch_by_id('010').set_alpha(0.5)
vk.get_patch_by_id('001').set_alpha(0.5)

vk.get_patch_by_id('110').set_alpha(0.9)
vk.get_patch_by_id('101').set_alpha(0.9)
vk.get_patch_by_id('011').set_alpha(0.9)

vk.get_patch_by_id('100').set_color('silver')
vk.get_patch_by_id('010').set_color('silver')
vk.get_patch_by_id('001').set_color('silver')
vk.get_patch_by_id('110').set_color('gold')
vk.get_patch_by_id('101').set_color('gold')
vk.get_patch_by_id('011').set_color('gold')
vk.get_patch_by_id('111').set_color('white')

vk.get_label_by_id('100').set_text('')
vk.get_label_by_id('010').set_text('')
vk.get_label_by_id('001').set_text('')
vk.get_label_by_id('110').set_text('')
vk.get_label_by_id('101').set_text('')
vk.get_label_by_id('011').set_text('')
vk.get_label_by_id('111').set_text('')


ck = venn3_circles(subsets=(1,1,1,1,1,1,1), linestyle='solid', ax=axes[0])


axes[0].annotate('Silver set \n gene counts', xy=vk.get_label_by_id('100').get_position() - np.array([0, 0.05]), xytext=(-190,-50),
             ha='center', textcoords='offset points', bbox=dict(boxstyle='round,pad=0.5', fc='silver', alpha=0.5),
             arrowprops=dict(arrowstyle='->', connectionstyle='arc3,rad=0.5',color='gray'), fontsize=28)

axes[0].annotate('Gold set \n gene counts', xy=vk.get_label_by_id('101').get_position() - np.array([0, 0.05]), xytext=(-270,-15),
             ha='center', textcoords='offset points', bbox=dict(boxstyle='round,pad=0.5', fc='gold', alpha=0.9),
             arrowprops=dict(arrowstyle='->', connectionstyle='arc3,rad=0.5',color='gray'), fontsize=28)

axes[0].annotate('Platinum set \n gene counts', xy=vk.get_label_by_id('111').get_position() - np.array([0, 0.05]), xytext=(-395,-240),
 			ha='center', textcoords='offset points', bbox=dict(boxstyle='round,pad=0.5', fc='white', alpha=1),
			arrowprops=dict(arrowstyle='->', connectionstyle='arc3,rad=0.5',color='gray'), fontsize=28)

axes[0].annotate('Silver set \n coverage', xy=vk.get_label_by_id('010').get_position() - np.array([0, 0.05]), xytext=(190,-50),
			 ha='center', textcoords='offset points', bbox=dict(boxstyle='round,pad=0.5', fc='silver', alpha=0.5),
			 arrowprops=dict(arrowstyle='->', connectionstyle='arc3,rad=-0.5',color='gray'), fontsize=28)

axes[0].annotate('Gold set \n coverage', xy=vk.get_label_by_id('011').get_position() - np.array([0, 0.05]), xytext=(270,-15),
             ha='center', textcoords='offset points', bbox=dict(boxstyle='round,pad=0.5', fc='gold', alpha=0.9),
             arrowprops=dict(arrowstyle='->', connectionstyle='arc3,rad=-0.5',color='gray'), fontsize=28)

axes[0].annotate('Platinum set \n coverage', xy=vk.get_label_by_id('111').get_position() - np.array([0, 0.05]), xytext=(395,-240),
 			ha='center', textcoords='offset points', bbox=dict(boxstyle='round,pad=0.5', fc='white', alpha=1),
			arrowprops=dict(arrowstyle='->', connectionstyle='arc3,rad=-0.5',color='gray'), fontsize=28)

count = 0
v = []
c = []

if(target_species != query_species):
	filename = base_dir + query_species + "_" + target_species + "_venn.txt"
	f = open(filename, "r")
	line1 = f.readline()
	line2 = f.readline()
	line3 = f.readline()
	vals = re.split('\(|,|\)', line3)

	row=1
	column=0

	v.append( venn3_unweighted(subsets=(1,1,1,1,1,1,1), set_labels = ('FATCAT', 'Foldseek', 'Diamond'), ax=axes[1]))

	for text in v[count].set_labels:
		text.set_fontsize(25)

	for x in range(len(v[count].subset_labels)):
		if v[count].subset_labels[x] is not None:
			v[count].subset_labels[x].set_fontsize(25)

	v[count].get_patch_by_id('100').set_alpha(0.5)
	v[count].get_patch_by_id('010').set_alpha(0.5)
	v[count].get_patch_by_id('001').set_alpha(0.5)

	v[count].get_patch_by_id('110').set_alpha(0.9)
	v[count].get_patch_by_id('101').set_alpha(0.9)
	v[count].get_patch_by_id('011').set_alpha(0.9)

	v[count].get_label_by_id('100').set_text("{:,}".format(int(vals[1])))
	v[count].get_label_by_id('010').set_text("{:,}".format(int(vals[2])))
	v[count].get_label_by_id('110').set_text("{:,}".format(int(vals[3])))
	v[count].get_label_by_id('001').set_text("{:,}".format(int(vals[4])))
	v[count].get_label_by_id('101').set_text("{:,}".format(int(vals[5])))
	v[count].get_label_by_id('011').set_text("{:,}".format(int(vals[6])))
	v[count].get_label_by_id('111').set_text("{:,}".format(int(vals[7])))

	silver_total = int(vals[1]) + int(vals[2]) + int(vals[4])
	gold_total = int(vals[3]) + int(vals[5]) + int(vals[6])
	plat_total = int(vals[7])
	all_total = silver_total + gold_total + plat_total

	silver_cov = 100 * (silver_total / protein_ct)
	gold_cov = 100 * (gold_total / protein_ct)
	plat_cov = 100 * (plat_total / protein_ct)

	v[count].get_patch_by_id('100').set_color('silver')
	v[count].get_patch_by_id('010').set_color('silver')
	v[count].get_patch_by_id('001').set_color('silver')
	v[count].get_patch_by_id('110').set_color('gold')
	v[count].get_patch_by_id('101').set_color('gold')
	v[count].get_patch_by_id('011').set_color('gold')
	v[count].get_patch_by_id('111').set_color('white')

	#v.get_label_by_id('A').set_text('Set "A"')
	c.append(venn3_circles(subsets=(1,1,1,1,1,1,1), linestyle='solid', ax=axes[1]))

	axes[1].annotate("{:,}".format(silver_total) + '\n genes' , xy=vk.get_label_by_id('100').get_position() - np.array([0, 0.05]), xytext=(-190,-50),
		     ha='center', textcoords='offset points', bbox=dict(boxstyle='round,pad=0.5', fc='silver', alpha=0.5), fontsize=28)

	axes[1].annotate("{:,}".format(gold_total) + '\n genes', xy=vk.get_label_by_id('101').get_position() - np.array([0, 0.05]), xytext=(-270,-15),
		    ha='center', textcoords='offset points', bbox=dict(boxstyle='round,pad=0.5', fc='gold', alpha=0.9), fontsize=28)

	axes[1].annotate("{:,}".format(plat_total) + '\n genes', xy=vk.get_label_by_id('111').get_position() - np.array([0, 0.05]), xytext=(-395,-240),
		 	ha='center', textcoords='offset points', bbox=dict(boxstyle='round,pad=0.5', fc='white', alpha=1), fontsize=28)

	axes[1].annotate("{0:,.1f}".format(silver_cov) + '% \n coverage', xy=vk.get_label_by_id('010').get_position() - np.array([0, 0.05]), xytext=(190,-50),
			ha='center', textcoords='offset points', bbox=dict(boxstyle='round,pad=0.5', fc='silver', alpha=0.5), fontsize=28)

	axes[1].annotate("{0:,.1f}".format(gold_cov) + '% \n coverage', xy=vk.get_label_by_id('011').get_position() - np.array([0, 0.05]), xytext=(270,-15),
		    ha='center', textcoords='offset points', bbox=dict(boxstyle='round,pad=0.5', fc='gold', alpha=0.9), fontsize=28)

	axes[1].annotate("{0:,.1f}".format(plat_cov) + '% \n coverage', xy=vk.get_label_by_id('111').get_position() - np.array([0, 0.05]), xytext=(395,-240),
		 	ha='center', textcoords='offset points', bbox=dict(boxstyle='round,pad=0.5', fc='white', alpha=1), fontsize=28)

	if (target_species == query_species):
		title_name = query_species.capitalize() + "/" + target_species.capitalize() + ' - Structual Homeologs' + '\n' + '(' + "{:,}".format(all_total) + ' out of ' + "{:,}".format(protein_ct) + ' proteins)'
	if (target_species != query_species):
		title_name = query_species.capitalize() + "/" + target_species.capitalize() + ' - Structual Orthologs' + '\n' + '(' + "{:,}".format(all_total) + ' out of ' + "{:,}".format(protein_ct) + ' proteins)'

	axes[1].set_title(title_name,fontsize=30)

############################
figure.savefig(venn_dir + query_species + '_' + target_species + '_Venn.png')
