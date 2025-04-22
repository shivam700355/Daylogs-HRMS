<?php
session_start();
if (!isset($_SESSION["token"]) OR empty($_SESSION["token"])) 
{
	$_SESSION["token"] = md5(uniqid(mt_rand(), true));
}
date_default_timezone_set("Asia/Kolkata");
?>