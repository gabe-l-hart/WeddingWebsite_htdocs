<?php

/*--Set include path---------------------------------------------------------*/
$clientLibraryPath = '../libs/ZendGdata/library';
set_include_path(get_include_path() . PATH_SEPARATOR . $clientLibraryPath);

/*--Load Zend classes--------------------------------------------------------*/
require_once 'Zend/Loader.php';
Zend_Loader::loadClass('Zend_Gdata_Photos');
Zend_Loader::loadClass('Zend_Gdata_Photos_UserQuery');
Zend_Loader::loadClass('Zend_Gdata_Photos_AlbumQuery');
Zend_Loader::loadClass('Zend_Gdata_Photos_PhotoQuery');

//session_start();

/*--Functions/Classes--------------------------------------------------------*/

/** This class represents an album */
class Album
{
  /** Private members */
  private $title = null;
  private $gphotoID = null;
  private $thumbnail = null;

  /** Constructor */
  public function __construct($title, $id, $thumb)
  {
    $this->title = $title;
    $this->gphotoID = $id;
    $this->thumbnail = $thumb;
  }

  /** Create the album tile */
  function createTile()
  {
    return '<div class="albumTileDiv">
    <a class="albumTile" href="#" style="opacity:0.'.$this->mainOpacity.';">
      <span class="overlay">

      </span>
      </a>';
  }
}

/** Get the list of albums */
function getAlbumList($client = null)
{
  $photos = new Zend_Gdata_Photos($client);
  $query = new Zend_Gdata_Photos_UserQuery();
  $query->setUser('rebekkah.gabe@googlemail.com');

  $userFeed = $photos->getUserFeed(null, $query);
  $albums = array();
  foreach ($userFeed as $entry) {
    if ($entry instanceof Zend_Gdata_Photos_AlbumEntry)
    {
      $albums[] = new Album($entry->getTitle(),
                            $entry->getGphotoId(),
                            $entry->getMediaGroup()->getThumbnail());
    }
  }
  return $albums;
}

/** Display albums */
function displayAlbums()
{
  $albums = getAlbumList();
  foreach ($albums as $album)
  {
    echo $album->createTile();
  }
}

?>