<?php 
include "config.php";
//CREATED BY MENTALBLANK
//http://cris-is.stylin-on.me/
?>

<HTML>
<HEAD>
<TITLE>MentalAQW - Server Item List</TITLE>
<style type="text/css">
<!--

body {
	font: .8em "Trebuchet MS", Verdana, Arial, Sans-Serif;
	text-align: center;
	color: #404040;
	background-color: #000;
	margin-top: 5em;

}
form {
	width: 28em;
	background-color: #660000;
	border: 1px solid #333;
	margin-left: auto;
	margin-right: auto;
	padding: 1em;
	color: #000;
	-webkit-border-radius: 20px;
	-moz-border-radius: 20px;
	border-radius: 20px;

}

a {
	color: #09c;
	text-decoration: none;
	font-weight: bold;
}

a:visited {
	color: #07a;
}

a:hover {
	color: #c30;
}


-->
</style>
</HEAD>
<center>

<?php 

//This checks if the form has been submitted.
if (isset($_POST['maps'])) { 
$query  = mysql_query("SELECT * FROM wqw_maps WHERE name != 'limbo' ORDER BY name");
$count = mysql_num_rows($query);
?>

<center><a href='maps.asp'><h1>Back</h1></a></center><br><form>
<table width="548" border="0" cellspacing="0" cellpadding="0" align="center">
<tr> 
    <td align="left" valign="top" height="173"> 
      <p>
        <font size="3"><a><b>Maps List</b></a></font>
      </p>
      <p>There is <?php echo $count; ?> Map(s) in the database.</p>
        
      <table width="548" border="1" cellspacing="0" cellpadding="5" bordercolor="#000000">
        <tr bgcolor="#4E3972" bordercolor="#000000">
          <td class='top100Heading'>#</td>
          <td class='top100Heading'>Name</td>
          <td class='top100Heading'>Monsters</td>
        </tr>

<?php
$i = 0;
while($chr = mysql_fetch_array($query)){
$i = $i + 1;
?>

<tr bgcolor="#0000" bordercolor="#000000">
<td class='top100'><p><?php echo $i; ?></p></td>
<td class='top100Name'><p><?php echo $chr["name"]; ?></p></td>
<td class='top100Name'><p><?php 
if ($chr['monsterid']!="") {
	echo "<font style=\"color: gold; font-weight: bold;\">True</font>";
} else {
	echo "False"; 
}
?></p></td>
</tr>

<?php
}
?>
</table><form>
<?php
} 
	
else if (isset($_POST['weapons'])) { 
$query  = mysql_query("SELECT * FROM wqw_equipment WHERE sES = 'Weapon' AND bStaff = '0' AND sType != 'Enhancement' ORDER BY sName");
$count = mysql_num_rows($query);
?>

<center><a href='maps.asp'><h1>Back</h1></a></center><br><form>

<table width="548" border="0" cellspacing="0" cellpadding="0" align="center">
<tr> 
    <td align="left" valign="top" height="173"> 
      <p>
        <font size="3"><a><b>Weapons List</b></a></font>
      </p>
      <p>There is <?php echo $count; ?> Weapon(s) in the database.</p>
        
      <table width="548" border="1" cellspacing="0" cellpadding="5" bordercolor="#000000">
        <tr bgcolor="#4E3972" bordercolor="#000000">
          <td class='top100Heading'>#</td>
          <td class='top100Heading'>Name</td>
          <td class='top100Heading'>Type</td>
          <td class='top100Heading'>Cost</td>
          <td class='top100Heading'>Level</td>
          <td class='top100Heading'>VIP</td>
        </tr>

<?php
$i = 0;
while($chr = mysql_fetch_array($query)){
$i = $i + 1;
?>

<tr bgcolor="#0000" bordercolor="#000000">
<td class='top100'><p><?php echo $i; ?></p></td>
<td class='top100Name'><p><?php echo $chr["sName"]; ?></p></td>
<td class='top100'><p><?php echo $chr["sType"]; ?></p></td>
<td class='top100'><p><?php echo $chr["iCost"]; ?></p></td>
<td class='top100'><p><?php echo $chr["iLvl"]; ?></p></td>
<td class='top100'><p><?php 
if ($chr["bUpg"] != 0) {
	echo "<font style=\"color: gold; font-weight: bold;\">True</font>";
} else {
	echo "False"; 
}
?></p></td>
</tr>

<?php
}
?>
</table><form>
<?php
} 


else if (isset($_POST['armors'])) { 
$query  = mysql_query("SELECT * FROM wqw_equipment WHERE sES = 'ar' AND bStaff = '0' AND sType != 'Enhancement' ORDER BY sName");
$count = mysql_num_rows($query);
?>

<center><a href='maps.asp'><h1>Back</h1></a></center><br><form>

<table width="548" border="0" cellspacing="0" cellpadding="0" align="center">
<tr> 
    <td align="left" valign="top" height="173"> 
      <p>
        <font size="3"><a><b>Armors List</b></a></font>
      </p>
      <p>There is <?php echo $count; ?> Armor(s) in the database.</p>
        
      <table width="548" border="1" cellspacing="0" cellpadding="5" bordercolor="#000000">
        <tr bgcolor="#4E3972" bordercolor="#000000">
          <td class='top100Heading'>#</td>
          <td class='top100Heading'>Name</td>
          <td class='top100Heading'>Type</td>
          <td class='top100Heading'>Cost</td>
          <td class='top100Heading'>Level</td>
          <td class='top100Heading'>VIP</td>
        </tr>

<?php
$i = 0;
while($chr = mysql_fetch_array($query)){
$i = $i + 1;
?>

<tr bgcolor="#0000" bordercolor="#000000">
<td class='top100'><p><?php echo $i; ?></p></td>
<td class='top100Name'><p><?php echo $chr["sName"]; ?></p></td>
<td class='top100'><p><?php echo $chr["sType"]; ?></p></td>
<td class='top100'><p><?php echo $chr["iCost"]; ?></p></td>
<td class='top100'><p><?php echo $chr["iLvl"]; ?></p></td>
<td class='top100'><p><?php 
if ($chr["bUpg"] != 0) {
	echo "<font style=\"color: gold; font-weight: bold;\">True</font>";
} else {
	echo "False"; 
}
?></p></td>
</tr>

<?php
}
?>
</table><form>
<?php
} 

else if (isset($_POST['backitems'])) { 
$query  = mysql_query("SELECT * FROM wqw_equipment WHERE sES = 'ba' AND bStaff = '0' AND sType != 'Enhancement' ORDER BY sName");
$count = mysql_num_rows($query);
?>

<center><a href='maps.asp'><h1>Back</h1></a></center><br><form>

<table width="548" border="0" cellspacing="0" cellpadding="0" align="center">
<tr> 
    <td align="left" valign="top" height="173"> 
      <p>
        <font size="3"><a><b>Back Item List</b></a></font>
      </p>
      <p>There is <?php echo $count; ?> Back Item(s) in the database.</p>
        
      <table width="548" border="1" cellspacing="0" cellpadding="5" bordercolor="#000000">
        <tr bgcolor="#4E3972" bordercolor="#000000">
          <td class='top100Heading'>#</td>
          <td class='top100Heading'>Name</td>
          <td class='top100Heading'>Type</td>
          <td class='top100Heading'>Cost</td>
          <td class='top100Heading'>Level</td>
          <td class='top100Heading'>VIP</td>
        </tr>

<?php
$i = 0;
while($chr = mysql_fetch_array($query)){
$i = $i + 1;
?>

<tr bgcolor="#0000" bordercolor="#000000">
<td class='top100'><p><?php echo $i; ?></p></td>
<td class='top100Name'><p><?php echo $chr["sName"]; ?></p></td>
<td class='top100'><p><?php echo $chr["sType"]; ?></p></td>
<td class='top100'><p><?php echo $chr["iCost"]; ?></p></td>
<td class='top100'><p><?php echo $chr["iLvl"]; ?></p></td>
<td class='top100'><p><?php 
if ($chr["bUpg"] != 0) {
	echo "<font style=\"color: gold; font-weight: bold;\">True</font>";
} else {
	echo "False"; 
}
?></p></td>
</tr>

<?php
}
?>
</table><form>
<?php
} 

else if (isset($_POST['outfits'])) { 
$query  = mysql_query("SELECT * FROM wqw_equipment WHERE sES = 'co' AND bStaff = '0' AND sType != 'Enhancement' ORDER BY sName");
$count = mysql_num_rows($query);
?>

<center><a href='maps.asp'><h1>Back</h1></a></center><br><form>

<table width="548" border="0" cellspacing="0" cellpadding="0" align="center">
<tr> 
    <td align="left" valign="top" height="173"> 
      <p>
        <font size="3"><a><b>Outfits List</b></a></font>
      </p>
      <p>There is <?php echo $count; ?> Outfit(s) in the database.</p>
        
      <table width="548" border="1" cellspacing="0" cellpadding="5" bordercolor="#000000">
        <tr bgcolor="#4E3972" bordercolor="#000000">
          <td class='top100Heading'>#</td>
          <td class='top100Heading'>Name</td>
          <td class='top100Heading'>Type</td>
          <td class='top100Heading'>Cost</td>
          <td class='top100Heading'>Level</td>
          <td class='top100Heading'>VIP</td>
        </tr>

<?php
$i = 0;
while($chr = mysql_fetch_array($query)){
$i = $i + 1;
?>

<tr bgcolor="#0000" bordercolor="#000000">
<td class='top100'><p><?php echo $i; ?></p></td>
<td class='top100Name'><p><?php echo $chr["sName"]; ?></p></td>
<td class='top100'><p><?php echo $chr["sType"]; ?></p></td>
<td class='top100'><p><?php echo $chr["iCost"]; ?></p></td>
<td class='top100'><p><?php echo $chr["iLvl"]; ?></p></td>
<td class='top100'><p><?php 
if ($chr["bUpg"] != 0) {
	echo "<font style=\"color: gold; font-weight: bold;\">True</font>";
} else {
	echo "False"; 
}
?></p></td>
</tr>

<?php
}
?>
</table><form>
<?php
} 

else if (isset($_POST['pets'])) { 
$query  = mysql_query("SELECT * FROM wqw_equipment WHERE sES = 'pe' AND bStaff = '0' AND sType != 'Enhancement' ORDER BY sName");
$count = mysql_num_rows($query);
?>

<center><a href='maps.asp'><h1>Back</h1></a></center><br><form>

<table width="548" border="0" cellspacing="0" cellpadding="0" align="center">
<tr> 
    <td align="left" valign="top" height="173"> 
      <p>
        <font size="3"><a><b>Pets List</b></a></font>
      </p>
      <p>There is <?php echo $count; ?> Pet(s) in the database.</p>
        
      <table width="548" border="1" cellspacing="0" cellpadding="5" bordercolor="#000000">
        <tr bgcolor="#4E3972" bordercolor="#000000">
          <td class='top100Heading'>#</td>
          <td class='top100Heading'>Name</td>
          <td class='top100Heading'>Type</td>
          <td class='top100Heading'>Cost</td>
          <td class='top100Heading'>Level</td>
          <td class='top100Heading'>VIP</td>
        </tr>

<?php
$i = 0;
while($chr = mysql_fetch_array($query)){
$i = $i + 1;
?>

<tr bgcolor="#0000" bordercolor="#000000">
<td class='top100'><p><?php echo $i; ?></p></td>
<td class='top100Name'><p><?php echo $chr["sName"]; ?></p></td>
<td class='top100'><p><?php echo $chr["sType"]; ?></p></td>
<td class='top100'><p><?php echo $chr["iCost"]; ?></p></td>
<td class='top100'><p><?php echo $chr["iLvl"]; ?></p></td>
<td class='top100'><p><?php 
if ($chr["bUpg"] != 0) {
	echo "<font style=\"color: gold; font-weight: bold;\">True</font>";
} else {
	echo "False"; 
}
?></p></td>
</tr>

<?php
}
?>
</table><form>
<?php
} 

else if (isset($_POST['helms'])) { 
$query  = mysql_query("SELECT * FROM wqw_equipment WHERE sES = 'he' AND bStaff = '0' AND sType != 'Enhancement' ORDER BY sName");
$count = mysql_num_rows($query);
?>

<center><a href='maps.asp'><h1>Back</h1></a></center><br><form>

<table width="548" border="0" cellspacing="0" cellpadding="0" align="center">
<tr> 
    <td align="left" valign="top" height="173"> 
      <p>
        <font size="3"><a><b>Helms List</b></a></font>
      </p>
      <p>There is <?php echo $count; ?> Helm(s) in the database.</p>
        
      <table width="548" border="1" cellspacing="0" cellpadding="5" bordercolor="#000000">
        <tr bgcolor="#4E3972" bordercolor="#000000">
          <td class='top100Heading'>#</td>
          <td class='top100Heading'>Name</td>
          <td class='top100Heading'>Type</td>
          <td class='top100Heading'>Cost</td>
          <td class='top100Heading'>Level</td>
          <td class='top100Heading'>VIP</td>
        </tr>

<?php
$i = 0;
while($chr = mysql_fetch_array($query)){
$i = $i + 1;
?>

<tr bgcolor="#0000" bordercolor="#000000">
<td class='top100'><p><?php echo $i; ?></p></td>
<td class='top100Name'><p><?php echo $chr["sName"]; ?></p></td>
<td class='top100'><p><?php echo $chr["sType"]; ?></p></td>
<td class='top100'><p><?php echo $chr["iCost"]; ?></p></td>
<td class='top100'><p><?php echo $chr["iLvl"]; ?></p></td>
<td class='top100'><p><?php 
if ($chr["bUpg"] != 0) {
	echo "<font style=\"color: gold; font-weight: bold;\">True</font>";
} else {
	echo "False"; 
}
?></p></td>
</tr>

<?php
}
?>
</table><form>
<?php
} 

else 
{
?>

 <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
 <table border="0">
 <h1>Server Item List</h1>
 <th colspan=2><input type="submit" name="maps" value="List Maps"></tr>
 <th colspan=2><input type="submit" name="weapons" value="List Weapons"></th></tr>
 <th colspan=2><input type="submit" name="armors" value="List Armors"></th></tr>
 <th colspan=2><input type="submit" name="backitems" value="List Back Items"></th></tr>
 <th colspan=2><input type="submit" name="outfits" value="List Outfits"></th></tr>
 <th colspan=2><input type="submit" name="pets" value="List Pets"></th></tr>
 <th colspan=2><input type="submit" name="helms" value="List Helms"></th></tr>
 </table><form>
 </form>

 <?php
 }
 ?> 
