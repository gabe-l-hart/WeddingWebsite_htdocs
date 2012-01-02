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
    return '<div class="regTileDiv">
    <a class="regTile" href="'.$this->link.'" style="position:relative; background-image:url(./images/InnerTile.png); height:212px; width:212px; display:block; text-align:center; opacity:0.'.$this->mainOpacity.';">
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
      </a>
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
      $sd = $row['shortDescrip'];
      $ld = $row['longDescrip'];
      $l = $row['link'];
      $this->items[$n] = new RegistryItem($ip, $sd, $ld, $n, $l);

      // Display it's tile
      echo $this->items[$n]->createSmallTile();
    }
  }

}

?>