<!-- Get PHP Scripts -->
<?php include './scripts/utils.php'; ?>
<?php pageHeader(".", "Home"); ?>

<body bgcolor="White">
<!-- Main Table------------------------------------------------------------ -->
<center>
<table width="704" cellpadding="0" cellspacing="0" border="0">
<tbody>

<!-- First Row -->
<tr>
<td><img src="./images/p11.png" alt="" /></td>
<td><?php createHomeTile("./images/p12.png", "./Welcome/", "Welcome", "p12") ?></td>
<td><?php createHomeTile("./images/p13.png", "./TheEvent/", "The Event", "p13") ?></td>
</tr>

<!-- Second Row -->
<tr>
<td><img src="./images/p21.png" alt="" /></td>
<td><?php createHomeTile("./images/p22.png", "./Colorado/", "Colorado", "p22") ?></td>
<td><?php createHomeTile("./images/p23.png", "./Photos/", "Photos", "p23") ?></td>
</tr>

<!-- Third Row -->
<tr>
<td><img src="./images/p31.png" alt="" /></td>
<td><?php createHomeTile("./images/p32.png", "./Registry/", "Registry", "p32") ?></td>
<td><?php createHomeTile("./images/p33.png", "./RSVP/", "RSVP", "p33") ?></td>
</tr>

</tbody>

</tbody></table>
</center>

</body></html>