<?php
require_once('security.php');
  $response="";
  $display="";
  if ((isset($_POST['submit'])) && ($_POST['submit'] != 1) ) 
  {

    // Split filename string into array using "." separator
    $extension = explode ('.', $_FILES['upload']['name']);
    // Create new filename with original file extension added
    // modified by ljohns 31Aug08 original code not working missing file name
    // also added remove an extension if supplied to maintain integ of file type
    $newFileName = explode('.',$_POST['filename']);
    $filename = $newFileName[0] . '.' . $extension[1];

    // Move the file from temp folder to images folder
    if (move_uploaded_file($_FILES['upload']['tmp_name'], "../images/$filename")) {
      $response = 'The file named <b>' . $filename . '</b> has been uploaded.';
      $display = '<br /><img src="../images/' . $filename . '" />';
    } else {
      $response = 'The file could not be moved.';
    }
  }

?>

<?php $thisPage = "upload"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Upload an Image</title>
<meta name="robots" content="noindex,nofollow" />
<?php require_once('theme/admintheme.php');?>
</head>
<body>

<div id="wrap">

<?php include_once('navigation.php'); ?>

<form enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
Select file on hard drive:<br />
<input type="file" name="upload" /><br />
Name file (omit file extension):<br />
<input size="20" name="filename" maxlength="30" />
<input type="hidden" name="MAX_FILE_SIZE" value="20000" />
<input type="submit" name="submit" value="Submit" />
</form>

<?php echo $response; ?>
<?php echo $display; ?>

<?php

  echo '<br /><p><b>Current image files:</b></p>';
  $dirname = "../images";
  $dh = opendir($dirname);
  while (false !== ($file = readdir($dh))) {
    if ((strstr($file, '.jpg')) || (strstr($file, '.bmp'))|| (strstr($file, '.jpeg')) || (strstr($file, '.gif')) || (strstr($file, '.png'))) {
      print '<a href="../images/' . $file . '" title="View">' . $file . '</a><br />';
    }
  }
  closedir($dh);

?>

</div>

</body>
</html>
