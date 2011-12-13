<?php

/* Function to create a tile in the home screen */
function createHomeTile($img, $link, $text, $opacity, $name) {
  $out='<div class="image">';
  $out=$out.'<img src='.$img.' alt="" name="'.$name.'" style="opacity: 1;" />';
  $out=$out.'<span class="overlay">
             <a href='.$link.'>
             <table width="234" style="height: 234px; opacity: 1; "
             onmouseover="'.$name.'.style.opacity=0.'.$opacity.';'.$name.'.filters.alpha.opacity='.$opacity.'"
             onmouseout="'.$name.'.style.opacity=1;'.$name.'.filters.alpha.opacity=100">
             <tr valign="bottom"><td>
             <p class="commonText" style="text-align:right; font-size:22px">'.$text.'&nbsp;&nbsp;&nbsp;
             </p>
             </td></tr></table>
             </a>
             </span>';
  $out=$out.'</div>';
  return $out;
}

/* Function to create a small link tile */
function createMiniTile($img, $link, $text, $opacity, $name, $w, $h)
{
  $out='<div class="image">';
  $out=$out.'<img src='.$img.' alt="" name="'.$name.'" style="opacity: 1;" />';
  $out=$out.'<span class="overlay">
             <a href='.$link.'>
             <table width="'.$w.'" style="height: '.$h.'px; opacity: 1; "
             onmouseover="'.$name.'.style.opacity=0.'.$opacity.';'.$name.'.filters.alpha.opacity='.$opacity.'"
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
    <td>'.createMiniTile("./images/p11.png", "../Welcome/", "Welcome", 85, "mp11", 117, 78).'</td>
    <td>'.createMiniTile("./images/p12.png", "../TheEvent/", "The Event", 85, "mp12", 118, 78).'</td>
  </tr>
  <tr>
    <td>'.createMiniTile("./images/p21.png", "../Colorado/", "Colorado", 85, "mp21", 117, 78).'</td>
    <td>'.createMiniTile("./images/p22.png", "../Photos/", "Photos", 85, "mp22", 118, 78).'</td>
  </tr>
  <tr>
    <td>'.createMiniTile("./images/p31.png", "../Registry/", "Registry", 85, "mp31", 117, 77).'</td>
    <td>'.createMiniTile("./images/p32.png", "../RSVP/", "RSVP", 85, "mp32", 118, 77).'</td>
  </tr>';

}

/* Function to set up a registry panel */
function createRegistryPanel($image, $title, $name, $opacity)
{
  return '<div class="image">
      <img src="./images/InnerTile.png" alt="" name="'.$name.'" style="opacity:1;">
      <span class="overlay">
      <a href="./TestItem.php">
      <table cellpadding="0" cellspacing="0" border="0" class="fixedTable"          onmouseover="'.$name.'.style.opacity=0.'.$opacity.';'.$name.'.filters.alpha.opacity='.$opacity.'"
        onmouseout="'.$name.'.style.opacity=1;'.$name.'.filters.alpha.opacity=100">
      <tbody>
        <tr><td height="10" width="212"></td></tr>
        <tr><td align="center">
        <img src="./images/TEST.png" height="160">
        <div style="color:#49002e; text-align:center">'.$title.'</div>
        </td></tr>
        <tr><td></td></tr>
      </tbody>
      </table>
      </a>
      </span>
      </div>';
}

?>