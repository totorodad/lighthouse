#! /usr/bin/env python3 
# Lighthouse 2.0
# J. Nolan
# 26-Dec-2023
#
# Raspberry Pi 4 and W Zero
# J8:
#    3V3  (1) (2)  5V    
#  GPIO2  (3) (4)  5V    
#  GPIO3  (5) (6)  GND   
#  GPIO4  (7) (8)  GPIO14
#    GND  (9) (10) GPIO15
# GPIO17 (11) (12) GPIO18
# GPIO27 (13) (14) GND   
# GPIO22 (15) (16) GPIO23
#    3V3 (17) (18) GPIO24
# GPIO10 (19) (20) GND   
#  GPIO9 (21) (22) GPIO25
# GPIO11 (23) (24) GPIO8 
#    GND (25) (26) GPIO7 
#  GPIO0 (27) (28) GPIO1 
#  GPIO5 (29) (30) GND   
#  GPIO6 (31) (32) GPIO12
# GPIO13 (33) (34) GND   
# GPIO19 (35) (36) GPIO16
# GPIO26 (37) (38) GPIO20
#    GND (39) (40) GPIO21


from datetime import datetime
from gpiozero import LED
from time import sleep
import sys
import gpiozero.pins.rpigpio
import os.path

verbose = False 
lights_on = False

def close(self): pass
gpiozero.pins.rpigpio.RPiGPIOPin.close = close

led2= LED("GPIO2", initial_value=None, pin_factory=gpiozero.pins.rpigpio.RPiGPIOFactory())
led3= LED("GPIO3", initial_value=None, pin_factory=gpiozero.pins.rpigpio.RPiGPIOFactory())
led4= LED("GPIO4", initial_value=None, pin_factory=gpiozero.pins.rpigpio.RPiGPIOFactory())
led5= LED("GPIO5", initial_value=None, pin_factory=gpiozero.pins.rpigpio.RPiGPIOFactory())
led6= LED("GPIO6", initial_value=None, pin_factory=gpiozero.pins.rpigpio.RPiGPIOFactory())
led7= LED("GPIO7", initial_value=None, pin_factory=gpiozero.pins.rpigpio.RPiGPIOFactory())
led8= LED("GPIO8", initial_value=None, pin_factory=gpiozero.pins.rpigpio.RPiGPIOFactory())
led9= LED("GPIO9", initial_value=None, pin_factory=gpiozero.pins.rpigpio.RPiGPIOFactory())
led10= LED("GPIO10", initial_value=None, pin_factory=gpiozero.pins.rpigpio.RPiGPIOFactory())
led11= LED("GPIO11", initial_value=None, pin_factory=gpiozero.pins.rpigpio.RPiGPIOFactory())
led12= LED("GPIO12", initial_value=None, pin_factory=gpiozero.pins.rpigpio.RPiGPIOFactory())
led13= LED("GPIO13", initial_value=None, pin_factory=gpiozero.pins.rpigpio.RPiGPIOFactory())
led14= LED("GPIO14", initial_value=None, pin_factory=gpiozero.pins.rpigpio.RPiGPIOFactory())
led15= LED("GPIO15", initial_value=None, pin_factory=gpiozero.pins.rpigpio.RPiGPIOFactory())
led16= LED("GPIO16", initial_value=None, pin_factory=gpiozero.pins.rpigpio.RPiGPIOFactory())
led17= LED("GPIO17", initial_value=None, pin_factory=gpiozero.pins.rpigpio.RPiGPIOFactory())
led18= LED("GPIO18", initial_value=None, pin_factory=gpiozero.pins.rpigpio.RPiGPIOFactory())
led19= LED("GPIO19", initial_value=None, pin_factory=gpiozero.pins.rpigpio.RPiGPIOFactory())
led20= LED("GPIO20", initial_value=None, pin_factory=gpiozero.pins.rpigpio.RPiGPIOFactory())
led21= LED("GPIO21", initial_value=None, pin_factory=gpiozero.pins.rpigpio.RPiGPIOFactory())
led22= LED("GPIO22", initial_value=None, pin_factory=gpiozero.pins.rpigpio.RPiGPIOFactory())
led23= LED("GPIO23", initial_value=None, pin_factory=gpiozero.pins.rpigpio.RPiGPIOFactory())
led24= LED("GPIO24", initial_value=None, pin_factory=gpiozero.pins.rpigpio.RPiGPIOFactory())
led25= LED("GPIO25", initial_value=None, pin_factory=gpiozero.pins.rpigpio.RPiGPIOFactory())
led26= LED("GPIO26", initial_value=None, pin_factory=gpiozero.pins.rpigpio.RPiGPIOFactory())
led27= LED("GPIO27", initial_value=None, pin_factory=gpiozero.pins.rpigpio.RPiGPIOFactory())

def usage():
	print("Nolan Engineering Lighting Controller Rev 1.1")
	print("Project Lighthouse 2.0")
	print("26-Dec-2023")
	print("-----------------------------------------------")
	print("Available LEDs: ")
	print("Run command pinout<enter> to see your board pinout.")
	print("LED 2-27 (GPIO2-27)")
	print("LED 2 value: ", led2.value,"	LED 3 value: ", led3.value)
	print("LED 4 value: ", led4.value,"	LED 5 value: ", led5.value)
	print("LED 6 value: ", led6.value,"	LED 7 value: ", led7.value)
	print("LED 8 value: ", led8.value,"	LED 9 value: ", led9.value)
	print("LED 10 value: ", led10.value,"	LED 11 value: ", led11.value)
	print("LED 12 value: ", led12.value,"	LED 13 value: ", led13.value)
	print("LED 14 value: ", led14.value,"	LED 15 value: ", led15.value)
	print("LED 16 value: ", led16.value,"	LED 17 value: ", led17.value)
	print("LED 18 value: ", led18.value,"	LED 19 value: ", led19.value)
	print("LED 20 value: ", led20.value,"	LED 21 value: ", led21.value)
	print("LED 22 value: ", led22.value,"	LED 23 value: ", led23.value)
	print("LED 24 value: ", led24.value,"	LED 25 value: ", led25.value)
	print("LED 26 value: ", led26.value,"	LED 27 value: ", led27.value)
	print("-----------------------------------------------")
	print("To read LEDvalue:") 
	print("Format: ",sys.argv[0],"<LED NUMBER>")
	print("-----------------------------------------------")
	print("To set LED value:")
	print("Format: ",sys.argv[0],"<LED NUMBER> <1/0>")
	print("-----------------------------------------------")
	print("To turn all lights on and off based on times in .startstop:")
	print("Format: ",sys.argv[0]," -timer")
	print("-----------------------------------------------")
	print("To turn all lights on:")
	print("Format: ",sys.argv[0]," -allon")
	print("-----------------------------------------------")
	print("To turn all lights off:")
	print("Format: ",sys.argv[0]," -alloff")
	exit(1)

# check for the correct number of arguments
n = len(sys.argv)
if n != 2 and n != 3:
	usage()

# if getting the LED value
if sys.argv[1].isdigit() and n == 2:
	led_number = int(sys.argv[1])

	match led_number:
		case 2:
			print(led2.value)
		case 3:
			print(led3.value)
		case 4:
			print(led4.value)
		case 5:
			print(led5.value)
		case 6:
			print(led6.value)
		case 7:
			print(led7.value)
		case 8:
			print(led8.value)
		case 9:
			print(led9.value)
		case 10:
			print(led10.value)
		case 11:
			print(led11.value)
		case 12:
			print(led12.value)
		case 13:
			print(led13.value)
		case 14:
			print(led14.value)
		case 15:
			print(led15.value)
		case 16:
			print(led16.value)
		case 17:
			print(led17.value)
		case 18:
			print(led18.value)
		case 19:
			print(led19.value)
		case 20:
			print(led20.value)
		case 21:
			print(led21.value)
		case 22:
			print(led22.value)
		case 23:
			print(led23.value)
		case 24:
			print(led24.value)
		case 25:
			print(led25.value)
		case 26:
			print(led26.value)
		case 27:
			print(led27.value)
	exit(0)

def all_on():
	led2.on()
	led3.on()
	led4.on()
	led5.on()
	led6.on()
	led7.on()
	led8.on()
	led9.on()
	led10.on()
	led11.on()
	led12.on()
	led13.on()
	led14.on()
	led15.on()
	led16.on()
	led17.on()
	led18.on()
	led19.on()
	led20.on()
	led21.on()
	led22.on()
	led23.on()
	led24.on()
	led25.on()
	led26.on()
	led27.on()

def all_off():
	led2.off()
	led3.off()
	led4.off()
	led5.off()
	led6.off()
	led7.off()
	led8.off()
	led9.off()
	led10.off()
	led11.off()
	led12.off()
	led13.off()
	led14.off()
	led15.off()
	led16.off()
	led17.off()
	led18.off()
	led19.off()
	led20.off()
	led21.off()
	led22.off()
	led23.off()
	led24.off()
	led25.off()
	led26.off()
	led27.off()

def timer():
	global lights_on

	if (os.path.isfile("/var/www/html/.startstop")):
		with open("/var/www/html/.startstop", "r") as filestream:
			for line in filestream:
				time_string = line.split(",")
				start_time = time_string[0]
				stop_time = time_string[1] 

	else:
		# Default to 6pm to 10pm lights will be on
		start_time = "18:00"
		stop_time  = "22:00"
		print("can't find: /usr/www/html/.startstop, using default 6pm-10pm")

	# Break up the start stop hour and minutes
	start_time_array = start_time.split(":")
	start_time_hour = int(start_time_array[0])
	start_time_minute = int(start_time_array[1])

	start_range_hour = start_time_hour
	#shave off a minute to allow a minute to be added (avoid roll over)
	if start_time_minute == 59:
	        start_time_minute = 58	
	start_range_minute = start_time_minute + 1

	print("Starting time range:\t",start_time_hour,":",start_time_minute, "to", start_time_hour,":",start_range_minute)

	stop_time_array = stop_time.split(":")
	stop_time_hour = int(stop_time_array[0])
	stop_time_minute = int(stop_time_array[1])
	if stop_time_minute == 59:
	        stop_time_minute = 58	
	stop_range_minute = stop_time_minute + 1

	print("Stop time range:\t",stop_time_hour,":",stop_time_minute, "to", stop_time_hour,":",stop_range_minute)

	current_time = datetime.now()
	current_hour = int(current_time.hour) 
	current_minute = int(current_time.minute)
	print("Current Time:\t",current_hour,":",current_minute)

	# Check to see if we need to turn on all LEDs
	if (current_hour == start_time_hour and (current_minute >= start_time_minute and current_minute <= start_range_minute)):
		if (lights_on == False):
			all_on()
			print("Set lights on")
			lights_on = True

	# Check to see if we need to turn off all LEDs
	if (current_hour == stop_time_hour and (current_minute >= stop_time_minute and current_minute <= stop_range_minute)):
		if(lights_on == True):
			all_off()
			print("Set Lights off")
			lights_on = False

	sleep(5)
	
# start timer
if sys.argv[1] == "-timer" and n == 2:
	print("Monitorsing time for on/off times: ")
	# Start infinite timer (or untiel CTRL-C is hit or process killed
	all_off()
	while True:
		timer()

# turn all LEDs on
if sys.argv[1] == "-allon" and n == 2:
	all_on()
	exit(0)

#turn all LEDs off
if sys.argv[1] == "-alloff" and n == 2:
	all_off()
	exit(0)	

#turn all LEDs off
# set LED on/off 
if n==3:
	if sys.argv[1].isdigit() and sys.argv[2].isdigit():
		led_number = int(sys.argv[1])
		led_status = int(sys.argv[2])
	else:
		usage()
else:
	usage()

# Check for out of range
if led_number <2 or led_number >27:
	usage()

match led_number:
	case 2:
		if led_status == 1:
			led2.on()
		else:
			led2.off()
	case 3:
		if led_status == 1:
			led3.on()
		else:
			led3.off()
	case 4:
		if led_status == 1:
			led4.on()
		else:
			led4.off()
	case 5:
		if led_status == 1:
			led5.on()
		else:
			led5.off()
	case 6:
		if led_status == 1:
			led6.on()
		else:
			led6.off()
	case 7:
		if led_status == 1:
			led7.on()
		else:
			led7.off()
	case 8:
		if led_status == 1:
			led8.on()
		else:
			led8.off()
	case 9:
		if led_status == 1:
			led9.on()
		else:
			led9.off()
	case 10:
		if led_status == 1:
			led10.on()
		else:
			led10.off()
	case 11:
		if led_status == 1:
			led11.on()
		else:
			led11.off()
	case 12:
		if led_status == 1:
			led12.on()
		else:
			led12.off()
	case 13:
		if led_status == 1:
			led13.on()
		else:
			led13.off()
	case 14:
		if led_status == 1:
			led14.on()
		else:
			led14.off()
	case 15:
		if led_status == 1:
			led15.on()
		else:
			led15.off()
	case 16:
		if led_status == 1:
			led16.on()
		else:
			led16.off()
	case 17:
		if led_status == 1:
			led17.on()
		else:
			led17.off()
	case 18:
		if led_status == 1:
			led18.on()
		else:
			led18.off()
	case 19:
		if led_status == 1:
			led19.on()
		else:
			led19.off()
	case 20:
		if led_status == 1:
			led20.on()
		else:
			led20.off()
	case 21:
		if led_status == 1:
			led21.on()
		else:
			led21.off()
	case 22:
		if led_status == 1:
			led22.on()
		else:
			led22.off()
	case 23:
		if led_status == 1:
			led23.on()
		else:
			led23.off()
	case 24:
		if led_status == 1:
			led24.on()
		else:
			led24.off()
	case 25:
		if led_status == 1:
			led25.on()
		else:
			led25.off()
	case 26:
		if led_status == 1:
			led26.on()
		else:
			led26.off()
	case 27:
		if led_status == 1:
			led27.on()
		else:
			led27.off()
