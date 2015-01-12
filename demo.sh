#!/bin/bash

BASEDIR=$(cd $(dirname $0) && pwd)
OUTPUTDIR=$BASEDIR/samples

COPULA_LIST=(
    'amh:      --copula=amh      --theta=-0.9'
    'clayton:  --copula=clayton  --theta=1.7'
    'frank:    --copula=frank    --theta=8'
    'gumbel:   --copula=gumbel   --theta=3'
    'joe:      --copula=joe      --theta=3'
    'plackett: --copula=plackett --theta=8'
    'product:  --copula=product'
)

DIST_LIST=(
    'normal:  --dist=normal --mean=0 --stddev=1 --range=-4:0.08:4 --delta=0.001'
    'uniform: --dist=uniform --min=-0.001 --max=1.001 --range=0:0.01:1 --delta=0.001'
)

WRITER_LIST=(
    'csv: --writer=csv'
    'png: --writer=contour'
)

mkdir -p $OUTPUTDIR

for (( di = 0; di < ${#DIST_LIST[@]}; di++ )); do
    dist=${DIST_LIST[di]}
    dist_id=${dist%%:*}
    dist_params=${dist#*:}
    for (( ci = 0; ci < ${#COPULA_LIST[@]}; ci++ )); do
	copula=${COPULA_LIST[ci]}
	copula_id=${copula%%:*}
	copula_params=${copula#*:}
        for (( wi = 0; wi < ${#WRITER_LIST[@]}; wi++ )); do
	    writer=${WRITER_LIST[wi]}
	    extension=${writer%%:*}
	    writer_params=${writer#*:}
	    filename=$OUTPUTDIR/copula_${dist_id}_${copula_id}.$extension
            echo "Generating PDF by ($dist_id, $copula_id) to $extension"
            php copula.php $copula_params $dist_params $writer_params >$filename
        done
    done
done
