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

/* This class represents an album */
class Album
{
  /* Private members */
  public $title = null;
  public $gphotoID = null;
  public $thumbnail = null;

  /* Constructor */
  public function __construct($title, $id, $thumb)
  {
    $this->title = $title;
    $this->gphotoID = $id;
    $this->thumbnail = $thumb;
  }

  /* Create the album tile */
  public function createTile()
  {
    return '
    <div class="albumTileDiv commonText">
      <a class="albumTile itemTile" href="#">
        <span class="overlay">
          <div class="albumThumbnail">
            <img src="'.$this->thumbnail[0]->getURL().'">
          </div>
          <div class="albumCaption">'.$this->title.'</div>
        </span>
      </a>
    </div>';
  }
}

/* This class represents the full photo set for a user */
class UserSet
{

  /* private members */
  private $user = '';
  private $albums = array();
  private $client = null;

  /* Constructor */
  public function __construct($user)
  {
    $this->user = $user;
  }

  /* Get the list of albums */
  function populateAlbums()
  {
    $photos = new Zend_Gdata_Photos($this->client);
    $query = new Zend_Gdata_Photos_UserQuery();
    $query->setUser($this->user);

    $userFeed = $photos->getUserFeed(null, $query);
    $this->albums = array();
    foreach ($userFeed as $entry) {
      if ($entry instanceof Zend_Gdata_Photos_AlbumEntry)
      {
        $this->albums[] = new Album($entry->getTitle(),
                                    $entry->getGphotoId(),
                                    $entry->getMediaGroup()->getThumbnail());
      }
    }
  }

  /* Display albums */
  function displayAlbums()
  {
    foreach ($this->albums as $album)
    {
      echo $album->createTile();
    }
  }

}
?>