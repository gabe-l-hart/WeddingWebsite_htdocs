<!-- Get PHP Utils -->
<?php
require '../scripts/utils.php';
require './scripts/photos.php';
?>

<link rel="stylesheet" type="text/css" href="./css/photos.css">

<?php pageHeader("..", "Photos"); ?>
<?php subPageTop(); ?>

  <p>TEST -- Photos</p>
  <?php displayAlbums(); ?>

  <!-- Make sure floated content gets expanded for -->
  <div style="clear:both;"></div>

<?php subPageBottom(); ?>