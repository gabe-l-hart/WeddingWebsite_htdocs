<?php
require '../scripts/utils.php';
require './scripts/photos.php';
?>

<?php pageHeader("..", "Photos"); ?>
<?php subPageTop(); ?>

  <link rel="stylesheet" type="text/css" href="./css/jquery.ad-gallery.css">
  <link rel="stylesheet" type="text/css" href="./css/photos.css">
  <script type="text/javascript" src="./scripts/jquery.ad-gallery.js"></script>

  <?php
    $userSet = new UserSet('rebekkah.gabe@googlemail.com');
    $userSet->populateAlbums();
    $userSet->displayAlbums();
  ?>

<?php subPageBottom(); ?>