<?php
require '../../scripts/db.php';

/* Set up a form with error info */
function quitWithError($id, $err)
{
  // Create dummy form
  echo "
  <form id='redirect' action='..' method='post'>
    <input type='hidden' id='failure_id' name='failure_id' value='$id'></input>
    <input type='hidden' id='error' name='error' value='$err'></input>
    <input type='hidden' id='quantity' name='quantity' value='".$_POST["quantity"]."'></input>
    <input type='hidden' id='price' name='price' value='".$_POST["price"]."'></input>
  </form>";

  // Submit form on load
  echo "<script type='text/javascript'>
    function submit () {
      document.getElementById('redirect').submit();
    }
    window.onload = submit;
  </script>";
}

/* Set up a form with success info */
function quitSuccess($id)
{
  // Create dummy form
  echo "
  <form id='redirect' action='..' method='post'>
    <input type='hidden' id='success_id' name='success_id' value='$id'></input>
    <input type='hidden' id='quantity' name='quantity' value='".$_POST["quantity"]."'></input>
    <input type='hidden' id='price' name='price' value='".$_POST["price"]."'></input>
  </form>";

  // Submit form on load
  echo "<script type='text/javascript'>
    function submit () {
      document.getElementById('redirect').submit();
    }
    window.onload = submit;
  </script>";
}

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
quitSuccess($_POST["item_id"]);
?>