<?php
require '../scripts/utils.php';
require './scripts/photos.php';
?>

<?php pageHeader("..", "Photos"); ?>
<?php subPageTop(); ?>

  <link rel="stylesheet" type="text/css" href="./css/jquery.ad-gallery.css">
  <link rel="stylesheet" type="text/css" href="./css/photos.css">
  <script type="text/javascript" src="./scripts/jquery.ad-gallery.js"></script>

  <script type="text/javascript">
  $(function() {
    var galleries = $('.ad-gallery').adGallery();
    galleries[0].settings.use_description = false;
  });
  </script>

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