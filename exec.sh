#!/bin/sh


if [ "$1" == "ex" ]
then

	echo executing $3 $4 $5 $6 $7 $8 $9 > /tmp/exec.tmp
	$3 $4 $5 $6 $7 $8 $9 > $2 2>&1
	#echo > /tmp/exec.end

else 
	#rm -fr /tmp/exec.out
	#rm -fr /tmp/exec.end
	screen -d -m $0 ex $1 $2 $3 $4 $5 $6 $7 $8 $9

	#while [ ! -f /tmp/exec.end ]
	#do
	#	sleep 1
	#done
	#cat /tmp/exec.out

fi