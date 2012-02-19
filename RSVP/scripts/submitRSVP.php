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
$query = "INSERT INTO  `".$db_name."`.`RSVP` (  `names`, `attending` ) VALUES ( '".$_POST['names']."', '".$_POST['attend']."' )";
mysql_query($query);

// Create dummy form
echo "
<form id='redirect' action='..' method='post'>
  <input type='hidden' id='success_names' name='success_names' value='".$_POST['names']."'></input>
  <input type='hidden' id='attending' name='attending' value='".$_POST['attending']."'></input>
</form>";

// Submit form on load
echo "<script type='text/javascript'>
  function submit () {
    document.getElementById('redirect').submit();
  }
  window.onload = submit;
</script>";
?>