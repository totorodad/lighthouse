Lighthouse.py
Free and open source
J. Nolan (totorodad@gmail.com)

This tool commands a Raspberry Pi gpio port on/off to drive 3V lamps in book-nook style craft
model.  In this case a Izakaya sushi shop with six different lights.

The lamps are controllable via a PHP web interface.
R-Pi -> Apache 2.0 + PHP 8.x -> index.php -> lighthouse.py
In the background lighthous.py -timer runs continuously to turn on/off all the lights based on the time set in
index.php at the bottom.

The files live in these directories:

/home/pi/lighthouse/boot.sh
/home/pi/.config/wayfire.ini
/var/www/html/index.php
/var/www/html/izakaya.png
/var/www/html/style.css
/var/www/html/lighthouse.py

See howto.pdf to building and setting up the R-Pi.
