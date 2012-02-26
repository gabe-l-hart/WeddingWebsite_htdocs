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

/* This class represents a photo */
class Photo
{
  /* Public members */
  public $title = null;
  public $thumbnail = null;
  public $full_image = null;
  public $gphotoID = null;

  /* Constructor */
  public function __construct($title, $id, $thumb, $img)
  {
    $this->title = $title;
    $this->gphotoID = $id;
    $this->thumbnail = $thumb;
    $this->full_image = $img;
  }
}

/* This class represents an album */
class Album
{
  /* Private members */
  private $title = null;
  private $gphotoID = null;
  private $thumbnail = null;
  private $photos = array();

  /* Constructor */
  public function __construct($title, $id, $thumb)
  {
    $this->title = $title;
    $this->gphotoID = $id;
    $this->thumbnail = $thumb;
  }

  /* Populate photos */
  public function populatePhotos($client, $user)
  {

    $photos = new Zend_Gdata_Photos($client);
    $query = new Zend_Gdata_Photos_AlbumQuery();
    $query->setUser($user);
    $query->setAlbumId($this->gphotoID);

    $albumFeed = $photos->getAlbumFeed($query);
    $this->photos = array();
    foreach ($albumFeed as $entry) {
      if ($entry instanceof Zend_Gdata_Photos_PhotoEntry)
      {
        $id = $entry->getGphotoId();
        $this->photos["$id"] = new Photo($entry->getTitle(), $id,
                                         $entry->getMediaGroup()->getThumbnail(),
                                         $entry->getMediaGroup()->getContent());
      }
    }

  }

  /* Get the img tag for a specific photo */
  public function photoImgTag($id)
  {
    return '<img name=\'debugPhoto\' src=\''.$this->photos[$id]->full_image[0]->getURL().'\'>';
  }

  /* Create the scripts needed to show the individual photos */
  public function createImageScripts()
  {
    $out = '<script type=\'text/javascript\'>';

    $firstPhoto = null;
    $foundFirst = false;
    foreach ($this->photos as $id => $photo) {
      if ($foundFirst == false) {
        $firstPhoto = $id;
        $foundFirst = true;
      }
      $out .= '
      function show_photo_'.$id.'() {
        document.getElementById(\'fullImageContainer\').innerHTML = "'.$this->photoImgTag($id).'";
      }';
    }

    $out .= '
    // Show the first one
    show_photo_'.$firstPhoto.'();

    </script>';
    return $out;
  }

  /* Create the album tile */
  public function createTile()
  {
    return '
    <div class="albumTileDiv commonText">
      <a class="albumTile itemTile" href="javascript: submit_show_album_'.$this->gphotoID.'()">
        <span class="overlayDiv">
          <div class="albumThumbnail">
            <img src="'.$this->thumbnail[0]->getURL().'">
          </div>
          <div class="albumCaption">'.$this->title.'</div>
        </span>
      </a>
      <form method=\'post\' action=\'\' name=\'show_album_'.$this->gphotoID.'\'>
        <input type=\'hidden\' name=\'album_id\' value=\''.$this->gphotoID.'\' />
      </form>
    </div>
    <script type=\'text/javascript\'>
      function submit_show_album_'.$this->gphotoID.'() {
        document.show_album_'.$this->gphotoID.'.submit();
      }
    </script>';
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
        $id = $entry->getGphotoId();
        $this->albums["$id"] = new Album($entry->getTitle(), $id,
                                         $entry->getMediaGroup()->getThumbnail());
      }
    }
  }

  /* Populate the content of a given album */
  function fetchAlbumContents($id)
  {
    $this->albums[$id]->populatePhotos($this->client, $this->user);
  }

  /* Get a handle to a specific album */
  function getAlbum($id)
  {
    return $this->albums[$id];
  }

  /* Display albums */
  function displayAlbums()
  {
    foreach ($this->albums as $id => $album)
    {
      echo $album->createTile();
    }
  }

  /* Show a single album in the overlay */
  function showAlbum($id)
  {
    $out = '
      <script>
      var $overlay_wrapper;
      var $overlay_panel;

      function show_overlay() {
          if ( !$overlay_wrapper ) append_overlay();
          $overlay_wrapper.fadeIn(700);
          $overlay_panel.fadeIn(0);
          fixOverlayHeight();
      }

      function hide_overlay() {
          $overlay_wrapper.fadeOut(500);
      }

      function append_overlay() {
          $overlay_wrapper = $("<div class=\'overlay\' id=\'overlayBG\'></div>").appendTo( $("BODY") );
          $overlay_panel = $("<div class=\'overlayPanel\' id=\'overlayPanel\'>\
            <div id=\'overlayBG\'>\
              <div class=\'overlayPanelTop\'></div>\
              <div class=\'overlayPanelBody\'>\
                <div class=\'overlayExit\'>\
                  <a href=\'#\' class=\'hide-overlay \'><img src=\'../images/closePanel.png\'></a>\
                </div>\
                <div class=\'fullImageContainer\' id=\'fullImageContainer\'>\
                </div>\
              </div>\
              <div class=\'overlayPanelBottom\'></div>\
            </div>\
          </div>").appendTo( $overlay_wrapper );
          attach_overlay_events();
      }

      function attach_overlay_events() {
          $("A.hide-overlay", $overlay_wrapper).click( function(ev) {
              ev.preventDefault();
              hide_overlay();
          });
      }

      $(function() {
          $("A.show-overlay").click( function(ev) {
              ev.preventDefault();
              show_overlay();
              fixOverlayHeight();
          });
      });

      // Fix the overlay background height
      function fixOverlayHeight() {
        var bodyH = $(document).height();
        var overlayH = $("#overlayPanel").height();
        if (bodyH > overlayH) {
          document.getElementById("overlayBG").style.height = bodyH + "px";
        } else {
          document.getElementById("overlayBG").style.height = overlayH + "px";
        }
      }

      // This will only get setup when reloading from opening an album
      show_overlay();

      </script>';

    $this->fetchAlbumContents($id);
    $album = $this->getAlbum($id);
    $out .= $album->createImageScripts();

    echo $out;

  }

}
?>