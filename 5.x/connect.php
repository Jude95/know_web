<?php
$con = mysql_connect("localhost","redrock","redrock");
if (!$con){
  die('Could not connect: ' . mysql_error());
  echo "connect error";
}
mysql_query("set names 'utf8'");
mysql_select_db("redrock", $con);
?>