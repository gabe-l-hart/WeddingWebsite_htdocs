<?php
/* Globals */
$highlightOpacity = 85;

/* Function to create a tile in the home screen */
function createHomeTile($img, $link, $text, $name) {
  global $highlightOpacity;
  $out='<div class="image">';
  $out=$out.'<img src='.$img.' alt="" name="'.$name.'" style="opacity: 1;" />';
  $out=$out.'<span class="overlay">
             <a href='.$link.'>
             <table width="234" style="height: 234px; opacity: 1; "
             onmouseover="'.$name.'.style.opacity=0.'.$highlightOpacity.';'.$name.'.filters.alpha.opacity='.$highlightOpacity.'"
             onmouseout="'.$name.'.style.opacity=1;'.$name.'.filters.alpha.opacity=100">
             <tr valign="bottom"><td>
             <p class="commonText" style="text-align:right; font-size:22px">'.$text.'&nbsp;&nbsp;&nbsp;
             </p>
             </td></tr></table>
             </a>
             </span>';
  $out=$out.'</div>';
  echo $out;
}

/* Function to create a small link tile */
function createMiniTile($img, $link, $text, $name, $w, $h)
{
  global $highlightOpacity;
  $out='<div class="image">';
  $out=$out.'<img src='.$img.' alt="" name="'.$name.'" style="opacity: 1;" />';
  $out=$out.'<span class="overlay">
             <a href='.$link.'>
             <table width="'.$w.'" style="height: '.$h.'px; opacity: 1; "
             onmouseover="'.$name.'.style.opacity=0.'.$highlightOpacity.';'.$name.'.filters.alpha.opacity='.$highlightOpacity.'"
             onmouseout="'.$name.'.style.opacity=1;'.$name.'.filters.alpha.opacity=100">
             <tr valign="middle"><td align="center">
             <p class="commonText" style="text-align:center;">'.$text.'
             </p>
             </td></tr></table>
             </a>
             </span>';
  $out=$out.'</div>';
  return $out;
}

/* Function to set up the links for a content page */
function createLinkTiles()
{
  return '<tr>
    <td>'.createMiniTile("./images/p11.png", "../Welcome/", "Welcome", "mp11", 117, 78).'</td>
    <td>'.createMiniTile("./images/p12.png", "../TheEvent/", "The Event", "mp12", 118, 78).'</td>
  </tr>
  <tr>
    <td>'.createMiniTile("./images/p21.png", "../Colorado/", "Colorado", "mp21", 117, 78).'</td>
    <td>'.createMiniTile("./images/p22.png", "../Photos/", "Photos", "mp22", 118, 78).'</td>
  </tr>
  <tr>
    <td>'.createMiniTile("./images/p31.png", "../Registry/", "Registry", "mp31", 117, 77).'</td>
    <td>'.createMiniTile("./images/p32.png", "../RSVP/", "RSVP", "mp32", 118, 77).'</td>
  </tr>';

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
  echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<!-- Get CSS -->
<style media="screen" type="text/css">/*<![CDATA[*/@import \'gabriola.css\';/*]]>*/</style>
<link rel="stylesheet" type="text/css" href="'.$pathToBase.'/css/style.css">
<style type="text/css">#title,#glyphs p{font-family:"Gabriola"}</style>

<title>Rebekkah and Gabe - '.$pageName.'</title>

</head>';
}

/* Function to set up common top section of a sub-page */
function subPageTop()
{
  echo '<body bgcolor="White">
<!-- Main Table------------------------------------------------------------ -->
<center>
<table width="704" cellpadding="0" cellspacing="0" border="0">
<tbody>

<tr>
<!-- Left Col -->
<td valign="top" style="height:469px;">
  <a href="..">
  <img src="./images/Image.png">
  </a>
</td>

<!-- Body Col -->
<td rowspan="3" valign="top">
  <table width="467" cellpadding="0" cellspacing="0" border="0" class="commonText">
  <tbody>
  <tr><td>
    <img src="./images/top.png" height="10">
  </td></tr>
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
  <tr><td>
    <img src="./images/bottom.png" height="10">
  </td></tr>
  </tbody>
  </table>
</td>
</tr>

<!-- Mini Panel -->
<tr valign="top">
<td>
  <table cellpadding="0" cellspacing="0" border="0">
  <tbody>
  '.createLinkTiles().'
  </tbody>
  </table>
</td>
</tr>

<!-- Empty Expander Row -->
<tr><td></td></tr>

</tbody>

</tbody></table>
</center>

</body></html>';
}

?>