<!-- Get PHP Utils -->
<?php require '../scripts/utils.php'; ?>
<?php require '../scripts/registry.php'; ?>

<?php
  // Set up registry
  $reg = new Registry();
  $reg->setHost('localhost');
  $reg->setUser('root');
  $reg->setPW('root');

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
  <?php $reg->populateItems(); ?>

<?php subPageBottom(); ?>