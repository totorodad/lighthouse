#!/bin/bash

if ps aux | grep 'python3 /var/www/html/lighthouse.py -timer' | grep -v grep
then
	echo Already Running
else
	# echo Not running. Booting
	/usr/bin/python3 /var/www/html/lighthouse.py -timer
fi
