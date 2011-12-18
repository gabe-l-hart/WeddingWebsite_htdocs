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
  						text-align:center; style="background-repeat:no-repeat;">
  						<span style="position:relative; top:25px;">'.$text.'</span>
  					</a>
  		  </td>';
}

/* Function to set up the links for a content page */
function createLinkTiles()
{
  return '
  <table cellpadding="0" cellspacing="0" border="0" style="position:relative; top:0px;">
  <tbody>
  <tr>
    <td>'.createMiniTile("./images/p11.png", "../Welcome/", "Welcome", "mp11", 117, 77).'</td>
    <td>'.createMiniTile("./images/p12.png", "../TheEvent/", "The Event", "mp12", 118, 77).'</td>
  </tr>
  <tr>
    <td>'.createMiniTile("./images/p21.png", "../Colorado/", "Colorado", "mp21", 117, 78).'</td>
    <td>'.createMiniTile("./images/p22.png", "../Photos/", "Photos", "mp22", 118, 78).'</td>
  </tr>
  <tr>
    <td>'.createMiniTile("./images/p31.png", "../Registry/", "Registry", "mp31", 117, 77).'</td>
    <td>'.createMiniTile("./images/p32.png", "../RSVP/", "RSVP", "mp32", 118, 77).'</td>
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
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<!-- Get CSS -->
<style media="screen" type="text/css">/*<![CDATA[*/@import \'gabriola.css\';/*]]>*/</style>
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
  });
</script>

</head>';
}

/* Function to set up common top section of a sub-page */
function subPageTop()
{
  echo '<body bgcolor="White">
<!-- Main Table------------------------------------------------------------ -->
<center>
<table class="fixedTable" width="704" cellpadding="0" cellspacing="0" border="0" style="padding:0px; border:0px;">
<tbody>

<tr>
<!-- Left Col -->
<td style="vertical-align:top; height:469px; width:235px">
  <a href=".." class="linkTile" style="background-image:url(./images/Image.png); display:block; width:235px; height:469px"></a>
</td>

<!-- Body Col -->
<td rowspan="2">
  <table width="467" cellpadding="0" cellspacing="0" border="0" class="commonText">
  <tbody>
  <tr><td background="./images/top.png" style="height:10px; width:447px;"></td></tr>
  <tr><td background="./images/body.png" bgcolor="49002e" style="background-repeat:no-repeat">

    <table cellpadding="0" cellspacing="0" border="0" class="fixedTable"><tbody><tr>
    <td width="10"></td>
    <td valign="top" width="447">';
}

/* Function to set up the common bottom section of a sub-page */
function subPageBottom()
{
  echo '</td>
    <td width="10"><img src="../images/spacer.png" width="1" height="681"></td>

    </tr></tbody></table>
  </td></tr>
  <tr><td background="./images/bottom.png" style="height:10px; width:447px;"></td></tr>
  </tbody>
  </table>
</td>
</tr>

<!-- Mini Panel -->
<tr>
<td style="position:absolute; top:';

	if (usingIE()){
		echo '485';
	} else {
		echo '478';
	}

	echo 'px;">
  '.createLinkTiles().'
</td>
</tr>

</tbody>

</tbody></table>
</center>

</body></html>';
}

?>