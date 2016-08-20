<?php @session_start(); ?>
<?php virtual('/boingy/Connections/localhost.php'); ?>
<?php virtual('/boingy/Connections/localhost.php'); ?>
<?php virtual('/boingy/Connections/localhost.php'); ?>
<?php virtual('/boingy/Connections/localhost.php'); ?>
<?php virtual('/boingy/Connections/localhost.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form2")) {
  $insertSQL = sprintf("INSERT INTO videodownloads (videoID, name, pathFinder, `date`) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString($_POST['VideoID'], "int"),
                       GetSQLValueString($_POST['VideoName'], "text"),
                       GetSQLValueString($_POST['VideoPathFinder'], "text"),
                       GetSQLValueString($_POST['VideoDate'], "date"));

  mysql_select_db($database_localhost, $localhost);
  $Result1 = mysql_query($insertSQL, $localhost) or die(mysql_error());
}

if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form2")) {
  $insertSQL = sprintf("INSERT INTO videodownloads (name, pathFinder, `date`) VALUES (%s, %s, %s)",
                       GetSQLValueString($_POST['textfield6'], "text"),
                       GetSQLValueString($_POST['textfield7'], "text"),
                       GetSQLValueString($_POST['textfield8'], "date"));

  mysql_select_db($database_localhost, $localhost);
  $Result1 = mysql_query($insertSQL, $localhost) or die(mysql_error());
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO imagedownloads (name, pathFinder, `date`) VALUES (%s, %s, %s)",
                       GetSQLValueString($_POST['ImageName'], "text"),
                       GetSQLValueString($_POST['PathFinder'], "text"),
                       GetSQLValueString($_POST['Date'], "date"));

  mysql_select_db($database_localhost, $localhost);
  $Result1 = mysql_query($insertSQL, $localhost) or die(mysql_error());
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form3")) {
  $insertSQL = sprintf("INSERT INTO textdownloads (textID, name, pathFinder, `date`) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString($_POST['TextID'], "int"),
                       GetSQLValueString($_POST['TextName'], "text"),
                       GetSQLValueString($_POST['TextPathFinder'], "text"),
                       GetSQLValueString($_POST['TextDate'], "date"));

  mysql_select_db($database_localhost, $localhost);
  $Result1 = mysql_query($insertSQL, $localhost) or die(mysql_error());
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

$colname_User = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_User = $_SESSION['MM_Username'];
}
mysql_select_db($database_localhost, $localhost);
$query_User = sprintf("SELECT * FROM `user` WHERE Username = %s", GetSQLValueString($colname_User, "text"));
$User = mysql_query($query_User, $localhost) or die(mysql_error());
$row_User = mysql_fetch_assoc($User);
$totalRows_User = mysql_num_rows($User);

mysql_select_db($database_localhost, $localhost);
$query_imagedownloads = "SELECT * FROM imagedownloads";
$imagedownloads = mysql_query($query_imagedownloads, $localhost) or die(mysql_error());
$row_imagedownloads = mysql_fetch_assoc($imagedownloads);
$totalRows_imagedownloads = mysql_num_rows($imagedownloads);

mysql_select_db($database_localhost, $localhost);
$query_VideoDownloads = "SELECT * FROM videodownloads";
$VideoDownloads = mysql_query($query_VideoDownloads, $localhost) or die(mysql_error());
$row_VideoDownloads = mysql_fetch_assoc($VideoDownloads);
$totalRows_VideoDownloads = mysql_num_rows($VideoDownloads);

mysql_select_db($database_localhost, $localhost);
$query_Text = "SELECT * FROM textdownloads";
$Text = mysql_query($query_Text, $localhost) or die(mysql_error());
$row_Text = mysql_fetch_assoc($Text);
$totalRows_Text = mysql_num_rows($Text);
?>
<!doctype html>
<html>
<head>
<link href="/boingy/CSS/layout.css" rel="stylesheet" type="text/css" />
<link href="/boingy/CSS/menu.css" rel="stylesheet" type="text/css" />

<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>

<div id="holder">
<div id="header"></div>
<div id="navibar">
	<nav>
    	<ul>
        
        <li><a href="Login2.php">Login</a></li>
        <li><a href="Register2.php">Register</a></li>
        <li><a href="ForgotPassword2.php">Forgot Password</a></li>     
               
        </ul>        
     </nav>
</div>

<div id="content">
	<div id="pageheading">
	  <h1>Welcome, <?php echo $row_User['FirstName']; ?><?php echo $row_User['LastName']; ?>! </h1>
	  <h1>&nbsp;</h1>
	  <h1><a href="/boingy/update2.php">Update Profile</a> </h1>
	  <h1>&nbsp;</h1>
	  <h1><a href="/boingy/LogOut.php">Logout</a></h1>
	</div>
	<div id="contentleft">
	  <h2>Downloaded Content</h2>
      <p>ImageDownlaods</p>
      <form action="<?php echo $editFormAction; ?>" id="form1" name="form1" method="POST">
        <table border="0">
          <tbody>
            <tr>
              <td>Image ID</td>
              <td><input name="ImageID" type="text" class="StyleTxtField" id="ImageID" title="ImageID" value="<?php echo $row_imagedownloads['imageID']; ?>"></td>
            </tr>
            <tr>
              <td>Image Name: </td>
              <td><input name="ImageName" type="text" class="StyleTxtField" id="ImageName" title="ImageName" value="<?php echo $row_imagedownloads['name']; ?>"></td>
            </tr>
            <tr>
              <td>Image Path:</td>
              <td><input name="PathFinder" type="text" class="StyleTxtField" id="PathFinder" title="PathFinder" value="<?php echo $row_imagedownloads['pathFinder']; ?>"></td>
            </tr>
            <tr>
              <td>Image Date:</td>
              <td><input name="Date" type="text" class="StyleTxtField" id="Date" title="Date" value="<?php echo $row_imagedownloads['date']; ?>"></td>
            </tr>
          </tbody>
        </table>
        <input type="hidden" name="MM_insert" value="form1">
      </form>
      <h6>&nbsp;</h6>
      <h6>&nbsp;</h6>
      <h6>&nbsp;</h6>
      <h6>Video Downlaods </h6>
      <p>&nbsp;</p>
      <form action="<?php echo $editFormAction; ?>" id="form2" name="form2" method="POST">
        <table border="0">
          <tbody>
            <tr>
              <td>Video ID</td>
              <td><input name="VideoID" type="text" class="StyleTxtField" id="VideoID" title="VideoID" value="<?php echo $row_VideoDownloads['videoID']; ?>"></td>
            </tr>
            <tr>
              <td>Video Name: </td>
              <td><input name="VideoName" type="text" class="StyleTxtField" id="VideoName" title="VideoName" value="<?php echo $row_VideoDownloads['name']; ?>"></td>
            </tr>
            <tr>
              <td>Video Path:</td>
              <td><input name="VideoPathFinder" type="text" class="StyleTxtField" id="VideoPathFinder" title="VideoPathFinder" value="<?php echo $row_VideoDownloads['pathFinder']; ?>"></td>
            </tr>
            <tr>
              <td>Video Date:</td>
              <td><input name="VideoDate" type="text" class="StyleTxtField" id="VideoDate" title="VideoDate" value="<?php echo $row_VideoDownloads['date']; ?>"></td>
            </tr>
          </tbody>
        </table>
        <p>
          <input type="hidden" name="MM_insert" value="form2">
        </p>
        <h6>&nbsp;</h6>
        <div></div>
      </form>
      <form action="<?php echo $editFormAction; ?>" id="form3" name="form3" method="POST">
        <p>Text Downloads</p>
        <table border="0">
          <tbody>
            <tr>
              <td>Text ID</td>
              <td><input name="TextID" type="text" class="StyleTxtField" id="TextID" title="TextID" value="<?php echo $row_Text['textID']; ?>"></td>
            </tr>
            <tr>
              <td>Text Name: </td>
              <td><input name="TextName" type="text" class="StyleTxtField" id="TextName" title="TextName" value="<?php echo $row_Text['name']; ?>"></td>
            </tr>
            <tr>
              <td>Text Path:</td>
              <td><input name="TextPathFinder" type="text" class="StyleTxtField" id="TextPathFinder" title="TextPathFinder" value="<?php echo $row_Text['pathFinder']; ?>"></td>
            </tr>
            <tr>
              <td>Text Date:</td>
              <td><input name="TextDate" type="text" class="StyleTxtField" id="TextDate" title="TextDate" value="<?php echo $row_Text['date']; ?>"></td>
            </tr>
          </tbody>
        </table>
        <input type="hidden" name="MM_insert" value="form3">
      </form>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <div></div>
	</div>
	<p>&nbsp;</p>
	<h2>&nbsp;</h2>
	<div>
	  <h2><img src="/boingy/assests/images/130221-Titanic-II-Swimming-Pool.jpg" width="483" height="206" alt=""/></h2>
    </div>
	<div id="contentright"></div>
  </div>
<div id="footer"></div>
</div>
</body>
</html>
<?php
mysql_free_result($User);

mysql_free_result($Text);

mysql_free_result($User);

mysql_free_result($imagedownloads);

mysql_free_result($VideoDownloads);
?>
