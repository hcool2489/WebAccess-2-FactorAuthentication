<?php
session_start();
$conn = mysql_connect("localhost","root","usbw") or die(mysql_error());
$DB = mysql_select_db("matree",$conn) or die(mysql_error());
date_default_timezone_set('Asia/Kolkata');
?>