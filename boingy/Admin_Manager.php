<?php @session_start(); ?>
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

$currentPage = $_SERVER["PHP_SELF"];

if ((isset($_POST['deleteUserhiddenField'])) && ($_POST['deleteUserhiddenField'] != "")) {
  $deleteSQL = sprintf("DELETE FROM ``user`` WHERE UserID=%s",
                       GetSQLValueString($_POST['deleteUserhiddenField'], "int"));

  mysql_select_db($database_localhost, $localhost);
  $Result1 = mysql_query($deleteSQL, $localhost) or die(mysql_error());

  $deleteGoTo = "/boingy/Admin_Manager.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $deleteGoTo));
}

$maxRows_ManageUsers = 10;
$pageNum_ManageUsers = 0;
if (isset($_GET['pageNum_ManageUsers'])) {
  $pageNum_ManageUsers = $_GET['pageNum_ManageUsers'];
}
$startRow_ManageUsers = $pageNum_ManageUsers * $maxRows_ManageUsers;

mysql_select_db($database_localhost, $localhost);
$query_ManageUsers = "SELECT * FROM `user` ORDER BY `Timestamp` DESC";
$query_limit_ManageUsers = sprintf("%s LIMIT %d, %d", $query_ManageUsers, $startRow_ManageUsers, $maxRows_ManageUsers);
$ManageUsers = mysql_query($query_limit_ManageUsers, $localhost) or die(mysql_error());
$row_ManageUsers = mysql_fetch_assoc($ManageUsers);

if (isset($_GET['totalRows_ManageUsers'])) {
  $totalRows_ManageUsers = $_GET['totalRows_ManageUsers'];
} else {
  $all_ManageUsers = mysql_query($query_ManageUsers);
  $totalRows_ManageUsers = mysql_num_rows($all_ManageUsers);
}
$totalPages_ManageUsers = ceil($totalRows_ManageUsers/$maxRows_ManageUsers)-1;

$queryString_ManageUsers = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_ManageUsers") == false && 
        stristr($param, "totalRows_ManageUsers") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_ManageUsers = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_ManageUsers = sprintf("&totalRows_ManageUsers=%d%s", $totalRows_ManageUsers, $queryString_ManageUsers);
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
	  <h1>Admin Control Panel</h1>
	</div>
	<div id="contentleft">
	  <h2><a href="/boingy/Admin.php">Admin Home</a></h2>
	  <p><a href="/boingy/LogOut.php">Logout</a></p>
	  <h6>&nbsp;</h6>
	  <p>&nbsp;</p>
	</div>
    <div id="contentright">
      <table width="670" border="0" align="center">
        <tbody>
          <tr>
            <td align="right" valign="top">Showing&nbsp;<?php echo ($startRow_ManageUsers + 1) ?> to <?php echo min($startRow_ManageUsers + $maxRows_ManageUsers, $totalRows_ManageUsers) ?>of <?php echo $totalRows_ManageUsers ?></td>
          </tr>
          <tr>
            <td align="center" valign="top"><?php if ($totalRows_ManageUsers == 0) { // Show if recordset empty ?>
              <?php do { ?>
                  <table width="500" border="0">
                    <tbody>
                      <tr>
                        <td align="left"><?php echo $row_ManageUsers['FirstName']; ?><?php echo $row_ManageUsers['LastName']; ?><?php echo $row_ManageUsers['Email']; ?></td>
                      </tr>
                      <tr>
                        <td><form id="DeleteUser" name="DeleteUser" method="post">
                          </form>
                          <input name="deleteUserhiddenField" type="hidden" id="deleteUserhiddenField" form="DeleteUser" value="<?php echo $row_ManageUsers['UserID']; ?>">
                        <input type="submit" name="Delete User" id="Delete User" value="Delete User"></td>
                      </tr>
                    </tbody>
                  </table>
                  <?php } while ($row_ManageUsers = mysql_fetch_assoc($ManageUsers)); ?>
            <?php } // Show if recordset empty ?></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td align="right" valign="top"><p>
              <?php if ($pageNum_ManageUsers < $totalPages_ManageUsers) { // Show if not last page ?>
                <a href="<?php printf("%s?pageNum_ManageUsers=%d%s", $currentPage, max(0, $pageNum_ManageUsers - 1), $queryString_ManageUsers); ?>">Next</a>
                <?php } // Show if not last page ?>
|
<?php if ($pageNum_ManageUsers > 0) { // Show if not first page ?>
  <a href="<?php printf("%s?pageNum_ManageUsers=%d%s", $currentPage, max(0, $pageNum_ManageUsers - 1), $queryString_ManageUsers); ?>">Previous</a>
  <?php } // Show if not first page ?>
            </p></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
<div id="footer"></div>
</div>
</body>
</html>
<?php
mysql_free_result($ManageUsers);
?>
