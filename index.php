<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- saved from url=(0025)http://cs.unc.edu/~hartg/ -->
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<!-- Get CSS -->
<link rel="stylesheet" type="text/css" href="./css/style.css">

<!-- Set Up PHP Functions-------------------------------------------------- -->
<?php

/* Function to create a tile in the home screen */
function createTile($img, $link, $text, $opacity, $name) {
	$out='<div class="image">';
	$out=$out.'<img src='.$img.' alt="" name="'.$name.'" style="opacity: 0.'.$opacity.';" />';
	$out=$out.'<span class="overlay">
						 <a href='.$link.'>
						 <table width="234" style="height: 234px; opacity: 0.'.$opacity.'; "
						 onmouseover="'.$name.'.style.opacity=1;'.$name.'.filters.alpha.opacity=100"
						 onmouseout="'.$name.'.style.opacity=0.'.$opacity.';'.$name.'.filters.alpha.opacity='.$opacity.'">
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

<body>
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


<!--
<tbody><tr><td>
	<!--Header Table->
	<table bgcolor="#6F7359" border="0" cellpadding="0" cellspacing="0">

    <!--Header Top Edge->
    <tbody><tr>
    <td><img src="./images/cornerUL_green.jpg" width="10" height="10"></td>
    <td><img src="./images/spacer.gif" width="150" height="10"></td>
    <td><img src="./images/spacer.gif" width="532" height="10"></td>
    <td><img src="./images/cornerUR_green.jpg" width="10" height="10"></td>
    </tr>

	<!--Header->
    <tr>
    <td><img src="./images/spacer.gif" width="10" height="10"></td>
    <td><img src="./images/headShot3.jpg"></td>
    <td>
    <center>
    <font style="font-family:Geneva, Arial, Helvetica, sans-serif; font-size:22px">
    Gabriel L. Hart<br><br></font>
    <font style="font-family:Geneva, Arial, Helvetica, sans-serif; font-size:14px">
    Graduate Student<br>
    Department of Computer Science<br>
    UNC Chapel Hill<br><br>
    Sitterson Hall 268<br>
    (919)962-1843
    </font>
    </center>
    </td>
    <td><img src="./images/spacer.gif" width="10" height="10"></td>
    </tr>
    
    <!--Header Bottom Edge->
    <tr>
    <td><img src="./images/cornerBL_green.jpg" width="10" height="10"></td>
    <td><img src="./images/spacer.gif" width="150" height="10"></td>
    <td><img src="./images/spacer.gif" width="532" height="10"></td>
    <td><img src="./images/cornerBR_green.jpg" width="10" height="10"></td>
    </tr>
    
    </tbody></table>
</td></tr>
<tr><td>
    
    <!--Links Table->
    <table width="705" cellpadding="0" cellspacing="0" border="0">
	<!--Row 1->
    <tbody><tr>
        <td>
        <a href="http://cs.unc.edu/~hartg/about.html" style="display:inline-table">
            <img src="./images/about.jpg" width="235" height="235" border="0" style="opacity: 0.6; " onmouseover="this.style.opacity=1;this.filters.alpha.opacity=100" onmouseout="this.style.opacity=0.6;this.filters.alpha.opacity=60">
        </a>
        </td>
        
        <td>
        <a href="http://cs.unc.edu/~hartg/research.html" style="display:inline-table">
            <img src="./images/research.jpg" width="235" height="235" border="0" style="opacity:0.6; filter:alpha(opacity=60)" onmouseover="this.style.opacity=1;this.filters.alpha.opacity=100" onmouseout="this.style.opacity=0.6;this.filters.alpha.opacity=60">
        </a>
        </td>
        
        <td>
        <a href="http://cs.unc.edu/~hartg/classes.html" style="display:inline-table">
            <img src="./images/classes.jpg" width="235" height="235" border="0" style="opacity:0.6; filter:alpha(opacity=60)" onmouseover="this.style.opacity=1;this.filters.alpha.opacity=100" onmouseout="this.style.opacity=0.6;this.filters.alpha.opacity=60">
        </a>
        </td>
        
    </tr>
    <!--Row 2->
    <tr>
    
    	<td>
        <a href="http://cs.unc.edu/~hartg/education.html" style="display:inline-table">
            <img src="./images/education.jpg" width="235" height="235" border="0" style="opacity: 0.6; " onmouseover="this.style.opacity=1;this.filters.alpha.opacity=100" onmouseout="this.style.opacity=0.6;this.filters.alpha.opacity=60">
        </a>
        </td>
        
        <td>
        <a href="http://picasaweb.google.com/gabe.l.hart" style="display:inline-table">
            <img src="./images/photos.jpg" width="235" height="235" border="0" style="opacity:0.6; filter:alpha(opacity=60)" onmouseover="this.style.opacity=1;this.filters.alpha.opacity=100" onmouseout="this.style.opacity=0.6;this.filters.alpha.opacity=60">
        </a>
        </td>
                
        <td>
        <a href="mailto:hartg@cs.unc.edu" style="display:inline-table">
            <img src="./images/contact.jpg" width="235" height="235" border="0" style="opacity:0.6; filter:alpha(opacity=60)" onmouseover="this.style.opacity=1;this.filters.alpha.opacity=100" onmouseout="this.style.opacity=0.6;this.filters.alpha.opacity=60">
        </a>
        </td>
    </tr>
    </tbody></table>
</td></tr>

-->

</tbody></table>
</center>



<autoscroll_cursor style="position: fixed !important; z-index: 2147483647 !important; left: 0px !important; top: 0px !important; width: 100% !important; height: 100% !important; background-color: transparent !important; background-attachment: fixed !important; background-image: url(chrome-extension://occjjkgifpmdgodlplnacmkejpdionan/icons/scroll/scroll-vertical.png) !important; display: none !important; cursor: auto !important; background-repeat: no-repeat no-repeat !important; "></autoscroll_cursor></body></html>