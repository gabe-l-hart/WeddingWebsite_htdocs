<!-- Get PHP Utils -->
<?php require '../scripts/utils.php'; ?>
<?php require '../scripts/registry.php'; ?>

<?php pageHeader("..", "Registry"); ?>
<?php subPageTop(); ?>

  <!-- Title -->
  <p style="font-size:32px; text-align:center">Registry</p>

  <!-- Item Grid -->
  <table cellpadding="0" cellspacing="0" border="0" class="fixedTable">
  <tbody>

    <img src="./images/TestImage.png">
    

<!--
  <tr><td width="5"></td>
  <td align="center" valign="top">
    <?php echo createRegistryPanel("./images/TestImage.png", "TEST", "TestItem") ?>
  </td>
  <td width="10"></td>
  <td align="center" valign="top">
    <?php echo createRegistryPanel("./images/TestImage.png", "TEST 2", "TestItem2") ?>
  </td>
  <td width="5"></td></tr>

-->

  </tbody>
  </table>

  <!-- DEBUG -->
  <p><?php listTest(); ?></p>

<?php subPageBottom(); ?>