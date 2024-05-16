<?php
$filename = '104Gateway.toml';
$path = 'load/104Gateway.toml';
$uploaddir = 'upload/';
$uploadfile = $uploaddir . basename($_FILES['userfile']['name']);
$myfile = fopen($path, "r") or die("Unable to open file!");

if (!empty($_POST['mydata'])) {
	$mystr = $_POST['mydata'];
} elseif (filesize($path) > 0) {
	$mystr = fread($myfile, filesize($path));
}
?>

<form action="." method="post" enctype="multipart/form-data">
	<input type="hidden" name="MAX_FILE_SIZE" value="30000" />

	<textarea name="mydata" rows="10" cols="100"><?php echo $mystr; ?></textarea>
	<br><br>
	<a href="<?php echo $path ?>" download="<?php echo $filename ?>"><button type="button">Download</button></a>
	<br><br>
	<input name="userfile" type="file" />
	<br><br>
	<button type="submit">Submit</button>
</form>
<br>

<?php
fclose($myfile);
$fp = fopen($path, 'w') or die("Unable to open file!");
fwrite($fp, $_POST['mydata']) or die("Unable to write to file!");
fclose($fp);

if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
    echo "File is valid, and was successfully uploaded.\n";
} else {
    echo "Possible file upload attack!\n";
}

echo $_FILES['userfile']['name']
?>
