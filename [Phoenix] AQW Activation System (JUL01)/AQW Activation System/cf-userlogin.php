<?php
include("config.php");
$user = mysql_real_escape_string(stripslashes($_POST["strUsername"]));
$pass = md5(mysql_real_escape_string(stripslashes($_POST["strPassword"])));
$error = 0;

if ($_SERVER['HTTP_X_FORWARD_FOR']) {
$ip = $_SERVER['HTTP_X_FORWARD_FOR'];
} else {
$ip = $_SERVER['REMOTE_ADDR'];
}

$getuservar = mysql_query("SELECT * FROM wqw_users WHERE username='$user' AND password='$pass' LIMIT 1")or die("Query failed with error: ".mysql_error());
$num = mysql_num_rows($getuservar);
$getuser = mysql_fetch_array($getuservar);

if ($num == 0) {
$error = 1;
echo "<login bSuccess='0' sMsg='The username and password you entered did not match. Please check the spelling and try again.'/>";
}

//Checks if User is Banned or Not Activated
	if ($getuser["banned"] != 0) {
	$error = 1;
	echo "<login bSuccess='0' sMsg='You are Banned.'/>";
	}

	if ($getuser["activateduser"] != 1) {
	$error = 1;
	echo "<login bSuccess='0' sMsg='You are not Activated.'/>";
	}

if ($error != 1) {
$setip = mysql_query("UPDATE wqw_users SET loginip='$ip' WHERE username='$user' AND password='$pass'");
echo "<login bSuccess='1'  iAccess='" . $getuser["access"] . "' iUpg='" . $getuser["upgrade"] . "' iAge='" . $getuser["age"] . "' sToken='" . $pass . "' dUpgExp='" . $getuser["upgrade"] . "' iUpgDays='" . $getuser["upgDays"] . "' iSendEmail='" . $getuser["emailActive"] . "' strEmail='" . $getuser["email"] . "' bCCOnly='0'>";
$getchar = mysql_query("SELECT * FROM wqw_servers LIMIT 10")or die("Query failed with error: ".mysql_error());
while ($char = mysql_fetch_array($getchar)) {
echo "<servers sName='" . $char["name"] . "' sIP='" . $char["ip"] . "' iCount='" . $char["count"] . "' iMax='" . $char["max"] . "' bOnline='" . $char["online"] . "' bChat='" . $char["bchat"] . "' iChat='" . $char["ichat"] . "' bUpg='" . $char["upgrade"] . "'/>";
}
echo "</login>";
}

?>