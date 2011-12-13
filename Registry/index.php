<!-- Get PHP Utils -->
<?php require '../scripts/utils.php'; ?>

<?php pageHeader("..", "Registry"); ?>
<?php subPageTop(); ?>

  <!-- Title -->
  <p style="font-size:32px; text-align:center">Registry</p>

  <!-- Item Grid -->
  <table cellpadding="0" cellspacing="0" border="0" class="fixedTable">
  <tbody>

  <tr><td width="5"></td>
  <td align="center" valign="top">
    <?php echo createRegistryPanel("./images/TestImage.png", "TEST", "TestItem") ?>
  </td>
  <td width="10"></td>
  <td align="center" valign="top">
    <?php echo createRegistryPanel("./images/TestImage.png", "TEST 2", "TestItem2") ?>
  </td>
  <td width="5"></td></tr>

  </tbody>
    </table>

<?php subPageBottom(); ?>