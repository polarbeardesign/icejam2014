<?php


include('inc/db_conn.php');

//=======================================
// donors
//=======================================

$shipTo_firstName = ucfirst($_POST['shipTo_firstName']);
$shipTo_lastName = ucfirst($_POST['shipTo_lastName']);
$affiliation = $_POST['affiliation'];
$shipTo_street1 = $_POST['shipTo_street1'];
$shipTo_street2 = $_POST['shipTo_street2'];
$shipTo_city = ucfirst($_POST['shipTo_city']);
$shipTo_state = strtoupper($_POST['shipTo_state']);
$shipTo_postalCode = $_POST['shipTo_postalCode'];
$shipTo_country = "US";

//=======================================
// enter info into donors
//=======================================

$sql_donor = "INSERT INTO donors ";
$sql_donor .= "(client_id, ";
$sql_donor .= "first_name, ";
$sql_donor .= "last_name, ";
$sql_donor .= "affiliation, ";
$sql_donor .= "email, ";
$sql_donor .= "address1, ";
$sql_donor .= "address2, ";
$sql_donor .= "city, ";
$sql_donor .= "state, ";
$sql_donor .= "postal_code, ";
$sql_donor .= "country, ";
$sql_donor .= "created_at, ";
$sql_donor .= "updated_at) ";
$sql_donor .= "VALUES ";
$sql_donor .= "(\"$client_id\", ";
$sql_donor .= "\"$shipTo_firstName\", ";
$sql_donor .= "\"$shipTo_lastName\", ";
$sql_donor .= "\"$affiliation\", ";
$sql_donor .= "\"$billTo_email\", ";
$sql_donor .= "\"$shipTo_street1\", ";
$sql_donor .= "\"$shipTo_street2\", ";
$sql_donor .= "\"$shipTo_city\", ";
$sql_donor .= "\"$shipTo_state\", ";
$sql_donor .= "\"$shipTo_postalCode\", ";
$sql_donor .= "\"$shipTo_country\", ";
$sql_donor .= "NOW(), ";
$sql_donor .= "NOW())";

$result_donor = @mysql_query($sql_donor, $connection) or die("Error #". mysql_errno() . ": " . mysql_error());

//=======================================
// pull donor just entered to get donor.id
//=======================================

$sql_donor_id ="SELECT ";
$sql_donor_id .="id ";
$sql_donor_id .="FROM donors ";
$sql_donor_id .="WHERE email = \"$billTo_email\"";

$result_donor_id = @mysql_query($sql_donor_id, $connection) or die("Error #". mysql_errno() . ": " . mysql_error());
$total_found_donor_id = @mysql_num_rows($result_donor_id);

while ($row = mysql_fetch_array($result_donor_id))
{
  $donor_id = $row['id'];
}

//=======================================
// billings
//=======================================

$billTo_firstName = ucfirst($_POST['billTo_firstName']);
$billTo_lastName = ucfirst($_POST['billTo_lastName']);
$billTo_street1 = $_POST['billTo_street1'];
$billTo_street2 = $_POST['billTo_street2'];
$billTo_city = ucfirst($_POST['billTo_city']);
$billTo_state = strtoupper($_POST['billTo_state']);
$billTo_postalCode = $_POST['billTo_postalCode'];
$billTo_country = "US";
$billTo_phoneNumber = $_POST['billTo_phoneNumber'];

//=======================================
// enter info into billings
//=======================================

$sql_billing = "INSERT INTO billings ";
$sql_billing .= "(donor_id, ";
$sql_billing .= "first_name, ";
$sql_billing .= "last_name, ";
$sql_billing .= "address1, ";
$sql_billing .= "address2, ";
$sql_billing .= "city, ";
$sql_billing .= "state, ";
$sql_billing .= "postal_code, ";
$sql_billing .= "country, ";
$sql_billing .= "phone, ";
$sql_billing .= "created_at, ";
$sql_billing .= "updated_at) ";
$sql_billing .= "VALUES ";
$sql_billing .= "(\"$donor_id\", ";
$sql_billing .= "\"$billTo_firstName\", ";
$sql_billing .= "\"$billTo_lastName\", ";
$sql_billing .= "\"$billTo_street1\", ";
$sql_billing .= "\"$billTo_street2\", ";
$sql_billing .= "\"$billTo_city\", ";
$sql_billing .= "\"$billTo_state\", ";
$sql_billing .= "\"$billTo_postalCode\", ";
$sql_billing .= "\"$billTo_country\", ";
$sql_billing .= "\"$billTo_phoneNumber\", ";
$sql_billing .= "NOW(), ";
$sql_billing .= "NOW())";

$result_billing = @mysql_query($sql_billing, $connection) or die("Error #". mysql_errno() . ": " . mysql_error());

//=======================================
// time_slots
//=======================================

//=======================================
// enter info into time_slots
//=======================================

foreach ($_POST['time_ids'] as $key => $times_selected)
{
$sql_days ="INSERT INTO selections ";
$sql_days .="(donor_id, ";
$sql_days .="time_slot_id, ";
$sql_days .= "created_at, ";
$sql_days .= "updated_at) ";
$sql_days .="VALUES ";
$sql_days .="(\"$donor_id\", ";
$sql_days .="\"$times_selected\", ";
$sql_days .= "NOW(), ";
$sql_days .= "NOW())";
  
$result_days = @mysql_query($sql_days, $connection) or die("Error #". mysql_errno() . ": " . mysql_error());

}

//=======================================
// time_slots display
//=======================================

$time_slot_id .= "(";
foreach ($_POST['time_ids'] as $key => $selections)
{
$time_slot_id .= $selections.",";
}
$time_slot_id = substr($time_slot_id, 0, -1).")";
$slots_chosen_array = array();

//==========================
// For selections
//==========================

$sql_time_slots = "SELECT ";
$sql_time_slots .= "id, ";
$sql_time_slots .= "DATE_FORMAT(start_time, '%b %D') AS start_date, ";
$sql_time_slots .= "DATE_FORMAT(start_time, '%I:%i %p') AS start_time_f, ";
$sql_time_slots .= "DATE_FORMAT(end_time, '%I:%i %p') AS end_time_f ";
$sql_time_slots .= "FROM time_slots ";
$sql_time_slots .= "WHERE id IN $time_slot_id ";
$sql_time_slots .= "ORDER BY start_time_f, start_time";

$total_time_slots = @mysql_query($sql_time_slots, $connection) or die("Error #". mysql_errno() . ": " . mysql_error());
$total_found_time_slots = @mysql_num_rows($total_time_slots);

do {

  if ($row['start_time_f'] != '')
  {

$display_block .="<tr>
  <td style=\"padding: 0.5em; border-bottom: 1px solid #ccc;\">" . $row['start_date'] . "</td><td style=\"border-bottom: 1px solid #ccc;\">&nbsp;&nbsp;&nbsp; " . $row['start_time_f'] . " - " . $row['end_time_f'] . "</td>";
  $slots_chosen_array[] =  $row['id'];
  }
}
while ($row = mysql_fetch_array($total_time_slots));


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
<link rel="stylesheet" href="emx_nav_left.css" type="text/css">
<link rel="stylesheet" href="inc/gorge_styles.css" type="text/css">

        <link rel="stylesheet" href="inc/validationEngine.jquery.css" type="text/css"/>
        <!-- <link rel="stylesheet" href="inc/template.css" type="text/css"/> -->
        <script src="inc/jquery-1.6.min.js" type="text/javascript">
        </script>
        <script src="inc/languages/jquery.validationEngine-en.js" type="text/javascript" charset="utf-8">
        </script>
        <script src="inc/jquery.validationEngine.js" type="text/javascript" charset="utf-8">
        </script>
        <script>
            jQuery(document).ready(function(){
                // binds form submission and fields to the validation engine
                jQuery("#formID").validationEngine();
            });
        </script>
        
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
  <img alt="" src="tl_curve_white.gif" height="6" width="6" id="tl"> <img alt="" src="tr_curve_white.gif" height="6" width="6" id="tr"> 
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

<h1 style="">Ice Jam  - Thank You!</h1>

<h2>Predict the Madison River Gorge Fundraiser</h2>

<p>Thank you for your participation in the Predict the Madison River Gorge Fundraiser. Your donation helps fund vital services at the Madison Valley Medical Center Foundation.</p>

<p>The following information has been recorded.</p>

<table>
  <tr>
    <th colspan="2" style="text-align: left;">Donor Info</th>
    <th width="75">&nbsp;</th>
    <th colspan="2" style="text-align: left;">Billing Info</th>
  </tr>
  <tr>
    <td>Name:</td>
    <td><?php echo "$shipTo_firstName $shipTo_lastName" ?></td>
    <td>&nbsp;</td>
    <td>Name:</td>
    <td><?php echo "$billTo_firstName $billTo_lastName" ?></td>
  </tr>
  <tr>
    <td>Address:</td>
    <td><?php echo "$shipTo_street1" ?><?php if ($shipTo_street1 !="") { echo "<br />$shipTo_street2";} ?></td>
    <td>&nbsp;</td>
    <td>Address:</td>
    <td><?php echo "$shipTo_street1" ?><?php if ($shipTo_street1 !="") { echo "<br />$shipTo_street2";} ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><?php echo "$shipTo_city, $shipTo_state $shipTo_postalCode" ?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><?php echo "$billTo_city, $billTo_state $billTo_postalCode" ?></td>
  </tr>
</table>

<hr />
<h3>Times Selected</h3>


<table cellspacing="0" style="margin: 0 0 0 4em;">
<tr >
 <?php echo $display_block ?>
</tr>
</table>

</div> 
   <div id="siteInfo">     
     <div align="center" class="style8">
       <div align="left" class="style9"><span class="storyLeft"><a href="privacypolicy.htm">Privacy Policy</a> | <a href="sitemap.xml">Site Map</a> | &copy;2011 Madison Valley Medical Center Foundation, Inc. All rights reserved.</span></div>
     </div>
   </div> 
</div> 
<span class="storyLeft"><!--end pagecell1--> 
<br> 
<script type="text/javascript">
    <!--
      var menuitem1 = new menu(7,1,"hidden");
			var menuitem2 = new menu(7,2,"hidden");
			var menuitem3 = new menu(7,3,"hidden");
			var menuitem4 = new menu(7,4,"hidden");
			var menuitem5 = new menu(7,5,"hidden");
			var menuitem6 = new menu(7,6,"hidden");
			var menuitem7 = new menu(7,7,"hidden");
    // -->
    </script> 
</span>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-22017961-1']);
  _gaq.push(['_setDomainName', 'none']);
  _gaq.push(['_setAllowLinker', true]);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</body>
</html>
