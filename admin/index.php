<?php

//===============================================
//  USER AUTHORIZATION                         //
//===============================================
session_start();
if(!isset($_SESSION['formusername'])){
header("location:login.php");
}

include('../inc/db_conn.php');

date_default_timezone_set("America/Chicago");

//==========================
// For summary info
//==========================

$sql_summary_slots = "SELECT ";
$sql_summary_slots .= "COUNT(time_slot_id) AS qty ";
$sql_summary_slots .= "FROM selections ";
$sql_summary_slots .= "WHERE selections.created_at > \"2014-06-15\"";

$total_summary_slots = @mysql_query($sql_summary_slots, $connection) or die("Error #". mysql_errno() . ": " . mysql_error());
$total_found_summary_slots = @mysql_num_rows($total_summary_slots);

while ($row = mysql_fetch_array($total_summary_slots)) {

$qty=$row['qty'];
$revenue = number_format($qty * 20, 2);

}


//==========================
// For time slots
//==========================

$sql_time_slots = "SELECT ";
$sql_time_slots .= "time_slot_id, ";
$sql_time_slots .= "first_name, ";
$sql_time_slots .= "last_name, ";
$sql_time_slots .= "donor_id, ";
$sql_time_slots .= "DATE_FORMAT(start_time, '%b %d') AS start_date, ";
$sql_time_slots .= "DATE_FORMAT(start_time, '%H:%i') AS start_time_f, ";
$sql_time_slots .= "DATE_FORMAT(end_time, '%H:%i') AS end_time_f ";
$sql_time_slots .= "FROM selections ";
$sql_time_slots .= "LEFT JOIN  time_slots ";
$sql_time_slots .= "ON time_slots.id = time_slot_id ";
$sql_time_slots .= "LEFT JOIN  donors ";
$sql_time_slots .= "ON donors.id = donor_id ";
$sql_time_slots .= "WHERE selections.created_at > \"2014-06-15\" ";
$sql_time_slots .= "ORDER BY start_time_f, start_time";

$total_time_slots = @mysql_query($sql_time_slots, $connection) or die("Error #". mysql_errno() . ": " . mysql_error());
$total_found_time_slots = @mysql_num_rows($total_time_slots);
$row_color=($row_count%2)?$row_1:$row_2;

$last_hour = '';
$last_date = '';

do {
  if ($row['donor_id'] != "") 
    {
  $display_block .="<tr><td><a href=\"donor_detail.php?id=" . $row['donor_id'] . "\">" . $row['first_name'] . " ". $row['last_name'] . "</a></td>
                   <td>" . $row['start_date'] . " " . $row['start_time_f'] . "-" . $row['end_time_f'] . "</td></tr>";
    }
}

while ($row = mysql_fetch_array($total_time_slots));





?>

<!DOCTYPE html>
<html>
<head>
<title>Ice Jam: supporting Madison Valley Medical Center Foundation</title>
<meta name="description" content= "Madison Valley Medical Center (MVMC) Foundation supporting high quality health care with modern services and qualified professionals"/>
<link rel="stylesheet" href="../inc/gorge_styles.css" type="text/css">
</head>

<body>

<?php include_once("../inc/analyticstracking.php") ?>

<div id="container">
<div id="page_content">

<section id="header">
<a href="index.php"><img src="../img/ICE_website_topbanner.jpg" width="95%" /></a>
</section>

<section id="content_left">
<h2>Learn More</h2>
<p>Ice Jam supports the Madison Valley Medical Center Foundation. <a href="http://mvmcf.org/">Visit our site</a> to learn more about what we do.</p>
</section>

<section id="content_main">
  <p class="signout"><a href="logout.php">Logout</a></p>
<h1>Ice Jam Admin</h1>

<h2 style="margin: 1em 0;">Overview</h2>
<p>There have been <?php echo $qty ?> selections to date, totaling $<?php echo $revenue ?>.</p>
<h2>Donor List</h2>

<table class="legible">
 <tr>
   <th width="150"> Donor&nbsp;Name </th><th width="150">Selected&nbsp;Time</th>
  </tr>
 <?php echo $display_block ?>
</table>
</section>


<div style="clear: both;"></div>
</div>
<section id="footer">
  <?php include("../inc/footer.php") ?>
</section>
</div>

</body>
</html>
