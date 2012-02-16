<?php

require_once('paypal.inc.php');

$fadeInTime = 700;
$fadeOutTime = 500;

/* Replace the spaces in a string with underscores */
function noSpace($s)
{
  return str_replace(" ","_",$s);
}

function escapeQuotes($str)
{
  $out = str_replace("'", "\'", $str);
  $out = str_replace('"', "\'", $out);
  return $out;
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
        $out = $out.'<div class=\'overlayButton120\' style=\'color:#616161\'>Sold Out</div>';
      } else {
        $out = $out.'\
          <a href=\'#\' class=\'overlay-purchase-transition_'.$this->id.' overlayButtonLink\'>\
            <div class=\'overlayButton120\'>Purchase</div>\
          </a>';
      }

      $out = $out.'\
          <a class=\'overlayButtonLink\' href=\''.$this->link.'\'>\
            <div class=\'overlayButton120\'>Visit their website</div>\
          </a>\
        </div>\
        <div class=\'overlayPanelText\'>'.$this->longDescrip.'</div>\
        <div style=\'clear:both;\'></div>\
      </div>\
      <div class=\'overlayPanelBottom\'></div>';
    return $out;
  }

  /* Create a PayPal button for the item. The quantity will be set with
   * javascript when transitioning from the info panel to the purchase panel */
  function createPayPalButton()
  {
    $button = new PayPalButton;
    $button->accountemail = 'rebekkah.gabe@gmail.com';
    $button->custom = 'id:'.$this->id;
    $button->currencycode = 'USD';
    $button->class = 'paypalbutton overlayButton140';
    $button->buttontext = 'Purchase';
    $button->askforaddress = false;
    $button->return_url = 'http://www.rebekkahandgabe.com/registry/scripts/process.php';
    $button->ipn_url = 'http://www.rebekkahandgabe.com/registry/scripts/process.php';
    $button->cancel_url = 'http://www.rebekkahandgabe.com/registry/scripts/process.php';

    //Items
    $button->AddItem($this->name,'paypal_qty_'.$this->id,$this->unitPrice,$this->id,'','','','0.00');				

    //Output		
    return escapeQuotes($button->GetButtonCode());
  }

  /* Method to create the html for the overlay purchase panel */
  function createOverlayPurchase()
  {
    $out = '<div class=\'overlayPanelTop\'></div>\
      <div class=\'overlayPanelBody\'>\
        <div class=\'regOverlayExit\'>\
          <a href=\'#\' class=\'hide-overlay_'.$this->id.' \'><img src=\'../images/closePanel.png\'></a>\
        </div>\
        <div class=\'purchaseHeader\'>Purchase Information.</div>\
        <div class=\'overlayPanelInfoContainer\' style=\'width:150px;\'>\
          <div class=\'overlayPanelTitle\'>'.$this->name.'</div>\
          <img src=\''.$this->thumbnailPath.'\' />\
          <div class=\'overlayPanelInfoText\'>Bought: '.$this->purchased.' / '.$this->requested.'</div>\
          <div class=\'overlayPanelInfoText\'>Unit Price: $'.$this->unitPrice.'</div>\
          <div class=\'overlayPanelInfoText\'>Quantity: <span id=\'fixed_qty_'.$this->id.'\'></span></div>\
          <div class=\'overlayPanelInfoText\'>Total Price: $<span id=\'total_price_'.$this->id.'\'></span></div>\
          <a href=\'#\' class=\'overlay-purchase-back_'.$this->id.' overlayButtonLink\'>\
              <div class=\'overlayButton140 overlayPanelBack\'>Back</div>\
          </a>'.$this->createPayPalButton().'</div>\
        <div class=\'purchaseFormDiv\'>\
          <form class=\'purchaseForm\' id=\'purchase_form_'.$this->id.'\' action=\'./scripts/process.php\' method=\'post\'>\
            <fieldset class=\'purchaseFields\'>\
              <legend class=\'purchaseLegend\'>Personal Information</legend>\
              <table>\
                <tr>\
                  <td class=\'purchaseLeft\'>\
                    <label for=\'buyer_first_name_'.$this->id.'\'>First Name:</label>\
                  </td>\
                  <td class=\'purchaseRight\'>\
                    <input type=\'text\' name=\'buyer_first_name\' id=\'buyer_first_name_'.$this->id.'\'>\
                  </td>\
                </tr>\
                <tr>\
                  <td class=\'purchaseLeft\'>\
                    <label for=\'buyer_last_name_'.$this->id.'\'>Last Name:</label>\
                  </td>\
                  <td class=\'purchaseRight\'>\
                    <input type=\'text\' name=\'buyer_last_name\' id=\'buyer_last_name_'.$this->id.'\'>\
                  </td>\
                </tr>\
                <tr>\
                  <td class=\'purchaseLeft\'>\
                    <label for=\'buyer_email_'.$this->id.'\'>Email:</label>\
                  </td>\
                  <td class=\'purchaseRight\'>\
                    <input type=\'text\' name=\'email\' id=\'buyer_email_'.$this->id.'\'>\
                  </td>\
                </tr>\
              </table>\
            </fieldset>\
            <fieldset class=\'purchaseFields\'>\
              <legend class=\'purchaseLegend\'>Credit Card Information</legend>\
              <table>\
                <tr>\
                  <td class=\'purchaseLeft\'>\
                    <label for=\'cc_type_'.$this->id.'\'>Card Type:</label>\
                  </td>\
                  <td class=\'purchaseRight\'>\
                    <select name=\'cc_type\' id=\'cc_type_'.$this->id.'\'>\
                      <option value=\'Visa\'>Visa</option>\
                      <option value=\'MasterCard\'>MasterCard</option>\
                      <option value=\'Amex\'>American Express</option>\
                      <option value=\'Discover\'>Discover</option>\
                    </select>\
                  </td>\
                </tr>\
                <tr>\
                  <td class=\'purchaseLeft\'>\
                    <label for=\'cc_number_'.$this->id.'\'>Card Number:</label>\
                  </td>\
                  <td class=\'purchaseRight\'>\
                    <input type=\'text\' name=\'cc_number\' id=\'cc_number_'.$this->id.'\'>\
                  </td>\
                </tr>\
                <tr>\
                  <td class=\'purchaseLeft\'>\
                    <label for=\'cc_addr1_'.$this->id.'\'>Address 1:</label>\
                  </td>\
                  <td class=\'purchaseRight\'>\
                    <input type=\'text\' name=\'cc_addr1\' id=\'cc_addr1_'.$this->id.'\'>\
                  </td>\
                </tr>\
                <tr>\
                  <td class=\'purchaseLeft\'>\
                    <label for=\'cc_addr2_'.$this->id.'\'>Address 2:</label>\
                  </td>\
                  <td class=\'purchaseRight\'>\
                    <input type=\'text\' name=\'cc_addr2\' id=\'cc_addr2_'.$this->id.'\'>\
                  </td>\
                </tr>\
                <tr>\
                  <td class=\'purchaseLeft\'>\
                    <label for=\'cc_city_'.$this->id.'\'>City:</label>\
                  </td>\
                  <td class=\'purchaseRight\'>\
                    <input type=\'text\' name=\'cc_city\' id=\'cc_city_'.$this->id.'\'>\
                  </td>\
                </tr>\
                <tr>\
                  <td class=\'purchaseLeft\'>\
                    <label for=\'cc_state_'.$this->id.'\'>State:</label>\
                  </td>\
                  <td class=\'purchaseRight\'>\
                  <select name=\'cc_state\' id=\'cc_state_'.$this->id.'\'>\
                    <option value=\'AL\'>Alabama</option>\
                    <option value=\'AK\'>Alaska</option>\
                    <option value=\'AZ\'>Arizona</option>\
                    <option value=\'AR\'>Arkansas</option>\
                    <option value=\'CA\'>California</option>\
                    <option value=\'CO\'>Colorado</option>\
                    <option value=\'CT\'>Connecticut</option>\
                    <option value=\'DE\'>Delaware</option>\
                    <option value=\'DC\'>District of Columbia</option>\
                    <option value=\'FL\'>Florida</option>\
                    <option value=\'GA\'>Georgia</option>\
                    <option value=\'HI\'>Hawaii</option>\
                    <option value=\'ID\'>Idaho</option>\
                    <option value=\'IL\'>Illinois</option>\
                    <option value=\'IN\'>Indiana</option>\
                    <option value=\'IA\'>Iowa</option>\
                    <option value=\'KS\'>Kansas</option>\
                    <option value=\'KY\'>Kentucky</option>\
                    <option value=\'LA\'>Louisiana</option>\
                    <option value=\'ME\'>Maine</option>\
                    <option value=\'MD\'>Maryland</option>\
                    <option value=\'MA\'>Massachusetts</option>\
                    <option value=\'MI\'>Michigan</option>\
                    <option value=\'MN\'>Minnesota</option>\
                    <option value=\'MS\'>Mississippi</option>\
                    <option value=\'MO\'>Missouri</option>\
                    <option value=\'MT\'>Montana</option>\
                    <option value=\'NE\'>Nebraska</option>\
                    <option value=\'NV\'>Nevada</option>\
                    <option value=\'NH\'>New Hampshire</option>\
                    <option value=\'NJ\'>New Jersey</option>\
                    <option value=\'NM\'>New Mexico</option>\
                    <option value=\'NY\'>New York</option>\
                    <option value=\'NC\'>North Carolina</option>\
                    <option value=\'ND\'>North Dakota</option>\
                    <option value=\'OH\'>Ohio</option>\
                    <option value=\'OK\'>Oklahoma</option>\
                    <option value=\'OR\'>Oregon</option>\
                    <option value=\'PA\'>Pennsylvania</option>\
                    <option value=\'RI\'>Rhode Island</option>\
                    <option value=\'SC\'>South Carolina</option>\
                    <option value=\'SD\'>South Dakota</option>\
                    <option value=\'TN\'>Tennessee</option>\
                    <option value=\'TX\'>Texas</option>\
                    <option value=\'UT\'>Utah</option>\
                    <option value=\'VT\'>Vermont</option>\
                    <option value=\'VA\'>Virginia</option>\
                    <option value=\'WA\'>Washington</option>\
                    <option value=\'WV\'>West Virginia</option>\
                    <option value=\'WI\'>Wisconsin</option>\
                    <option value=\'WY\'>Wyoming</option>\
                  </select>\
                  </td>\
                </tr>\
                <tr>\
                  <td class=\'purchaseLeft\'>\
                    <label for=\'cc_zip_'.$this->id.'\'>Zip Code:</label>\
                  </td>\
                  <td class=\'purchaseRight\'>\
                    <input type=\'text\' name=\'cc_zip\' id=\'cc_zip_'.$this->id.'\' size=\'5\'>\
                  </td>\
                </tr>\
              </table>\
            </fieldset>\
            <input type=\'hidden\' name=\'item_name\' value=\''.$this->name.'\'>\
            <input type=\'hidden\' name=\'item_id\' value=\''.$this->id.'\'>\
            <input type=\'hidden\' name=\'quantity\' id=\'quantity_hidden_'.$this->id.'\'>\
            <input type=\'hidden\' name=\'price\' id=\'price_hidden_'.$this->id.'\'>\
          </form>\
        </div>\
        <div style=\'clear:both;\'></div>\
      </div>\
      <div class=\'overlayPanelBottom\'></div>';
    return $out;
  }

  /* Method to create the html for the overlay confirmation panel */
  function createOverlayConf()
  {
    $price = '-1';
    if (isset($_POST['price'])) {
      $price = $_POST['price'];
    }
    $qty = '0';
    if (isset($_POST['quantity'])) {
      $qty = $_POST['quantity'];
    }
    $out = '<div class=\'overlayPanelTop\'></div>\
      <div class=\'overlayPanelBody\'>\
        <div class=\'regOverlayExit\'>\
          <a href=\'#\' class=\'hide-overlay_'.$this->id.' \'><img src=\'../images/closePanel.png\'></a>\
        </div>\
        <div class=\'overlayConfHeader\'>Thank You! Your gift will help make our honeymoon incredible!</div>\
        <div class=\'overlayConfDetails\'>\
          <img class=\'confThumb\' src=\''.$this->thumbnailPath.'\'>\
          <div class=\'overlayPanelInfoContainer\' style=\'width:130px;\'>\
            <div class=\'overlayPanelTitle\'>'.$this->name.'</div>\
            <div class=\'overlayPanelInfoText\'>Unit Price: $'.$this->unitPrice.'</div>\
            <div class=\'overlayPanelInfoText\'>Quantity: '.$qty.'</div>\
            <div class=\'overlayPanelInfoText\'>Total Price: $'.$price.'</div>\
          </div>\
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
  var $overlay_panel_conf_'.$this->id.';

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
        document.getElementById("paypal_qty_'.$this->id.'").value = qty;
        document.getElementById("quantity_hidden_'.$this->id.'").value = qty;
        var price = (parseInt(qty) * '.$this->unitPrice.').toFixed(2);
        document.getElementById("total_price_'.$this->id.'").innerHTML = price;
        document.getElementById("price_hidden_'.$this->id.'").value = price;
        $overlay_panel_info_'.$this->id.'.fadeOut(0);
        $overlay_panel_conf_'.$this->id.'.fadeOut(0);
        $overlay_panel_purchase_'.$this->id.'.fadeIn(0);
      }
      else
      {
        alert("Please enter a valid quantity between 1 and '.($this->requested - $this->purchased).'");
      }
  }

  function show_info_'.$this->id.'() {
      $overlay_panel_purchase_'.$this->id.'.fadeOut(0);
      $overlay_panel_conf_'.$this->id.'.fadeOut(0);
      $overlay_panel_info_'.$this->id.'.fadeIn(0);
  }

  function show_conf_'.$this->id.'() {
      show_overlay_'.$this->id.'();
      $overlay_panel_info_'.$this->id.'.fadeOut(0);
      $overlay_panel_purchase_'.$this->id.'.fadeOut(0);
      $overlay_panel_conf_'.$this->id.'.fadeIn(0);
      fixOverlayHeight();
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
      $overlay_panel_conf_'.$this->id.' = $("<div class=\'regOverlayPanelConf\'></div>").appendTo( $overlay_panel_'.$this->id.' );
  
      $overlay_panel_info_'.$this->id.'.html( "'.$this->createOverlayInfo().'" );
      $overlay_panel_purchase_'.$this->id.'.html( "'.$this->createOverlayPurchase().'" );
      $overlay_panel_conf_'.$this->id.'.html( "'.$this->createOverlayConf().'" );
  
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
  public function show()
  {
    // First, populate the items
    $this->populateItems();

    // Then show them
    foreach($this->items as $item)
    {
      echo $item->createSmallTile();
      echo $item->createOverlay();
    }

    // Add clear div if necessary
    if (count($this->items) >= 4) {
      echo '<div style="clear:both;"></div>';
    }

    // If we arrive from a purchase confirmation, display it
    if (isset($_POST['success_id']))
    {
      echo "<script type='text/javascript'>
        window.onload = show_conf_".$_POST['success_id'].";
      </script>";
    }
    elseif (isset($_POST['failure_id']))
    {
      
    }

  }

}

?>