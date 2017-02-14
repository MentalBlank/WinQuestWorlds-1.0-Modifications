<?php
include("config.php");

//CREATED BY MENTALBLANK
//http://cris-is.stylin-on.me/

//IMPORTANT STUFF
$username = mysql_real_escape_string(stripslashes($_POST["strUsername"]));
$password = mysql_real_escape_string(stripslashes($_POST["strPassword"]));
$pass = md5($password);
$age = mysql_real_escape_string(stripslashes($_POST["intAge"]));
$dob = mysql_real_escape_string(stripslashes($_POST["strDOB"]));
$email = mysql_real_escape_string(stripslashes($_POST["strEmail"]));
$gender = mysql_real_escape_string(stripslashes($_POST["strGender"]));
$classid = mysql_real_escape_string(stripslashes($_POST["ClassID"]));
$eyecolor = mysql_real_escape_string(stripslashes($_POST["intColorEye"]));
$skincolor = mysql_real_escape_string(stripslashes($_POST["intColorSkin"]));
$haircolor = mysql_real_escape_string(stripslashes($_POST["intColorHair"]));
$hairid = $_POST['HairID'];

//Grabs IP
if ($_SERVER['HTTP_X_FORWARD_FOR']) {
$ip = $_SERVER['HTTP_X_FORWARD_FOR'];
} else {
$ip = $_SERVER['REMOTE_ADDR'];
}

//Checks if IP already has an Account
$ipcheck = mysql_query("SELECT * FROM wqw_users WHERE signupip='$ip' AND banned=0");
if (mysql_num_rows($ipcheck) != 0) {
	die("status=Taken&strReason=Sorry, This IP has already created an account");
}

//Checks if IP is Banned
$bancheck = mysql_query("SELECT * FROM wqw_users WHERE signupip='$ip' AND banned=1");
if (mysql_num_rows($bancheck) != 0) {
	diedie("status=Taken&strReason=Sorry, This IP has been banned");
}

//Checks if Email has Already been used
$emailcheck = mysql_query("SELECT * FROM wqw_users WHERE email='$email' AND banned=0") or die("status=Error&strReason=" . mysql_error());
if (mysql_num_rows($emailcheck) != 0) {
	die("status=Taken&strReason=Sorry, This Email has already been used.");
}

//Checks If Username has been Taken
$sql = mysql_query("SELECT * FROM wqw_users WHERE username = '" . $user_name . "'") or die("status=Error&strReason=" . mysql_error());
if (mysql_num_rows($sql) > 0) {
	die("status=Taken&strReason=The username is already in use by another character.");
} else {

//Sets Hairname & hairfile
switch ($hairid) {
	//MALE HAIR
	case 52:
		$hairname = 'Default';
		$hairfile = 'hair/M/Default.swf';
		break;
	case 55:
		$hairname = 'Goku1';
		$hairfile = 'hair/M/Goku1.swf';
		break;
	case 58:
		$hairname = 'Goku2';
		$hairfile = 'hair/M/Goku2.swf';
		break;
	case 64:
		$hairname = 'Normal2';
		$hairfile = 'hair/M/Normal2.swf';
		break;
	case 92:
		$hairname = 'Ponytail8';
		$hairfile = 'hair/M/Ponytail8.swf';
		break;
	
	//FEMALE HAIR
	case 14:
		$hairname = 'Pig1Bangs1';
		$hairfile = 'hair/F/Pig1Bangs1.swf';
		break;
	case 18:
		$hairname = 'Pig2Bangs2';
		$hairfile = 'hair/F/Pig2Bangs2.swf';
		break;
	case 26:
		$hairname = 'Pony2Bangs2';
		$hairfile = 'hair/F/Pony2Bangs2.swf';
		break;
	case 83:
		$hairname = 'Bangs2Long';
		$hairfile = 'hair/F/Bangs2Long.swf';
		break;
	case 84:
		$hairname = 'Bangs3Long';
		$hairfile = 'hair/F/Bangs3Long.swf';
		break;
}

//Inserts Character Info into DB
$sql2 = mysql_query("INSERT INTO wqw_users (username, password, email, age, dob, gender, currentclass, hairName, hairFile, plaColorSkin, plaColorHair, plaColorEyes, signupip) VALUES ('$username', '$pass', '$email', '$age', '$dob', '$gender','$classid','$hairname','$hairfile', '$skincolor', '$haircolor', '$eyecolor', '$ip')") or die("status=Error&strReason=" . mysql_error());

//Selects New User ID
$sql3 = mysql_query("SELECT * FROM wqw_users WHERE username='$username'") or die("status=Error&strReason=" . mysql_error());
$user = mysql_fetch_assoc($sql3) or die("status=Error&strReason=" . mysql_error());
$userid = $user['id'];

//Add's Starting Armor
switch ($classid) {
	case 2: //Warrior
		$addarmour = mysql_query("INSERT INTO wqw_items (itemid, userid, equipped, sES, iLvl, classXP, className) VALUES ('16', '$userid', '1', 'ar', '1', '0', 'Warrior Class')") or die("status=Error&strReason=" . mysql_error());
		break;
	case 4: //Rogue
		$addarmour = mysql_query("INSERT INTO wqw_items (itemid, userid, equipped, sES, iLvl, classXP, className) VALUES ('96', '$userid', '1', 'ar', '1', '0', 'Rogue Class')") or die("status=Error&strReason=" . mysql_error());
		break;
	case 3: //Mage
		$addarmour = mysql_query("INSERT INTO wqw_items (itemid, userid, equipped, sES, iLvl, classXP, className) VALUES ('92', '$userid', '1', 'ar', '1', '0', 'Mage Class')") or die("status=Error&strReason=" . mysql_error());
		break;
	case 5: //Priest
		$addarmour = mysql_query("INSERT INTO wqw_items (itemid, userid, equipped, sES, iLvl, classXP, className) VALUES ('94', '$userid', '1', 'ar', '1', '0', 'Priest Class')") or die("status=Error&strReason=" . mysql_error());
		break;
}	

//Adds Default Weapon to User
$addweapon = mysql_query("INSERT INTO wqw_items (itemid, userid, equipped, sES, iLvl) VALUES ('1', '$userid', '1', 'Weapon', '1')") or die("status=Error&strReason=" . mysql_error()); 

//So The User Isn't Lonely
$addfriends = mysql_query("INSERT INTO wqw_friends (userid) VALUES ('$userid')") or die("status=Error&strReason=" . mysql_error());

//SUCCESS	
echo "status=Success";
}
?>