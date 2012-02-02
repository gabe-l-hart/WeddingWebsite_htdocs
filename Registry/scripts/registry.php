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
  private $id = '';
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
    $this->id = noSpace($n);
    $this->link = $l;
    $this->purchased = $p;
    $this->requested = $r;
    $this->unitPrice = $pr;
  }

  /* Method to create the small tile */
  function createSmallTile()
  {
    $out = '<div class="regTileDiv">
    <a class="regTile itemTile show-overlay_'.$this->id.'" href="#">
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
          <a href=\'#\' class=\'hide-overlay_'.$this->id.' \'><img src=\'../images/closePanel.png\'></a>\
        </div>\
        <div class=\'overlayPanelInfoContainer\'>\
          <div class=\'overlayPanelTitle\'>'.$this->name.'</div>\
            <div class=\'overlayPanelInfoText\'>Bought: '.$this->purchased.' / '.$this->requested.'</div>\
            <div class=\'overlayPanelInfoText\'>Unit Price: $'.$this->unitPrice.'</div>\
            <div class=\'overlayPanelInfoText\'>\
              <form id=\'quantity_form_'.$this->id.'\'>\
                <label for=\'quantity_'.$this->id.'\'>Qty: </label>\
                <input type=\'text\' maxlength=3 size=3 id=\'quantity_'.$this->id.'\' value=\'1\' />\
              </form>\
            </div>';

      if ($this->purchased >= $this->requested) {
        $out = $out.'<div class=\'overlayButton\' style=\'color:#616161\'>Sold Out</div>';
      } else {
        $out = $out.'\
          <a href=\'#\' class=\'overlay-purchase-transition_'.$this->id.' overlayButtonLink\'>\
            <div class=\'overlayButton\'>Purchase</div>\
          </a>';
      }

      $out = $out.'\
          <a class=\'overlayButtonLink\' href=\''.$this->link.'\'>\
            <div class=\'overlayButton\'>Visit their website</div>\
          </a>\
        </div>\
        <div class=\'overlayPanelText\'>'.$this->longDescrip.'</div>\
        <div style=\'clear:both;\'></div>\
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
          <a href=\'#\' class=\'hide-overlay_'.$this->id.' \'><img src=\'../images/closePanel.png\'></a>\
        </div>\
        <div>Thank You! Your gift will help make our honeymoon incredible!</div>\
        <div class=\'overlayPanelInfoContainer\'>\
          <div class=\'overlayPanelTitle\'>'.$this->name.'</div>\
          <div class=\'overlayPanelInfoText\'>Bought: '.$this->purchased.' / '.$this->requested.'</div>\
          <div class=\'overlayPanelInfoText\'>Unit Price: $'.$this->unitPrice.'</div>\
          <div class=\'overlayPanelInfoText\'>Quantity: <span id=\'fixed_qty_'.$this->id.'\'></span></div>\
          <div class=\'overlayPanelInfoText\'>Total Price: $<span id=\'total_price_'.$this->id.'\'></span></div>\
          <a href=\'#\' class=\'overlay-purchase-back_'.$this->id.' overlayButtonLink\'>\
              <div class=\'overlayButton overlayPanelBack\'>Back</div>\
          </a>\
          <a href=\'#\' class=\'overlay-purchase-submit_'.$this->id.' overlayButtonLink\'>\
            <div class=\'overlayButton overlayPanelSubmit\'>Purchase</div>\
          </a>\
        </div>\
        <div class=\'purchaseFormDiv\'>\
          <form class=\'purchaseForm\' id=\'purchase_form_'.$this->id.'\' action=\'./scripts/process.php\' method=\'post\'>\
            <p>\
              <label for=\'buyer_first_name_'.$this->id.'\'>First Name</label>\
              <input type=\'text\' name=\'buyer_first_name\' id=\'buyer_first_name_'.$this->id.'\'>\
            <br />\
              <label for=\'buyer_last_name_'.$this->id.'\'>Last Name</label>\
              <input type=\'text\' name=\'buyer_last_name\' id=\'buyer_last_name_'.$this->id.'\'>\
            </p>\
            <p>\
              <label for=\'buyer_email_'.$this->id.'\'>Email</label>\
              <input type=\'text\' name=\'email\' id=\'buyer_email_'.$this->id.'\'><br />\
            </p>\
            <input type=\'hidden\' name=\'item_name\' value=\''.$this->name.'\'>\
            <input type=\'hidden\' name=\'quantity\' id=\'quantity_hidden_'.$this->id.'\'>\
          </form>\
        </div>\
        <div style=\'clear:both;\'></div>\
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
  var $overlay_wrapper_'.$this->id.';
  var $overlay_panel_'.$this->id.';
  var $overlay_panel_info_'.$this->id.';
  var $overlay_panel_purchase_'.$this->id.';

  function show_overlay_'.$this->id.'() {
      if ( !$overlay_wrapper_'.$this->id.' ) append_overlay_'.$this->id.'();
      $overlay_wrapper_'.$this->id.'.fadeIn('.$fadeInTime.');
  }

  function hide_overlay_'.$this->id.'() {
      $overlay_wrapper_'.$this->id.'.fadeOut('.$fadeOutTime.', delay_reset_'.$this->id.'());
  }

  function show_purchase_'.$this->id.'() {
      if (validateQuantity("quantity_'.$this->id.'", '.($this->requested - $this->purchased).')) {
        var qty = document.getElementById("quantity_'.$this->id.'").value;
        document.getElementById("fixed_qty_'.$this->id.'").innerHTML = qty;
        document.getElementById("quantity_hidden_'.$this->id.'").value = qty;
        document.getElementById("total_price_'.$this->id.'").innerHTML = (parseInt(qty) * '.$this->unitPrice.').toFixed(2)
        $overlay_panel_info_'.$this->id.'.fadeOut(0);
        $overlay_panel_purchase_'.$this->id.'.fadeIn(0);
      }
      else
      {
        alert("Please enter a valid quantity between 1 and '.($this->requested - $this->purchased).'");
      }
  }

  function show_info_'.$this->id.'() {
      $overlay_panel_info_'.$this->id.'.fadeIn(0);
      $overlay_panel_purchase_'.$this->id.'.fadeOut(0);
  }

  function delay_reset_'.$this->id.'() {
      $overlay_panel_info_'.$this->id.'.delay('.$fadeOutTime.');
      show_info_'.$this->id.'();
  }

  function append_overlay_'.$this->id.'() {
      $overlay_wrapper_'.$this->id.' = $("<div class=\'regOverlay\' id=\'overlayBG\'></div>").appendTo( $("BODY") );
      $overlay_panel_'.$this->id.' = $("<div class=\'regOverlayPanel\' id=\'overlayPanel\'></div>").appendTo( $overlay_wrapper_'.$this->id.' );
      $overlay_panel_info_'.$this->id.' = $("<div class=\'regOverlayPanelInfo\'></div>").appendTo( $overlay_panel_'.$this->id.' );
      $overlay_panel_purchase_'.$this->id.' = $("<div class=\'regOverlayPanelPurchase\'></div>").appendTo( $overlay_panel_'.$this->id.' );
  
      $overlay_panel_info_'.$this->id.'.html( "'.$this->createOverlayInfo().'" );
      $overlay_panel_purchase_'.$this->id.'.html( "'.$this->createOverlayPurchase().'" );
  
      attach_overlay_events_'.$this->id.'();
  }

  function validate_form_'.$this->id.'() {
    var fname = document.forms[\'purchase_form_'.$this->id.'\']["buyer_first_name"].value;
    if (fname == null || fname == "")
    {
      alert("Please enter your First Name");
      return false;
    }
    var lname = document.forms[\'purchase_form_'.$this->id.'\']["buyer_last_name"].value;
    if (lname == null || lname == "")
    {
      alert("Please enter your Last Name");
      return false;
    }
    var email = document.forms[\'purchase_form_'.$this->id.'\']["email"].value;
    if (email == null || email == "")
    {
      alert("Please enter your email address");
      return false;
    }
    return true;
  }

  function submit_form_if_valid_'.$this->id.'() {
    if (validate_form_'.$this->id.'()) {
      document.forms[\'purchase_form_'.$this->id.'\'].submit()
    }
  }

  function attach_overlay_events_'.$this->id.'() {
      $("A.hide-overlay_'.$this->id.'", $overlay_wrapper_'.$this->id.').click( function(ev) {
          ev.preventDefault();
          hide_overlay_'.$this->id.'();
      });
      $("A.overlay-purchase-transition_'.$this->id.'").click( function(ev) {
          ev.preventDefault();
          show_purchase_'.$this->id.'();
      });
      $("A.overlay-purchase-submit_'.$this->id.'").click( function(ev) {
          ev.preventDefault();
          submit_form_if_valid_'.$this->id.'();
      });
      $("A.overlay-purchase-back_'.$this->id.'").click( function(ev) {
          ev.preventDefault();
          show_info_'.$this->id.'();
      });
  }

  $(function() {
      $("A.show-overlay_'.$this->id.'").click( function(ev) {
          ev.preventDefault();
          show_overlay_'.$this->id.'();
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

  /* Create one-time scripts */
  public function createCommonScripts()
  {
    echo '<script type="text/javascript" >

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

      // Validate input text as integer less than a given max
      function validateQuantity(id, max) {
        var n = document.getElementById(id).value;
        var nInt = parseInt(n);
        return !isNaN(nInt) && isFinite(n) && nInt <= max && nInt >= 1;
      }

    </script>';
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