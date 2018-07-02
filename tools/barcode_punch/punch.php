<?php

$RECONNECT = 0;
$LAST_PUNCH = 0;
$LAST_PUNCH_TIME = time();

require_once('../../classes/modules/api/client/TimeTrexClientAPI.class.php');

//admin login info
$TIMETREX_URL = 'http://192.168.2.182/timetrex/api/soap/api.php'; // replace with correct TimeTrex server
$TIMETREX_USERNAME = 'admin';
$TIMETREX_PASSWORD = '3137Y6St';

	$colors = new Colors();
	
reconnect:

    $TIMETREX_SESSION_ID= FALSE;
    echo "\n" . $colors->getColoredString("Reconnecting to server..... Attempt " . $RECONNECT, "white", "red"). "\n";
	$RECONNECT = $RECONNECT + 1;
	
	if ($RECONNECT == 5){
	
	
    $cmd = 'echo "Administrator Alert. Error: Over 5 Reconnection Attempts." | mail -S smtp=1.1.1.1 -s "TimeTrex Timeclock" "name@site.com, name@site.com"  > /dev/null 2>/dev/null &';
	exec($cmd);
	
	}
	
    $api_session = new TimeTrexClientAPI();
	$api_session->Login( $TIMETREX_USERNAME, $TIMETREX_PASSWORD );
	
	if ( $TIMETREX_SESSION_ID == FALSE ) {
              sleep(10);
		goto reconnect;
	}
	
     
newscan:
	$punch_obj = new TimeTrexClientAPI( 'Punch' );
	$punchtime = time();
    $punchtype = "Normal";
	$punchstatus = "Auto";
    $punchid = 0;
	$firsttime = TRUE;
 while ($punchid == 0){
    
    if (time() - $punchtime > 10){
    	    $punchtype = "Normal";
	        $punchstatus = "Auto";
	}

    //get time from server and print it
    $result = $punch_obj->getUserPunch();

	if($result == false){
	 echo $colors->getColoredString("CONNECTION ERROR", "white", "red");
 	echo "\n";
	goto reconnect;
	}
	$punch_data = $result->getResult();
	if($punch_data == false){
	 echo $colors->getColoredString("CONNECTION ERROR", "white", "red");
 	echo "\n";
	goto reconnect;
	}
	echo "\n\n";
 	echo $punch_data['time_stamp'];
	 echo "\n\nScanner Ready\n\n";

	 
	 
	 if ($punchtype != "Normal"){
	echo $colors->getColoredString("Punch Type: " . $punchtype , "white", "red");
	} else{
	echo "Punch Type: ". $punchtype ;
	}
	echo "\n";
	 if ($punchstatus != "Auto"){
	echo $colors->getColoredString("Punch Direction: " . $punchstatus , "white", "red");
	} else{
    echo "Punch Direction: ". $punchstatus;
	}
	
	$reconnect = 0;
	echo "\n\n";
	
	//skip the padding to leave the last report on the screen
	if ($firsttime == FALSE){
	 echo "\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n"; 
	 }


	//get scanner input if over 10 seconds, refresh screen
    $input = fgets_u(STDIN,10);
   
   if (strpos($input,"IN") !== FALSE){
    $punchstatus = "In";
	$punchtime = time();
   }
   if (strpos($input,"OUT") !== FALSE){
    $punchstatus = "Out";
	$punchtime = time();
   }
   
   if (strpos($input,"BREAK") !== FALSE){
    $punchtype = "Break";
    $punchstatus = "Out";
	$punchtime = time();
   }
   if (strpos($input,"LUNCH") !== FALSE){
    $punchtype = "Lunch";
    $punchstatus = "Out";
	$punchtime = time();
   }
   
   if (strpos($input,"NORMAL") !== FALSE || strpos($input,"RESET") !== FALSE ||  strpos($input,"CLEAR") !== FALSE){
        $punchtype = "Normal";
	    $punchstatus = "Auto";
   }
    
   if (strpos($input,"REPORT") !== FALSE){
    $punchtype = "Report";
	$punchtime = time();
   }
      
   if (is_numeric($input)){
	$punchid = (int)$input;
   }   
   
   $firsttime = FALSE;
}
  
$user_obj = new TimeTrexClientAPI( 'User' );

if($user_obj  == false){

	 echo $colors->getColoredString("CONNECTION ERROR - user_obj\n", "white", "red");
	goto reconnect;
}

$result = $user_obj->getUser(array('filter_data' => array('employee_number' => $punchid)));
	
if($result == false){
     echo $colors->getColoredString("CONNECTION ERROR - getUser", "white", "red");
 	echo "\n";
	goto reconnect;
}
$user_data = $result->getResult();

if($user_data  == false){
     echo $colors->getColoredString("CONNECTION ERROR- getResult -> getUser", "white", "red");
 	echo "\n";
	goto reconnect;
}
if (is_bool($user_data) == TRUE) {
 	echo "\n\n";
	echo $colors->getColoredString("USER NOT FOUND IN DATABASE!", "white", "red");
 	echo "\n\n";
	
	$cmd = 'echo "Error: User ID not found! #';
	$cmd .= (string)$punchid;
	$cmd .=  '" | mail -S smtp=1.1.1.1 -s "TimeTrex Timeclock" name@site.com  > /dev/null 2>/dev/null &';
	exec($cmd);



	goto newscan;
}

echo "\nUser found.  Working...\n";

if ($punchtype != "Report"){

 
  
if($user_data[0]["status"]  != "Active"){
     echo $colors->getColoredString("INACTIVE USER", "white", "red");
 	echo "\n";
	
	$cmd = 'echo "Error: User ID inactive! ';
	$cmd .= "#{$user_data[0]['employee_number']}: {$user_data[0]['last_name']}, {$user_data[0]['first_name']}\n\n";
	$cmd .=  '" | mail -S smtp=1.1.1.1 -s "TimeTrex Timeclock" name@site.com  > /dev/null 2>/dev/null &';
	exec($cmd);
	goto reconnect;
}
  
  
//Switch to the User we scanned in
$auth_obj = new TimeTrexClientAPI( 'Authentication' );


if($auth_obj  == false){
	 echo $colors->getColoredString("CONNECTION ERROR - auth_obj", "white", "red");
 	echo "\n";
	goto reconnect;
}
$auth_obj->switchUser( $user_data[0]['id'] );


if($auth_obj  == false){
	 echo $colors->getColoredString("CONNECTION ERROR - switchUser", "white", "red");
 	echo "\n";
	goto reconnect;
}

$punch_obj = new TimeTrexClientAPI( 'Punch' );

if($punch_obj  == false){
	 echo $colors->getColoredString("CONNECTION ERROR - punch_obj", "white", "red");
 	echo "\n";
	goto reconnect;
}

$result = $punch_obj->getUserPunch();
if($result  == false){
	 echo $colors->getColoredString("CONNECTION ERROR - getUserPunch", "white", "red");
 	echo "\n";
	goto reconnect;
}


$punch_data = $result->getResult();

if($punch_data  == false){
     echo $colors->getColoredString("CONNECTION ERROR - getResult -> getUserPunch", "white", "red");
 	echo "\n";
	goto reconnect;
}


//override the automaticlly generated punch
if ($punchstatus == "In"){
 $punch_data['status_id']=10;
}
if ($punchstatus == "Out"){
$punch_data['status_id']=20;
}

if ($punchtype == "Break"){
 $punch_data['type_id']=30;
}
if ($punchtype == "Lunch"){
$punch_data['type_id']=20;
}



if ($punchtype != "Report"){

$result = $punch_obj->setUserPunch($punch_data);
if($result  == false){
     echo $colors->getColoredString("CONNECTION ERROR - setUserPunch", "white", "red");
 	echo "\n";
	goto reconnect;
}

$result = $result->getResult();

if ($result == false) {
    echo $colors->getColoredString("\nPLEASE WAIT AT LEAST ONE MINUTE BETWEEN PUNCHES!", "white", "red");
 	echo "\n";
	
	$cmd = 'echo "Error: Cannot generate punch - User likely double punched! ';
	$cmd .= "#{$user_data[0]['employee_number']}: {$user_data[0]['last_name']}, {$user_data[0]['first_name']}\n\n";
	$cmd .=  '" | mail -S smtp=1.1.1.1 -s "TimeTrex Timeclock" name@site.com  > /dev/null 2>/dev/null &';
	exec($cmd);
	
	goto reconnect;
}else {
echo "#{$user_data[0]['employee_number']} Punch Complete\n";
}

}

$api_session->Logout();
}

//Generate the punch report
//log back in as admin

$api_session->Login( $TIMETREX_USERNAME, $TIMETREX_PASSWORD );
if ( $TIMETREX_SESSION_ID == FALSE ) {
	 echo $colors->getColoredString("CONNECTION ERROR - REPORT LOGIN FAILED", "white", "red");
 	echo "\n";
	goto reconnect;
}

//get report
echo "____________________\n\n";
echo "Punch Summary Report\n";
echo "____________________\n\n";
$report_obj = new TimeTrexClientAPI( 'PunchSummaryReport' );
if($report_obj  == false){
     echo $colors->getColoredString("CONNECTION ERROR - report_obj", "white", "red");
 	echo "\n";
	goto reconnect;
}

$config = $report_obj->getTemplate('by_employee+punch_summary+total_time')->getResult();
if($config  == false){
     echo $colors->getColoredString("CONNECTION ERROR - getTemplate", "white", "red");
 	echo "\n";
	goto reconnect;
}

//adjust template
$config['-1010-time_period']['time_period'] = 'this_pay_period';
$config['employee_number'] = $user_data[0]['employee_number'];


//let the server generate the report
$result = $report_obj->getPunchSummaryReport($config , 'csv' );
if($result  == false){
     echo $colors->getColoredString("CONNECTION ERROR - getPunchSummaryReport", "white", "red");
 	echo "\n";
	goto reconnect;
}

$result = $result->getResult();
if($result  == false){
     echo $colors->getColoredString("CONNECTION ERROR - getResult -> getPunchSummaryReport", "white", "red");
 	echo "\n";
	goto reconnect;
}

//parse and display the CSV file

//decode report
$input = base64_decode($result['data']);
//split the line breaks
$input = str_replace("\"", "", $input);
$csvData = explode( "\n", $input); 
//split at the commas
foreach ($csvData as &$value) {
     $value = explode(',', $value); 
}

$total = 0;  // tally of total hours worked

//print table headers
echo "#{$user_data[0]['employee_number']}: {$user_data[0]['last_name']}, {$user_data[0]['first_name']}\n\n";

//echo each line of data
foreach ($csvData as &$value) {
if(isset($value[2]) && isset($value[3]) &&isset($value[4]) && isset($value[5]) && isset($value[6])) {
     echo str_pad ($value[2], 10);
	 echo str_pad ($value[3], 20);
	 echo str_pad ($value[4], 10);
	 echo str_pad ($value[5], 20);
     if (is_numeric($value[6]) ) {
	   $total = $total + (float)$value[6];
	   if ((float)$value[6] != 0 ){
	   printf( "% 6.3f", $value[6]); 
	 }else{
	 echo str_pad($value[6], 10);
	 }
	 echo "\n";
}	
}
//print total hours worked
echo str_pad (" ", 60);
echo $colors->getColoredString(sprintf( "% 6.3f",  $total), "white", "green");
//done

if ($punchtype != "Report"){

if ($LAST_PUNCH == $punchid and $LAST_PUNCH_TIME + 90 > time()){
 	$cmd = 'echo "Warning: Punches too close together - User likely double punched! ';
	$cmd .= "#{$user_data[0]['employee_number']}: {$user_data[0]['last_name']}, {$user_data[0]['first_name']}\n\n";
	$cmd .=  '" | mail -S smtp=1.1.1.1 -s "TimeTrex Timeclock" name@site.com  > /dev/null 2>/dev/null &';
	exec($cmd);
}

//done
$LAST_PUNCH = $punchid;
$LAST_PUNCH_TIME = time();

}


goto newscan;
  
			
function fgets_u($pStdn,$delay) {
        $pArr = array($pStdn);
        if (false === ($num_changed_streams = stream_select($pArr, $write = NULL, $except = NULL,$delay ))) {
            print("\$ 001 Socket Error : UNABLE TO WATCH STDIN.\n");
            return FALSE;
        } elseif ($num_changed_streams > 0) {
                return trim(fgets($pStdn, 1024));
        }
    }
?>

<?php
 
	class Colors {
		private $foreground_colors = array();
		private $background_colors = array();
 
		public function __construct() {
			// Set up shell colors
			$this->foreground_colors['black'] = '0;30';
			$this->foreground_colors['dark_gray'] = '1;30';
			$this->foreground_colors['blue'] = '0;34';
			$this->foreground_colors['light_blue'] = '1;34';
			$this->foreground_colors['green'] = '0;32';
			$this->foreground_colors['light_green'] = '1;32';
			$this->foreground_colors['cyan'] = '0;36';
			$this->foreground_colors['light_cyan'] = '1;36';
			$this->foreground_colors['red'] = '0;31';
			$this->foreground_colors['light_red'] = '1;31';
			$this->foreground_colors['purple'] = '0;35';
			$this->foreground_colors['light_purple'] = '1;35';
			$this->foreground_colors['brown'] = '0;33';
			$this->foreground_colors['yellow'] = '1;33';
			$this->foreground_colors['light_gray'] = '0;37';
			$this->foreground_colors['white'] = '1;37';
 
			$this->background_colors['black'] = '40';
			$this->background_colors['red'] = '41';
			$this->background_colors['green'] = '42';
			$this->background_colors['yellow'] = '43';
			$this->background_colors['blue'] = '44';
			$this->background_colors['magenta'] = '45';
			$this->background_colors['cyan'] = '46';
			$this->background_colors['light_gray'] = '47';
		}
 
		// Returns colored string
		public function getColoredString($string, $foreground_color = null, $background_color = null) {
			$colored_string = "";
 
			// Check if given foreground color found
			if (isset($this->foreground_colors[$foreground_color])) {
				$colored_string .= "\033[" . $this->foreground_colors[$foreground_color] . "m";
			}
			// Check if given background color found
			if (isset($this->background_colors[$background_color])) {
				$colored_string .= "\033[" . $this->background_colors[$background_color] . "m";
			}
 
			// Add string and end coloring
			$colored_string .=  $string . "\033[0m";
 
			return $colored_string;
		}
 
		// Returns all foreground color names
		public function getForegroundColors() {
			return array_keys($this->foreground_colors);
		}
 
		// Returns all background color names
		public function getBackgroundColors() {
			return array_keys($this->background_colors);
		}
	}
 
}

?>