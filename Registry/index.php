<!-- Get PHP Utils -->
<?php
require '../scripts/utils.php';
require './scripts/registry.php';
require '../scripts/db.php';
?>

<link rel="stylesheet" type="text/css" href="./css/registry.css">

<?php
  global $db_hostname;
  global $db_user;
  global $db_pw;
  global $db_name;

  // Set up registry
  $reg = new Registry();
  $reg->setHost($db_hostname);
  $reg->setUser($db_user);
  $reg->setPW($db_pw);
  $reg->setDBName($db_name);

  // Connect to DB
  $reg->connect();
?>

<?php pageHeader("..", "Registry"); ?>
<?php subPageTop(); ?>

  <!-- Title -->
  <p style="font-size:32px; text-align:center">Registry</p>

  <!-- Description Text -->
  <div style="margin:10px;">
  <p>This is some really nifty descriptive text about how the registry and honeymoon are going to work.  Yay Cost Rica!!!</p>
  </div>

  <!-- Item Grid -->
  <?php
  $reg->populateItems();
  $reg->showItems();
  ?>

<?php subPageBottom(); ?>