<?php
require '../scripts/utils.php';
require './scripts/photos.php';
?>

<?php pageHeader("..", "Photos"); ?>
<?php subPageTop(); ?>

  <link rel="stylesheet" type="text/css" href="./css/jquery.ad-gallery.css">
  <link rel="stylesheet" type="text/css" href="./css/photos.css">
  <script type="text/javascript" src="./scripts/jquery.ad-gallery.js"></script>

  <p class="subPageTitle">Photos</p>

  <a class="uploadButtonLink" href="./Upload">
    <div href="./Upload" class="uploadButton">Upload Your Photos!</div>
  </a>

  <div class="descriptionText">
    <p>We will upload our official wedding pictures here after the event.  You will also receive instructions at the wedding on how to upload your own pictures to the website so all guests can view and download pictures others have taken.</p>
    <p>For now, please enjoy the below pictures of the Red Rock Ranch and our engagement photos!</p>
  </div>

  <?php
    $userSet = new UserSet('rebekkah.gabe@googlemail.com');
    $userSet->populateAlbums();
    $userSet->displayAlbums();
  ?>
  <div style="clear:both;">
<?php subPageBottom(); ?>
