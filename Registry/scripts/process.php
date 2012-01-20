<?php
  require '../../scripts/db.php';

  global $db_hostname;
  global $db_user;
  global $db_pw;
  global $db_name;

 $name=$_POST['item_name']; 
 $email=$_POST['email']; 
 mysql_connect($db_hostname, $db_user, $db_pw) or die(mysql_error()); 
 mysql_select_db($db_name) or die(mysql_error()); 
 mysql_query("INSERT INTO `data` VALUES ('$name', '$email', '$location')"); 
 Print "Your information has been successfully added to the database.";
?>