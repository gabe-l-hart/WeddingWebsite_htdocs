<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- saved from url=(0025)http://cs.unc.edu/~hartg/ -->
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<!-- Get CSS -->
<style media="screen" type="text/css">/*<![CDATA[*/@import 'gabriola.css';/*]]>*/</style>
<link rel="stylesheet" type="text/css" href="../css/style.css">
<style type="text/css">#title,#glyphs p{font-family:"Gabriola"}</style>

<!-- Set Up PHP Functions ------------------------------------------------- -->
<?php
function createMiniTile($img, $link, $text, $opacity, $name, $w, $h) {
  $out='<div class="image">';
  $out=$out.'<img src='.$img.' alt="" name="'.$name.'" style="opacity: 1;" />';
  $out=$out.'<span class="overlay">
             <a href='.$link.'>
             <table width="'.$w.'" style="height: '.$h.'px; opacity: 1; "
             onmouseover="'.$name.'.style.opacity=0.'.$opacity.';'.$name.'.filters.alpha.opacity='.$opacity.'"
             onmouseout="'.$name.'.style.opacity=1;'.$name.'.filters.alpha.opacity=100">
             <tr valign="middle"><td align="center">
             <p class="linkText" style="text-align:center;">'.$text.'
             </p>
             </td></tr></table>
             </a>
             </span>';
  $out=$out.'</div>';
  return $out;
}
?>

<title>Rebekkah and Gabe - RSVP</title>

</head>

<body bgcolor="White">
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
<td rowspan="3">
  <table width="467" cellpadding="0" cellspacing="0" border="0">
  <tbody>
  <tr><td>
    <img src="./images/top.png" height="10">
  </td></tr>
  <tr><td background="./images/body.png" bgcolor="49002e" style="background-repeat:no-repeat">

    <!-- Place Body Here ------------------------------------------------- -->

    <p>RSVP -- TEST</p>
    <p>RSVP -- TEST</p>
    <p>RSVP -- TEST</p>
    <p>RSVP -- TEST</p>
    <p>RSVP -- TEST</p>
    <p>RSVP -- TEST</p>
    <p>RSVP -- TEST</p>
    <p>RSVP -- TEST</p>
    <p>RSVP -- TEST</p>
    <p>RSVP -- TEST</p>
    <p>RSVP -- TEST</p>
    <p>RSVP -- TEST</p>
    <p>RSVP -- TEST</p>
    <p>RSVP -- TEST</p>
    <p>RSVP -- TEST</p>
    <p>RSVP -- TEST</p>
    <p>RSVP -- TEST</p>
    <p>RSVP -- TEST</p>
    <p>RSVP -- TEST</p>
    <p>RSVP -- TEST</p>
    <p>RSVP -- TEST</p>
    <p>RSVP -- TEST</p>
    <p>RSVP -- TEST</p>
    <p>RSVP -- TEST</p>
    <p>RSVP -- TEST</p>
    <p>RSVP -- TEST</p>
    <p>RSVP -- TEST</p>
    <p>RSVP -- TEST</p>
    <p>RSVP -- TEST</p>
    <p>RSVP -- TEST</p>
    <p>RSVP -- TEST</p>
    <p>RSVP -- TEST</p>
    <p>RSVP -- TEST</p>
    <p>RSVP -- TEST</p>
    <p>RSVP -- TEST</p>
    <p>RSVP -- TEST</p>
    <p>RSVP -- TEST</p>
    <p>RSVP -- TEST</p>
    <p>RSVP -- TEST</p>
    <p>RSVP -- TEST</p>
    <p>RSVP -- TEST</p>
    <p>RSVP -- TEST</p>
    <p>RSVP -- TEST</p>
    <p>RSVP -- TEST</p>
    <p>RSVP -- TEST</p>
    <p>RSVP -- TEST</p>
    <p>RSVP -- TEST</p>
    <p>RSVP -- TEST</p>
    <p>RSVP -- TEST</p>
    <p>RSVP -- TEST</p>
    <p>RSVP -- TEST</p>
    <p>RSVP -- TEST</p>
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
  <tr>
    <td><?php echo createMiniTile("./images/p11.png", "../Welcome/", "Welcome", 85, "mp11", 117, 78) ?></td>
    <td><?php echo createMiniTile("./images/p12.png", "../ThePlace/", "The Place", 85, "mp12", 118, 78) ?></td>
  </tr>
  <tr>
    <td><?php echo createMiniTile("./images/p21.png", "../Registry/", "Registry", 85, "mp21", 117, 78) ?></td>
    <td><?php echo createMiniTile("./images/p22.png", ".", "RSVP", 85, "mp22", 118, 78) ?></td>
  </tr>
  <tr>
    <td><?php echo createMiniTile("./images/p31.png", "../Welcome/", "Welcome", 85, "mp31", 117, 77) ?></td>
    <td><?php echo createMiniTile("./images/p32.png", "../ThePlace/", "The Place", 85, "mp32", 118, 77) ?></td>
  </tr>
  </tbody>
  </table
</td>
</tr>

<!-- Empty Expander Row -->
<tr><td></td></tr>

</tbody>

</tbody></table>
</center>

</body></html>