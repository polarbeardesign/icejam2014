<?php

// db connection

if ($_SERVER['SERVER_NAME'] == "localhost")
{
$db_name = "mv_gorge";
  $connection = @mysql_connect("127.0.0.1","jri","tensai14") or die("Couldn't Connect.");
}
elseif ($_SERVER['SERVER_NAME'] == "10.0.1.8")
{
$db_name = "mv_gorge";
  $connection = @mysql_connect("127.0.0.1","jri","tensai14") or die("Couldn't Connect.");
}
else 
{
  $db_name = "icejam";
  $connection = @mysql_connect("50.63.237.107","icejam","Logan178#fluke") or die("Couldn't Connect.");
}

$db = @mysql_select_db($db_name, $connection) or die("Couldn't select database.");
?>