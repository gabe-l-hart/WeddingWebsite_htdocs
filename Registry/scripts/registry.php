<?php

$fadeInTime = 700;
$fadeOutTime = 500;

/* Replace the spaces in a string with underscores */
function noSpace($s)
{
  return str_replace(" ","_",$s);
}

/* Class to represent info for a registry item */
class RegistryItem
{
  /* Members */
  private $imagePath = '';
  private $thumbnailPath = '';
  private $longDescrip = '';
  private $name = '';
  private $noSpaceName = '';
  private $link = '';
  private $purchased = 0;
  private $requested = 1;
  private $unitPrice = 1.00;

  /* Constructor */
  public function __construct($ip, $tp, $ld, $n, $l, $p, $r, $pr)
  {
    $this->imagePath = $ip;
    $this->thumbnailPath = $tp;
    $this->longDescrip = $ld;
    $this->name = $n;
    $this->noSpaceName = noSpace($n);
    $this->link = $l;
    $this->purchased = $p;
    $this->requested = $r;
    $this->unitPrice = $pr;
  }

  /* Method to create the small tile */
  function createSmallTile()
  {
/*
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


      '<table cellpadding="0" cellspacing="0" border="0" class="fixedTable">
      <tbody>
        <tr><td height="10" width="212"></td></tr>
        <tr><td align="center">
        <img src="'.$this->thumbnailPath.'" class="regThubnail">
        <div style="color:#4a002f; text-align:center">'.$this->name.'</div>
        </td></tr>
        <tr><td></td></tr>
      </tbody>
      </table>'
*/

    $out = '<div class="regTileDiv">
    <a class="regTile itemTile show-overlay_'.$this->noSpaceName.'" href="#">
      <div class="overlay regTileWrapper">
        <div class="regTileCaption">'.$this->name.'</div>
        <div class="regTileThumbnail">
          <img src="'.$this->thumbnailPath.'" class="regThubnail">
        </div>
        <div class="regTileBought">Bought: '.$this->purchased.' / '.$this->requested.'</div>
        <div class="regTilePrice">Price: $'.$this->unitPrice.'</div>
      </div>
      </a>';

    if ($this->purchased == $this->requested) {
      $out = $out.'<div class="regBoughtBanner">SOLD OUT</div>';
    }
    // Catch errors... should never need this
    elseif ($this->purchased > $this->requested) {
      $out = $out.'<div class="regBoughtBanner">TOO MANY PURCHASED!!!!! ('.$this->purchased.' > '.$this->requested.')</div>';
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
        <div class=\'regOverlayExit\'>\
          <a href=\'#\' class=\'hide-overlay_'.$this->noSpaceName.' \'><img src=\'../images/closePanel.png\'></a>\
        </div>\
        <div class=\'overlayPanelInfoContainer\'>\
          <a href=\''.$this->link.'\' class=\'overlayButton overlayPanelLink\'>Visit their website</a>';

      if ($this->purchased) {
        $out = $out.'<div class=\'overlayButton overlayPanelBuy\' style=\'color:#616161\'>Already Purchased</div>';
      } else {
        $out = $out.'<a href=\'#\' class=\'overlay-purchase-transition_'.$this->noSpaceName.' overlayButton overlayPanelBuy\'>Purchase</a>';
      }

      $out = $out.'<div class=\'overlayPanelTitle\'>'.$this->name.'</div>\
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
        <div class=\'regOverlayExit\'>\
          <a href=\'#\' class=\'hide-overlay_'.$this->noSpaceName.' \'><img src=\'../images/closePanel.png\'></a>\
        </div>\
        <div class=\'overlayPanelTitle\'>'.$this->name.'</div>\
        <div>FIXME!!! Please provide us with contact information so that we can organize payment.</div>\
        <div>\
          <a href=\'#\' class=\'overlay-purchase-back_'.$this->noSpaceName.' overlayButton overlayPanelBack\'>Back</a>\
          <a href=\'#\' class=\'overlay-purchase-submit_'.$this->noSpaceName.' overlayButton overlayPanelSubmit\'>Purchase</a>\
          <form class=\'purchaseForm\' id=\'purchase_form_'.$this->noSpaceName.'\' action=\'./scripts/process.php\' method=\'post\'>\
            name <input type=\'text\' name=\'buyer_name\'>\
            email <input type=\'text\' name=\'email\'><br />\
            <input type=\'hidden\' name=\'item_name\' value=\''.$this->noSpaceName.'\'>\
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
  var $overlay_wrapper_'.$this->noSpaceName.';
  var $overlay_panel_'.$this->noSpaceName.';
  var $overlay_panel_info_'.$this->noSpaceName.';
  var $overlay_panel_purchase_'.$this->noSpaceName.';

  function show_overlay_'.$this->noSpaceName.'() {
      if ( !$overlay_wrapper_'.$this->noSpaceName.' ) append_overlay_'.$this->noSpaceName.'();
      $overlay_wrapper_'.$this->noSpaceName.'.fadeIn('.$fadeInTime.');
  }

  function hide_overlay_'.$this->noSpaceName.'() {
      $overlay_wrapper_'.$this->noSpaceName.'.fadeOut('.$fadeOutTime.', delay_reset_'.$this->noSpaceName.'());
  }

  function show_purchase_'.$this->noSpaceName.'() {
      $overlay_panel_info_'.$this->noSpaceName.'.fadeOut(0);
      $overlay_panel_purchase_'.$this->noSpaceName.'.fadeIn(0);
  }

  function show_info_'.$this->noSpaceName.'() {
      $overlay_panel_info_'.$this->noSpaceName.'.fadeIn(0);
      $overlay_panel_purchase_'.$this->noSpaceName.'.fadeOut(0);
  }

  function delay_reset_'.$this->noSpaceName.'() {
      $overlay_panel_info_'.$this->noSpaceName.'.delay('.$fadeOutTime.');
      show_info_'.$this->noSpaceName.'();
  }

  function append_overlay_'.$this->noSpaceName.'() {
      $overlay_wrapper_'.$this->noSpaceName.' = $("<div class=\'regOverlay\' id=\'overlayBG\'></div>").appendTo( $("BODY") );
      $overlay_panel_'.$this->noSpaceName.' = $("<div class=\'regOverlayPanel\' id=\'overlayPanel\'></div>").appendTo( $overlay_wrapper_'.$this->noSpaceName.' );
      $overlay_panel_info_'.$this->noSpaceName.' = $("<div class=\'regOverlayPanelInfo\'></div>").appendTo( $overlay_panel_'.$this->noSpaceName.' );
      $overlay_panel_purchase_'.$this->noSpaceName.' = $("<div class=\'regOverlayPanelPurchase\'></div>").appendTo( $overlay_panel_'.$this->noSpaceName.' );
  
      $overlay_panel_info_'.$this->noSpaceName.'.html( "'.$this->createOverlayInfo().'" );
      $overlay_panel_purchase_'.$this->noSpaceName.'.html( "'.$this->createOverlayPurchase().'" );
  
      attach_overlay_events_'.$this->noSpaceName.'();
  }

  function validate_form_'.$this->noSpaceName.'() {
    var name = document.forms[\'purchase_form_'.$this->noSpaceName.'\']["buyer_name"].value;
    if (name == null || name == "")
    {
      alert("Please enter your name");
      return false;
    }
    var email = document.forms[\'purchase_form_'.$this->noSpaceName.'\']["email"].value;
    if (email == null || email == "")
    {
      alert("Please enter your email address");
      return false;
    }
    return true;
  }

  function submit_form_if_valid_'.$this->noSpaceName.'() {
    if (validate_form_'.$this->noSpaceName.'()) {
      document.forms[\'purchase_form_'.$this->noSpaceName.'\'].submit()
    }
  }

  function attach_overlay_events_'.$this->noSpaceName.'() {
      $("A.hide-overlay_'.$this->noSpaceName.'", $overlay_wrapper_'.$this->noSpaceName.').click( function(ev) {
          ev.preventDefault();
          hide_overlay_'.$this->noSpaceName.'();
      });
      $("A.overlay-purchase-transition_'.$this->noSpaceName.'").click( function(ev) {
          ev.preventDefault();
          show_purchase_'.$this->noSpaceName.'();
      });
      $("A.overlay-purchase-submit_'.$this->noSpaceName.'").click( function(ev) {
          ev.preventDefault();
          submit_form_if_valid_'.$this->noSpaceName.'();
      });
      $("A.overlay-purchase-back_'.$this->noSpaceName.'").click( function(ev) {
          ev.preventDefault();
          show_info_'.$this->noSpaceName.'();
      });
  }

  $(function() {
      $("A.show-overlay_'.$this->noSpaceName.'").click( function(ev) {
          ev.preventDefault();
          show_overlay_'.$this->noSpaceName.'();
          fixOverlayHeight();
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
  private $name = 'Wedding';
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
  /* Set table */
  public function setDBName($n) {
    $this->name = $n;
  }

  /* Connect to the MySQL server */
  public function connect()
  {
    $this->dbLink = mysql_connect($this->host, $this->user, $this->pw);
    if (!$this->dbLink) {
      die('Failed to connect to database');
    }
    mysql_select_db($this->name);
  }

  /* Add an item to the database. */
  public function addItem($name, $imagePath, $thumbnailPath, $longDescrip,
                          $link, $unit_price, $requested)
  {
    $query = 'INSERT INTO `'.$this->name.'`.`Registry` (`name`, `link`, `imagePath`, `thumbnailPath`, `longDescrip`, `purchased`, `requested`, `unit_price`, `buyer_email`, `buyer_name`) VALUES ("'.$name.'", "'.$link.'", "'.$imagePath.'", "'.$thumbnailPath.'", "'.$longDescrip.'", "0", "'.$requested.'", "'.$unit_price.'", "", "");';
    $result = mysql_query($query);
    if (!$result) {
      return false;
    }
    return true;
  }

  /* Populate the array of items */
  public function populateItems()
  {
    // Get the contents of the Registry table
    $result = mysql_query('SELECT * FROM Registry');
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
      $tp = $row['thumbnailPath'];
      $ld = $row['longDescrip'];
      $l = $row['link'];
      $p = $row['purchased'];
      $r = $row['requested'];
      $pr = $row['unit_price'];
      $this->items[] = new RegistryItem($ip, $tp, $ld, $n, $l, $p, $r, $pr);
    }
  }

  /* Display items for main page */
  public function showItems()
  {
    foreach($this->items as $item)
    {
      echo $item->createSmallTile();
      echo $item->createOverlay();
    }
  }

}

?>