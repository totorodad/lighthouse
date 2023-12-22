#! /usr/bin/env python3 

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

led2 = LED("GPIO2", initial_value=None, pin_factory=gpiozero.pins.rpigpio.RPiGPIOFactory())
led3 = LED("GPIO3", initial_value=None, pin_factory=gpiozero.pins.rpigpio.RPiGPIOFactory())
led4 = LED("GPIO4", initial_value=None, pin_factory=gpiozero.pins.rpigpio.RPiGPIOFactory())
led5 = LED("GPIO5", initial_value=None, pin_factory=gpiozero.pins.rpigpio.RPiGPIOFactory())
led6 = LED("GPIO6", initial_value=None, pin_factory=gpiozero.pins.rpigpio.RPiGPIOFactory())
led7 = LED("GPIO7", initial_value=None, pin_factory=gpiozero.pins.rpigpio.RPiGPIOFactory())

def usage():
	print("Nolan Engineering Lighting Controller Rev 1.1")
	print("Project Lighthouse")
	print("9-Dec-2023")
	print("-----------------------------------------------")
	print("Available LEDs: ")
	print("Run command pinout<enter> to see your board pinout.")
	print("LED 2-7 (GPIO2-7)")
	print("LED 2 value: ", led2.value)
	print("LED 3 value: ", led3.value)
	print("LED 4 value: ", led4.value)
	print("LED 5 value: ", led5.value)
	print("LED 6 value: ", led6.value)
	print("LED 7 value: ", led7.value)
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
	exit(0)

def all_on():
	led2.on()	
	led3.on()
	led4.on()
	led5.on()
	led6.on()
	led7.on()

def all_off():
	led2.off()
	led3.off()
	led4.off()
	led5.off()
	led6.off()
	led7.off()

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
if led_number <2 or led_number >7:
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
