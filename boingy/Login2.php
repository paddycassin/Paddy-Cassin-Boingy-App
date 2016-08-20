<?php @session_start();?>
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

$colname_Login = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_Login = $_SESSION['MM_Username'];
}
mysql_select_db($database_localhost, $localhost);
$query_Login = sprintf("SELECT * FROM `user` WHERE UserID = %s", GetSQLValueString($colname_Login, "int"));
$Login = mysql_query($query_Login, $localhost) or die(mysql_error());
$row_Login = mysql_fetch_assoc($Login);
$totalRows_Login = mysql_num_rows($Login);
?>
<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['Username'])) {
  $loginUsername=$_POST['Username'];
  $password=$_POST['password'];
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "/boingy/account.php";
  $MM_redirectLoginFailed = "/boingy/Login2.php";
  $MM_redirecttoReferrer = true;
  mysql_select_db($database_localhost, $localhost);
  
  $LoginRS__query=sprintf("SELECT Username, Password FROM `user` WHERE Username=%s AND Password=%s",
    GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysql_query($LoginRS__query, $localhost) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
     $loginStrGroup = "";
    
	if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && true) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
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
	  <h1>Boingy Login Page</h1>
	</div>
	<div id="contentleft">
	  <h2>Login Into Your Account</h2>
	  <p>&nbsp;</p>
	  <h6>Not Registered, Click Register Button</h6>
	</div>
    <div id="contentright">
      <form ACTION="<?php echo $loginFormAction; ?>" id="loginform" name="loginform" method="POST">
        <table width="400" border="0" align="center">
          <tbody>
            <tr>
              <td><label for="Username">Username:<br>
                <br>
              </label>
              <input name="Username" type="text" class="StyleTxtField" id="Username" form="loginform"></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td><label for="password">Password:<br>
                <br>
              </label>
              <input name="password" type="password" class="StyleTxtField" id="password" form="loginform"></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td><table border="0">
                <tbody>
                  <tr>
                    <td><input name="Login" type="submit" class="StyleTxtField" id="Login" form="loginform" value="Login"></td>
                    <td>&nbsp;</td>
                  </tr>
                </tbody>
              </table></td>
            </tr>
          </tbody>
        </table>
      </form>
    </div>
  </div>
<div id="footer"></div>
</div>
</body>
</html>
<?php
mysql_free_result($Login);
?>
