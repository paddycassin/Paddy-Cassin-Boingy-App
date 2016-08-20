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
	  <h1>Email Password</h1>
	</div>
	<div id="contentleft">
	  <h2>Enter Registered Email</h2>
	  <p>&nbsp;</p>
	  <h6>Your Password Will be sent directly to you</h6>
	</div>
    <div id="contentright">
      <form action="/boingy/EmailPW-Script.php" method="post" name="Emailpwform" id="Emailpwform">
         <p>
           <input name="email" type="email" class="StyleTxtField" id="email" form="Emailpwform">
         </p>
         <p>
           <input name="emailpassword" type="button" class="StyleTxtField" id="emailpassword" form="Emailpwform" value="Email Password">
         </p>
      </form>
    </div>
  </div>
<div id="footer"></div>
</div>
</body>
</html>