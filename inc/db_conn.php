<?php

// db connection

if ($_SERVER['SERVER_NAME'] == "localhost")
{
$db_name = "mv_gorge";
  $connection = @mysql_connect("127.0.0.1","jri","tensai14") or die("Couldn't Connect.");
}
elseif ($_SERVER['SERVER_NAME'] == "10.0.1.6")
{
  $connection = @mysql_connect("127.0.0.1","jri","tensai14") or die("Couldn't Connect.");
}
else 
{
  $db_name = "polarbea_gorge_db";
  $connection = @mysql_connect("127.0.0.1","polarbea_web","tensai14") or die("Couldn't Connect.");
}

$db = @mysql_select_db($db_name, $connection) or die("Couldn't select database.");
?>