<?php 
ob_start();
session_start();

//AQW PRIVATE SERVER SIGNUP (PHP Version)
//Created by Phoenix(aka MentalBlank) with the assistance of Mutants.
//http://cris-is.stylin-on.me/

# Connect to the database
include("config.php");

//IMPORTANT STUFFS
$dob = $_POST['dateOfBirth']."/".$_POST['monthOfBirth']."/".$_POST['yearOfBirth'];
$dobcalc = $_POST['yearOfBirth'].$_POST['monthOfBirth'].$_POST['dateOfBirth']; 
$age = mysql_real_escape_string(stripslashes(intval((date("Ymd",mktime()) - $dobcalc)/10000)));
$gender = mysql_real_escape_string(stripslashes($_POST["strGender"]));
$hair = mysql_real_escape_string(stripslashes($_POST["Hair"]));
$hairexplode = explode('|', $hair);
$hairswf = $hairexplode[0];
$hairid = $hairexplode[1];
$hairid = explode('|', $hairid);
$hairid = $hairid[0];
$hairname = $hairexplode[2];
$hairname = explode('|', $hairname);
$hairname = $hairname[0];
$classid = mysql_real_escape_string(stripslashes($_POST["ClassID"]));
$username = mysql_real_escape_string(stripslashes($_POST["strUsername"]));
$password = mysql_real_escape_string(stripslashes($_POST["strPassword"]));
$pass = md5($password);
$email = $_POST["strEmail"];
$skincol = mysql_real_escape_string(stripslashes(hexdec($_POST["skincol"])));
$haircol = mysql_real_escape_string(stripslashes(hexdec($_POST["haircol"])));
$eyecol = mysql_real_escape_string(stripslashes(hexdec($_POST["eyecol"])));
$SecCode = $_POST['strSecCode'];

//Grabs IP
if ($_SERVER['HTTP_X_FORWARD_FOR']) {
	$ip = $_SERVER['HTTP_X_FORWARD_FOR'];
} else {
	$ip = $_SERVER['REMOTE_ADDR'];
}

//This checks if the form has been submitted.
if (isset($_POST['submit'])) { 

//Checks if IP already has an Account
$ipcheck = mysql_query("SELECT * FROM wqw_users WHERE signupip='$ip' AND banned=0");
if (mysql_num_rows($ipcheck) != 0) {
	die("Sorry, This IP has already created an account");
}

//Checks if IP is Banned
$bancheck = mysql_query("SELECT * FROM wqw_users WHERE signupip='$ip' AND banned=1");
if (mysql_num_rows($bancheck) != 0) {
	diedie("Sorry, This IP has been banned");
}

//Checks if Username, etc. Only Contains Specified Characters
//Helps to Prevent SQL Injection...etc.
if (!preg_match('/^[a-z0-9\s_-]+$/i', $username) || ($username == "")) {
	die('Error, Username must contain Letters and/or Numbers');
}

if (!preg_match('/^[a-z0-9]+$/i', $password) || ($password == "")) {
	die('Error, Password must contain Letters and/or Numbers');
}

if (!preg_match('/^[a-z]+$/i',$gender) || ($gender != "M" && $gender != "F")) {
	die('Error, Gender Must Be an "M" or "F"');
}

if(!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email) || ($email == "")) {
	die('Error, Email Must Contain Letters and/or Numbers');
}

//Word Filter - Pretty Nifty Eh?
if ($username == "cris" || $username == "xvii" || $username == "divien") {
	Die('The username you entered is forbidden, Please try again.');
}

//This Checks if the 2 passwords given match
if ($_POST['strPassword'] != $_POST['strPassword2']) {
	die('Error, Passwords Do not Match. Please Try Again.');
}

//Checks that the user has chosen D.O.B
if (($_POST['dateOfBirth'] == "Date") || ($_POST['monthOfBirth'] == "Month") || ($_POST['yearOfBirth'] == "Year")){
	die('Error, Please Select D.O.B');
}

//This Checks if the 2 passwords given match
if ($SecCode != $_SESSION["securecode"]) {
	die('Error, Security Code is Incorrect.');
}

//This checks if the username is in use
$check = mysql_query("SELECT username FROM wqw_users WHERE username = '$username'") or die(mysql_error());
if (mysql_num_rows($check) != 0) {
	die('Sorry, the username '.$_POST['strUsername'].' is already in use.');
}

//Checks if Email has Already been used
$emailcheck = mysql_query("SELECT * FROM wqw_users WHERE email='$email' AND banned=0") or die("status=Error&strReason=" . mysql_error());
if (mysql_num_rows($emailcheck) != 0) {
	die("Sorry, This Email has already been used.");
}

//This Inserts the User's Data into the database and adds Default Items
	$createuser = mysql_query("INSERT INTO wqw_users (username, password, email, age, dob, signupip, gender, currentclass, hairID, hairName, hairFile, plaColorSkin, plaColorHair, plaColorEyes) VALUES ('$username', '$pass', '$email', '$age', '$dob', '$ip','$gender','$classid','$hairid','$hairname','$hairswf','$skincol','$haircol','$eyecol')"); 
	$usersql = mysql_query("SELECT id FROM wqw_users WHERE username='$username'") or die ("Query failed with error: ".mysql_error());

//Selects New User ID
 	$sql3 = mysql_query("SELECT * FROM wqw_users WHERE username='$username'") or die("status=Error&strReason=" . mysql_error());
 	$user = mysql_fetch_assoc($sql3) or die("status=Error&strReason=" . mysql_error());
 	$userid = $user['id'];

//Adds Starting Armor
switch ($classid) {
	case 2: //Warrior Class
		$addarmour = mysql_query("INSERT INTO wqw_items (itemid, userid, equipped, sES, iLvl, classXP, className) VALUES ('16', '$userid', '1', 'ar', '1', '0', 'Warrior Class')") or die("status=Error&strReason=" . mysql_error());
		break;
	case 3: //Mage Class
		$addarmour = mysql_query("INSERT INTO wqw_items (itemid, userid, equipped, sES, iLvl, classXP, className) VALUES ('94', '$userid', '1', 'ar', '1', '0', 'Mage Class')") or die("status=Error&strReason=" . mysql_error());
		break;
	case 4: //Rogue Class
		$addarmour = mysql_query("INSERT INTO wqw_items (itemid, userid, equipped, sES, iLvl, classXP, className) VALUES ('97', '$userid', '1', 'ar', '1', '0', 'Rogue Class')") or die("status=Error&strReason=" . mysql_error());
		break;
	case 5: //Priest Class
		$addarmour = mysql_query("INSERT INTO wqw_items (itemid, userid, equipped, sES, iLvl, classXP, className) VALUES ('95', '$userid', '1', 'ar', '1', '0', 'Priest Class')") or die("status=Error&strReason=" . mysql_error());
		break;
}	

//Adds the Default weapon to the users inventory
$addweapon = mysql_query("INSERT INTO wqw_items (itemid, userid, equipped, sES, iLvl) VALUES ('1', '$userid', '1', 'Weapon', '1')"); 

//So your not a Loner
$addfriends = mysql_query("INSERT INTO wqw_friends (userid) VALUES ('$userid')"); 
?>

<h1>Success</h1>
<p>Thank you, Registration is Complete - you may now login to the Server.</p>
 
<?php 
} else {	
?>
<html>
<head>
</head>
<body onload="makecode()">
 <script src="http://jscolor.com/jscolor/jscolor.js"></script>
<script>makecode();</script>
 <form action="<?php echo $_SERVER['PATH_INFO']; ?>" method="post">
 <table border="0">
 <h1>AQW Private Server Signup</h1>
 <p>Registration Page Created by Phoenix with the assistance of Mutants.</p>
 <tr><td>Username:</td><td>
 <input onChange="javascript:makecode()" type="text" name="strUsername">
 </td></tr>
 <tr><td>Password:</td><td>
 <input type="password" name="strPassword">
 </td></tr>
 <tr><td>Confirm Password:</td><td>
 <input type="password" name="strPassword2">
 </td></tr>
 <tr><td>Class:</td><td>
 <select onChange="javascript:makecode()" NAME="ClassID">
 	<Option value="2">Warrior</option>
 	<Option value="3">Mage</option>
 	<Option value="4">Rouge</option>
 	<Option value="5">Priest</option>
 </select>
 </td></tr>
 <tr><td>D.O.B:</td><td>
 <select name="dateOfBirth">
	 <option>Date</option>
	 <?php for ($i = 1; $i <= 31; $i++) : ?>
	 <option value="<?php echo ($i < 10) ? '0'.$i : $i; ?>"><?php echo $i; ?></option>
	 <?php endfor; ?>
 </select>
 <select name="monthOfBirth">
	 <Option>Month</option>
	 <?php for ($i = 1; $i <= 12; $i++) : ?>
	 <option value="<?php echo ($i < 10) ? '0'.$i : $i; ?>"><?php echo $i; ?></option>
	 <?php endfor; ?>
 </select>
 <select name="yearOfBirth">
 	 <Option>Year</option>
	 <?php for ($i = 1980; $i < date('Y'); $i++) : ?>
	 <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
	 <?php endfor; ?>
 </select>
 </td></tr>
 <tr><td>Gender:</td><td>
 <select onChange="javascript:makecode()" type="text" name="strGender">
<Option value="M">Male</option>
<Option value="F">Female</option>
 </td></tr>
 <tr><td>Hair:</td><td>
 <select onChange="javascript:makecode()" NAME="Hair">
 	 <Option value="hair/M/bald.swf|4|Bald|M|">Bald</option>
 	 <Option value="hair/M/BaldBeard.swf|38|BaldBeard|M">Bald Beard</option>
 	 <Option value="hair/M/BaldStache.swf|39|BaldStache|M">Bald Stache</option>
 	 <Option value="hair/M/Bangs22.swf|40|Bangs22|M">Bangs</option>
 	 <Option value="hair/M/Bangs22Beard.swf|41|Bangs22Beard|M">Bangs Beard</option>
 	 <Option value="hair/M/Bangs22Stache.swf|42|Bangs22Stache|M">Bangs Stache</option>
 	 <Option value="hair/M/Bob.swf|43|Bob|M">Bob</option>
 	 <Option value="hair/M/BobBeard.swf|44|BobBeard|M">Bob Beard</option>
 	 <Option value="hair/M/BobStache.swf|45|BobStache|M">Bob Stache</option>
 	 <Option value="hair/m/Braid1.swf|46|Braid1|M">Braid</option>
 	 <Option value="hair/M/Braid1Beard.swf|47|Braid1Beard|M">Braid Beard</option>
 	 <Option value="hair/M/Braid1Stache.swf|48|Braid1Stache|M">Bread Stache</option>
 	 <Option value="hair/M/Curl.swf|49|Curl|M">Curl</option>
 	 <Option value="hair/M/CurlBeard.swf|50|CurlBeard|M">Curl Beard</option>
 	 <Option value="hair/M/CurlStache.swf|51|CurlStache|M">Curl Stache</option>
 	 <Option value="hair/M/Default.swf|52|Default|M">Default</option>
 	 <Option value="hair/M/DefaultBeard.swf|53|DefaultBeard|M">Default Beard</option>
 	 <Option value="hair/M/DefaultStache.swf|54|DefaultStache|M">Default Stache</option>
 	 <Option value="hair/M/Goku1.swf|55|Goku1|M">Goku</option>
 	 <Option value="hair/M/Goku1Beard.swf|56|Goku1Beard|M">Goku Beard</option>
 	 <Option value="hair/M/Goku1Stache.swf|57|Goku1Stache|M">Goku Stache</option>
 	 <Option value="hair/M/Goku2.swf|58|Goku2|M">Goku 2</option>
 	 <Option value="hair/M/Goku2Beard.swf|59|Goku2Beard|M">Goku Beard2</option>
 	 <Option value="hair/M/Goku2Stache.swf|60|Goku2Stache|M">Goku Stache 2</option>
 	 <Option value="hair/M/Normal.swf|61|Normal|M">Normal</option>
 	 <Option value="hair/M/NormalBeard.swf|62|NormalBeard|M">Normal Beard</option>
 	 <Option value="hair/M/NormalStache.swf|63|NormalStache|M">Normal Stache</option>
 	 <Option value="hair/M/Normal2.swf|64|Normal2|M">Normal 2</option>
 	 <Option value="hair/M/Normal2Beard.swf|65|Normal2Beard|M">Normal Beard 2</option>
 	 <Option value="hair/M/Normal2Stache.swf|66|Normal2Stache|M">Normal Stache 2</option>
 	 <Option value="hair/M/Pompadour.swf|67|Pompadour|M">Pompadour</option>
 	 <Option value="hair/M/PompadourBeard.swf|68|PompadourBeard|M">Pompadour Beard</option>
 	 <Option value="hair/M/PompadourStache.swf|69|PompadourStache|M">Pompadour Steache</option>
 	 <Option value="hair/M/Spikedown.swf|70|Spikedown|M">Spikedown</option>
 	 <Option value="hair/M/SpikedownBeard.swf|71|SpikedownBeard|M">Spikedown Beard</option>
 	 <Option value="hair/M/SpikedownStache.swf|72|SpikedownStache|M">Spikedown Stache</option>
 	 <Option value="hair/M/Tonsure.swf|73|Tonsure|M">Tonsure</option>
 	 <Option value="hair/M/TonsureBeard.swf|74|TonsureBeard|M">Tonsure Beard</option>
 	 <Option value="hair/M/TonsureStache.swf|75|TonsureStache|M">Tonsure Stache</option>
 	 <Option value="hair/M/Wavy.swf|76|Wavy|M">Wavy</option>
 	 <Option value="hair/M/WavyBeard.swf|77|WavyBeard|M">Wavy Beard</option>
 	 <Option value="hair/M/WavyStache.swf|78|WavyStache|M">Wavy Stache</option>
 	 <Option value="hair/M/Zhoom.swf|79|Zhoom|M">Zhoom</option>
 	 <Option value="hair/M/ZhoomBeard.swf|80|ZhoomBeard|M">Zhoom Beard</option>
 	 <Option value="hair/M/ZhoomStache.swf|81|ZhoomStache|M">Zhoom Stache</option>
 	 <Option value="hair/M/Ponytail8.swf|92|Ponytail8|M">Ponytail</option>
 	 <Option value="hair/M/Ponytail7.swf|93|Ponytail7|M">Ponytail 2</option>
 	 <Option value="hair/M/Ponytail6.swf|94|Ponytail6|M">Ponytail 3</option>
 	 <Option value="hair/M/Ponytail5.swf|95|Ponytail5|M">Ponytail 4</option>
 	 <Option value="hair/M/Ponytail4.swf|96|Ponytail4|M">Ponytail 5</option>
 	 <Option value="hair/M/Ponytail3.swf|106|Ponytail3|M">Ponytail 6</option>
 	 <Option value="hair/M/Ponytail.swf|109|Ponytail|M">Ponytail 7</option>
 	 <Option value="hair/M/Ponytail9.swf|201|Ponytail9|M">Ponytail 8</option>
 	 <Option value="hair/M/Slickback1.swf|101|Slickback1|M">Slickback</option>
 	 <Option value="hair/M/Slickback2.swf|110|Slickback2|M">Slickback 2</option>
 	 <Option value="hair/M/Mohawk1.swf|102|Mohawk1|M">Mohawk</option>
 	 <Option value="hair/M/Mohawk2.swf|103|Mohawk2|M">Mohawk 2</option>
 	 <Option value="hair/M/Mohawk3.swf|104|Mohawk3|M">Mohawk 3</option>
 	 <Option value="hair/M/Mohawk4.swf|139|Mohawk4|M">Mohawk 4</option>
 	 <Option value="hair/M/Conan1.swf|105|Conan1|M">Conan</option>
 	 <Option value="hair/M/Conan2.swf|107|Conan2|M">Conan 2</option>
 	 <Option value="hair/M/Conan3.swf|108|Conan3|M">Conan 3</option>
 	 <Option value="hair/M/Feathered1.swf|111|Feathered1|M">Feathered</option>
 	 <Option value="hair/M/Feathered2.swf|112|Feathered2|M">Feathered 2</option>
 	 <Option value="hair/M/Halo1.swf|114|Halo1|M">Halo</option>
 	 <Option value="hair/M/Fro1.swf|128|Fro1|M">Fro</option>
 	 <Option value="hair/M/Fro2.swf|131|Fro2|M">Fro 2</option>
 	 <Option value="hair/M/Glowingeyes1.swf|192|Glowingeyes1|M">Glowing Eyes</option>
 	 <Option value="hair/M/Glowingeyes2.swf|194|Glowingeyes2|M">Glowing Eyes 2</option>
 	 <Option value="hair/M/Miltonius.swf|195|Miltonius|M">Miltonius</option>
 	 <Option value="hair/M/Beard1.swf|221|Beard1|M">Beard</option>
 	 <Option value="hair/M/Beard2.swf|222|Beard2|M">Beard 2</option>
 	 <Option value="hair/M/Beard3.swf|223|Beard3|M">Beard 3</option>
 	 <Option value="hair/M/Widowspeak1.swf|233|Widowspeak1|M">Widow's Peak</option>
 	 <Option value="hair/M/Wildbeard1.swf|237|Wildbeard1|M">Wild Beard</option>
 	 <Option value="hair/M/Wildbeard2.swf|238|Wildbeard2|M">Wild Beard 2</option>
 	 <Option value="hair/M/Long1.swf|240|Long1|M">Long</option>
 	 <Option value="hair/M/Braided1.swf|244|Braided1|M">Braided</option>
 	 <Option value="hair/M/Rennhair1.swf|245|Rennhair1|M">Renn Hair</option>
 	 <Option value="hair/M/Ziohair1.swf|247|Ziohair1|M">Zio Hair</option>
 	 <Option value="hair/M/Beatlehair1.swf|255|Beatlehair1|M">Beetle Hair</option>
 	 <Option value="hair/M/MythsongJett2.swf|256|MythsongJett2|M">Mythsong Jett</option>
 	 <Option value="hair/M/MythsongJett.swf|259|MythsongJett|M">Mythsong Jett 2</option>
 	 <Option value="hair/M/EmoHair1.swf|258|EmoHair1|M">Emo Hair</option>
 	 <Option value="hair/M/AxleRose.swf|263|AxleHair1|M">Axle Hair</option>
 	 <Option value="hair/M/AxleRose2.swf|265|AxleHair2|M">Axle Hair</option>
 	 <Option value="hair/M/Flow.swf|268|Flow|M">Flow</option>
 	 <Option value="hair/M/DageScene.swf|270|DageScene|M">Scene</option>
 	 <Option value="hair/M/Rapper1.swf|271|Rapper1|M">Rapper</option>
 	 <Option value="hair/M/Rapper2.swf|272|Rapper2|M">Rapper 2</option>
 	 <Option value="hair/M/Flock.swf|273|Flock|M">Flock</option>
 	 <Option value="hair/M/FauxHawk.swf|275|FauxHawk|M">Faux Hawk</option>
 	 <Option value="hair/M/Dragonhawk.swf|278|Dragonhawk|M">Dragon Hawk</option>
 </select>
 </td></tr>
 <tr><td>Skin Color:</td><td>
<input onChange="javascript:makecode()" name="skincol" class="color">
 </td></tr>
 <tr><td>Hair Color:</td><td>
<input onChange="javascript:makecode()" name="haircol" class="color">
 </td></tr>
 <tr><td>Eye Color:</td><td>
<input onChange="javascript:makecode()" name="eyecol" class="color">
 </td></tr>
 <tr><td>Email:</td><td>
 <input type="text" name="strEmail" value="awesome@hotmail.com">
 </td></tr>
 <tr><td>Security Image:</td><td>
 <img id="imgCaptcha" src="captcha.php" />
 </td></tr>
 <tr><td>Security Code:</td><td>
 <input type="text" size="20%" maxlength="5" name="strSecCode">
 </td></tr>
 <tr><th colspan=2><input type="submit" name="submit" value="Register"></th></tr></table>
 </form>

<mutant></mutant>

 <script>
function makecode()
{
var sword=""
if (document.getElementsByTagName('select')[0].value == "2"){
var armor="warrior_skin.swf"
var armorlink="Warrior"
}
if (document.getElementsByTagName('select')[0].value == "3"){
var armor="mage_skin.swf"
var armorlink="Mage"
}
if (document.getElementsByTagName('select')[0].value == "4"){
var armor="rogue_skin.swf"
var armorlink="Rogue"
}
if (document.getElementsByTagName('select')[0].value == "5"){
var armor="priest_skin.swf"
var armorlink="Priest"
}

var haircolor=parseInt(document.getElementsByTagName('input')[5].value,16)
var eyecolor=parseInt(document.getElementsByTagName('input')[6].value, 16)
var skincolor=parseInt(document.getElementsByTagName('input')[4].value, 16)
var name=document.getElementsByTagName('input')[0].value
var lvl="OVER 9000!"
var class="Mutant Class"
var gender=document.getElementsByTagName('select')[4].value
var trim="none"
var base="none"
var accessory="none"


var hair=document.getElementsByTagName('select')[5].value.split("|")[0]
var hairlink=document.getElementsByTagName('select')[5].value.split("|")[2].split("|")[0]
var helm="none"
var helmlink="none"
var cape="none"
var capelink="none"
var code='<embed src="http://game.aqworlds.com/flash/character.swf" width="450" height="285" quality="high" pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" flashvars="intColorHair=' + haircolor + '&intColorSkin=' + skincolor + '&intColorEye=' + eyecolor + '&intColorTrim=' + trim + '&intColorBase=' + base + '&intColorAccessory=' + accessory + '&strGender=' + gender + '&strHairFile=' + hair + '&strHairName=' + hairlink + '&strName=' + name + '&intLevel=' + lvl + '&strClassName=' + class + '&strClassFile=' + armor + '&strClassLink=' + armorlink + '&strWeaponFile=' + sword + '&strCapeFile=' + cape + '&strCapeLink=' + capelink + '&strHelmFile=' + helm + '&strHelmLink=' + helmlink +'&strPetFile=none&strPetLink=none"></embed> </object>';
void(document.getElementsByTagName('mutant')[0].innerHTML=code);
};


</script>
</body>
<br>
<br>
<center>
<a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/3.0/"><img alt="Creative Commons License" style="border-width:0" src="http://i.creativecommons.org/l/by-nc-sa/3.0/88x31.png" /></a><br />This work is licensed under a <a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/3.0/">Creative Commons Attribution-NonCommercial-ShareAlike 3.0 Unported License</a>.
</center>
</html>
<?php
}
?> 