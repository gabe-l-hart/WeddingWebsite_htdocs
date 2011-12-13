<?php

/* Class to represent info for a registry item */
class RegistryItem
{
  /* Members */
  public $imagePath = '';
  public $shortDescrip = '';
  public $longDescrip = '';
  public $name = '';
  public $link = '';

  private $mainOpacity=90;
  private $highlightOpacity=75;

  /* Constructor */
  public function __construct($ip, $sd, $ld, $n, $l)
  {
    $this->imagePath = $ip;
    $this->shortDescrip = $sd;
    $this->longDescrip = $ld;
    $this->name = $n;
    $this->link = $l;
  }

  /* Method to create the small tile */
  function createSmallTile()
  {
    return '<div class="image">
      <img src="./images/InnerTile.png" alt="" name="'.$this->name.'" style="opacity:0.'.$this->mainOpacity.';">
      <span class="overlay">
      <a href="./TestItem.php">
      <table cellpadding="0" cellspacing="0" border="0" class="fixedTable"          onmouseover="'.$this->name.'.style.opacity=0.'.$this->highlightOpacity.';'.$this->name.'.filters.alpha.opacity='.$this->highlightOpacity.'"
        onmouseout="'.$this->name.'.style.opacity=0.'.$this->mainOpacity.';'.$this->name.'.filters.alpha.opacity='.$this->mainOpacity.'">
      <tbody>
        <tr><td height="10" width="212"></td></tr>
        <tr><td align="center">
        <img src="'.$this->imagePath.'" height="160">
        <div style="color:#49002e; text-align:center">'.$this->shortDescrip.'</div>
        </td></tr>
        <tr><td></td></tr>
      </tbody>
      </table>
      </a>
      </span>
      </div>';
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
    $this->pw = $u;
  }

  /* Connect to the MySQL server */
  public function connect()
  {
    $this->dbLink = mysql_connect($this->host, $this->user, $this->pw);
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
//      items[$row['name']] = new RegistryEntry($row['imagePath'],
//                                              $row['shortDescrip'],
//                                              $row['longDescrip'],
//                                              $row['name'],
//                                              $row['link']);
    }
  }

}

?>