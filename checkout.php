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

</div>

</body>
</html>  
  
<?php  
   ;}
  else
  {

$length = count($_POST) - 1;
$selections = array_slice($_POST, 0, $length, true);

$total_cost = 20 * $length;

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
  $index = 1;
do {

  if ($row['start_time_f'] != '')
  {

$display_block .="<tr>
  <td style=\"padding: 0.5em; border-bottom: 1px solid #ccc;\">" . $row['start_date'] . "</td><td style=\"border-bottom: 1px solid #ccc;\">&nbsp;&nbsp;&nbsp; " . $row['start_time_f'] . " - " . $row['end_time_f'] . "</td>";
  $slots_chosen_array[] =  $row['id'];

$paypal_block .="
<input type=\"hidden\" name=\"item_name_" . $index . "\" value=\"#" . $row['id'] . ", " . $row['start_date'] . ", " . $row['start_time_f'] . " - " . $row['end_time_f'] . "\">
<input type=\"hidden\" name=\"amount_" . $index . "\" value=\"20.00\">";
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
    </tr>
    <tr>
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

<?php echo $paypal_block ?>

</section>


<div style="clear: both;"></div>
</div>

</div>

</body>
</html>
<?php
;}
?>