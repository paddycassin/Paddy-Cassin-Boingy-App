<?php @session_start(); ?>
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
$query_Updateform = "SELECT * FROM `user`";
$Updateform = mysql_query($query_Updateform, $localhost) or die(mysql_error());
$row_Updateform = mysql_fetch_assoc($Updateform);
$totalRows_Updateform = mysql_num_rows($Updateform);

mysql_select_db($database_localhost, $localhost);
$query_Update = "SELECT * FROM `user`";
$Update = mysql_query($query_Update, $localhost) or die(mysql_error());
$row_Update = mysql_fetch_assoc($Update);
$totalRows_Update = mysql_num_rows($Update);
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
	  <h1>Update Account</h1>
	</div>
	<div id="contentleft">
	  <h2><a href="/boingy/account.php">Profile Home</a></h2>
	  <p>&nbsp;</p>
	  <h6>&nbsp;</h6>
	</div>
    <div id="contentright">
      <form id="Updateform" name="Updateform" method="post">
      </form>
      <table width="600" border="0" align="center">
        <tbody>
          <tr>
            <td><h6>Account:<?php echo $row_User['FirstName']; ?> <?php echo $row_User['LastName']; ?> | Username: <?php echo $row_User['Username']; ?></h6></td>
          </tr>
        </tbody>
      </table>
      <table width="400" border="0" align="center">
        <tbody>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><h6>Email:
            </h6>
              <p>
                <input name="email" type="text" id="email" value="<?php echo $row_Updateform['Email']; ?>">
              </p></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><h6>Password:
            </h6>
              <p>
                <input name="password" type="text" id="password" value="<?php echo $row_Updateform['Password']; ?>">
              </p></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><input name="Update" type="submit" class="StyleTxtField" id="Update" form="Updateform" value="Update Account">
            <input name="UserIDhiddenField" type="hidden" id="UserIDhiddenField" form="Updateform" value="<?php echo $row_Updateform['UserID']; ?>"></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
        </tbody>
      </table>
      <p>&nbsp;</p>
    </div>
  </div>
<div id="footer"></div>
</div>
</body>
</html>
<?php
mysql_free_result($User);

mysql_free_result($Updateform);

mysql_free_result($Update);
?>
