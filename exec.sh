#!/bin/bash -xv

if [ "$1" == "ex" ]
then
	sudo -u drush $3 $4 $5 $6 $7 $8 $9 > $2 2>&1
else
	screen -d -m $0 ex "$1" $2 $3 $4 $5 $6 $7 $8 $9
fi
