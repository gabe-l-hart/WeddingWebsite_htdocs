<?php
require '../../scripts/db.php';

// Pull in db variables
global $db_hostname;
global $db_user;
global $db_pw;
global $db_name;

// Connect to db
mysql_connect($db_hostname, $db_user, $db_pw) or die(mysql_error());
mysql_select_db($db_name) or die(mysql_error());

// Make db changes
$item_name=$_POST["item_name"];
$email=$_POST["email"];
$buyer_name=$_POST["buyer_first_name"]."_".$_POST["buyer_last_name"];
$quantity=$_POST["quantity"];
$query = "UPDATE  `".$db_name."`.`Registry` SET  `purchased` =  purchased + ".$quantity.",
`buyer_email` =  CONCAT(buyer_email,'".$email.",'),
`buyer_name` =  CONCAT(buyer_name,'".$buyer_name.":".$quantity.",') WHERE  `Registry`.`name` =  '".$item_name."';";
mysql_query($query);

// Link back to registry page
header("Location: ..");
?>