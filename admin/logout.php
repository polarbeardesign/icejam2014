<?php

include('../inc/db_conn.php');

date_default_timezone_set("America/Chicago");

session_start();

$_SESSION = array();

if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"]
    );
}

setcookie("username",'',0);

session_destroy();

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<!-- DW6 -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Madison Valley Medical Center Foundation</title>
<meta name="description" content= "Madison Valley Medical Center (MVMC) Foundation supporting high quality health care with modern services and qualified professionals"/>
<meta name="keywords" content= "Madison Valley Medical Center Foundation, MVMCF, MVMC, Madison Valley Medical Center, MADISON VALLEY MEDICAL CENTER, Montana Healthcare,
Montana Hospital Foundations, Ennis Montana, Ennis, 59729" />
<META name="Donita_Powell_Ennis_Montana_406-682-4477"/>
<link href='http://fonts.googleapis.com/css?family=Rye' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="../emx_nav_left.css" type="text/css">
<link rel="stylesheet" href="../inc/gorge_styles.css" type="text/css">
<script type="text/javascript">
<!--
var time = 3000;
var numofitems = 7;

//menu constructor
function menu(allitems,thisitem,startstate){ 
  callname= "gl"+thisitem;
  divname="subglobal"+thisitem;  
  this.numberofmenuitems = 7;
  this.caller = document.getElementById(callname);
  this.thediv = document.getElementById(divname);
  this.thediv.style.visibility = startstate;
}

//menu methods
function ehandler(event,theobj){
  for (var i=1; i<= theobj.numberofmenuitems; i++){
    var shutdiv =eval( "menuitem"+i+".thediv");
    shutdiv.style.visibility="hidden";
  }
  theobj.thediv.style.visibility="visible";
}
				
function closesubnav(event){
  if ((event.clientY <48)||(event.clientY > 107)){
    for (var i=1; i<= numofitems; i++){
      var shutdiv =eval('menuitem'+i+'.thediv');
      shutdiv.style.visibility='hidden';
    }
  }
}
// -->
</script>
<style type="text/css">
<!--
.style1 {font-size: 90%}
.style2 {
	color: #FFFFFF;
	font-size: 90%;
}
.style3 {
	font-size: 100%;
	color: #000000;
}
.style8 {color: #666666}
.style9 {color: #999999}
.style13 {font-size: smaller}
.style22 {color: #8397B8}
.style17 {font-size: 75%}
.style23 {color: #FFFFFF}
.style25 {color: #334d55}
.style10 {color: #005fa9}
.style16 {color: #000000;
	font-weight: bold;
}
.style18 {color: #000000}
.style101 {color: #005fa9}
-->
</style>
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_reloadPage(init) {  //reloads the window if Nav4 resized
  if (init==true) with (navigator) {if ((appName=="Netscape")&&(parseInt(appVersion)==4)) {
    document.MM_pgW=innerWidth; document.MM_pgH=innerHeight; onresize=MM_reloadPage; }}
  else if (innerWidth!=document.MM_pgW || innerHeight!=document.MM_pgH) location.reload();
}
MM_reloadPage(true);
//-->
</script>

</head>
<body onmousemove="closesubnav(event);"> 
<div class="skipLinks">skip to: <a href="#content">page content</a> | <a href="pageNav">links on this page</a> | <a href="#globalNav">site navigation</a> | <a href="#siteInfo">footer (site information)</a> </div>
<div id="masthead"> 
  <h1 class="style1" id="siteName"><span class="style22">Welcome to the Madison Valley Medical Center Foundation</span>
    <!-- end globalNav --> 
  </h1>
 
</div> 
<!-- end masthead --> 
<div id="pagecell1"> 
  <!--pagecell1--> 
  <img alt="" src="../tl_curve_white.gif" height="6" width="6" id="tl"> <img alt="" src="../tr_curve_white.gif" height="6" width="6" id="tr"> 
  <div id="breadCrumb"></div> 
  <div id="pageName">
    <h2 class="style2 style3">&nbsp;</h2>
    <h2 class="style2 style3"><br>
      <br>
      <br>
      <br>
      <br>
      ...
      <br>
    </h2>
  </div> 
  <div id="pageNav"> 
     <div id="sectionLinks"> 
      <a href="index.htm">Home</a> <a href="aboutus.htm">About Us...</a>
      <a href="dollarsatwork.htm">Foundation Dollars <br>
      at Work</a>  <a href="donation.htm">Support the Foundation...</a> <a href="shopandsupport.htm">Shop &amp; Support</a> <a href="news_events.htm">Newsletters &amp; Events </a><a href="contactus.htm">Contact Us </a> <a href="http://www.mvmedcenter.org">Madison Valley <br>
      Medical Center</a></div> 
    <div class="relatedLinks">
      <p>Area Links <br>
        <br>
      <a href="http:\\www.ennischamber.com" title="Ennis Chamber">Ennis Chamber</a> <a href="http:\\www.madison.mt.gov" title="Madison County, MT">Madison County</a></p>
    </div> 
  </div> 
  <div id="content"> 
     <div class="feature">
<p>&nbsp;</p>
<h1>Pick the Gorge Time Fundraiser</h1>
<p>You have successfully logged out of the Admin Section of Pick the Gorge Time Fundraiser.</p>

    <form name="form1" method="post" action="admin_auth.php">
        <table width="300" border="0" id="login">
            <tr> 
                <th colspan="2">Admin Login</th>
            </tr>
            <tr> 
                <td>User ID:</td>
                <td><input name="username" type="text" size=25 maxlength=255 /></td>
            </tr>
            <tr> 
                <td>Password:</td>
                <td><input name="password" type="password" size=25 maxlength=255 /></td>
            </tr>
            <tr> 
                <td>&nbsp;</td>
                <td> <input type="submit" name="Submit" value="Submit" /> </td>
            </tr>
            <?php if ($error != "") {
            echo "<tr><td colspan=\"2\"><div class=\"error\">$error</div></td></tr>";
            } ?>
        </table>
    </form>
</section>


<div style="clear: both;"></div>
</div>

</div>

</body>
</html>
