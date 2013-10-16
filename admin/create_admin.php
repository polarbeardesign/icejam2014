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




?>

<!DOCTYPE html>
<html>
<head>
<title>Ice Jam: supporting Madison Valley Medical Center Foundation</title>
<meta name="description" content= "Madison Valley Medical Center (MVMC) Foundation supporting high quality health care with modern services and qualified professionals"/>
<link rel="stylesheet" href="../inc/gorge_styles.css" type="text/css">
</head>

<body>

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

<p>Create Admin Login, user will be emailed login credentials.</p>
    <form name="form1" method="post" action="admin_auth.php">
        <table width="400" border="0" id="login">
            <tr> 
                <th colspan="2">Create Admin Login</th>
            </tr>
            <tr> 
                <td>User ID:</td>
                <td><input name="username" type="text" size=25 maxlength=255 /></td>
            </tr>
            <tr><td colspan="2">Use email address</td></tr>
            <tr> 
                <td>&nbsp;</td>
                <td> <input type="submit" name="Submit" value="Create" /> </td>
            </tr>
        </table>
    </form>

</section>


<div style="clear: both;"></div>
</div>

</div>

</body>
</html>
