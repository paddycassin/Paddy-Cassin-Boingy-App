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
	  <h1>Boingy Home</h1>
	</div>
	<div id="contentleft">
	  <h2>Returning User: 
	    <input name="login" type="submit" class="StyleTxtField" id="login" formaction="/boingy/Login2.php" value="Login">
	  </h2>
	  <h2>New User:
	    <input name="Register" type="submit" class="StyleTxtField" id="Register" formaction="/boingy/Register2.php" value="Register">
	  </h2>
	</div>
    <div id="contentright"></div>
  </div>
<div id="footer"></div>
</div>
</body>
</html>