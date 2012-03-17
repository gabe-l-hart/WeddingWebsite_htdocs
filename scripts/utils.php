<?php
$fadeTime = 500;

/* Check if using IE */
function usingIE() 
{
    $u_agent = $_SERVER['HTTP_USER_AGENT']; 
    $ub = False; 
    if(preg_match('/MSIE/i',$u_agent)) 
    { 
        $ub = True; 
    }
    return $ub; 
} 

/* Function to create a tile in the home screen */
function createHomeTile($img, $link, $text, $name) {
  echo '<td><a href="'.$link.'" class="commonText fadeTile linkTile" style="background-image:url('.$img.'); 
              display:block; height:234px; width:234px; text-align:right; font-size:22px;">
              <span style="position:relative; top:180px; right:20px;">'.$text.'</span>
            </a>
        </td>';
}

/* Function to create a small link tile */
function createMiniTile($img, $link, $text, $name, $w, $h)
{
  return '<td><a href="'.$link.'" class="commonText fadeTile linkTile" style="background-image:url('.$img.'); 
              display:block; height:'.$h.'px; width:'.$w.'px;
              text-align:center; background-repeat:no-repeat;">
              <span style="position:relative; top:25px;">'.$text.'</span>
            </a>
        </td>';
}

/* Function to set up the links for a content page */
function createLinkTiles($basePath = "..")
{
  return '
  <table cellpadding="0" cellspacing="0" border="0" style="position:relative; top:0px;">
  <tbody>
  <tr>
    <td>'.createMiniTile($basePath."/images/m11.png", $basePath."/Welcome/", "Wedding Weekend", "mp11", 117, 77).'</td>
    <td>'.createMiniTile($basePath."/images/m12.png", $basePath."/TheEvent/", "Weekend Logistics", "mp12", 118, 77).'</td>
  </tr>
  <tr>
    <td>'.createMiniTile($basePath."/images/m21.png", $basePath."/Registry/", "Registry", "mp21", 117, 78).'</td>
    <td>'.createMiniTile($basePath."/images/m22.png", $basePath."/RSVP/", "RSVP", "mp22", 118, 78).'</td>
  </tr>
  <tr>
    <td>'.createMiniTile($basePath."/images/m31.png", $basePath."/Colorado/", "Visiting Colorado", "mp31", 117, 77).'</td>
    <td>'.createMiniTile($basePath."/images/m32.png", $basePath."/Photos/", "Photos", "mp32", 118, 77).'</td>
  </tr>
  </tbody>
  </table>';

}

/* This set of 3 functions (pageHader, subPageTop, and subPageBottom) should
 * all be used in conjunction to create the standard sub-page template.
 * pageHeader can also be used on its own as the header for any page.
 *
 * \param pathToBase - The relative path to the base level htdocs
 * \param pageName - Name to be displayed in title bar
 */
function pageHeader($pathToBase, $pageName)
{
  global $fadeTime;
  echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<!-- Get CSS -->
<style media="screen" type="text/css">/*<![CDATA[*/@import \''.$pathToBase.'/css/gabriola.css\';/*]]>*/</style>
<link rel="stylesheet" type="text/css" href="'.$pathToBase.'/css/style.css">
<style type="text/css">#title,#glyphs p{font-family:"Gabriola"}</style>
<title>Rebekkah and Gabe - '.$pageName.'</title>

<script src="'.$pathToBase.'/scripts/jquery.js"></script>
<script>
  $(document).ready(function(){    
    // Iitially, hide everything, then fade in
    $("body").css("display", "none");
    $("body").fadeIn('.$fadeTime.');

    // Fade out when leaving the page from a tile
    $(".linkTile").click(function(event){
      event.preventDefault();
      linkLocation = this.href;
      $("body").fadeOut('.$fadeTime.', redirectPage);
    });
 
     // Callback that redirects page correctly
    function redirectPage() {
        window.location = linkLocation;
    }

    // Fade out on mouse over
    $(".fadeTile").mouseover(function(event){
      $(this).fadeTo(0,0.85);
    });

    // Fade in on mouse out
    $(".fadeTile").mouseout(function(event){
      $(this).fadeTo(0,1);
    });

    // Fade registry tile out on mouse over
    $(".itemTile").mouseover(function(event){
      $(this).fadeTo(0,0.75);
    });
  
    // Fade registry in on mouse out
    $(".itemTile").mouseout(function(event){
      $(this).fadeTo(0,0.95);
    });


  });

  function fixHeight() {
    var h = document.getElementById("main_panel").offsetHeight;
    if (h < 704) {
      document.getElementById("footer").style.backgroundImage = "url('.$pathToBase.'/images/shortFooter.png)";
    }
  }
</script>

</head>';
}

/* Function to set up common top section of a sub-page */
function subPageTop($pathToBase = "..")
{
  echo '<body bgcolor="White" id="pageBody" onload="fixHeight();" onunload="">
<center>

<!-- Main Panel------------------------------------------------------------ -->
<div id="main_panel" class="mainPanel">

<!-- Panel Image -->
<div class="panelImage" style="background-image:url(./images/Image.png);"></div>

<!-- Page Background -->
<div class="pageBackground">

<!-- Footer Image -->
<div id="footer" class="footerImage"></div>

<!-- Left Panel------------------------------------------------------------ -->
<div class="leftPanel">

<!-- Image Link -->
<div style="height:469px; width:235px;">
  <a href=".." class="linkTile" style="display:block; width:235px; height:469px"></a>
</div>

<!-- Mini Links -->
<div>'.createLinkTiles($pathToBase).'</div>

</div> <!-- end left panel -->

<!-- Pad left side of body area -->
<div style="height:702px; width:10px; float:left;"></div>

<!-- Body Panel------------------------------------------------------------ -->

<div class="commonText bodyPanel">';
}

/* Function to set up the common bottom section of a sub-page */
function subPageBottom()
{
  echo '</div> <!-- end body div -->
</div> <!-- end background div -->
</div> <!-- end main div -->
</center>
</body></html>';
}

?>