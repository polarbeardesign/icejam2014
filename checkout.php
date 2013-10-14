<?php


$ccards = array('' => 'Choose', '002' => 'MasterCard', '001' => 'Visa', '003' => 'American Express', '004' => 'Discover');
$months = array('' => 'mm', '01' => '01', '02' => '02', '03' => '03', '04' => '04', '05' => '05', '06' => '06', '07' => '07', '08' => '08', '09' => '09', '10' => '10', '11' => '11', '12' => '12');
$years = array('' => 'yyyy', '2012' => '2012', '2013' => '2013', '2014' => '2014', '2015' => '2015', '2016' => '2016', '2017' => '2017', '2018' => '2018', '2019' => '2019', '2020' => '2020', '2021' => '2021');

include('inc/db_conn.php');

//print_r($_POST);

$length = count($_POST) - 1;
$selections = array_slice($_POST, 0, $length, true);

$total_cost = 10 * $length;

$time_slot_id .= "(";
foreach ($selections as $key => $selections)
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

<h1 style="">Ice Jam</h1>

<h2>Predict the Madison River Gorge Fundraiser</h2>

<p>You have picked the following <?php if ($length > 1) {echo "$length timeslots";} else {echo "timeslot";} ?> for the river to gorge:</p>

<table cellspacing="0" style="margin: 0 0 0 4em;">
<tr >
 <?php echo $display_block ?>
</tr>
</table>
<p>For a total of <strong>$<?php echo number_format($total_cost,2) ?></strong>.</p>


<p>If you would like to enter these times into the contest, fill out and submit the form below.</p>

<hr />
<form id="formID" method="post" name="PaymentInfo" action="thank_you.php">

<h3 style="margin: 1em 0 1em 0;">Contact Information</h3>

<table class="indent" style="margin: 0 0 0 4em;">
    <tr>
    <td class="no_brder" colspan='2'><label for="FirstName">* First Name</label><br /><input class="validate[required] text-input" type='text' id='FirstName' name='shipTo_firstName' value=''></td>
    <td class="no_brder" colspan='2'><label for="">* Last Name</label><br /><input class="validate[required] text-input" type='text' id='LastName' name='shipTo_lastName' value=''></td>
    <td class="no_brder" colspan='2'><label for="">Affiliation/Company</label><br /><input type='text' name='affiliation' value=''></td>
    </tr>
    <tr>
      <td class="no_brder" colspan='2'><label for="">* Email</label><br /><input class="validate[required,custom[email]]" type='text' id='email' name='billTo_email' value=''></td>
      <td class="no_brder" colspan='2'><label for="">* Confirm Email</label><br /><input class="validate[required,equals[email]]" type='text' id='ecom_billto_online_email' name='ecom_billto_online_email' value=''></td>
    </tr>
    <tr>
      <td class="no_brder" colspan='2'><label for="">Address 1</label><br /><input type='text' id='Addr1'  name='shipTo_street1' value=''></td>
      <td class="no_brder" colspan='4'><label for="">Address 2</label><br /><input type='text' id='Addr2' name='shipTo_street2' value=''></td>
    </tr>
    <tr>
    <td class="no_brder" colspan='2'><label for="">City</label><br /><input type='text' id='City' name='shipTo_city' value=''></td>
    <td class="no_brder"><label for="">State</label><br /><input type='text' size='3' id='State' name='shipTo_state' value=''></td>
    <td class="no_brder"><label for="">Zip</label><br /><input type='text' size='10' id='ZipCode' name='shipTo_postalCode' value=''></td>
    <td class="no_brder"> </td>

    </tr>
</table>

<h3 style="margin: 2em 0 1em 0;">Payment Information</h3>

<table class="indent" style="margin: 0 0 0 4em;">
    <tr>
        <td class="no_brder" ><label for="">* Credit Card Number</label><br /><input  class="validate[required,creditCard] text-input" type='text' id='ecom_payment_card_number' name='card_accountNumber' value=''></td>
        <td class="no_brder" ><label for="">* Card Type:</label><br />
            <select class="validate[required]" id="card_cardType" name='card_cardType'>
            <?php foreach ($ccards as $key => $card_cardType) {
            echo "<option value='$key'>$card_cardType</option>";
            } ?></select>
        </td>
        <td class="no_brder"><label for="">* Expiration Date</label><br />
        <select class="validate[required]" id='ecom_payment_card_expdate_month' name='card_expirationMonth'>
           <?php foreach ($months as $key =>  $card_expirationMonth) {
            echo "<option value='$key'>$card_expirationMonth</option>";
            } ?></select>
        <select class="validate[required]" id='ecom_payment_card_expdate_year' name='card_expirationYear'>
           <?php foreach ($years as $key =>  $card_expirationYear) {
            echo "<option value='$key'>$card_expirationYear</option>";
            } ?></select>
      </td>
    </tr>
</table>

<h3 style="margin: 2em 0 1em 0;">Credit Card Billing Information</h3>

<table class="form indent" style="margin: 0 0 0 4em;">

    <tr><td class="no_brder" colspan='6'>Same as contact information <input type="checkbox" name="SameBillAsShip" id="SameBillAsShip""/></td></tr>
    <tr>
      <td class="no_brder" colspan='3'><label for="">* First Name</label><br /><input class="validate[required] text-input" type='text' size="24" id='ecom_billto_postal_name_first' name='billTo_firstName' value=''></td>
        <td class="no_brder" colspan='3'><label for="">* Last Name</label><br /><input class="validate[required] text-input" type='text' size="24" id='ecom_billto_postal_name_last' name='billTo_lastName' value=''></td>
    </tr>
    <tr>
        <td class="no_brder" colspan='3'><label for="">* Address 1</label><br /><input class="validate[required] text-input" type='text'  id='ecom_billto_postal_street_line1' name='billTo_street1' value=''></td>
        <td class="no_brder" colspan='3'><label for="">Address 2</label><br /><input type='text'  id='ecom_billto_postal_street_line2' name='billTo_street2' value=''></td>
    </tr>
    <tr>
        <td class="no_brder" colspan='2'><label for="">* City</label><br /><input class="validate[required] text-input" type='text' size="15" id='ecom_billto_postal_city' name='billTo_city' value=''></td>
        <td class="no_brder"><label for="">* State</label><br /><input class="validate[required] text-input" type='text' size="3" id='ecom_billto_postal_stateprov' name='billTo_state' value=''></td>
        <td class="no_brder"><label for="">* Zip</label><br /><input class="validate[required] text-input" type='text' size="11" id='ecom_billto_postal_postalcode' name='billTo_postalCode' value=''></td>
    </td>
    </tr>
    <tr>
      <td class="no_brder" colspan='6'><label for="">* Phone</label><br /><input class="validate[required,custom[phone]]" type='text' id='phone' name='billTo_phoneNumber' value=''></td>
    </tr>
</table>

<?php
foreach ($slots_chosen_array as $key => $selections)
{
echo "<input type=\"hidden\" name=\"time_ids[]\" value=$selections />";
}
?>
<hr />
<div align="center">
  <input type="submit" name="Submit" value="Submit">
</div>
</form>


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
