<?php
# Connect to the database
include("config.php");
?>
<HTML>
<HEAD>
<TITLE>EvoQuest Worlds - Top Characters</TITLE>
<link href="site.css" rel="stylesheet" type="text/css"/><META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
</HEAD>
<center>
<a href="index.php" target="_blank">EvoQuest Worlds</a> | <a href="http://betaevo.isgreat.org/" target="_blank">Beta Evolution</a> | <a href="signup.php" target="_blank">Register</a> | <a href="top100.php" target="_blank">Top 100</a><br></center>
<table width="548" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr> 
    <td align="left" valign="top" height="173"> 
      <p>
        <font size="3"><a><b>Top 100 Characters</b></a></font>
      </p>
      <p>This is a list of the top 100 characters in the server.</p>
        
      <table width="548" border="1" cellspacing="0" cellpadding="5" bordercolor="#000000">
        <tr bgcolor="#FFFFFF" bordercolor="#000000">
          <td class='top100Heading'>#</td>
          <td class='top100Heading'>Name</td>

          <td class='top100Heading'>Level</td>
          <td class='top100Heading'>Gold</td>
          <td class='top100Heading'>PvP Kills</td>
          <td class='top100Heading'>Monster Kills</td>
        </tr>
<?php
# Don't select moderator or banned characters, and select the top 100 by level in descending (Highest to lowest) order
$character = mysql_query("SELECT * FROM wqw_users WHERE banned != 1 AND moderator != 1 ORDER BY level DESC LIMIT 100");

$i = 0;

while($chr = mysql_fetch_array($character)){
$i = $i + 1;
?>
<tr bgcolor="#CCCC66" bordercolor="#000000">
<td class='top100'><?php echo $i; ?></td>
<td class='top100Name'><a href="aw-character.php?id=<?php echo $chr["username"]; ?>"><?php echo $chr["username"]; ?></a></td>
<td class='top100'><?php echo $chr["level"]; ?></td>
<td class='top100'><?php echo $chr["gold"]; ?></td>
<td class='top100'><?php echo $chr["pvpkill"]; ?></td>
<td class='top100'><?php echo $chr["monkill"]; ?></td>
</tr>
<?php
}
?>
      </table>
      <p>&nbsp;</p>
    </td>
  </tr>
<p>&nbsp;</p>
</BODY>
<br>
<br>
<center>
<a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/3.0/"><img alt="Creative Commons License" style="border-width:0" src="http://i.creativecommons.org/l/by-nc-sa/3.0/88x31.png" /></a><br />This work is licensed under a <a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/3.0/">Creative Commons Attribution-NonCommercial-ShareAlike 3.0 Unported License</a>.
</center>
</HTML>