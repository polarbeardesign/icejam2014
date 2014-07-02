<?php
// production
//$identity_token = "HboVy9I5G3br-uNqxumlAFB1mmgFLz0NJQwMlseZMf6lfRN0fVyviib0lrS";

// sandbox
//$identity_token = "XC-RVBLamoaBjbaRR_46H0Rr_veMEbUGuFHnHQMXReu2DIotjZO0uHQqBUe";

//=============================================================================
// PDT code
//=============================================================================

// switch $to https://www.paypal.com || https://www.sandbox.paypal.com and $token for testing and production

$to = "https://www.sandbox.paypal.com/cgi-bin/webscr";
$token = "XC-RVBLamoaBjbaRR_46H0Rr_veMEbUGuFHnHQMXReu2DIotjZO0uHQqBUe";
$cmd = "_notify-synch";
$arr_var;
$posted;

if ($_GET['tx'])
  {

  $conn = curl_init($to);
  curl_setopt($conn, CURLOPT_HEADER, 0);
  curl_setopt($conn, CURLOPT_NOBODY, 0);
  curl_setopt($conn, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($conn, CURLOPT_USERAGENT, "Mozilla/5.0");
  curl_setopt($conn, CURLOPT_FOLLOWLOCATION, 1);
  curl_setopt($conn, CURLOPT_SSL_VERIFYPEER, 1);
  curl_setopt($conn, CURLOPT_POST, 1);
  curl_setopt($conn, CURLOPT_POSTFIELDS, array(
		'cmd' => $cmd,
		'tx' => $_GET['tx'],
		'at' => $token));

  if (!$page = curl_exec($conn))
	{
	echo curl_error($conn);
	curl_close($conn);
	}
  else
    {

    $arr_var = preg_split("/\n/", $page);

    if ($arr_var[0] == "FAIL")
	{echo "Error getting data";}
    else if ($arr_var[0] == "SUCCESS")
	{

	for ($a=1; $a<count($arr_var); $a++)
	  {

	  list ($key, $val) = preg_split("/\=/", $arr_var[$a]);
	  $val = preg_replace('/\+/', ' ', $val);

	  # # # # # # # # # # # # # # # # # # # # # # # # #
	  # # This is a single line 

	  $val = preg_replace('/%([\da-f][\da-f])/ei',"chr(hexdec('\\1'))", $val);

	  # # This is a single line 
	  # # # # # # # # # # # # # # # # # # # # # # # # #

	  $posted[$key] = $val;

	  }

	}

      curl_close($conn);

    }

  }

//================================================================================

include('inc/db_conn.php');

//=======================================
// donors
//=======================================

$shipTo_firstName = $posted[first_name];
$shipTo_lastName = $posted[last_name];
$affiliation = $posted[payer_business_name];
$shipTo_street1 = $posted[address_street];
//$shipTo_street2 = $posted[address_street];
$shipTo_city = $posted[address_city];
$shipTo_state = $posted[address_state];
$shipTo_postalCode = $posted[address_zip];
$shipTo_country = $posted[address_country_code];
$billTo_email = $posted[payer_email];

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
//$sql_donor .= "address2, ";
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
//$sql_donor .= "\"$shipTo_street2\", ";
$sql_donor .= "\"$shipTo_city\", ";
$sql_donor .= "\"$shipTo_state\", ";
$sql_donor .= "\"$shipTo_postalCode\", ";
$sql_donor .= "\"$shipTo_country\", ";
$sql_donor .= "NOW(), ";
$sql_donor .= "NOW())";

//$result_donor = @mysql_query($sql_donor, $connection) or die("Error #". mysql_errno() . ": " . mysql_error());

//=======================================
// pull donor just entered to get donor.id
//=======================================

$sql_donor_id ="SELECT ";
$sql_donor_id .="id ";
$sql_donor_id .="FROM donors ";
$sql_donor_id .="WHERE email = \"$billTo_email\"";

//$result_donor_id = @mysql_query($sql_donor_id, $connection) or die("Error #". mysql_errno() . ": " . mysql_error());
//$total_found_donor_id = @mysql_num_rows($result_donor_id);

//while ($row = mysql_fetch_array($result_donor_id))
//{
//  $donor_id = $row['id'];
//}

//=======================================
// billings
//=======================================

$billTo_firstName = $posted[first_name];
$billTo_lastName = $posted[last_name];
$billTo_street1 = $posted[address_street];
//$billTo_street2 = $_POST['billTo_street2'];
$billTo_city = $posted[address_city];
$billTo_state = $posted[address_state];
$billTo_postalCode = $posted[address_zip];
$billTo_country = $posted[address_country_code];
//$billTo_phoneNumber = $_POST['billTo_phoneNumber'];

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

//$result_billing = @mysql_query($sql_billing, $connection) or die("Error #". mysql_errno() . ": " . mysql_error());

//=======================================
// time_slots
//=======================================

//=======================================
// enter info into time_slots
//=======================================
//item_name

$time_ids = array_key_exists_wildcard("item_name*", $posted);

foreach ($time_ids as &$value)
 {
  $value = substr($value, 1, stripos($value, ',')-1);
 }


//=======================================
// time_slots display
//=======================================

$time_slot_id .= "(";
foreach ($time_ids as $key => $selections)
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
  <td style=\"padding: 0.5em; border-bottom: 1px solid #ccc;\">" . $row['start_date'] . "</td><td style=\"border-bottom: 1px solid #ccc;\">&nbsp;&nbsp;&nbsp; " . $row['start_time_f'] . " - " . $row['end_time_f'] . "</td>
  </tr>";
//  $slots_chosen_array[] =  $row['id'];
  }
}
while ($row = mysql_fetch_array($total_time_slots));

function array_key_exists_wildcard($sWildKey, $aArray)
{
    $sPattern = sprintf(
        '~%s~',
        str_replace('\*', '(.{1})', preg_quote($sWildKey))
    );
    $aFinal = array();
    foreach ($aArray as $mKey => $mValue)
    {
        if(preg_match($sPattern, $mKey))
        {
            $aFinal[$mKey] = $mValue;
        }
    }
    return $aFinal;
}

?>

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
<h1>Ice Jam  - Thank You!</h1>

<p>Thank you for your participation in the Predict the Madison River Gorge Fundraiser. Your donation helps fund vital services at the Madison Valley Medical Center Foundation.</p>

<p>Your transaction has been completed, and a receipt for your purchase has been emailed to you. You may log into your account at <a href="www.paypal.com">www.paypal.com</a> to view details of this transaction.</p>

<p>The following information has been recorded.</p>

<hr />
Results: <strong><?php echo $posted[payment_status]; ?></strong>
<hr />

<table>
  <tr>
    <th colspan="2" style="text-align: left;">Contact Info</th>
  </tr>
  <tr>
    <td>Name:</td>
    <td><?php echo $posted[first_name]; ?> <?php echo $posted[last_name]; ?></td>
  </tr>
  <tr>
    <td>Email:</td>
    <td><?php echo $posted[payer_email]; ?></td>
  </tr>
  <tr>
    <td>Address:</td>
    <td><?php echo $posted[address_street]; ?><?php if ($shipTo_street1 !="") { echo "<br />$shipTo_street2";} ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><?php echo "$posted[address_city], $posted[address_state] $posted[address_zip]"; ?></td>
  </tr>
</table>

<hr />
<h3>Times Selected</h3>


<table cellspacing="0" style="margin: 0 0 0 4em;">

 <?php echo $display_block ?>

</table>
<hr />

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
