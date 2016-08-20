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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "registerForm")) {
  $insertSQL = sprintf("INSERT INTO ``user`` (FirstName, LastName, Email, Username, Password) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['FirstName'], "text"),
                       GetSQLValueString($_POST['LastName'], "text"),
                       GetSQLValueString($_POST['Email'], "text"),
                       GetSQLValueString($_POST['Username'], "text"),
                       GetSQLValueString($_POST['password'], "text"));

  mysql_select_db($database_localhost, $localhost);
  $Result1 = mysql_query($insertSQL, $localhost) or die(mysql_error());

  $insertGoTo = "/boingy/Login2.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_localhost, $localhost);
$query_Homepage = "SELECT * FROM `user`";
$Homepage = mysql_query($query_Homepage, $localhost) or die(mysql_error());
$row_Homepage = mysql_fetch_assoc($Homepage);
$totalRows_Homepage = mysql_num_rows($Homepage);
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
	  <h1>Boingy Website</h1>
	</div>
	<div id="contentleft">
	  <h2>User Account</h2>
	  <p>&nbsp;</p>
	  <h6>Register</h6>
	  <p>&nbsp;</p>
	</div>
    <div id="contentright">
      <form action="<?php echo $editFormAction; ?>" method="POST" name="registerForm" id="registerForm" title="registerForm">
        <table width="600" border="0" align="center">
          <tbody>
            <tr>
              <td><table border="0">
                <tbody>
                  <tr>
                    <td><h6>
                      <label for="FirstName">First Name:</label>
                    </h6>
                      <p>
                        <input name="FirstName" type="text" class="StyleTxtField" id="FirstName" form="registerForm" title="FirstName">
                      </p></td>
                    <td><h6>
                      <label for="LastName">Last Name:</label>
                    </h6>
                      <p>
                        <input name="LastName" type="text" class="StyleTxtField" id="LastName" form="registerForm" title="LastName">
                      </p></td>
                  </tr>
                </tbody>
              </table></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td><h6>
                <label for="Email">Email:</label>
              </h6>
                <h6>&nbsp;</h6>
                <h6>
                  <input name="Email" type="email" class="StyleTxtField" id="Email" form="registerForm" title="Email">
              </h6></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td><p>
                <label for="Username">Username:</label>
              </p>
                <p>
                  <input name="Username" type="text" class="StyleTxtField" id="Username" form="registerForm" title="Username">
              </p></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td><table border="0">
                <tbody>
                  <tr>
                    <td><h6>
                      <label for="password">Password:</label>
                    </h6>
                      <p>
                        <input name="password" type="password" class="StyleTxtField" id="password" form="registerForm" title="password">
                      </p></td>
                    <td><h6>
                      <label for="password2">Confirm Password:</label>
                    </h6>
                      <p>
                        <input name="password2" type="password" class="StyleTxtField" id="password2" title="confirmpassword">
                      </p></td>
                  </tr>
                </tbody>
              </table></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td><input name="Register" type="submit" class="StyleTxtField" id="Register" form="registerForm" title="Register" value="Register"></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
          </tbody>
        </table>
        <input type="hidden" name="MM_insert" value="registerForm">
      </form>
    </div>
  </div>
<div id="footer"></div>
</div>
</body>
</html>
<?php
mysql_free_result($Homepage);
?>
