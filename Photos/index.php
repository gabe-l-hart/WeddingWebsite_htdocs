<?php
require '../scripts/utils.php';
require './scripts/photos.php';
?>

<?php pageHeader("..", "Photos"); ?>
<?php subPageTop(); ?>

  <link rel="stylesheet" type="text/css" href="./css/photos.css">

  <?php
    $userSet = new UserSet('rebekkah.gabe@googlemail.com');
    $userSet->populateAlbums();
    $userSet->displayAlbums();

    // Show a specific album in the overlay
    if (isset($_POST['album_id']))
    {
      $userSet->showAlbum($_POST['album_id']);
    }

  ?>

  <!-- Make sure floated content gets expanded for -->
  <div style="clear:both;"></div>

<?php subPageBottom(); ?>