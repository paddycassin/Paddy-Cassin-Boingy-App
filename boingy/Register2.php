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

// *** Redirect if username exists
$MM_flag="MM_insert";
if (isset($_POST[$MM_flag])) {
  $MM_dupKeyRedirect="/boingy/Register2.php";
  $loginUsername = $_POST['Username'];
  $LoginRS__query = sprintf("SELECT Username FROM `user` WHERE Username=%s", GetSQLValueString($loginUsername, "text"));
  mysql_select_db($database_localhost, $localhost);
  $LoginRS=mysql_query($LoginRS__query, $localhost) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);

  //if there is a row in the database, the username was found - can not add the requested username
  if($loginFoundUser){
    $MM_qsChar = "?";
    //append the username to the redirect page
    if (substr_count($MM_dupKeyRedirect,"?") >=1) $MM_qsChar = "&";
    $MM_dupKeyRedirect = $MM_dupKeyRedirect . $MM_qsChar ."requsername=".$loginUsername;
    header ("Location: $MM_dupKeyRedirect");
    exit;
  }
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "registerform")) {
  $insertSQL = sprintf("INSERT INTO ``user`` (FirstName, LastName, Email, Username, Password) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['FirstName'], "text"),
                       GetSQLValueString($_POST['LastName'], "text"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['Username'], "text"),
                       GetSQLValueString($_POST['Password'], "text"));

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
$query_Register = "SELECT * FROM `user`";
$Register = mysql_query($query_Register, $localhost) or die(mysql_error());
$row_Register = mysql_fetch_assoc($Register);
$totalRows_Register = mysql_num_rows($Register);
 @session_start();?>
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
	  <h1>Boingy Sign Up</h1>
	</div>
	<div id="contentleft">
	  <h2>Create Your Account</h2>
	  <h6>&nbsp;</h6>
	  <p>&nbsp;</p>
	  <p>&nbsp;</p>
	</div>
    <div class="StyleTxtField" id="contentright">
<form action="<?php echo $editFormAction; ?>" id="registerform" name="registerform" method="POST">
  <table width="400" border="0" align="center">
    <tbody>
      <tr>
        <td><table border="0">
          <tbody>
            <tr>
              <td><h6>
                <label for="FirstName4">First Name:</label>
              </h6>
                <p>
                  <input name="FirstName" type="text" required="required" class="StyleTxtField" id="FirstName4" form="RegisterForm">
                </p>
                <h6>&nbsp;</h6></td>
              <td><h6>
                <label for="LastName">Last Name:</label>
              </h6>
                <p>
                  <input name="LastName" type="text" required="required" class="StyleTxtField" id="LastName" form="RegisterForm">
                </p>
                <h6>&nbsp;</h6></td>
            </tr>
          </tbody>
        </table></td>
      </tr>
      <tr>
        <td><h6>&nbsp;</h6></td>
      </tr>
      <tr id="Email">
        <td><h6>           <label for="Email" id="RegistrationForm">Email: <br>             
          <br>
          </label>           
          <input name="Email" type="email" required="required" class="StyleTxtField" id="Email" form="RegisterForm" accept="">         
          <br>
        </h6></td>
      </tr>
      <tr>
        <td><h6>&nbsp;</h6></td>
      </tr>
      <tr>
        <td><h6>
          <label for="Username">Username:</label>
        </h6>
          <p>&nbsp;</p>
          <h6>
            <input name="Username" type="text" required="required" class="StyleTxtField" id="Username" form="RegisterForm">
          </h6></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><table border="0">
          <tbody>
            <tr>
              <td><h6>
                <label for="Password">Password:</label>
              </h6>
                <p>&nbsp;</p>
                <h6>
                  <input name="Password" type="password" class="StyleTxtField" id="Password" form="RegisterForm">
                </h6></td>
              <td><h6>
                <label for="Password">Confirm Password:</label>
              </h6>
                <p>&nbsp;</p>
                <h6>
                  <input name="Password" type="password" class="StyleTxtField" id="Password" title="confirmpassword">
                </h6></td>
            </tr>
          </tbody>
        </table></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><input name="Register" type="submit" class="StyleTxtField" id="Register" form="registerform" formmethod="POST" value="Register"></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
    </tbody>
  </table>
  <input type="hidden" name="MM_insert" value="registerform">
</form>
    </div>
  </div>
<div id="footer"></div>
</div>
</body>
</html>
<?php
mysql_free_result($Register);
?>
