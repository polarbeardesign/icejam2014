<?php

echo 'BP: 0';

$_POST = array('mc_gross' => '30.00', 'protection_eligibility' => 'Eligible', 'address_status' => 'confirmed', 'item_number1' => '', 'tax' => '0.00', 'item_number2' => '', 'payer_id' => 'Y4ZJ256AC374N', 'item_number3' => '', 'address_street' => '1 Main St', 'payment_date' => '14:09:33 Jul 01, 2014 PDT', 'payment_status' => 'Completed', 'charset' => 'windows-1252', 'address_zip' => '95131', 'mc_shipping' => '0.00', 'mc_handling' => '0.00', 'first_name' => 'Jim', 'mc_fee' => '1.17', 'address_country_code' => 'US', 'address_name' => 'Jim Ivanoff\'s Test Store', 'notify_version' => '3.8', 'custom' => '', 'payer_status' => 'verified', 'business' => 'jim30@toliveistofly.com', 'address_country' => 'United States', 'num_cart_items' => '3', 'mc_handling1' => '0.00', 'mc_handling2' => '0.00', 'mc_handling3' => '0.00', 'address_city' => 'San Jose', 'verify_sign' => 'AUaxvSojqajxsiGA9qXfGuCulUctA7f4JhuheRln6XwmPiTQiW3okbQp', 'payer_email' => 'jim_1320695061_biz@polarbeardesign.net', 'mc_shipping1' => '0.00', 'mc_shipping2' => '0.00', 'mc_shipping3' => '0.00', 'tax1' => '0.00', 'tax2' => '0.00', 'tax3' => '0.00', 'txn_id' => '53987989NR728272V', 'payment_type' => 'instant', 'payer_business_name' => 'Jim Ivanoff\'s Test Store', 'last_name' => 'Ivanoff', 'address_state' => 'CA', 'item_name1' => '#10874, Nov 15th, 2014, 01:00 AM - 01:59 AM', 'receiver_email' => 'jim30@toliveistofly.com', 'item_name2' => '#10875, Nov 15th, 2014, 02:00 AM - 02:59 AM', 'payment_fee' => '1.17', 'item_name3' => '#10873, Nov 15th, 2014, 12:00 AM - 12:59 AM', 'quantity1' => '1', 'quantity2' => '1', 'receiver_id' => '858SDVHTCQD68', 'quantity3' => '1', 'txn_type' => 'cart', 'mc_gross_1' => '10.00', 'mc_currency' => 'USD', 'mc_gross_2' => '10.00', 'mc_gross_3' => '10.00', 'residence_country' => 'US', 'test_ipn' => '1', 'transaction_subject' => '', 'payment_gross' => '30.00', 'ipn_track_id' => 'afe40452bae1f');


// read the post from PayPal system and add _notify-validate
// #####$req = 'cmd=_notify-validate';
// #####foreach ($_POST as $key => $value) {
// #####  $value = urlencode(stripslashes($value));
// #####  $req .= "&$key=$value";
// #####  }

// send validation to PayPal
$header .= "POST /cgi-bin/webscr HTTP/1.1\r\n";
$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
// $header .= "Host: www.paypal.com\r\n";  // www.sandbox.paypal.com for a test site
$header .= "Host: www.sandbox.paypal.com\r\n";
$header .= "Content-Length: " . strlen($req) . "\r\n";
$header .= "Connection: close\r\n\r\n";


//$fp = fsockopen ('www.paypal.com', 80, $errno, $errstr, 30);
//$fp = fsockopen ('www.sandbox.paypal.com', 80, $errno, $errstr, 30);


// #####$fp = fsockopen ('ssl://www.sandbox.paypal.com', 443, $errno, $errstr, 30);

// if (!$fp) {
 if (1 != 1) {



// HTTP error...
$to = 'jim@polarbeardesign.net';
$subject = 'IceJam2014 | HTTP error';
$message = 'somethings wrong';
$headers = 'From:noreply@mvmcf.org' . "\r\n";
mail($to, $subject, $message, $headers);

echo 'BP: 1';

} else {
// #####fputs ($fp, $header . $req);
// #####while (!feof($fp)) {
// #####  $res = fgets ($fp, 1024);
// #####  if (stripos($res, "VERIFIED") !== false) {
  if (1 == 1) {
// check for duplicate message
// payment valid insert info into db

//if (($payment_status == 'Completed') &&   //payment_status = Completed
//   ($receiver_email == "jim30@toliveistofly.com") &&   // receiver_email is same as your account email
//   ($payment_amount == $amount_they_should_have_paid ) &&  //check they payed what they should have
//   ($payment_currency == "USD") &&  // and its the correct currency 
//   (!txn_id_used_before($txn_id))) {  //txn_id isn't same as previous to stop duplicate payments. You will need to write a function to do this check.
echo 'IceJam2014 | HTTP error';
echo print_r($_POST);

$first_name = $_POST['first_name'];
foreach ($_POST as $key => $value) {
  $pp_array .= $key . " = " . $value . "
  ";
}

$to = 'jim@polarbeardesign.net';
$subject = 'IceJam2014 | Payment';
$message = $pp_array;
$headers = 'From:noreply@mvmcf.org' . "\r\n";
mail($to, $subject, $message, $headers);

include('inc/db_conn.php');


// donors
$billTo_email = $_POST['payer_email'];
$shipTo_firstName = $_POST['first_name'];
$shipTo_lastName = $_POST['last_name'];
$affiliation = $_POST['payer_business_name'];
$shipTo_street1 = $_POST['address_street'];
$shipTo_city = $_POST['address_city'];
$shipTo_state = $_POST['address_state'];
$shipTo_postalCode = $_POST['address_zip'];
$shipTo_country = $_POST['address_country_code'];

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

$billTo_firstName = $_POST['first_name'];
$billTo_lastName = $_POST['last_name'];
$billTo_street1 = $_POST['address_street'];
$billTo_city = $_POST['address_city'];
$billTo_state = $_POST['address_state'];
$billTo_postalCode = $_POST['address_zip'];
$billTo_country = $_POST['address_country_code'];

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
//item_name

$time_ids = array_key_exists_wildcard("item_name*", $_POST);

foreach ($time_ids as &$value)
 {
  $value = substr($value, 1, stripos($value, ',')-1);
 }


foreach ($time_ids as $key => $times_selected)
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



//$to = $billTo_email;
$to = 'jim@polarbeardesign.net';
$subject = 'IceJam2014 | Donation';
$message = "Thank you for your participation in the Predict the Madison River Gorge Fundraiser. Your donation helps fund vital services at the Madison Valley Medical Center Foundation.

Name:    $shipTo_firstName $shipTo_lastName
Email:   $billTo_email


";

$headers .= "From: noreply@mvmcf.org\r\n";
$headers .= "Bcc: jim@polarbeardesign.net\r\n";
mail($to, $subject, $message, $headers);

}
 
else if (stripos ($res, "INVALID") !== false) {
 
// payment was not valid - send an email to trigger investigation

$to      = 'jim@polarbeardesign.net';
$subject = 'IceJam2014 | Invalid Payment';
$message = '
 
A payment has been made but is flagged as INVALID.
Please verify the payment manually and contact the registrant.
 
Buyer Email: '.$email.'
';
$headers = 'From:noreply@mvmcf.org' . "\r\n";
 
mail($to, $subject, $message, $headers);
 
}
}
// ##### fclose ($fp);
}




?>