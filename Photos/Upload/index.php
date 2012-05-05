<?php
require '../../scripts/utils.php';
require './scripts/upload.php';
?>

<?php pageHeader("../..", "Photos"); ?>
<?php subPageTop("../.."); ?>

<!-- Local style settings -->
<style type="text/css">

  .upload_failure {
    color:red;
  }

  .upload_success {
    color:green;
  }

  .uploadForm {
    border-style:solid;
    border-width:2px;
    border-color:#cccccc;
    float:left;
    padding:10px;
  }

</style>

<p class="subPageTitle">Upload Photos</p>

<p>
Thanks you so much for sharing our special weekend with us! We hope you had a great time.
We’d love to see all the great photos you took, so this page will let you upload them to
our site and share them with everyone.  Just give your new album a name and then choose
all the photos you want to include.  You can add as many as you want with the “Browse”
button.  When you’re done, just hit “Upload.” It will probably take quite a while for all
of the photos to be uploaded, so be patient.  When it’s all done you should see a set of
messages telling you that each photo was uploaded.  After that you can go back to the main
Photos page and see your new album (sometimes it takes a while for the album to make its
way through the plumbing of the internet, so it could take a little while for it to show
up).  Thanks for sharing!
</p>

<!-- Set up the form -->
<div class="uploadForm">
<script src="./scripts/jquery.form.js" type="text/javascript" language="javascript"></script>
<script src="./scripts/jquery.MetaData.js" type="text/javascript"
language="javascript"></script>
<script src="./scripts/jquery.MultiFile.js" type="text/javascript"
language="javascript"></script>
<script src="./scripts/jquery.blockUI.js" type="text/javascript" language="javascript"></script>

<form enctype="multipart/form-data" method="POST" action="." class="MultiFile-intercepted">
  <input type="hidden" name="MAX_FILE_SIZE" value="20971520" />
  <input type="hidden" name="command" value="addPhoto" />
  Please enter an album name:<br><input name="albumName" type="text" /><br />
  Please select the photos to upload:<br><input name="photos[]" class="multi" accept="gif|jpg|jpeg|png" type="file" /><br />
  <input type="submit" name="Upload" value="Upload" />
</form>
</div>

<?php
if (isset($_POST['albumName']) and
    isset($_FILES['photos']) and
    isset($_FILES['photos']['name']))
  {
    // Get the authenticated client
    $authClient = getAuthClient();
    $photos = new Zend_Gdata_Photos($authClient);

    // Create the album
    $album = createNewAlbum($photos, $_POST['albumName']);

    // Add the photos
    if ($album)
    {
      for ($i = 0; $i < count($_FILES['photos']['name']); $i++)
      {
        $photo = array();
        foreach($_FILES['photos'] as $k => $v)
        {
          $photo[$k] = $v[$i];
        }
        if (addPhoto($photos, $album, $photo))
        {
          echo "<div class='upload_success'>Successfully uploaded ".$photo["name"]."</div>";

        }
        else
        {
          echo "<div class='upload_failure'>There was a problem uploading ".$photo["name"]."</div>";
        }
      }
    }
    else
    {
      echo "<div class='upload_failure'>There was a problem creating the album ".$_POST['albumName'].". This probably means the name is already taken.</div>";
    }
  }
?>

<?php subPageBottom(); ?>
