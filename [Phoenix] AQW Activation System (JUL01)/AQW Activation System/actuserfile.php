<?php 

# Connect to the database
include("config.php");

$username = mysql_real_escape_string(stripslashes($_POST["strUsername"]));
$password = mysql_real_escape_string(stripslashes($_POST["strPassword"]));
$pass = md5($password);
$access = mysql_real_escape_string(stripslashes($_POST["strAccess"]));

 //This checks if the data has been submitted
 if (isset($_POST['submit'])) { 

 //checks if password is correct.
 $getadminvar = mysql_query("SELECT * FROM wqw_users WHERE id = 1")or die("Query failed with error: ".mysql_error());
 $getadmin = mysql_fetch_array($getadminvar);

 if ($getadmin["password"] != $pass) {
 	die("Sorry, The Admin Password is incorrect.");
 }

 $usercheck = $_POST['strUsername'];
 $check = mysql_query("SELECT username FROM wqw_users WHERE username = '$usercheck'") or die(mysql_error());
 $check2 = mysql_num_rows($check);

 //this checks if the name exists and returns an error.
 if ($check2 = 0) {
 		die('Sorry, the username '.$_POST['strUsername'].' cannot be found.');
 		}

 //This Inserts the Data into the database
	$createuser = mysql_query("UPDATE wqw_users SET activateduser = '$access' WHERE username = '$username'");


?>
 
 <h1>Success</h1>
 <p>Thank you, The User was successfully modified</a>.</p>
 <?php 
 } 
 else 
 {	
 ?>

 
 <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
 <table border="0">
 <h1>User Access</h1>
 <p>Made by MentalBlank</a>.</p>
 <tr><td>Username:</td><td>
 <input type="text" name="strUsername" maxlength="60">
 </td></tr>
 <tr><td>Password:</td><td>
 <input type="password" name="strPassword" maxlength="50">
 </td></tr>
 <tr><td>Access Level:</td><td>
 <input type="text" name="strAccess" maxlength="1">
 </td></tr>
 <tr><th colspan=2><input type="submit" name="submit" value="Modify"></th></tr> </table>
 </form>
<br>
<br>
<center>
<a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/3.0/"><img alt="Creative Commons License" style="border-width:0" src="http://i.creativecommons.org/l/by-nc-sa/3.0/88x31.png" /></a><br />This work is licensed under a <a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/3.0/">Creative Commons Attribution-NonCommercial-ShareAlike 3.0 Unported License</a>.
</center>
 <?php
 }
 ?> 