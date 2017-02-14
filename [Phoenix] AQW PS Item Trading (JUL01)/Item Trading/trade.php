<?php 

//CREATED BY MENTALBLANK
//http://cris-is.stylin-on.me/

# Connect to the database
include("config.php");

//This checks if the form has been submitted.
 if (isset($_POST['submit'])) { 

//IMPORTANT STUFFS 
$username = mysql_real_escape_string(stripslashes($_POST["strUsername"]));
$password = mysql_real_escape_string(stripslashes($_POST["strPassword"]));
$pass = md5($password);
$username2 = mysql_real_escape_string(stripslashes($_POST["strUsername2"]));
$itemname = mysql_real_escape_string(stripslashes($_POST["strItem"]));

//Checks if Text Fields Only Contain Specified Characters.
//Helps to Prevent SQL Injection...etc.
if (!preg_match('/^[a-z0-9]+$/i', $username)) {
	die('Username must contain Letters and/or Numbers');
}

if (!preg_match('/^[a-z0-9]+$/i', $password)) {
	die('Password must contain Letters and/or Numbers');
}

if (!preg_match('/^[a-z0-9]+$/i', $username2)) {
	die('Username 2 must contain Letters and/or Numbers');
}

if (!preg_match('/^[a-z0-9]+$/i', $itemname)) {
	die('Item Name must contain Letters and/or Numbers');
}
 
//EVEN MORE IMPORTANT STUFF
$objRS1_query = mysql_query("SELECT * FROM wqw_users WHERE username = '$username' LIMIT 1");
$objRS1 = mysql_fetch_assoc($objRS1_query);
$u1num = mysql_num_rows($objRS1_query);
$objRS2_query = mysql_query("SELECT * FROM wqw_users WHERE username = '".$username2."' LIMIT 1");
$objRS2 = mysql_fetch_assoc($objRS2_query);
$u2num = mysql_num_rows($objRS2_query);

//Returns Error If User 1 Could not Be Found
	if ($u1num == 0) {
		die('Error, Your Username Could not be Found.');
	}
	
//Returns Error If User 2 Could not Be Found
	if ($u2num == 0) {
		die('Error, Friends Username could not be found.');
	}

//Returns Error If Given Password Does not Match Pass in the Database
	if ($pass != $objRS1['password']) {
	  die('Error, Your password is Incorrect.');
	}

//GRABS ITEM INFO
$grab_id = mysql_query("SELECT * FROM wqw_equipment WHERE sName = '$itemname'") or die('Error, Please Contact Site Owner.');
$item_id = mysql_fetch_assoc($grab_id);
$userid = $objRS1['id'];
$itemid = $item_id['itemID'];
$trading_item = mysql_query("SELECT * FROM wqw_items WHERE userid = '$userid' AND itemid = '".$itemid."' LIMIT 1") or die('Error Loading Item, Please Try Again.');
$tradei = mysql_fetch_assoc($trading_item);
$grabnum = mysql_num_rows($grab_id);
$tr_item_num = mysql_num_rows($trading_item);

//Returns Error If Item Could not Be Found
	if ($grabnum == 0) {
		die('Error, Grabbing item info, The item may not exist in your inventory.');
	}

//Returns Error If Item Could not Be Found
	if ($tr_item_num == 0) {
		die('Error, Grabbing item info, The item may not exist in your inventory.');
	}

//Inserts Data into the DB
$addweapon = mysql_query("INSERT INTO wqw_items (itemid, userid, equipped, sES, iLvl) VALUES ('".$itemid."', '".$objRS2['id']."', '0', '".$tradei['sES']."', '".$tradei['iLvl']."')") or die('Error, Please Contact Site Owner.');
$deleteweapon = mysql_query("DELETE FROM wqw_items WHERE itemid = '$itemid' AND userid = '$userid'") or die('Error, Please Contact Site Owner.');
?>

 <h1>Success</h1>
 <p>Hooray, You have successfully given '<?php echo$itemname; ?>' to '<?php echo$username2; ?>'</p>
 <?php 
 } 
 else 
 {	
 ?>

<center>
 <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
 <table border="0">
 <h1>~Evo Worlds~</h1>
 <p>Trade Item</p>
 <tr><td>Your Username:</td><td>
 <input type="text" name="strUsername">
 </td></tr>
 <tr><td>Their Username:</td><td>
 <input type="text" name="strUsername2">
 </td></tr>
 <tr><td>Your Password:</td><td>
 <input type="password" name="strPassword">
 </td></tr>
 <tr><td>Item Name:</td><td>
 <input type="text" name="strItem">
 </td></tr>
 <tr><th colspan=2><input type="submit" name="submit" value="Trade"></th></tr> </table>
 </form>
~MentalBlank
</center>
<br>
<br>
<center>
<a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/3.0/"><img alt="Creative Commons License" style="border-width:0" src="http://i.creativecommons.org/l/by-nc-sa/3.0/88x31.png" /></a><br />This work is licensed under a <a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/3.0/">Creative Commons Attribution-NonCommercial-ShareAlike 3.0 Unported License</a>.
</center>
 <?php
 }
 ?> 