<?php
  require '../scripts/utils.php';
  require './scripts/registry.php';
  require '../scripts/db.php';

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

<link rel="stylesheet" type="text/css" href="./css/registry.css">
<?php $reg->createCommonScripts(); ?>

<?php subPageTop(); ?>

  <!-- Title -->
  <p class="subPageTitle">Registry</p>

	<div class="descriptionText">
		<p>When thinking about the type of gift that would be most meaningful and memorable around our wedding, we could think of nothing greater than help making our dream honeymoon come true.  After years of valuing travel as individuals and as a couple, we could not be more excited to explore Costa Rica together!</p>
		<p>We have planned our ideal itinerary and have compiled a list of adventures.  Below please find places we would most love to stay, eat, and explore!</p>
		<p>Please note that the below system is secured through Paypal.  Purchases will be deposited into a special honeymoon account in our name.</p>
	</div>

	<!-- Add spacing to bump the first row down -->
	<br><br><br><br>

  <!-- Item Grid -->
  <?php
  $reg->show();
  ?>

<?php subPageBottom(); ?>