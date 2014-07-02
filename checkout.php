<?php


$ccards = array('' => 'Choose', '002' => 'MasterCard', '001' => 'Visa', '003' => 'American Express', '004' => 'Discover');
$months = array('' => 'mm', '01' => '01', '02' => '02', '03' => '03', '04' => '04', '05' => '05', '06' => '06', '07' => '07', '08' => '08', '09' => '09', '10' => '10', '11' => '11', '12' => '12');
$years = array('' => 'yyyy', '2012' => '2012', '2013' => '2013', '2014' => '2014', '2015' => '2015', '2016' => '2016', '2017' => '2017', '2018' => '2018', '2019' => '2019', '2020' => '2020', '2021' => '2021');

include('inc/db_conn.php');

//print_r($_POST);

if (count($_POST) == 1)
  { ?>

<!DOCTYPE html>
<html>
<head>
<title>Ice Jam: supporting Madison Valley Medical Center Foundation</title>
<meta name="description" content= "Madison Valley Medical Center (MVMC) Foundation supporting high quality health care with modern services and qualified professionals"/>
<link rel="stylesheet" href="inc/gorge_styles.css" type="text/css">
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

<h1>Error</h1> 
<p>It appears you did not select a time slot. Please use your browser's back button and make a time slot selection.</p>


</div> 
</section>


<div style="clear: both;"></div>
</div>
<section id="footer">
  <?php include("inc/footer.php") ?>
</section>
</div>

</body>
</html>  
  
<?php  
   ;}
  else
  {

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
$sql_time_slots .= "DATE_FORMAT(start_time, '%b %D, %Y') AS start_date, ";
$sql_time_slots .= "DATE_FORMAT(start_time, '%I:%i %p') AS start_time_f, ";
$sql_time_slots .= "DATE_FORMAT(end_time, '%I:%i %p') AS end_time_f ";
$sql_time_slots .= "FROM time_slots ";
$sql_time_slots .= "WHERE id IN $time_slot_id ";
$sql_time_slots .= "ORDER BY start_time_f, start_time";

$total_time_slots = @mysql_query($sql_time_slots, $connection) or die("Error #". mysql_errno() . ": " . mysql_error());
$total_found_time_slots = @mysql_num_rows($total_time_slots);
  $index = 1;
do {

  if ($row['start_time_f'] != '')
  {

$display_block .="<tr>
  <td style=\"padding: 0.5em; border-bottom: 1px solid #ccc;\">" . $row['start_date'] . "</td><td style=\"border-bottom: 1px solid #ccc;\">&nbsp;&nbsp;&nbsp; " . $row['start_time_f'] . " - " . $row['end_time_f'] . "</td>";
  $slots_chosen_array[] =  $row['id'];

$paypal_block .="
<input type=\"hidden\" name=\"item_name_" . $index . "\" value=\"#" . $row['id'] . ", " . $row['start_date'] . ", " . $row['start_time_f'] . " - " . $row['end_time_f'] . "\">
<input type=\"hidden\" name=\"amount_" . $index . "\" value=\"10.00\">
<input type=\"hidden\" name=\"quantity_" . $index . "\" value=\"1\">";
$index = $index + 1;
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
<link rel="stylesheet" href="inc/validationEngine.jquery.css" type="text/css"/>

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

<p>You have picked the following <?php if ($length > 1) {echo "$length timeslots";} else {echo "timeslot";} ?> for the Madison River to ice gorge:</p>

<table cellspacing="0" style="margin: 0 0 0 4em;">
<tr >
 <?php echo $display_block ?>
</tr>
</table>
<p>For a total of <strong>$<?php echo number_format($total_cost,2) ?></strong>.</p>


<p>If you would like to enter these times slots into the raffle, click the PayPal<sup>&reg;</sup> "Buy Now" button below to complete your transaction. Madison Valley Medical Center Foundation utilizes PayPal<sup>&reg;</sup> for ICE JAM payment transaction processing.</p>

<!-- switch between sandbox and www and business name jim30@toliveistofly.com vs ctrapp@mvmcf.org -->
<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_cart">
<input type="hidden" name="upload" value="1">
<input type="hidden" name="business" value="ctrapp@mvmcf.org">
<?php echo $paypal_block ?>
<div align="center">
<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
</div>
</form>

</div> 



</section>

<div style="clear: both;"></div>
<section id="footer">
  <?php include("inc/footer.php") ?>
</section>
</div>

</div>

</body>
</html>
<?php
;}
?>