<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- saved from url=(0025)http://cs.unc.edu/~hartg/ -->
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<!-- Get CSS -->
<style media="screen" type="text/css">/*<![CDATA[*/@import 'gabriola.css';/*]]>*/</style>
<link rel="stylesheet" type="text/css" href="./css/style.css">
<style type="text/css">#title,#glyphs p{font-family:"Gabriola"}</style>

<!-- Set Up PHP Functions-------------------------------------------------- -->
<?php

/* Function to create a tile in the home screen */
function createTile($img, $link, $text, $opacity, $name) {
  $out='<div class="image">';
  $out=$out.'<img src='.$img.' alt="" name="'.$name.'" style="opacity: 1;" />';
  $out=$out.'<span class="overlay">
             <a href='.$link.'>
             <table width="234" style="height: 234px; opacity: 1; "
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

<title>Rebekkah and Gabe</title>

</head>

<body bgcolor="White">
<!-- Main Table------------------------------------------------------------ -->
<center>
<table width="704" cellpadding="0" cellspacing="0" border="0">
<tbody>

<!-- First Row -->
<tr>
<td><img src="./images/p11.png" alt="" /></td>
<td><?php echo "" . createTile("./images/p12.png", "www.test.com", "Welcome", 85, "p12") ?></td>
<td><?php echo "" . createTile("./images/p13.png", "www.test.com", "The Place", 85, "p13") ?></td>
</tr>

<!-- Second Row -->
<tr>
<td><img src="./images/p21.png" alt="" /></td>
<td><?php echo "" . createTile("./images/p22.png", "www.test.com", "RSVP", 85, "p22") ?></td>
<td><?php echo "" . createTile("./images/p23.png", "www.test.com", "Registry", 85, "p23") ?></td>
</tr>

<!-- Third Row -->
<tr>
<td><img src="./images/p31.png" alt="" /></td>
<td><?php echo "" . createTile("./images/p32.png", "www.test.com", "The Place", 85, "p32") ?></td>
<td><?php echo "" . createTile("./images/p33.png", "www.test.com", "RSVP", 85, "p33") ?></td>
</tr>

</tbody>

</tbody></table>
</center>

</body></html>