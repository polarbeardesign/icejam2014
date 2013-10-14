<?php

$submit = $_POST['Submit'];

if ($submit == "Submit") 

{

//$error = $_POST['error'];
$error = "The information entered was not valid, please try again. Fields are case sensitive.";

// Connect to server and select databse.
include('../inc/db_conn.php');
if ("none_required"=="none_required") {

define('SALT', 'flyfishing');

$tbl_name = "admins";

// username and password sent from form 
$formusername=$_POST['username']; 
$formpassword=sha1($_POST['password']);


// To protect MySQL injection (more detail about MySQL injection)
$formusername = stripslashes($formusername);
$formpassword = stripslashes($formpassword);

$formusername = mysql_real_escape_string($formusername);
$formpassword = mysql_real_escape_string($formpassword);

// Search for user credentials
$sql="SELECT id, username, password FROM $tbl_name WHERE username='$formusername'";
$result=mysql_query($sql);

while ($row = mysql_fetch_array($result)) {

$id=$row['id'];
$username=$row['username'];
$password=$row['password'];
}

// Mysql_num_row is counting table row
//$count=mysql_num_rows($result);
// If result matched $myusername and $mypassword, table row must be 1 row
//if($count==1){

if(md5(SALT . $_POST['password']) == $password) {


// Register $formusername, $formpassword
session_start();
$_SESSION['validate'] = "validated";
$_SESSION['formusername'] = $formusername;
$_SESSION['formpassword"'] = $formpassword;
setcookie("username",$username,0);

$sql_update ="UPDATE $tbl_name SET last_login=NOW() WHERE id=\"$id\"";

$result_update = @mysql_query($sql_update, $connection) or die("Error #". mysql_errno() . ": " . mysql_error());

// and redirect to appropriate page
if ($requested_url != "") 
{
header("Location:$requested_url");
}
else
{
header("Location:index.php");
}

}

else
{

session_start();
$_SESSION['errormessage'] = $error;

header("location:login.php");

}

}
}

elseif  
($submit == "Create") 

{

include('../inc/db_conn.php');

function generatePassword($length, $strength) {
  $vowels = 'aeuy';
  $consonants = 'bdghjmnpqrstvz';
  if ($strength & 1) {
    $consonants .= 'BDGHJLMNPQRSTVWXZ';
  }
  if ($strength & 2) {
    $vowels .= "AEUY";
  }
  if ($strength & 4) {
    $consonants .= '23456789';
  }
  if ($strength & 8) {
    $consonants .= '@#$%';
  }
 
  $password = '';
  $alt = time() % 2;
  for ($i = 0; $i < $length; $i++) {
    if ($alt == 1) {
      $password .= $consonants[(rand() % strlen($consonants))];
      $alt = 0;
    } else {
      $password .= $vowels[(rand() % strlen($vowels))];
      $alt = 1;
    }
  }
  return $password;
}

$cert_pass = generatePassword(8,4);

$clean = array();

define('SALT', 'flyfishing');

$encrypted_password = md5(SALT . $cert_pass);

//if(cytpe_alnum($_POST['username']))
//  {
    $username = $_POST['username'];
//  }
//  else
//  {
//    $error = "Invalid username";
//    echo $error;
//  }

//$st = $db->prepare('INSERT
//             INTO admins (username, password)
//             VALUES (?, ?)');
//$st->execute(array($clean['username'], $encrypted_password));

$sql ="INSERT INTO admins ";
$sql .="(username, ";
$sql .="password, ";
$sql .="created) ";
$sql .="VALUES ";
$sql .="(\"$username\", ";
$sql .="\"$encrypted_password\", ";
$sql .="NOW())";

$result = @mysql_query($sql, $connection) or die("Error #". mysql_errno() . ": " . mysql_error());


////////////////////////////////////////
// MAIL FUNCTION
////////////////////////////////////////


$to = "$username";
$subject = "Gorge Fundraiser Account Information";
$message = "

<p>An account has been created for you on the MVMCF website.</p>

<p>This account will enable you to log in to the admin area of the website.</p>

<p>Please TYPE the username and password into the login page. Your login may not work if you try to copy and paste the information into the form.</p>

<table width=\"300\" border=\"0\" cellspacing=\"0\">
	<tr>
		<td valign = \"top\">Web Address:</td>
		<td valign = \"top\"><a href=\"http://www.polarbeardesign.net/clients/madison_valley/mvmcf_preview_site/admin/login.php\">http://www.polarbeardesign.net/clients/madison_valley/mvmcf_preview_site/admin/login.php</a></td>
	</tr>
	<tr>
		<td valign = \"top\">Username:</td>
		<td valign = \"top\">$username</td>
	</tr>
	<tr>
		<td valign = \"top\">Password:</td>
		<td valign = \"top\">$cert_pass</td>
	</tr>
</table>

</body>
</html>";

$headers = "From: jim@polarbeardesign.net\nBcc: jim@polarbeardesign.net\nContent-Type: text/html; charset=iso-8859-1";

mail("$to", "$subject", "$message", "$headers");

echo "TO: $to <br />Subject: $subject <br /> $message <br />Headers: $headers";

}

?>