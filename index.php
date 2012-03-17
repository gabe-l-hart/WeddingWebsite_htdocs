<?php include './scripts/utils.php'; ?>
<?php pageHeader(".", "Home"); ?>

<body bgcolor="White">

<!-- Main Table------------------------------------------------------------ -->
<center>
<table width="704" cellpadding="0" cellspacing="0" border="0" class="fixedTable">
<tbody>

<!-- First Row -->
<tr>
<td><img src="./images/p11.png" alt="" /></td>
<?php createHomeTile("./images/p12.png", "./Welcome/", "Our Wedding Weekend", "p12") ?>
<?php createHomeTile("./images/p13.png", "./TheEvent/", "Logistics of the Weekend", "p13") ?>
</tr>

<!-- Second Row -->
<tr>
<td><img src="./images/p21.png" alt="" /></td>
<?php createHomeTile("./images/p22.png", "./Registry/", "Registry", "p22") ?>
<?php createHomeTile("./images/p23.png", "./RSVP/", "RSVP", "p23") ?>
</tr>

<!-- Third Row -->
<tr>
<td><img src="./images/p31.png" alt="" /></td>
<?php createHomeTile("./images/p32.png", "./Colorado/", "Visiting Colorado", "p32") ?>
<?php createHomeTile("./images/p33.png", "./Photos/", "Photos", "p33") ?>
</tr>

</tbody>

</tbody></table>
</center>

</body></html>