<?php

include('inc/db_conn.php');

date_default_timezone_set("America/Chicago");

//==========================
// For days
//==========================

$sql_hours = "SELECT ";
$sql_hours .= "DATE_FORMAT(start_time, '%b %D') AS start_date ";
$sql_hours .= "FROM time_slots ";
$sql_hours .= "GROUP BY start_date ";
$sql_hours .= "ORDER BY start_time";

$total_hours = @mysql_query($sql_hours, $connection) or die("Error #". mysql_errno() . ": " . mysql_error());
$total_found_hours = @mysql_num_rows($total_hours);

$last_start_date = '';

do {

  if ($row['start_date'] != '')
  {
  if ($row['start_date'] != $last_start_date) 
   {
    $display_block_date .="<td><strong>" . $row['start_date'] . "</strong></td>";
    }
  }
}
while ($row = mysql_fetch_array($total_hours));

//==========================
// For time slots
//==========================

$sql_time_slots = "SELECT ";
$sql_time_slots .= "time_slots.id, ";
$sql_time_slots .= "donor_id, ";
$sql_time_slots .= "DATE_FORMAT(start_time, '%b %d') AS start_date, ";
$sql_time_slots .= "DATE_FORMAT(start_time, '%H:%i') AS start_time_f, ";
$sql_time_slots .= "DATE_FORMAT(end_time, '%H:%i') AS end_time_f ";
$sql_time_slots .= "FROM time_slots ";
$sql_time_slots .= "LEFT JOIN selections ";
$sql_time_slots .= "ON time_slots.id = time_slot_id ";
$sql_time_slots .= "ORDER BY start_time_f, start_time";

$total_time_slots = @mysql_query($sql_time_slots, $connection) or die("Error #". mysql_errno() . ": " . mysql_error());
$total_found_time_slots = @mysql_num_rows($total_time_slots);
$row_color=($row_count%2)?$row_1:$row_2;

$last_hour = '';
$last_date = '';

do {

  if ($row['start_time_f'] != '')
  {
  if ($row['start_time_f'] != $last_hour) 
   {
$display_block .="<tr>
";
  if ($row['donor_id'] != "") 
    {
  $display_block .="<td class=\"taken\">" . $row['start_time_f'] . "</td>";
    }
    else
    {
  $display_block .="<td><input type=\"checkbox\" name=\"time_slot_" . $row['id'] . "\" value=\"" . $row['id'] . "\">" . $row['start_time_f'] . "</td>";
    }
  $last_hour = $row['start_time_f'];
    }
    else 
    {
  if ($row['donor_id'] != "") 
    {
  $display_block .="<td class=\"taken\">" . $row['start_time_f'] . "</td>";
    }
    else
    {
  $display_block .="<td><input type=\"checkbox\" name=\"time_slot_" . $row['id'] . "\" value=\"" . $row['id'] . "\">" . $row['start_time_f'] . "</td>";
    }
  $last_hour = $row['start_time_f'];
    }
  if ($row['start_date'] == "Mar 31")
  {
  $display_block .="
  </tr>
  ";
  }
}
}
while ($row = mysql_fetch_array($total_time_slots));





//  <tr>
//    <td><input type=\"checkbox\" name=\"time_slot\" value=\"$value 00:00\">00:00</td>
//  </tr>


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

<div style="background: #fff url('img/ice_web background.jpg')  no-repeat right top;;">
<p style="line-height: 1.4em;">The Madison Valley Medical Center Foundation, a non-profit corporation, has created an on-line fundraising raffle called "Ice Jam" where time slots are sold to predict the date and time within one hour, that the Madison River will ice gorge - for the first time - at the Ennis Bridge, located just south of downtown Ennis, MT.</p>

<p>The one individual who purchases the correct date and time within the hour that the Madison River ice gorges will win-half of the proceeds raised at Ice Jam! The Madison Valley Medical Center Foundation will retain the other half of the proceeds raised.</p>

<p>$20 buys a 1-hour time slot. You may purchase as many slots as you wish. The odds of winning are based on the total number of time slots sold and climatological activity.</p>

<p>If no one purchases the winning time slot and/or if the Madison River does not ice gorge at the Ennis Bridge, the Madison Valley Medical Center Foundation will retain half of the proceeds raised and the other half of the proceeds raised will roll-over to the following year's Ice Jam fundraiser proceeds.</p>

<div style="height:12em; width:95%; border:1px solid #ccc; overflow:auto; background:#f8f1d3;padding:0.5em;font-size:0.9em;">

<p>Madison Valley Medical Center Foundation "ICE JAM" Fundraiser Terms and Conditions</p>

<p>I. INTRODUCTION</p>

<p>Please read these terms and conditions carefully before using this Website.</p>

<p>Thank you for visiting the Madison Valley Medical Center Foundation's website, which includes www.MVMCF.ORG and ICE-JAM.COM; ICE-JAM.NET; ICE-JAM.ORG; ICE-JAM.INFO; ICEJAM.INFO; ICEJAM.NET; OR ICEJAM.ORG (collectively, this "Website"). The purchase of Internet time slots on this Website is strictly limited to persons who are at least 18 years or older and that you "represent" that you are; and who are not affiliated with the Madison Valley Medical Center Foundation. Failure to comply with any of these requirements will result in forfeiture of winnings.</p>

<p>For purposes of these Terms and Conditions, "you" and "your" means each person, group of individuals, entity or entities who visits this Website for any purpose.</p>

<p>The following terms and conditions ("Terms and Conditions") govern your use of this Website. These Terms and Conditions are a binding legal agreement between you and the Madison Valley Medical Center Foundation. By visiting this Website, you agree to be bound by these Terms and Conditions.</p>

<p>The Madison Valley Medical Center Foundation may change these Terms and Conditions at any time without notice to you by posting changes on this Website. The Madison Valley Medical Center Foundation encourages you to review these Terms and Conditions from time to time. Your continued use of this Website following the posting of any changes will mean that you accept the revised Terms and Conditions.</p>

<p>If you do not agree with these Terms and Conditions, you should immediately stop using this Website.</p>

<p>II. USE OF WEBSITE AND WEBSITE MATERIAL</p>

<p>You agree to access and use this Website only for lawful reasons. You are responsible for knowing and complying with any and all laws, statutes, rules and regulations pertaining to your use of this Website.</p>

<p>The official record of all time slot purchases and the winning time slot will be maintained by the Madison Valley Medical Center Foundation. All validated winnings over $XXX will be evaluated by the Office of the State Comptroller to determine if they are subject to any applicable offset(s).</p>

<p>A. Internet Time Slots</p>

<p>You will be able to utilize this Website to purchase time slots for the Madison Valley Medical Center Foundation's "Ice Jam" fundraiser. By purchasing an Internet time slot via PayPal&reg;, you authorize the Madison Valley Medical Center Foundation to deduct the purchase price of each time slot from your PayPal&reg;, credit card or checking account.</p>

<p>Internet Time Slots may be purchased using this Website up until the Madison River ice gorges for the first time during this fundraiser. The Executive Director of the Madison Valley Medical Center Foundation in their sole discretion determines when the Madison River ice gorges for the first time and thus a winner is determined.</p>

<p>III. LINKS AND THIRD PARTIES</p>

<p>This Website may contain links to third party Websites or Facebook. These links are provided solely as a convenience to you. If you click on any of these links, you will leave this Website. The Madison Valley Medical Center Foundation does not control, and is not responsible for, any third party Websites or their content.</p>

<p>IV. OWNERSHIP OF INTELLECTUAL PROPERTY</p>

<p>The Madison Valley Medical Center Foundation and its agents, contractors, and any parties involved in creating, producing, or delivering this Website and licensors (and each of their respective successors and assigns) own the copyrights, trademarks, service marks, and trade dress rights to all materials and content displayed on and from this Website (collectively referred to as "Intellectual Property"). You may not reproduce, modify, create derivative works from, display, frame, perform, publish, distribute, disseminate, transmit, broadcast or circulate any such materials or content to any third party (including displaying or distributing the Intellectual Property using a third party Website) without the prior written consent of the Madison Valley Medical Center Foundation or its contractors, or licensors, as applicable, except to use this Website for its intended purpose.</p>

<p>V. DISCLAIMERS AND LIMITATION OF LIABILITY</p>

<p>A. Disclaimer of Liability</p>

<p>The Madison Valley Medical Center Foundation is not liable for any direct, indirect, incidental, consequential, or punitive damages (including, without limitation, those resulting from lost profits, lost data, or business interruption) arising out of your access to, use of, or inability to use, this Website or any material from this Website, including but not limited to damages caused by any failure of performance, interruption (including those disruptions described including: error, omission, deletion, defect, delay in operation or transmission, computer virus, security, communication line failure, theft, destruction or unauthorized access to, alteration of, or use of record, whether for breach of contract, tortious behavior, negligence or under any other cause of action. Without limiting the foregoing, this Website and the material provided on this Website are provided "AS IS" WITHOUT WARRANTY OF ANY KIND, EITHER EXPRESSED OR IMPLIED. ANY CLAIMS FOR DAMAGES WILL BE LIMITED TO THE PRICE OF EACH INTERNET TIME SLOT PURCHASED VIA THIS WEBSITE.</p>

<p>B. Disclaimer of Accuracy of Data</p>

<p>The Madison Valley Medical Center Foundation makes no warranties or representations as to the accuracy, completeness or timeliness of the materials, or content provided on this Website and assumes no liability or responsibility for any errors or omissions on this Website. No warranty, expressed or implied, is made regarding accuracy, adequacy, completeness, legality, reliability or usefulness of any materials or content. This disclaimer applies to both isolated and aggregate uses of the materials or content. If you find any errors or omissions, we encourage you to report them to MVMCF.org.</p>

<p>The Madison Valley Medical Center Foundation makes every effort possible to make sure that the winning time slot information posted on this Website is accurate and available within a reasonable amount of time after river ice gorges.</p>

<p>C. Disclaimer of Endorsement</p>

<p>The Madison Valley Medical Center Foundation may from time to time distribute content supplied by third parties. Any opinions, advice, statements, services, offers, or other information or content expressed or made available by third parties, including information providers, users, or others, are those of the respective author(s) or distributor(s) and do not necessarily state or reflect the opinion of the Madison Valley Medical Center Foundation for advertising or product endorsement purposes. Reference herein to any specific commercial products, process, or service by trade name, trademark, manufacturer, or otherwise, does not constitute or imply its endorsement, recommendation, or favoring by the Madison Valley Medical Center Foundation.</p>

<p>VI. APPLICABLE LAW</p>

<p>Any dispute arising out of your use of this Website or material or content from this Website shall be resolved according to the laws of the State of Montana, United States of America. If you are an Out Of State Residence, you agree to be subject to Montana Law and the Foundation is not responsible if not allowed in your state.</p>

<p>VII. INTERNET PRIVACY AND SECURITY</p>

<p>Due to the design of the Internet, the Madison Valley Medical Center Foundation cannot guarantee that communications between you and the Foundation will be free from unauthorized access by third parties or will be secure. By agreeing to these Terms and Conditions, you expressly agree that your use of this Website is at your sole risk, and you agree that the Madison Valley Medical Center Foundation shall not be liable if a security breach occurs, or if this Website malfunctions, except as determined by law.</p>

<p>VIII. POTENTIAL DISRUPTION OF SERVICE</p>

<p>Access to this Website may from time to time be unavailable, delayed, limited or slowed due to, but not limited to, the following:</p>

<p>Scheduled daily maintenance;</p>

<p>emergency (unscheduled) maintenance;</p>

<p> hardware failure, including but not limited to, failures of computers (including your own computer), servers, networks, connections, and other electronic and mechanical equipment;</p>

<p>software failure, including but not limited to, bugs, errors, viruses, configuration problems, incompatibility of systems, utilities or applications, the operation of firewalls or screening programs, unreadable codes, or irregularities within particular documents or other content;</p>

<p>overload of system capacities;</p>

<p>damage caused by severe weather, earthquakes, act of God, accident, fire, water damage, explosion, mechanical breakdown or natural disasters;</p>

<p>interruption (whether partial or total) of power supplies or other utility or service (including the Internet);</p>

<p>or other similar disruptions.</p>

<p>VIIII. CONTACT US</p>

<p>Any questions regarding these Terms and Conditions should be directed to MVMCF.ORG or 406-682-6641.</p>
</div>

<p>By checking the "I Accept the Terms and Conditions" box and clicking the "Continue" button on this page, you acknowledge you have read and agree to the above Terms & Conditions.</p>

<div style="text-align: center;"><input type="checkbox" name="TandCs" />I Accept the Terms and Conditions</div>

<hr />

<div class="story"> <img src="img/taken.gif" alt="slider" /> - boxes are taken, please make another selection   </div> 

<div class="row">
  <div class="cell"><img src="img/left_arrow.png"  style="margin: 0.75em 2em 0 11em;" /></div>
  <div class="cell"><p style="text-align: center;">Use scroll bar at table bottom to scroll to future dates.</p></div>
  <div class="cell"><img src="img/right_arrow.png"  style="margin: 0.75em 0 0 2em;" /></div>
</div>

<form id="gorge1" action="checkout.php" method="post">
<div class="row">
<div class="scrolls">
<div class="tables">
  <div class="cell">
<table width="100" class="hourly" cellspacing="0">
<tr >
  <?php echo $display_block_date ?>
</tr>
 <?php echo $display_block ?>
</table>
</div>
</div>
</div>
</div> 
<div style="clear: both;"></div>
<div class="row">
  <div class="cell"><img src="img/left_arrow.png"  style="margin: 0.75em 2em 0 15em;" /></div>
  <div class="cell"><p style="text-align: center;">Use scroll bar to scroll to other dates.</p></div>
  <div class="cell"><img src="img/right_arrow.png"  style="margin: 0.75em 0 0 2em;" /></div>
</div>
<div align="center" style="margin: 1em 0 0 0;">
  <input type="submit" name="checkout" />
</div>
</form>

<!-- close row div -->




    <div class="story"> <img src="img/taken.gif" alt="slider" /> - boxes are taken, please make another selection   </div> 
</div> 

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
