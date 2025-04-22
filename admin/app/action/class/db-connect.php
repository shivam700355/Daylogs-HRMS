<?php
error_reporting(0);
class Database
{
public $con;
public function __construct(){
$hostname = "localhost";
$username = "u955456464_dl_uhrms";
$password = "P@55word#DL";
    $this->con = new PDO("mysql:host=$hostname;dbname=u955456464_dl_hrms",$username,$password);
    $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
        if (!$this->con) {
         echo "Error in Connecting ".mysqli_connect_error();
        }
}
}
