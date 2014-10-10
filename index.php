<?php

include('inc/db_conn.php');

date_default_timezone_set("America/Chicago");

//==========================
// For days
//==========================

$sql_hours = "SELECT ";
$sql_hours .= "DATE_FORMAT(start_time, '%b %D') AS start_date ";
$sql_hours .= "FROM time_slots ";
$sql_hours .= "WHERE start_time > \"2014-11-01\" ";
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
    $display_block_date .="<td class=\"time_table_header\">" . $row['start_date'] . "</td>";
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
$sql_time_slots .= "WHERE start_time > \"2014-11-01\" ";
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
  $display_block .="<td class=\"time_table_body\"><input type=\"checkbox\" name=\"time_slot_" . $row['id'] . "\" value=\"" . $row['id'] . "\">" . $row['start_time_f'] . "</td>";
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
  $display_block .="<td class=\"time_table_body\"><input type=\"checkbox\" name=\"time_slot_" . $row['id'] . "\" value=\"" . $row['id'] . "\">" . $row['start_time_f'] . "</td>";
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

?>

<!DOCTYPE html>
<html>
<head>
<title>Ice Jam: supporting Madison Valley Medical Center Foundation</title>
<meta name="description" content= "Madison Valley Medical Center (MVMC) Foundation supporting high quality health care with modern services and qualified professionals"/>
<link rel="stylesheet" href="inc/gorge_styles.css" type="text/css">

<script src="inc/jquery.min.js" type="text/javascript">
        </script>


<script type="text/javascript">

// TandCs
// if the TandCs checkbox is checked, and a time slot is picked, enable button
$(document).ready(function () {
//$('input[id=checkout]').prop('disabled', true);
    $(document.getElementById("TandCs")).change(function () {

        var total = 0;
//        $(":checkbox:checked").each(function () {
//            total += 1;
//        });

        if (document.getElementById("TandCs").checked === true) { 
            $('input[id=checkout]').prop('disabled', false);
        } else {
            $('input[id=checkout]').prop('disabled', true);
        }
    });
});

</script>

</head>

<body>

<?php include_once("inc/analyticstracking.php") ?>

<div id="container">
<div id="page_content">

<section id="header">
<a href="index.php"><img src="img/ICE_website_topbanner.jpg" width="95%" /></a>
</section>

<section id="content_left">
<h2>Learn More</h2>
<p>Ice Jam supports the Madison Valley Medical Center Foundation. <a href="http://mvmcf.org/">Visit our site</a> to learn more about what we do.</p>
</section>

<section id="content_main">

<h1>Ice Jam 2014</h1>

<p>The Madison Valley Medical Center Foundation, a non-profit corporation, has created an on-line fundraising raffle called "Ice Jam" where time slots are sold to predict the date and time within one hour, that the Madison River will ice gorge - for the first time - at the Ennis Bridge, located just south of downtown Ennis, MT.</p>

<p>The one individual who purchases the correct date and time within the hour that the Madison River ice gorges will win-half of the proceeds raised at Ice Jam! The Madison Valley Medical Center Foundation will retain the other half of the proceeds raised.</p>

<h1>$5 buys a 1-hour time slot</h1>

<div style="float: left; margin: 2em 1em 2em 0;"><img src="img/raffle.png" width="166" height="118" alt="raffle"  /></div><p>You may purchase as many slots as you wish. The odds of winning are based on the total number of time slots sold and climatological activity.</p>

<a name="tocs"></a>
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

<p>The official record of all time slot purchases and the winning time slot will be maintained by the Madison Valley Medical Center Foundation. Winnings of $6,000 or more are required to be reported to the Internal Revenue Service and are subject to 28% withholding.  The Winner will be required to provide their name, address, and Social Security number in order to collect raffle proceeds.</p>

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

<p>By checking the "I Accept the Terms and Conditions" box and clicking the "Submit" button on this page, you acknowledge you have read and agree to the above Terms & Conditions.</p>

<div style="text-align: center;"><input type="checkbox" id="TandCs" name="TandCs" value="Accept" />I Accept the Terms and Conditions</div>

<hr />

<div class="row">
  <div class="cell" style="width:70px; margin: 0 0 0 15%;"><img src="img/taken.gif" alt="taken" /></div>
  <div class="cell" style="width:20%;"><span style="float: left; margin: 0 0 0 0; font-style: italic; color: #333;"> - indicates boxes are taken, please make another selection</span></div>
</div>

<div class="row">
  <div class="cell" style="width:20%;"><img src="img/left_arrow.png"  style="float: right;margin: 0.75em 0 0;" /></div>
  <div class="cell" style="width:65%;text-align: center;"><p>Use scroll bar at table bottom to scroll to future dates.</p></div>
  <div class="cell" style="width:10%;"><img src="img/right_arrow.png"  style="margin: 0.75em 0 0;" /></div>
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
  <div class="cell" style="width:20%;"><img src="img/left_arrow.png"  style="float: right;margin: 0.75em 0 0;" /></div>
  <div class="cell" style="width:65%;text-align: center;"><p>Use scroll bar at table bottom to scroll to future dates.</p></div>
  <div class="cell" style="width:10%;"><img src="img/right_arrow.png"  style="margin: 0.75em 0 0;" /></div>
</div>

<div class="row">
  <div class="cell" style="width:70px; margin: 0 0 2em 15%;"><img src="img/taken.gif" alt="taken" /></div>
  <div class="cell" style="width:20%;"><span style="float: left; margin: 0 0 0 0; font-style: italic; color: #333;"> - indicates boxes are taken, please make another selection</span></div>
</div>

<div align="center" style="margin: 0 0 0 0;">
  <input type="submit" id="checkout" name="checkout" disabled="true"/><br />
<span style="font-size: 0.75em; color: #333;">You must accept the Terms and Conditions (<a href="#tocs">above</a>) to enable Submit button</span><br />
</div>
</form>

<!-- close row div -->



</section>


<div style="clear: both;"></div>

<section id="footer">
  <?php include("inc/footer.php") ?>
</section>
</div>

</body>
</html>
