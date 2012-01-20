<?php
require '../../scripts/db.php';

global $db_hostname;
global $db_user;
global $db_pw;
global $db_name;

$item_name=$_POST["item_name"];
$email=$_POST["email"];
$buyer_name=$_POST["buyer_name"];
mysql_connect($db_hostname, $db_user, $db_pw) or die(mysql_error());
mysql_select_db($db_name) or die(mysql_error());

mysql_query("UPDATE  `".$db_name."`.`Registry` SET  `purchased` =  '1',
`buyer_email` =  '".$email."',
`buyer_name` =  '".$buyer_name."' WHERE  `Registry`.`name` =  '".$item_name."';");

header("Location: ..");
?>