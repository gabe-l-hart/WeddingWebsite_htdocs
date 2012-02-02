<?php
// Include important scripts
require "../../../scripts/db.php";
require "../../scripts/registry.php";

/* Function to create a thumbnail */
function resizeImg( $inputPath, $outputPath, $maxWidth, $maxHeight ) 
{
  // parse path for the extension
  $info = pathinfo($inputPath);

  // Load the image (jpg, png, or gif)
  $img = null;
  if ( strtolower($info['extension']) == 'jpg' )
  {
    $img = imagecreatefromjpeg( $inputPath );
  }
  elseif ( strtolower($info['extension']) == 'png' )
  {
    $img = imagecreatefrompng( $inputPath );
  }
  elseif ( strtolower($info['extension']) == 'gif' )
  {
    $img = imagecreatefromgif( $inputPath );
  }
  else
  {
    return false;
  }

  // calculate thumbnail size
  $width = imagesx( $img );
  $height = imagesy( $img );
  $new_width = $maxWidth;
  $new_height = $maxHeight;
  if ($width > $height)
  {
    $new_height = ($height / $width) * $maxHeight;
  }
  elseif ($height > $width)
  {
    $new_width = ($width / $height) * $maxWidth;
  }

  // create a new temporary image
  $tmp_img = imagecreatetruecolor( $new_width, $new_height );

  // copy and resize old image into new image 
  imagecopyresized( $tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height );

  // save thumbnail into a file
  if ( strtolower($info['extension']) == 'jpg' )
  {
    return imagejpeg( $tmp_img, $outputPath );
  }
  elseif ( strtolower($info['extension']) == 'png' )
  {
    return imagepng( $tmp_img, $outputPath );
  }
  elseif ( strtolower($info['extension']) == 'gif' )
  {
    return imagegif( $tmp_img, $outputPath );
  }
  else
  {
    return false;
  }
}

/* Set up a form with error info */
function quitWithError($err)
{
  // Create dummy form
  echo "
  <form id='redirect' action='..' method='post'>
    <input type='hidden' id='error' name='error' value='$err'></input>
  </form>";

  // Submit form on load
  echo "<script type='text/javascript'>
    function submit () {
      document.getElementById('redirect').submit();
    }
    window.onload = submit;
  </script>";
}

/* Set up a form with success info */
function quitSuccess($name)
{
  // Create dummy form
  echo "
  <form id='redirect' action='..' method='post'>
    <input type='hidden' id='success_name' name='success_name' value='$name'></input>
  </form>";

  // Submit form on load
  echo "<script type='text/javascript'>
    function submit () {
      document.getElementById('redirect').submit();
    }
    window.onload = submit;
  </script>";
}

//////
// Do the upload
//////
$imageDirFromHere = '../../images/items/';
$imageDirFromReg = './images/items/';
$fieldname = 'file';
$maxImgW = 400;
$maxImgH = 400;
$maxThumbW = 140;
$maxThumbH = 140;


// Make sure we got here correctly
if (!isset($_POST['submit']))
{
  quitWithError("Arrived at script incorrectly");
}

// Check built in upload errors
if ($_FILES[$fieldname]['error'] != 0)
{
  quitWithError("PHP errors found: ".$_FILES[$fieldname]['error']);
}

// Check that file is actually from an HTTP upload
if (!is_uploaded_file($_FILES[$fieldname]['tmp_name']))
{
  quitWithError("Arrived at script from non-HTTP upload");
}

// Make sure file is an image (getimagesize returns false if not an image)
if (!getimagesize($_FILES[$fieldname]['tmp_name']))
{
  quitWithError("Upload isn't an image");
}

// Set up the output paths
$filename = noSpace($_POST['name']);
$ext = end(explode('.', $_FILES[$fieldname]['name']));
$tempFileName = $filename."_tmp.".$ext;
$fullFileName = $filename.".".$ext;
$thumbFileName = $filename."_thumb.".$ext;

// Make sure images don't already exist
if (file_exists($imageDirFromHere.$fullFileName) or
    file_exists($imageDirFromHere.$thumbFileName))
{
  quitWithError("Cannot upload image for item that already exists");
}

// Do the upload
if (!move_uploaded_file($_FILES[$fieldname]['tmp_name'], $imageDirFromHere.$tempFileName))
{
  quitWithError("Upload failed (insufficient permissions)");
}

// Resize the main image
if (!resizeImg($imageDirFromHere.$tempFileName, $imageDirFromHere.$fullFileName,
               $maxImgW, $maxImgH))
{
  // Remove the uploaded file
  unlink($imageDirFromHere.$tempFileName);
  quitWithError("Image couldn't be resized");
}

// Create the thumbnail
if (!resizeImg($imageDirFromHere.$fullFileName, $imageDirFromHere.$thumbFileName,
               $maxThumbW, $maxThumbH))
{
  // Remove the uploaded file and main image
  unlink($imageDirFromHere.$tempFileName);
  unlink($imageDirFromHere.$fullFileName);
  quitWithError("Thumbnail creation failes: upload deleted");
}

// If resizing a success, delete the full sized image
unlink($imageDirFromHere.$tempFileName);

//////
// Add the item to the db
//////
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

// Add the item
if (!$reg->addItem($_POST['name'], $imageDirFromReg.$fullFileName,
                   $imageDirFromReg.$thumbFileName,
                   $_POST['longDescrip'], $_POST['link'],
                   $_POST['unit_price'], $_POST['requested']))
{
  // Remove the images
  unlink($imageDirFromHere.$fullFileName);
  unlink($imageDirFromHere.$thumbFileName);
  quitWithError("Failed to insert into database");
}


// Redirect back to registry admin
quitSuccess($_POST['name']);
?>