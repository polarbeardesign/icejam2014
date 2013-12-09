<?php

include('../inc/db_conn.php');

date_default_timezone_set("America/Chicago");

session_start();

$_SESSION = array();

if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"]
    );
}

setcookie("username",'',0);

session_destroy();

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
<h1>Ice Jam Admin</h1>

<p>You have successfully logged out of the Admin Section of Ice Jam Fundraiser.</p>

    <form name="form1" method="post" action="admin_auth.php">
        <table width="300" border="0" id="login">
            <tr> 
                <th colspan="2">Admin Login</th>
            </tr>
            <tr> 
                <td>User ID:</td>
                <td><input name="username" type="text" size=25 maxlength=255 /></td>
            </tr>
            <tr> 
                <td>Password:</td>
                <td><input name="password" type="password" size=25 maxlength=255 /></td>
            </tr>
            <tr> 
                <td>&nbsp;</td>
                <td> <input type="submit" name="Submit" value="Submit" /> </td>
            </tr>
            <?php if ($error != "") {
            echo "<tr><td colspan=\"2\"><div class=\"error\">$error</div></td></tr>";
            } ?>
        </table>
    </form>
</section>


</section>


<div style="clear: both;"></div>
</div>
<section id="footer">
  <?php include("../inc/footer.php") ?>
</section>
</div>

</body>
</html>
