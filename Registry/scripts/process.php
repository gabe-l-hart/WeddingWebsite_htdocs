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
$buyer_name=$_POST["buyer_name"];
mysql_query("UPDATE  `".$db_name."`.`Registry` SET  `purchased` =  '1',
`buyer_email` =  '".$email."',
`buyer_name` =  '".$buyer_name."' WHERE  `Registry`.`name` =  '".$item_name."';");

// Send email to reg admin
/*
global $reg_admin_email;
$message = "REGISTRY UPDATE\n\nItem: ".$item_name."\nBuyer Name: ".$buyer_name."\nBuyer Email: ".$email."\n";
mail($reg_admin_email, 'Rebekkah and Gabe - Registry Update', wordwrap($message, 70));
*/

// Link back to registry page
header("Location: ..");
?>