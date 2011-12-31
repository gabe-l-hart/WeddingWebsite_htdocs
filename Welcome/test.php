<!-- Get PHP Utils -->
<?php require '../scripts/utils.php'; ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<!-- Get CSS -->
<style media="screen" type="text/css">/*<![CDATA[*/@import 'gabriola.css';/*]]>*/</style>
<link rel="stylesheet" type="text/css" href="../css/style.css">
<style type="text/css">#title,#glyphs p{font-family:"Gabriola"}</style>
<title>Rebekkah and Gabe - Welcome</title>

<script src="../scripts/jquery.js"></script>
<script>
  $(document).ready(function(){    
    // Iitially, hide everything, then fade in
    $("body").css("display", "none");
    $("body").fadeIn(500);

    // Fade out when leaving the page from a tile
    $(".linkTile").click(function(event){
      event.preventDefault();
      linkLocation = this.href;
      $("body").fadeOut(500, redirectPage);
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

  function fixHeight() {
    var h = document.getElementById('main_panel').offsetHeight;
    if (h == 701) {
      //alert("found it");
      //document.getElementById('footer').style.height = url(./images/shortFooter.png);
    }
  }

</script>

</head><body bgcolor="White" onload="fixHeight();">
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
<div style="height:469px; 235px;">
  <a href=".." class="linkTile" style="display:block; width:235px; height:469px"></a>
</div>

<!-- Mini Links -->
<div><?php echo createLinkTiles(); ?></div>

</div> <!-- end left panel -->

<!-- Body Panel------------------------------------------------------------ -->

<div style="min-height:701px;">

    <p>Welcome -- TEST</p>
<!--
    <p>Welcome -- TEST</p>
    <p>Welcome -- TEST</p>
    <p>Welcome -- TEST</p>
    <p>Welcome -- TEST</p>
    <p>Welcome -- TEST</p>
    <p>Welcome -- TEST</p>

    <p>Welcome -- TEST</p>
    <p>Welcome -- TEST</p>
    <p>Welcome -- TEST</p>
    <p>Welcome -- TEST</p>
    <p>Welcome -- TEST</p>
    <p>Welcome -- TEST</p>

    <p>Welcome -- TEST</p>
    <p>Welcome -- TEST</p>
    <p>Welcome -- TEST</p>
    <p>Welcome -- TEST</p>
    <p>Welcome -- TEST</p>
    <p>Welcome -- TEST</p>

    <p>Welcome -- TEST</p>
    <p>Welcome -- TEST</p>
    <p>Welcome -- TEST</p>
    <p>Welcome -- TEST</p>
    <p>Welcome -- TEST</p>
    <p>Welcome -- TEST</p>

    <p>Welcome -- TEST</p>
    <p>Welcome -- TEST</p>
    <p>Welcome -- TEST</p>
    <p>Welcome -- TEST</p>
    <p>Welcome -- TEST</p>
    <p>Welcome -- TEST</p>

    <p>Welcome -- TEST</p>
    <p>Welcome -- TEST</p>
    <p>Welcome -- TEST</p>
    <p>Welcome -- TEST</p>
    <p>Welcome -- TEST</p>
    <p>Welcome -- TEST</p>

    <p>Welcome -- TEST</p>
    <p>Welcome -- TEST</p>
    <p>Welcome -- TEST</p>
    <p>Welcome -- TEST</p>
    <p>Welcome -- TEST</p>
    <p>Welcome -- TEST</p>

    <p>Welcome -- TEST</p>
    <p>Welcome -- TEST</p>
    <p>Welcome -- TEST</p>
    <p>Welcome -- TEST</p>
    <p>Welcome -- TEST</p>
    <p>Welcome -- TEST</p>

    <p>Welcome -- TEST</p>
    <p>Welcome -- TEST</p>
    <p>Welcome -- TEST</p>
<!-- -->

</div> <!-- end body div -->

</div> <!-- end background div -->
</div> <!-- end main div -->
</center>
</body></html>