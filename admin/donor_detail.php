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

$donor_id = $_GET['id'];

//==========================
// For donor detail
//==========================

$sql_donor_detail = "SELECT ";
$sql_donor_detail .= "first_name, ";
$sql_donor_detail .= "last_name, ";
$sql_donor_detail .= "affiliation, ";
$sql_donor_detail .= "email, ";
$sql_donor_detail .= "address1, ";
$sql_donor_detail .= "address2, ";
$sql_donor_detail .= "city, ";
$sql_donor_detail .= "state, ";
$sql_donor_detail .= "postal_code, ";
$sql_donor_detail .= "country ";
$sql_donor_detail .= "FROM donors ";
$sql_donor_detail .= "WHERE id = \"$donor_id\"";


$total_donor_detail = @mysql_query($sql_donor_detail, $connection) or die("Error #". mysql_errno() . ": " . mysql_error());

while ($row = mysql_fetch_array($total_donor_detail)) {

$first_name = $row['first_name'];
$last_name = $row['last_name'];
$affiliation = $row['affiliation'];
$email = $row['email'];
$address1 = $row['address1'];
$address2 = $row['address2'];
$city = $row['city'];
$state = $row['state'];
$postal_code = $row['postal_code'];
$country = $row['country'];

}



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
     <div class="feature">
<p>&nbsp;</p>
<h1>Ice Jam Admin</h1>
<p>&nbsp;</p>
<h2>Donor Detail</h2>

<table class="legible">
  <tr>
    <td>Name:</td>
    <td><strong><?php echo "$first_name $last_name"; ?></strong></td>
  </tr>
  <tr>
    <td>Address:</td>
    <td><strong><?php echo "$address1"; if ($address2 != "") {echo "<br />$address2";} echo "<br />$city, $state $postal_code" ?></strong></td>
  </tr>
  <tr>
    <td>Email:</td>
    <td><strong><?php echo "$email"; ?></strong></td>
  </tr>
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
