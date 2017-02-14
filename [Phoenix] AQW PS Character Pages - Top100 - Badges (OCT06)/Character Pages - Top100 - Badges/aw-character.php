<?php
# Connect to the database
include("config.php");

$userid2 = $_GET['id'];

$userid2 = $_GET['id'];

if ($userid2 != ""){
    $objRS_query = mysql_query("SELECT * FROM wqw_users WHERE username = '".$userid2."'");
    $objRS1_query = mysql_query("SELECT * FROM wqw_users WHERE username = '".$userid2."'");
    $objRS1 = mysql_fetch_assoc($objRS1_query);
    $rows = mysql_num_rows($objRS1_query);
    if($rows == 0){
	die('Sorry, The User Cannot be Found.');
    }
    
    $i = 0;
    
    while ($objRS = mysql_fetch_array($objRS_query)){
        $i = $i + 1;        
    }
    
    if ($i != ""){
        
        $username = $objRS1['username'];
        $level  = $objRS1['level'];
        $facecolors = $objRS1['facecolors'];
        $armorcolors = $objRS1['armorcolors'];
	}
} else {
	die('Sorry, The User Cannot be Found.');
}

//CURRENT ARMOR
$current_arm = mysql_query("SELECT * FROM wqw_items WHERE sES = 'ar' AND userid = '".$objRS1['id']."' AND equipped = 1 ORDER BY id ASC LIMIT 1");
$carm = mysql_fetch_assoc($current_arm);
$current_a = mysql_query("SELECT * FROM wqw_equipment WHERE itemid = '".$carm['itemid']."'");
$ca = mysql_fetch_assoc($current_a);

//CURRENT WEAPON
$current_wep = mysql_query("SELECT * FROM wqw_items WHERE sES = 'Weapon' AND userid = '".$objRS1['id']."' AND equipped = 1 ORDER BY id ASC LIMIT 1");
$checkw = mysql_num_rows($current_wep);
if ($checkw == 0) {
	$weaponfile = 'none';
	$weaponlink = 'none';
}
else {
	$cwep = mysql_fetch_assoc($current_wep);
	$current_w = mysql_query("SELECT * FROM wqw_equipment WHERE itemid = '".$cwep['itemid']."'");
	$cw = mysql_fetch_assoc($current_w);
	$weaponfile = $cw['sFile'];
	$weaponlink = $cw['sLink'];
}

//CURRENT BACK ITEM
$current_ba = mysql_query("SELECT * FROM wqw_items WHERE sES = 'ba' AND userid = '".$objRS1['id']."' AND equipped = 1 ORDER BY id ASC LIMIT 1");
$checkba = mysql_num_rows($current_ba);
if ($checkba == 0) {
	$bafile = 'none';
	$balink = 'none';
}
else {
	$cba = mysql_fetch_assoc($current_ba);
	$current_b = mysql_query("SELECT * FROM wqw_equipment WHERE itemid = '".$cba['itemid']."'");
	$cb = mysql_fetch_assoc($current_b);
	$bafile = $cb['sFile'];
	$balink = $cb['sLink'];
}

//CURRENT PET
$current_pe = mysql_query("SELECT * FROM wqw_items WHERE sES = 'pe' AND userid = '".$objRS1['id']."' AND equipped = 1 ORDER BY id ASC LIMIT 1");
$checkcp = mysql_num_rows($current_pe);
if ($checkcp == 0) {
	$cpfile = 'none';
	$cplink = 'none';
}
else {
	$cpe = mysql_fetch_assoc($current_pe);
	$current_p = mysql_query("SELECT * FROM wqw_equipment WHERE itemid = '".$cpe['itemid']."'");
	$cp = mysql_fetch_assoc($current_p);
	$cpfile = $cp['sFile'];
	$cplink = $cp['sLink'];
}

//CURRENT HELM
$current_he = mysql_query("SELECT * FROM wqw_items WHERE sES = 'he' AND userid = '".$objRS1['id']."' AND equipped = 1 ORDER BY id ASC LIMIT 1");
//IF THERE IS NONE EQUIPPED WILL LOAD HAIR INSTEAD
$checkh = mysql_num_rows($current_he);
if ($checkh == 0) {
	$helmhair = 'none';
	$helmhairl = 'none';
}
else {
$che = mysql_fetch_assoc($current_he);
$current_h = mysql_query("SELECT * FROM wqw_equipment WHERE itemid = '".$che['itemid']."'");
$ch = mysql_fetch_assoc($current_h);
$helmhair = $ch['sFile'];
$helmhairl = $ch['sLink'];
}

//CURRENT OUTFIT
$current_ou = mysql_query("SELECT * FROM wqw_items WHERE sES = 'co' AND userid = '".$objRS1['id']."' AND equipped = 1 ORDER BY id ASC LIMIT 1");
$cur_ou = mysql_fetch_assoc($current_ou);
$current_o = mysql_query("SELECT * FROM wqw_equipment WHERE itemid = '".$cur_ou['itemid']."'");
$cou = mysql_fetch_assoc($current_o);
$armco = $cou['sFile'];
$armcol = $cou['sLink'];

//Checks if there is not an Equipped Outfit
//IF THERE IS NONE EQUIPPED WILL LOAD CURRENT CLASS INSTEAD
$checko = mysql_num_rows($current_ou);
if ($checko == 0) {
	$armco = $ca['sFile'];
	$armcol = $ca['sLink'];
}

?>

<html>
<head>
<title>MentalQuest Worlds - <?php echo $username; ?> Character Page</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>
<meta http-equiv="CACHE-CONTROL" content="NO-CACHE"/>
<link href="site.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<center>
<a href="index.php" target="_blank">MentalQuest Worlds</a> | <a href="http://betaevo.cz.cc/forum/" target="_blank">Beta Evolution</a> | <a href="signup.php" target="_blank">Register</a> | <a href="top100.php" target="_blank">Top 100</a> | <a href="maps.php" target="_blank">Maps</a> | <a href="stafflist.php" target="_blank">Staff</a> | <a href="vip.php" target="_blank">V.I.P</a> | <a href="trade.php" target="_blank">Trade</a> | <a href="../index.php" target="_blank">Main Page</a>
<br /><br />
<a href="#">MentalQuest Worlds- <?php echo $username; ?>'s Character Page</a>
</center><br>
<center>
<div id="content">
<form>
<div id="bla">
<div id="ctop"></div>
<div id="ccontent">
		 <table width="600" border="0" cellpadding="10" cellspacing="0">
          <tr align="center">
            <td colspan="2">
				<p>
					<h2><?php echo $username; ?></h2>
					<b>Level <?php echo $level; ?>, <?php echo $ca['sName']; ?></b>

				</p>

  <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" 
codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0"
 width="550" height="350">
    <embed src="aqworlds.com/character.swf" 
quality="high" 
pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash"
 type="application/x-shockwave-flash" 
flashvars="intColorHair=<?php echo $objRS1['plaColorHair']; ?>&amp;intColorSkin=<?php echo $objRS1['plaColorSkin']; ?>&amp;intColorEye=<?php echo $objRS1['plaColorEyes']; ?>&amp;intColorTrim=<?php echo $objRS1['cosColorTrim']; ?>&amp;intColorBase=<?php echo $objRS1['cosColorBase']; ?>&amp;intColorAccessory=<?php echo $objRS1['cosColorAccessory']; ?>&amp;strGender=<?php echo $objRS1['gender']; ?>&amp;strHairFile=<?php echo $objRS1['hairFile']; ?>&amp;strHairName=<?php echo $objRS1['hairName']; ?>&amp;strName=<?php echo $username ?>&amp;intLevel=<?php echo $level; ?>&amp;strClassName=<?php echo $ca['sName']?>&amp;strClassFile=<?php echo $armco ?>&amp;strClassLink=<?php echo $armcol ?>&amp;strWeaponFile=<?php echo $weaponfile; ?>&amp;strWeaponLink=<?php echo $weaponlink; ?>&amp;strCapeFile=<?php echo $bafile; ?>&amp;strCapeLink=<?php echo $balink; ?>&amp;strHelmFile=<?php echo $helmhair; ?>&amp;strHelmLink=<?php echo $helmhairl; ?>&amp;strPetFile=<?php echo $cpfile; ?>&amp;strPetLink=<?php echo $cplink; ?>" width="550" height="350">
  </object>
			</td>
          </tr>
          <tr>
 
                </div>
            </td>

            <td align="left" valign="top">
            
				<br/>
				<p>
					<font size="3"><b>Account Type:</b><span class="style5">
					
						<?php echo$objRS1['chartype']; ?></font>
					
					</span>
				  <br />

 				  <font size="3"><b>Class: </b> <?php echo $ca['sName']; ?></font><br/>
                  <font size="3"><b>Gold:</b> <?php echo$objRS1['gold']; ?></font><br/>


                  <br/>
               
                </p>
            </td>

        </tr>
		<tr>
		<td>
		 <?php
			if(isset($_GET['id'])){
				$id = mysql_real_escape_string($_GET['id']);
				$query = mysql_query("SELECT * FROM wqw_achievements WHERE username = '$id'");
				$num = mysql_numrows($query);
	
				$i=0;
				echo "<font size='3'><strong>Achievements:</strong></font><br />";
				while ($i < $num) {
					$image=mysql_result($query,$i,"achievement_image");
					$name=mysql_result($query,$i,"achievement_name");
					echo "<img src='img/newbadges/".$image."' /> ";
					$i++;
				} 
				echo "</tr>";
		      } else {
				echo "The user ID is not set. ";
			}
		 ?>
			</blockquote>
		</td>
		<td>
		</td>
	</tr>          
      <tr>
        <td colspan="2" align="left" valign="top">
		<table width="450" cellspacing="0" cellpadding="6" align="center">
		<tr> 
		  <td colspan="2">&nbsp;</td>
		</tr>

		<tr valign="top"> 
		  <td width="205">
			<table width="200" cellpadding="2">
				<tr>
					<td class="heading"><strong><font size="3">Weapons</strong></td>
				</tr>
				<?php
                
                $weapons_query = mysql_query("SELECT * FROM wqw_items WHERE sES='weapon' AND userid = '".$objRS1['id']."' ORDER BY id DESC");
				
                while ($weapons = mysql_fetch_array($weapons_query)){
                    
                    $inform_query = mysql_query("SELECT * FROM wqw_equipment WHERE itemid = '".$weapons['itemid']."'");
                    $inform = mysql_fetch_array($inform_query);
                    
                    ?>
                    <tr align="left" valign="top"> 
					<td class="normal">
						
					<font size="2"><?php echo$inform['sName']; ?></td>

				</tr>
                <?php
                
                }
                
                ?>
			
			</table>

		  </td>
		  <td width="205">
			<table width="200" cellpadding="2"> 
				<tr>
					<td class="heading"><strong><font size="3">Armors</font></strong></td>
				</tr>
			
				<?php
                
                $armors_query = mysql_query("SELECT * FROM wqw_items WHERE sES = 'ar' AND userid = '".$objRS1['id']."' ORDER BY id DESC");
                
                while ($armors = mysql_fetch_array($armors_query)){
                    
                    $inform1_query = mysql_query("SELECT * FROM wqw_equipment WHERE itemid = '".$armors['itemid']."'");
                    $inform1 = mysql_fetch_assoc($inform1_query);
                    
                    ?>
				<tr align="left" valign="top"> 
				<td class="normal">
						
				<font size="2"><?php echo$inform1['sName']; ?></font></td>

				</tr>
                
				<?php
                
                }
                
                ?>		
			
			</table>
		  </td>
		</tr>
		<tr> 
		  <td colspan=2>&nbsp;</td>

		</tr>
		<tr valign="top"> 
		  <td width="205">
			<table width="200" cellpadding="2">
				<tr>
					<td class="heading"><strong><font size="3">Outfits</font></strong></td>
				</tr>
				
				<?php
                
                $armors_query = mysql_query("SELECT * FROM wqw_items WHERE sES = 'co' AND userid = '".$objRS1['id']."' ORDER BY id DESC");
                
                while ($armors = mysql_fetch_array($armors_query)){
                    
                    $inform1_query = mysql_query("SELECT * FROM wqw_equipment WHERE itemid = '".$armors['itemid']."'");
                    $inform1 = mysql_fetch_assoc($inform1_query);
                    
                    ?>
				<tr align="left" valign="top"> 
				<td class="normal">
						
				<font size="2"><?php echo$inform1['sName']; ?></font></td>

				</tr>
                
				<?php
                
                }
                
                ?>		
                
			</table>
		</td>

		<td width="205">
			<table width="200" cellpadding="2"> 
				<tr>
				  <td class="heading"><strong><font size="3">Helms</font></strong></td>
				</tr>
								
				<?php
                
                $armors_query = mysql_query("SELECT * FROM wqw_items WHERE sES = 'he' AND userid = '".$objRS1['id']."' ORDER BY id DESC");
                
                while ($armors = mysql_fetch_array($armors_query)){
                    
                    $inform1_query = mysql_query("SELECT * FROM wqw_equipment WHERE itemid = '".$armors['itemid']."'");
                    $inform1 = mysql_fetch_assoc($inform1_query);
                    
                    ?>
				<tr align="left" valign="top"> 
				<td class="normal">
						
				<font size="2"><?php echo$inform1['sName']; ?></font></td>

				</tr>
                
				<?php
                
                }
                
                ?>		
                

			</table>
  		  </td>
		</tr> 
		  <td colspan=2>&nbsp;</td>

		</tr>
		<tr valign="top"> 
		  <td width="205">
			<table width="200" cellpadding="2">
				<tr>
				  <td class="heading"><strong><font size="3">Back Items</font></strong></td>
				</tr>
								
				<?php
                
                $armors_query = mysql_query("SELECT * FROM wqw_items WHERE sES = 'ba' AND userid = '".$objRS1['id']."' ORDER BY id DESC");
                
                while ($armors = mysql_fetch_array($armors_query)){
                    
                    $inform1_query = mysql_query("SELECT * FROM wqw_equipment WHERE itemid = '".$armors['itemid']."'");
                    $inform1 = mysql_fetch_assoc($inform1_query);
                    
                    ?>
				<tr align="left" valign="top"> 
				<td class="normal">
						
				<font size="2"><?php echo$inform1['sName']; ?></font></td>

				</tr>
                
				<?php
                
                }
                
                ?>		
                
			</table>
		</td>

		<td width="205">
			<table width="200" cellpadding="2"> 
				<tr>
				  <td class="heading"><strong><font size="3">Pets</font></strong></td>
				</tr>
								
				<?php
                
                $armors_query = mysql_query("SELECT * FROM wqw_items WHERE sES = 'pe' AND userid = '".$objRS1['id']."' ORDER BY id DESC");
                
                while ($armors = mysql_fetch_array($armors_query)){
                    
                    $inform1_query = mysql_query("SELECT * FROM wqw_equipment WHERE itemid = '".$armors['itemid']."'");
                    $inform1 = mysql_fetch_assoc($inform1_query);
                    
                    ?>
				<tr align="left" valign="top"> 
				<td class="normal">
						
				<font size="2"><?php echo$inform1['sName']; ?></font></td>

				</tr>
                
				<?php
                
                }
                
                ?>		
                
			</table>

		</td>			
	</tr>

	</table>

	</td>
	</tr>

	</table>
    </div>
    <div id="cbottom"></div>
</div>
    
<br /><br /><br />
</div>
<div id="bottom"><a>Credits to: MentalBlank, F3ar and Inuyasha</a></div>
<br>
<br>
<a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/3.0/"><img alt="Creative Commons License" style="border-width:0" src="http://i.creativecommons.org/l/by-nc-sa/3.0/88x31.png" /></a><br />This work is licensed under a <a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/3.0/">Creative Commons Attribution-NonCommercial-ShareAlike 3.0 Unported License</a>.
</center>

</body>

</html>