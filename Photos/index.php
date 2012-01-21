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

<?php subPageBottom(); ?>