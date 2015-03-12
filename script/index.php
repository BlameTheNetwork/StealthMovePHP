<?PHP
/////////////////////////////////
//     BlameTheNetwork.com     //
//       PHP Stealth Move      //
/////////////////////////////////

// Defining Variables
$current = getcwd();

#To email multiple users, comment out the line below and uncomment the $adminemail array line.
$adminemail = "notification@emailaddress.com";
//$adminemail = "some@email.com,some@other.com,yet@another.net";

#Set mode below (1 = IP Whitelist, 2 = Block Search Engines, 3 = No Security/Open Page)
$mode = "1";

// Functions for call
function Random($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $Length = strlen($characters);
    $String = '';
    for ($i = 0; $i < $length; $i++) {
        $String .= $characters[rand(0, $Length - 1)];
    }
    return $String;
}

// Checking who's looking based on selected mode
if ($mode == "1")
{
	$ipaddress = $_SERVER["REMOTE_ADDR"];
	$ipwhitelist = array("1.2.3.4", "127.0.0.1");
	if (!in_array($ipaddress, $ipwhitelist)) { $move = true; } else { $move = false; }
} 
elseif($mode == "2") 
{
	$useragent = strstr(strtolower($_SERVER['HTTP_USER_AGENT']));
	$agentblacklist = array("googlebot", "Mozilla/5.0 (compatible; Yahoo! Slurp; http://help.yahoo.com/help/us/ysearch/slurp)", "YahooSeeker/1.2 (compatible; Mozilla 4.0; MSIE 5.5; yahooseeker at yahoo-inc dot com ; http://help.yahoo.com/help/us/shop/merchant/)", "Mozilla/5.0 (compatible; bingbot/2.0; +http://www.bing.com/bingbot.htm)", "Mozilla/5.0 (compatible; bingbot/2.0 +http://www.bing.com/bingbot.htm)");
	if (in_array($useragent, $agentblacklist)) { $move = true; } else { $move = false; }
} 
else 
{
	$move = false;
}

///////////////////////////


//For DEMO use, uncomment the following 2 lines and comment out the if($move == true) line.
// $testmove = $_GET['move'];
// if($testmove == "1") {
  if($move == true)
  {
	//Display fake Apache error
	echo '
	<?xml version="1.0" encoding="UTF-8"?>
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
	<head>
	<title>Object not found!</title>
	<link rev="made" href="mailto:postmaster@localhost" />
	<style type="text/css"><!--/*--><![CDATA[/*><!--*/ 
	    body { color: #000000; background-color: #FFFFFF; }
	    a:link { color: #0000CC; }
	    p, address {margin-left: 3em;}
	    span {font-size: smaller;}
	/*]]>*/--></style>
	</head>
	
	<body>
	<h1>Object not found!</h1>
	<p>
	
	
	    The requested URL was not found on this server.
	
	  
	
	    If you entered the URL manually please check your
	    spelling and try again.
	
	  
	
	</p>
	<p>
	If you think this is a server error, please contact
	the <a href="mailto:postmaster@localhost">webmaster</a>.
	
	</p>
	
	<h2>Error 404</h2>
	<address>
	  <a href="/">localhost</a><br />
	  <span>Apache/2.4.10 (Win32) OpenSSL/1.0.1i PHP/5.5.15</span>
	</address>
	</body>
	</html>
	';
$new = Random();
//Move the webpage
rename(realpath(dirname(__FILE__)),realpath(dirname(__FILE). '/..').'/'.$new) or die();
//Email Notification of new location
$subject = 'Stealth Move Activated';
$message = 'New Site Location: '.$new.'/index.php';
$headers = 'From: noreply@sitemoved.com' . "\r\n" .
    'Reply-To: noreply@sitemoved.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

mail($adminemail, $subject, $message, $headers);
} 
else 
{
	echo "Website Contents Here.";
}
?>

