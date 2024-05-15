<?php

$path = 'load/text.txt';
$myfile = fopen($path, "r") or die("Unable to open file!");

if (!empty($_POST['mydata'])) {
	$mystr = $_POST['mydata'];
} elseif (filesize($path) > 0) {
	$mystr = fread($myfile, filesize($path));
}
?>

<form action="." method="post">
	<textarea name="mydata" rows="10"><?php echo $mystr; ?></textarea>
	<br>
	<button type="submit">Submit</button>
</form>
<br>

<?php
fclose($myfile);
$fp = fopen($path, 'w') or die("Unable to open file!");
fwrite($fp, $_POST['mydata']) or die("Unable to write to file!");
fclose($fp);
?>