<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- saved from url=(0025)http://cs.unc.edu/~hartg/ -->
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<!-- Get CSS -->
<style media="screen" type="text/css">/*<![CDATA[*/@import 'gabriola.css';/*]]>*/</style>
<link rel="stylesheet" type="text/css" href="../css/style.css">
<style type="text/css">#title,#glyphs p{font-family:"Gabriola"}</style>

<!-- Get PHP Utils -->
<?php include '../scripts/utils.php'; ?>

<title>Rebekkah and Gabe - Registry</title>

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
<td rowspan="3" valign="top">
  <table width="467" cellpadding="0" cellspacing="0" border="0" class="commonText">
  <tbody>
  <tr><td>
    <img src="./images/top.png" height="10">
  </td></tr>
  <tr><td background="./images/body.png" bgcolor="49002e" style="background-repeat:no-repeat">

    <table cellpadding="0" cellspacing="0" border="0" class="fixedTable"><tbody><tr>
    <td width="10"></td>
    <td valign="top" width="447">

    <!-- Place Body Here ------------------------------------------------- -->

    <!-- Title -->
    <p style="font-size:32px; text-align:center">Registry</p>

    <!-- Item Grid -->
    <table cellpadding="0" cellspacing="0" border="0" class="fixedTable">
    <tbody>

    <tr><td width="5"></td>
    <td align="center" valign="top">
      <?php echo createRegistryPanel("./images/TestImage.png", "TEST", "TestItem", 85) ?>
    </td>
    <td width="10"></td>
    <td align="center" valign="top">
      <?php echo createRegistryPanel("./images/TestImage.png", "TEST 2", "TestItem2", 85) ?>
    </td>
    <td width="5"></td></tr>

    </tbody>
    </table>

    </td>
    <td width="10"><img src="../images/spacer.png" width="1" height="676"></td>

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
  <?php echo createLinkTiles() ?>
  </tbody>
  </table>
</td>
</tr>

<!-- Empty Expander Row -->
<tr><td></td></tr>

</tbody>

</tbody></table>
</center>

</body></html>