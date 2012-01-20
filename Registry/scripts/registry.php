<?php

$fadeInTime = 700;
$fadeOutTime = 500;

/* Function to create a thumbnail
 * Credit: http://www.webcheatsheet.com/php/create_thumbnail_images.php */
function createThumbs( $pathToImages, $pathToThumbs, $thumbWidth ) 
{
  // open the directory
  $dir = opendir( $pathToImages );

  // loop through it, looking for any/all JPG files:
  while (false !== ($fname = readdir( $dir ))) {
    // parse path for the extension
    $info = pathinfo($pathToImages . $fname);
    // continue only if this is a JPEG image
    if ( strtolower($info['extension']) == 'jpg' ) 
    {
      echo "Creating thumbnail for {$fname} <br />";

      // load image and get image size
      $img = imagecreatefromjpeg( "{$pathToImages}{$fname}" );
      $width = imagesx( $img );
      $height = imagesy( $img );

      // calculate thumbnail size
      $new_width = $thumbWidth;
      $new_height = floor( $height * ( $thumbWidth / $width ) );

      // create a new temporary image
      $tmp_img = imagecreatetruecolor( $new_width, $new_height );

      // copy and resize old image into new image 
      imagecopyresized( $tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height );

      // save thumbnail into a file
      imagejpeg( $tmp_img, "{$pathToThumbs}{$fname}" );
    }
  }
  // close the directory
  closedir( $dir );
}

/* Class to represent info for a registry item */
class RegistryItem
{
  /* Members */
  public $imagePath = '';
  public $shortDescrip = '';
  public $longDescrip = '';
  public $name = '';
  public $link = '';
  public $purchased = False;

  /* Constructor */
  public function __construct($ip, $sd, $ld, $n, $l, $p)
  {
    $this->imagePath = $ip;
    $this->shortDescrip = $sd;
    $this->longDescrip = $ld;
    $this->name = $n;
    $this->link = $l;
    $this->purchased = $p;
  }

  /* Method to create the small tile */
  function createSmallTile()
  {
    $out = '<div class="regTileDiv">
    <a class="regTile show-overlay_'.$this->name.'" href="#" style="position:relative; background-image:url(./images/InnerTile.png); height:212px; width:212px; display:block; text-align:center; opacity:0.'.$this->mainOpacity.';">
      <span class="overlay">
      <table cellpadding="0" cellspacing="0" border="0" class="fixedTable">
      <tbody>
        <tr><td height="10" width="212"></td></tr>
        <tr><td align="center">
        <img src="'.$this->imagePath.'" height="160">
        <div style="color:#4a002f; text-align:center">'.$this->shortDescrip.'</div>
        </td></tr>
        <tr><td></td></tr>
      </tbody>
      </table>
      </span>
      </a>';

    if ($this->purchased) {
      $out = $out.'<div class="regBoughtBanner">ALREADY PURCHASED</div>';
    }

    $out = $out.'</div>';
    return $out;
  }

  /* Method to create the html for the overlay info panel */
  function createOverlayInfo()
  {
    $out = '<div class=\'overlayPanelTop\'></div>\
      <div class=\'overlayPanelBody\'>\
        <img src=\''.$this->imagePath.'\'>\
        <div style=\'float:right;\'>\
          <a href=\'#\' class=\'hide-overlay_'.$this->name.' \'><img src=\'../images/closePanel.png\'></a>\
        </div>\
        <div class=\'overlayPanelInfoContainer\'>\
          <a href=\''.$this->link.'\' class=\'overlayPanelLink\'>Visit their website</a>';

      if ($this->purchased) {
        $out = $out.'<div class=\'overlayPanelBuy\' style=\'color:#616161\'>Already Purchased</div>';
      } else {
        $out = $out.'<a href=\'#\' class=\'overlay-purchase-transition_'.$this->name.' overlayPanelBuy\'>Purchase</a>';
      }

      $out = $out.'<div class=\'overlayPanelTitle\'>'.$this->shortDescrip.'</div>\
          <div class=\'overlayPanelText\'>'.$this->longDescrip.'</div>\
        </div>\
      </div>\
      <div class=\'overlayPanelBottom\'></div>';
    return $out;
  }

  /* Method to create the html for the overlay purchase panel */
  function createOverlayPurchase()
  {
    $out = '<div class=\'overlayPanelTop\'></div>\
      <div class=\'overlayPanelBody\'>\
        <div style=\'float:right;\'>\
          <a href=\'#\' class=\'hide-overlay_'.$this->name.' \'><img src=\'../images/closePanel.png\'></a>\
        </div>\
        <div class=\'overlayPanelTitle\'>'.$this->shortDescrip.'</div>\
        <div>FIXME!!! Please provide us with contact information so that we can organize payment.</div>\
        <div>\
          <form id=\'purchase_form_'.$this->name.'\' action=\'\'>\
            email <input type=\'text\' name=\'purchase_email_'.$this->name.'\'>\
            <input type=\'submit\' value=\'Purchase\' />\
          </form>\
        </div>\
      </div>\
      <div class=\'overlayPanelBottom\'></div>';
    return $out;
  }

  /* Method to create the full overlay */
  function createOverlay()
  {
    global $fadeInTime;
    global $fadeOutTime;
    return '<script>
  var $overlay_wrapper_'.$this->name.';
  var $overlay_panel_'.$this->name.';
  var $overlay_panel_info_'.$this->name.';
  var $overlay_panel_purchase_'.$this->name.';
  
  function show_overlay_'.$this->name.'() {
      if ( !$overlay_wrapper_'.$this->name.' ) append_overlay_'.$this->name.'();
      $overlay_wrapper_'.$this->name.'.fadeIn('.$fadeInTime.');
  }

  function hide_overlay_'.$this->name.'() {
      $overlay_wrapper_'.$this->name.'.fadeOut('.$fadeOutTime.', delay_reset_'.$this->name.'());
  }

  function show_purchase_'.$this->name.'() {
      $overlay_panel_info_'.$this->name.'.fadeOut(0);
      $overlay_panel_purchase_'.$this->name.'.fadeIn(0);
  }

  function show_info_'.$this->name.'() {
      $overlay_panel_info_'.$this->name.'.fadeIn(0);
      $overlay_panel_purchase_'.$this->name.'.fadeOut(0);
  }

  function delay_reset_'.$this->name.'() {
      $overlay_panel_info_'.$this->name.'.delay('.$fadeOutTime.');
      show_info_'.$this->name.'();
  }

  function append_overlay_'.$this->name.'() {
      $overlay_wrapper_'.$this->name.' = $("<div class=\'regOverlay\'></div>").appendTo( $("BODY") );
      $overlay_panel_'.$this->name.' = $("<div class=\'regOverlayPanel\'></div>").appendTo( $overlay_wrapper_'.$this->name.' );
      $overlay_panel_info_'.$this->name.' = $("<div class=\'regOverlayPanelInfo\'></div>").appendTo( $overlay_panel_'.$this->name.' );
      $overlay_panel_purchase_'.$this->name.' = $("<div class=\'regOverlayPanelPurchase\'></div>").appendTo( $overlay_panel_'.$this->name.' );
  
      $overlay_panel_info_'.$this->name.'.html( "'.$this->createOverlayInfo().'" );
      $overlay_panel_purchase_'.$this->name.'.html( "'.$this->createOverlayPurchase().'" );
  
      attach_overlay_events_'.$this->name.'();
  }

  function attach_overlay_events_'.$this->name.'() {
      $("A.hide-overlay_'.$this->name.'", $overlay_wrapper_'.$this->name.').click( function(ev) {
          ev.preventDefault();
          hide_overlay_'.$this->name.'();
      });
      $("A.overlay-purchase-transition_'.$this->name.'").click( function(ev) {
          ev.preventDefault();
          show_purchase_'.$this->name.'();
      });
  }

  $(function() {
      $("A.show-overlay_'.$this->name.'").click( function(ev) {
          ev.preventDefault();
          show_overlay_'.$this->name.'();
      });
  });
  </script>';
  }
}

///////////////////////////////////////////////////////////////////////////////

/* Class to hold the entire registry. This class will interface with the MySQL
 * database directly */
class Registry
{
  /* Members */
  private $host = 'localhost';
  private $user = 'root';
  private $pw = 'root';
  private $dbLink = '';
  private $items = '';

  /* Set host */
  public function setHost($h) {
    $this->host = $h;
  }
  /* Set user */
  public function setUser($u) {
    $this->user = $u;
  }
  /* Set pw */
  public function setPW($p) {
    $this->pw = $p;
  }

  /* Connect to the MySQL server */
  public function connect()
  {
    $this->dbLink = mysql_connect($this->host, $this->user, $this->pw);
    if (!$this->dbLink) {
      die('Failed to connect to database');
    }
    mysql_select_db("Wedding");
  }

  /* Populate the array of items */
  public function populateItems()
  {
    // Get the contents of the Registry table
    $result = mysql_query('SELECT * FROM Registry ORDER BY purchased');
    if (!$result) {
      die('Invalid Query');
    }

    // Go through all entries in Registry and create items for each
    $this->items = array();
    while($row = mysql_fetch_assoc($result)) {

      // Add comment
      echo '<!-- '.$row['name'].' -->';

      // Create the item
      $n = $row['name'];
      $ip = $row['imagePath'];
      $sd = $row['shortDescrip'];
      $ld = $row['longDescrip'];
      $l = $row['link'];
      $p = $row['purchased'];
      $this->items[$n] = new RegistryItem($ip, $sd, $ld, $n, $l, $p);

      // Display it's tile
      echo $this->items[$n]->createSmallTile();

      // Set up it's overlay
      echo $this->items[$n]->createOverlay();
    }
  }

}

?>