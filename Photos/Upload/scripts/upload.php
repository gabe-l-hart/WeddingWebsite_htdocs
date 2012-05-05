<?php

/*--Zend Setup---------------------------------------------------------------*/

// Picasa credentials
require 'cred.php';

// Set include path
$clientLibraryPath = '../../libs/ZendGdata/library';
set_include_path(get_include_path() . PATH_SEPARATOR . $clientLibraryPath);

require_once 'Zend/Loader.php';
Zend_Loader::loadClass('Zend_Gdata_Photos');
Zend_Loader::loadClass('Zend_Gdata_Photos_UserQuery');
Zend_Loader::loadClass('Zend_Gdata_Photos_AlbumQuery');
Zend_Loader::loadClass('Zend_Gdata_Photos_PhotoQuery');
Zend_Loader::loadClass('Zend_Gdata_ClientLogin');

/*--Functions----------------------------------------------------------------*/

/* Create the authenticated client */
function getAuthClient()
{
  global $picasa_user;
  global $picasa_pass;
  return Zend_Gdata_ClientLogin::getHttpClient($picasa_user, $picasa_pass, 'lh2');
}

/* Create a new album */
function createNewAlbum($photos, $name)
{
  $entry = new Zend_Gdata_Photos_AlbumEntry();
  $entry->setTitle($photos->newTitle($name));

  $access = new Zend_Gdata_Photos_Extension_Access('public');
  $entry->setGphotoAccess($access);

  $result = $photos->insertAlbumEntry($entry);
  return $result;
}

/* Add a photo to the album */
function addPhoto($photos, $album, $photoInfo)
{
  $fd = $photos->newMediaFileSource($photoInfo["tmp_name"]);
  $fd->setContentType($photoInfo["type"]);

  $entry = new Zend_Gdata_Photos_PhotoEntry();
  $entry->setMediaSource($fd);
  $entry->setTitle($photos->newTitle($photoInfo["name"]));

  $result = $photos->insertPhotoEntry($entry, $album);
  return $result;
}

?>
