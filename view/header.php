<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $version ?></title>
<link href="prototype.css" rel="stylesheet" type="text/css" />
</head>

<body>
<a name="top"></a>    
<table width="1450" height="600" border="0">
  <tr>
      <td colspan="2" height="30"><?php
if ($_ENV['engineering mode'] == True) {
    echo "[page: <b>$page</b>]&nbsp;&nbsp;&nbsp;[todo: <b>$todo</b>]&nbsp;&nbsp;&nbsp;".
            "[memberID: <b>$currentMemberID</b>]&nbsp;&nbsp;&nbsp;[projectID: <b>$currentProjectID</b>]&nbsp;&nbsp;&nbsp;[PM_ID: <b>$currentProjectMemberID</b>]\n";
} else {
    echo "OPA Prototype\n";
}
?><br /><br /><hr /><br /></td>
  </tr>
  <tr>
<!-- header  header  header  header  header  header  header  header  header  header -->

