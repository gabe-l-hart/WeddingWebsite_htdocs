<?php
require '../../scripts/db.php';
require 'use_sandbox.php';
global $use_sandbox;

/* Set up a form with error info */
function quitWithError($id, $err, $qty, $price, $email)
{
  // Create dummy form
  echo "
  <form id='redirect' action='..' method='post'>
    <input type='hidden' id='failure_id' name='failure_id' value='$id'></input>
    <input type='hidden' id='error' name='error' value='$err'></input>
    <input type='hidden' id='quantity' name='quantity' value='".$qty."'></input>
    <input type='hidden' id='price' name='price' value='".$price."'></input>
    <input type='hidden' id='email' name='email' value='".$email."'></input>
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
function quitSuccess($id, $qty, $price, $email)
{
  // Create dummy form
  echo "
  <form id='redirect' action='..' method='post'>
    <input type='hidden' id='success_id' name='success_id' value='$id'></input>
    <input type='hidden' id='quantity' name='quantity' value='".$qty."'></input>
    <input type='hidden' id='price' name='price' value='".$price."'></input>
    <input type='hidden' id='email' name='email' value='".$email."'></input>
  </form>";

  // Submit form on load
  echo "<script type='text/javascript'>
    function submit () {
      document.getElementById('redirect').submit();
    }
    window.onload = submit;
  </script>";
}

// Set empty vars for important info
$item_id="";
$item_name = "";
$email="";
$buyer_name="";
$quantity='0';
$price='0';

// Keep track of status during PayPal's script
$error = false;
$success = false;

// BEGIN PAYPAL SCRIPT ////////////////////////////////////////////////////////

// read the post from PayPal system and add 'cmd'
$req = 'cmd=_notify-synch';

$tx_token = $_GET['tx'];

$auth_token = "";
if ($use_sandbox) {
  $auth_token = "_DzGveNPFnisu6WPTUoYas4XUX2QOvERSuJ7BEOX4q3ael7ZIa47JSFil0u";
} else {
  $auth_token = "1_5ylUDVJGupUuCFEzuR4aBDid0n7PiP6UZwCyKK0c5SeYgBpoZq_MmOc6a";
}

$req .= "&tx=$tx_token&at=$auth_token";


// post back to PayPal system to validate
$header .= "POST /cgi-bin/webscr HTTP/1.0\r\n";
$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
$header .= "Content-Length: " . strlen($req) . "\r\n\r\n";
$paypal_url = "";
if ($use_sandbox) {
  $paypal_url = "https://www.sandbox.paypal.com/cgi-bin/webscr";
} else {
  $paypal_url = "https://www.paypal.com/cgi-bin/webscr";
}

// Send the post with cURL
$c = curl_init($paypal_url); // SANDBOX
curl_setopt($c, CURLOPT_POST, true);
curl_setopt($c, CURLOPT_POSTFIELDS, $req);
curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
$contents = curl_exec($c);
$response_code = curl_getinfo($c, CURLINFO_HTTP_CODE);
curl_close($c);

if (!$contents || $response_code != 200)
{
  // HTTP error
  $error = true;
} else {

  // parse the data
  $lines = explode("\n", $contents);
  $keyarray = array();
  if (strcmp ($lines[0], "SUCCESS") == 0)
  {
    $success = true;
    for ($i=1; $i<count($lines);$i++)
    {
      list($key,$val) = explode("=", $lines[$i]);
      $keyarray[urldecode($key)] = urldecode($val);
    }
    // check the payment_status is Completed
    // check that txn_id has not been previously processed
    // check that receiver_email is your Primary PayPal email
    // check that payment_amount/payment_currency are correct
    // process payment
    $item_id = $keyarray['custom'];
    $item_name = $keyarray['item_name'];
    $email=$keyarray['payer_email'];
    $buyer_name=$keyarray['first_name']."_".$keyarray['last_name'];
    $quantity=$keyarray['quantity'];
    $price=$keyarray['mc_gross'];
  }
  else if (strcmp ($lines[0], "FAIL") == 0)
  {
    $success = false;
  }

}

// END PAYPAL SCRIPT //////////////////////////////////////////////////////////


// Pull in db variables
global $db_hostname;
global $db_user;
global $db_pw;
global $db_name;

// Connect to db
mysql_connect($db_hostname, $db_user, $db_pw) or die(mysql_error());
mysql_select_db($db_name) or die(mysql_error());

// Make db changes
$query = "UPDATE  `".$db_name."`.`Registry` SET  `purchased` =  purchased + ".$quantity.",
`buyer_email` =  CONCAT(buyer_email,'".$email.",'),
`buyer_name` =  CONCAT(buyer_name,'".$buyer_name.":".$quantity.",') WHERE  `Registry`.`name` =  '".$item_name."';";
mysql_query($query);

// Link back to registry page
if ($error) {
  quitWithError($item_id, "There was a network error while confirming your purchase.", $quantity, $price, $email);
}
elseif ($success)
{
  quitSuccess($item_id, $quantity, $price, $email);
} else {
  quitWithError($item_id, "There was an error processing your payment with PayPal.", $quantity, $price, $email);
}
?>