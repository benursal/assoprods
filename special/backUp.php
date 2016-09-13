<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Untitled Document</title>
</head>

<body>
<?php
if($_POST['copy'])
{
	$errors = array();

	$sourcePath = "/xampp/mysql/data/assoprods/";
	$destination = "D:/backups/";
	
	$newDir = mkdir($destination.date("Ymd")."/");
	//echo $newDir;
	if(!$newDir)
	{
		echo "Error creating folder <br>".date("Ymd")."!!!";
	}
	else
	{
		$files = scandir($sourcePath);
		foreach($files as $k=>$v)
		{
			if(!copy("C:/xampp/mysql/data/assoprods/$v", "D:/backups/".date("Ymd")."/$v"))
			{
				echo "Error copying file <b>".$v."</b>";
			}
			//echo $v."<br>";
		}
	}
}
?>
<form method="post">

<input type="submit" name="copy" value="Back Up Now!">
</form>
</body>
</html>
