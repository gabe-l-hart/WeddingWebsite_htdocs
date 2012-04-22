<?php
require '../../scripts/utils.php';
require './scripts/upload.php';
?>

<?php pageHeader("../..", "Photos"); ?>
<?php subPageTop("../.."); ?>

<?php

  if (isset($_POST['albumName']))
  {
    // Get the authenticated client
    $authClient = getAuthClient();
    $photos = new Zend_Gdata_Photos($authClient);

    // Create the album
    $album = createNewAlbum($photos, $_POST['albumName']);

    //DEBUG -- Add the photo
    addPhoto($photos, $album, $_FILES['photo']);
  }
?>

<form enctype="multipart/form-data" method="POST" action=".">
  <input type="hidden" name="MAX_FILE_SIZE" value="20971520" />
  <input type="hidden" name="command" value="addPhoto" />
  Please enter an album name: <input name="albumName" type="text" /><br />
  Please select a photo to upload: <input name="photo" type="file" /><br />
  <input type="submit" name="Upload" />
</form>

<?php subPageBottom(); ?>