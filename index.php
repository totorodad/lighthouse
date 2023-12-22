<!DOCTYPE html> 
<html> 
     
<head> 
	<link rel="stylesheet" href="styles.css">
    	<title> 
        	Izakaya Lighting Control
    	</title> 
</head> 
  
<body> 
      
    <h1> 
    	Izakaya Lighting Control	
    </h1> 

    <img src="izakaya.png" alt="sushi-shop" width="10%" height="10%">
      
    <?php
	if(array_key_exists('lighthouse_ontime', $_POST) && array_key_exists('lighthouse_offtime', $_POST)) {
	   if ("" != trim($_POST['lighthouse_ontime']) && "" != trim($_POST['lighthouse_offtime'])) {
	     write_start_stop_time($_POST["lighthouse_ontime"], $_POST["lighthouse_offtime"]);
	     $_POST["lighthouse_ontime"] = "";
	     $_POST["lighthouse_offtime"] = "";
	   }
	}

        if(array_key_exists('led2_on', $_POST)) { 
            LED2_ON(); 
        } 
        else if(array_key_exists('led3_on', $_POST)) { 
            LED3_ON(); 
        }
        else if(array_key_exists('led4_on', $_POST)) { 
            LED4_ON(); 
        }
        else if(array_key_exists('led5_on', $_POST)) { 
            LED5_ON(); 
        }
        else if(array_key_exists('led6_on', $_POST)) { 
            LED6_ON(); 
        }
        else if(array_key_exists('led7_on', $_POST)) { 
            LED7_ON(); 
        }
        else if(array_key_exists('led2_off', $_POST)) { 
            LED2_OFF(); 
        } 
        else if(array_key_exists('led3_off', $_POST)) { 
            LED3_OFF(); 
        }
        else if(array_key_exists('led4_off', $_POST)) { 
            LED4_OFF(); 
        }
        else if(array_key_exists('led5_off', $_POST)) { 
            LED5_OFF(); 
        }
        else if(array_key_exists('led6_off', $_POST)) { 
            LED6_OFF(); 
        }
        else if(array_key_exists('led7_off', $_POST)) { 
            LED7_OFF(); 
        }
        else if(array_key_exists('all_off', $_POST)) { 
            ALL_OFF(); 
        }
        else if(array_key_exists('all_on', $_POST)) { 
            ALL_ON(); 
        }

	function ALL_ON() {
 	  $lighthouse_script = __DIR__ . DIRECTORY_SEPARATOR . "lighthouse.py 2 1";
	  $result = shell_exec("sudo python3 $lighthouse_script");
 	  $lighthouse_script = __DIR__ . DIRECTORY_SEPARATOR . "lighthouse.py 3 1";
	  $result = shell_exec("sudo python3 $lighthouse_script");
 	  $lighthouse_script = __DIR__ . DIRECTORY_SEPARATOR . "lighthouse.py 4 1";
	  $result = shell_exec("sudo python3 $lighthouse_script");
 	  $lighthouse_script = __DIR__ . DIRECTORY_SEPARATOR . "lighthouse.py 5 1";
	  $result = shell_exec("sudo python3 $lighthouse_script");
 	  $lighthouse_script = __DIR__ . DIRECTORY_SEPARATOR . "lighthouse.py 6 1";
	  $result = shell_exec("sudo python3 $lighthouse_script");
 	  $lighthouse_script = __DIR__ . DIRECTORY_SEPARATOR . "lighthouse.py 7 1";
	  $result = shell_exec("sudo python3 $lighthouse_script");
	}

	function ALL_OFF() {
 	  $lighthouse_script = __DIR__ . DIRECTORY_SEPARATOR . "lighthouse.py 2 0";
	  $result = shell_exec("sudo python3 $lighthouse_script");
 	  $lighthouse_script = __DIR__ . DIRECTORY_SEPARATOR . "lighthouse.py 3 0";
	  $result = shell_exec("sudo python3 $lighthouse_script");
 	  $lighthouse_script = __DIR__ . DIRECTORY_SEPARATOR . "lighthouse.py 4 0";
	  $result = shell_exec("sudo python3 $lighthouse_script");
 	  $lighthouse_script = __DIR__ . DIRECTORY_SEPARATOR . "lighthouse.py 5 0";
	  $result = shell_exec("sudo python3 $lighthouse_script");
 	  $lighthouse_script = __DIR__ . DIRECTORY_SEPARATOR . "lighthouse.py 6 0";
	  $result = shell_exec("sudo python3 $lighthouse_script");
 	  $lighthouse_script = __DIR__ . DIRECTORY_SEPARATOR . "lighthouse.py 7 0";
	  $result = shell_exec("sudo python3 $lighthouse_script");
	}

	function LED2_ON() {
 	  $lighthouse_script = __DIR__ . DIRECTORY_SEPARATOR . "lighthouse.py 2 1";
	  $result = shell_exec("sudo python3 $lighthouse_script");
	  //echo "Returned valuse - $result";
	} 

	function LED3_ON() {
 	  $lighthouse_script = __DIR__ . DIRECTORY_SEPARATOR . "lighthouse.py 3 1";
	  $result = shell_exec("sudo python3 $lighthouse_script");
	  //echo "Returned valuse - $result";
	} 

	function LED4_ON() {
 	  $lighthouse_script = __DIR__ . DIRECTORY_SEPARATOR . "lighthouse.py 4 1";
	  $result = shell_exec("sudo python3 $lighthouse_script");
	  //echo "Returned valuse - $result";
	} 

	function LED5_ON() {
 	  $lighthouse_script = __DIR__ . DIRECTORY_SEPARATOR . "lighthouse.py 5 1";
	  $result = shell_exec("sudo python3 $lighthouse_script");
	  //echo "Returned valuse - $result";
	} 

	function LED6_ON() {
 	  $lighthouse_script = __DIR__ . DIRECTORY_SEPARATOR . "lighthouse.py 6 1";
	  $result = shell_exec("sudo python3 $lighthouse_script");
	  //echo "Returned valuse - $result";
	} 

	function LED7_ON() {
 	  $lighthouse_script = __DIR__ . DIRECTORY_SEPARATOR . "lighthouse.py 7 1";
	  $result = shell_exec("sudo python3 $lighthouse_script");
	  //echo "Returned valuse - $result";
	} 

	function LED2_OFF() {
 	  $lighthouse_script = __DIR__ . DIRECTORY_SEPARATOR . "lighthouse.py 2 0";
	  $result = shell_exec("sudo python3 $lighthouse_script");
	  //echo "Returned valuse - $result";
	} 

	function LED3_OFF() {
 	  $lighthouse_script = __DIR__ . DIRECTORY_SEPARATOR . "lighthouse.py 3 0";
	  $result = shell_exec("sudo python3 $lighthouse_script");
	  //echo "Returned valuse - $result";
	} 

	function LED4_OFF() {
 	  $lighthouse_script = __DIR__ . DIRECTORY_SEPARATOR . "lighthouse.py 4 0";
	  $result = shell_exec("sudo python3 $lighthouse_script");
	  //echo "Returned valuse - $result";
	} 

	function LED5_OFF() {
 	  $lighthouse_script = __DIR__ . DIRECTORY_SEPARATOR . "lighthouse.py 5 0";
	  $result = shell_exec("sudo python3 $lighthouse_script");
	  //echo "Returned valuse - $result";
	} 

	function LED6_OFF() {
 	  $lighthouse_script = __DIR__ . DIRECTORY_SEPARATOR . "lighthouse.py 6 0";
	  $result = shell_exec("sudo python3 $lighthouse_script");
	  //echo "Returned valuse - $result";
	} 

	function LED7_OFF() {
 	  $lighthouse_script = __DIR__ . DIRECTORY_SEPARATOR . "lighthouse.py 7 0";
	  $result = shell_exec("sudo python3 $lighthouse_script");
	  //echo "Returned valuse - $result";
	} 

	function write_start_stop_time($start_time, $stop_time) {
	     print "<h1>Set ontime: ".$start_time."</h1>";
	     print "<h1>Set offtime: ".$stop_time."</h1>";

             $myfile = fopen(".startstop", "w") or die("Unable to open file!");
	     $txt = $start_time.",".$stop_time; 
             fwrite($myfile, $txt);
             fclose($myfile);
	}
    ?> 

    <h3>Turn LED's on</h3>  
    <form method="post"> 
        <input type="submit" name="led2_on"
                class="button" value="LED2 ON" /> 
          
        <input type="submit" name="led3_on"
                class="button" value="LED3 ON" /> 

        <input type="submit" name="led4_on"
                class="button" value="LED4 ON" /> 
          
        <input type="submit" name="led5_on"
                class="button" value="LED5 ON" /> 
          
        <input type="submit" name="led6_on"
                class="button" value="LED6 ON" /> 
          
        <input type="submit" name="led7_on"
                class="button" value="LED7 ON" /> 
          
    </form> 

    <h3>Turn LED's off</h3>
    <form method="post"> 
        <input type="submit" name="led2_off"
                class="button" value="LED2 OFF" /> 
          
        <input type="submit" name="led3_off"
                class="button" value="LED3 OFF" /> 
          
        <input type="submit" name="led4_off"
                class="button" value="LED4 OFF" /> 
          
        <input type="submit" name="led5_off"
                class="button" value="LED5 OFF" /> 
          
        <input type="submit" name="led6_off"
                class="button" value="LED6 OFF" /> 
          
        <input type="submit" name="led7_off"
                class="button" value="LED7 OFF" /> 
    </form> 

    <br>
    <h3>All On/Off:</h3>
    <form method="post"> 
        <input type="submit" name="all_on"
                class="button" value="ALL ON" /> 
          
        <input type="submit" name="all_off"
                class="button" value="ALL OFF" /> 
    </form>

    <br><br>
    <h3>Set ON and OFF times:</h3>
    <form method="post">
       <label for="ontime">Select an ON time:</label>
       <input type="time" id="ontime" name="lighthouse_ontime">
       <br><br>
       <label for="offtime">Select an OFF time:</label>
       <input type="time" id="offtime" name="lighthouse_offtime">
       <br><br>
       <input type="submit">
    </form>

</body> 
</html>
