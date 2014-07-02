<?php

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

// read the post from PayPal system and add _notify-validate
$req = 'cmd=_notify-validate';
foreach ($_POST as $key => $value) {
  $value = urlencode(stripslashes($value));
  $req .= "&$key=$value";
  }

// send validation to PayPal
$header .= "POST /cgi-bin/webscr HTTP/1.1\r\n";
$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
// $header .= "Host: www.paypal.com\r\n";  // www.sandbox.paypal.com for a test site
$header .= "Host: www.sandbox.paypal.com\r\n";
$header .= "Content-Length: " . strlen($req) . "\r\n";
$header .= "Connection: close\r\n\r\n";


//$fp = fsockopen ('www.paypal.com', 80, $errno, $errstr, 30);
//$fp = fsockopen ('www.sandbox.paypal.com', 80, $errno, $errstr, 30);


$fp = fsockopen ('ssl://www.sandbox.paypal.com', 443, $errno, $errstr, 30);

if (!$fp) {
// HTTP error...
$to = 'jim@polarbeardesign.net';
$subject = 'IceJam2014 | HTTP error';
$message = 'somethings wrong';
$headers = 'From:noreply@mvmcf.org' . "\r\n";
mail($to, $subject, $message, $headers);

} else {
fputs ($fp, $header . $req);
while (!feof($fp)) {
  $res = fgets ($fp, 1024);
  if (stripos($res, "VERIFIED") !== false) {
// check for duplicate message
// payment valid insert info into db

//if (($payment_status == 'Completed') &&   //payment_status = Completed
//   ($receiver_email == "jim30@toliveistofly.com") &&   // receiver_email is same as your account email
//   ($payment_amount == $amount_they_should_have_paid ) &&  //check they payed what they should have
//   ($payment_currency == "USD") &&  // and its the correct currency
//   (!txn_id_used_before($txn_id))) {  //txn_id isn't same as previous to stop duplicate payments. You will need to write a function to do this check.

$first_name = $_POST['first_name'];
foreach ($_POST as $key => $value) {
  $pp_array .= $key . " = " . $value . "<br />";
}

$to = 'jim@polarbeardesign.net';
$subject = 'IceJam2014 | Payment Transaction';
$message = "" .  $pp_array . "

";
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
          $sql_donor .= "(first_name, ";
          $sql_donor .= "last_name, ";
          $sql_donor .= "affiliation, ";
          $sql_donor .= "email, ";
          $sql_donor .= "address1, ";
          $sql_donor .= "city, ";
          $sql_donor .= "state, ";
          $sql_donor .= "postal_code, ";
          $sql_donor .= "country, ";
          $sql_donor .= "created_at, ";
          $sql_donor .= "updated_at) ";
          $sql_donor .= "VALUES ";
          $sql_donor .= "(\"$shipTo_firstName\", ";
          $sql_donor .= "\"$shipTo_lastName\", ";
          $sql_donor .= "\"$affiliation\", ";
          $sql_donor .= "\"$billTo_email\", ";
          $sql_donor .= "\"$shipTo_street1\", ";
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
            $total_trans = $total_found_time_slots * 10;
            do {

              if ($row['start_time_f'] != '')
              {

            $display_block .="    " . $row['start_date'] . " " . $row['start_time_f'] . " - " . $row['end_time_f'] . "
";
            //  $slots_chosen_array[] =  $row['id'];
              }
            }
            while ($row = mysql_fetch_array($total_time_slots));


$to = $billTo_email;
//$to = 'jim@polarbeardesign.net';
$subject = 'IceJam2014 | Thank You!';
$message = "Thank you for your participation in the Predict the Madison River Gorge Fundraiser. Your donation helps fund vital services at the Madison Valley Medical Center Foundation.

Your transaction has been completed, and a receipt for your purchase has been emailed to you from PayPal.

The following information has been recorded.

Name:    $shipTo_firstName $shipTo_lastName
Email:   $billTo_email

Time Slot selections:
";
$message .= $display_block;
$message .= "
Total: $  $total_trans

Madison Valley Medical Center Foundation";


$headers .= "From: noreply@mvmcf.org\r\n";
$headers .= "Bcc: jim@polarbeardesign.net\r\n";
mail($to, $subject, $message, $headers);


}

else if (stripos ($res, "INVALID") !== false) {

// payment was not valid - send an email to trigger investigation

$to      = 'jim@polarbeardesign.net';
$subject = 'IceJam2014 | Invalid Payment  IPN';
$message = '

A payment has been made but is flagged as INVALID.
Please verify the payment manually and contact the registrant.

Buyer Email: '.$email.'
';
$headers = 'From:noreply@mvmcf.org' . "\r\n";

mail($to, $subject, $message, $headers);

}
}
fclose ($fp);
}


?>
