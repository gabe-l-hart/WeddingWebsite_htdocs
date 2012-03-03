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
  /* Public members */
  public $title = null;
  public $gphotoID = null;
  public $thumbnail = null;
  public $photos = array();

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

  /* Create the album tile */
  public function createTile()
  {
    return '
    <div class="albumTileDiv commonText">
      <div class="albumTile itemTile" onclick="javascript: show_overlay_'.$this->gphotoID.'()">
        <div class="overlayDiv">
          <div class="albumThumbnail">
            <img src="'.$this->thumbnail[0]->getURL().'">
          </div>
          <div class="albumCaption">'.$this->title.'</div>
        </div>
      </div>
      <form method=\'post\' action=\'\' name=\'show_album_'.$this->gphotoID.'\'>
        <input type=\'hidden\' name=\'album_id\' value=\''.$this->gphotoID.'\' />
      </form>
    </div>';
  }

  /* Create the scripts to show this album in the overlay */
  function createShowScripts()
  {
    $out = '
      <script>
      var $overlay_wrapper_'.$this->gphotoID.';
      var $overlay_panel_'.$this->gphotoID.';
      var $gallery_'.$this->gphotoID.';

      function show_overlay_'.$this->gphotoID.'() {
          if ( !$overlay_wrapper_'.$this->gphotoID.' ) append_overlay_'.$this->gphotoID.'();
          $overlay_wrapper_'.$this->gphotoID.'.fadeIn(700);
          $overlay_panel_'.$this->gphotoID.'.fadeIn(0);
          if ( !$gallery_'.$this->gphotoID.' ) create_gallery_'.$this->gphotoID.'();
          fixOverlayHeight();
      }

      function create_gallery_'.$this->gphotoID.'() {
        $gallery_'.$this->gphotoID.' = $(\'.ad-gallery\').adGallery();
        $gallery_'.$this->gphotoID.'[0].settings.use_description = false;
      }

      function hide_overlay_'.$this->gphotoID.'() {
          $overlay_wrapper_'.$this->gphotoID.'.fadeOut(500);
      }

      function append_overlay_'.$this->gphotoID.'() {
          $overlay_wrapper_'.$this->gphotoID.' = $("<div class=\'overlay\' id=\'overlayBG\'></div>").appendTo( $("BODY") );
          $overlay_panel_'.$this->gphotoID.' = $("<div class=\'photoOverlayPanel\' id=\'overlayPanel\'>\
            <div id=\'overlayBG\'>\
              <div class=\'photoOverlayPanelTop\'></div>\
              <div class=\'photoOverlayPanelBody\'>\
                <div class=\'overlayExit\'>\
                  <a href=\'#\' class=\'hide-overlay_'.$this->gphotoID.' \'><img src=\'../images/closePanel.png\'></a>\
                </div>\
                <div class=\'galleryWrapper\'>\
\
\
    <div id=\'gallery\' class=\'ad-gallery\'>\
      <div class=\'ad-image-wrapper\'>\
      </div>\
      <div class=\'ad-controls\'>\
      </div>\
      <div class=\'ad-nav\'>\
        <div class=\'ad-thumbs\'>\
          <ul class=\'ad-thumb-list\'>';

    foreach($this->photos as $photo)
    {
      $out .= '<li>\
            <a href=\''.$photo->full_image[0]->getUrl().'\'>\
              <img height=\'50px\' src=\''.$photo->thumbnail[0]->getUrl().'\' class=\''.$photo->gphotoID.'\'>\
            </a>\
          </li>';
    }

    $out .='</ul>\
        </div>\
      </div>\
    </div>\
\
\
              </div>\
              </div>\
              <div class=\'photoOverlayPanelBottom\'></div>\
            </div>\
          </div>").appendTo( $overlay_wrapper_'.$this->gphotoID.' );
          attach_overlay_events_'.$this->gphotoID.'();
      }

      function attach_overlay_events_'.$this->gphotoID.'() {
          $("A.hide-overlay_'.$this->gphotoID.'", $overlay_wrapper_'.$this->gphotoID.').click( function(ev) {
              ev.preventDefault();
              hide_overlay_'.$this->gphotoID.'();
          });
      }

      $(function() {
          $("A.show-overlay_'.$this->gphotoID.'").click( function(ev) {
              ev.preventDefault();
              show_overlay_'.$this->gphotoID.'();
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
      </script>';

    echo $out;

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
        $album = new Album($entry->getTitle(), $id,
                           $entry->getMediaGroup()->getThumbnail());
        $album->populatePhotos($this->client, $this->user);
        $this->albums["$id"] = $album;
      }
    }
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
      echo $album->createShowScripts();
    }

    // Add clear div if necessary
    if (count($this->albums) >= 6) {
      echo '<div style="clear:both;"></div>';
    }
  }



}
?>