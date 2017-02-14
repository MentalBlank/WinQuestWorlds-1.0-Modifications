<?php
/*-----------------------------------
 MentalBlanks' / Phoenix's SWF Uploader
 Created for use with F3ar's CMS
 (mentalblank@live.com)
 Released On: http://cris-is.stylin-on.me
 -----------------------------------*/

//Loads Settings
$server_name = "EternalWorlds";
$server_url = "http://localhost/";
session_start();

//Checks if user is an administrator.
if(!isset($_SESSION['adm'])){
	header('location: ../login.php');
}

//Checks if the form has been submitted.
if(isset($_POST['submit'])) { 
?>
<html>
<title><?php echo $server_name; ?> | Upload</title>
<link type="text/css" rel="stylesheet" href="../css/main.css" />
<body>
<div id="content">
<?php include "../sidebar.php"; ?>
<div id="main-content-area">
<?php
//IMPORTANT
$directory = $_POST["directory"];

//this sets the directory for the file...
$rootdirect = "../";
$filedirect = "wqw/gamefiles/";
$target = $rootdirect.$filedirect.$directory;

//This combines the directory, and the file name
$origname = $_FILES['uploaded']['name'];
$target = $target . $origname;

//Checks if file is a SWF File
function findexts ($filename)

{

$filename = strtolower($filename) ;

$exts = split("[/\\.]", $filename) ;

$n = count($exts)-1;

$exts = $exts[$n];

return $exts;

}

$ext = findexts ($_FILES['uploaded']['name']) ;

//Uploads The File
if($ext == "swf"){
    $origname = $_FILES['uploaded']['name'];
    if(move_uploaded_file($_FILES['uploaded']['tmp_name'], $target))
    {
        if ($ext == "swf") {
            echo "<center><form action='' method='post'><b>Direct URL</b>:<br /><textarea name='direct' cols='40' rows='1'>"; echo $server_url.$filedirect.$directory.$origname;
            echo "</textarea><br /><br /><a href='"; echo $server_url.$filedirect.$directory.$origname;
            echo "' target=\"_blank\"><center><h1>Download this File</h1></center></a></form></center>";
        } else {
        	echo "<center><form><b>Sorry, There was a problem uploading your file</b></center></form></center>";
        }
    }
    else
    {
        echo "<center><form><b>Sorry, There was a problem uploading your file</b></center></form></center>";
    }
} else {
    echo "<center><form><b>Sorry, you're not allowed to upload anything besides:</b> SWF Files</center></form></center>";
}
?>
</div>
<?php include "sidebar-right.php"; ?>
</div>
</body>
</html>
<?php
//If the form has not been submitted.
} else {
?>
<html>
<title><?php echo $server_name; ?> | Upload SWF</title>
<link type="text/css" rel="stylesheet" href="../css/main.css" />
<body>
<div id="content">
<?php include "../sidebar.php"; ?>
<div id="main-content-area">
<form enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
	Please choose a SWF file: <input name="uploaded" type="file" /><br />
	Upload Directory:
	<select name="directory">
		<Option value="hair/M/">Hair (M)</Option>
		<Option value="hair/F/">Hair (F)</Option>
		<Option value="classes/M/">Classes (M)</Option>
		<Option value="classes/F/">Classes (F)</Option>
		<Option value="items/axes/">Axes</Option>
		<Option value="items/bows/">Bows</Option>
		<Option value="items/capes/">Capes</Option>
		<Option value="items/daggers/">Daggers</Option>
		<Option value="items/guns/">Guns</Option>
		<Option value="items/hair/">Hair</Option>
		<Option value="items/helms/">Helms</Option>
		<Option value="items/maces/">Maces</Option>
		<Option value="items/pets/">Pets</Option>
		<Option value="items/polearms/">Polearms</Option>
		<Option value="items/staves/">Staves</Option>
		<Option value="items/swords/">Swords</Option>
	</select><br />
	<input type="submit" name="submit" value="Upload" />
</form>
</div>
<?php include "sidebar-right.php"; ?>
</div>
</body>
</html>
<?php
}
?>