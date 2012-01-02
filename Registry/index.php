<!-- Get PHP Utils -->
<?php require '../scripts/utils.php'; ?>
<?php require '../scripts/registry.php'; ?>

<?php
  // Set up registry
  $reg = new Registry();
  $reg->setHost('localhost');
  $reg->setUser('root');
  $reg->setPW('root');

  // Connect to DB
  $reg->connect();
?>

<?php pageHeader("..", "Registry"); ?>
<?php subPageTop(); ?>

  <!-- Title -->
  <p style="font-size:32px; text-align:center">Registry</p>

  <!-- Item Grid -->
  <div style="position:relative;">

<!---->
    <?php
      $item1 = new RegistryItem("./images/TEST.png", "test", "long test", "testItem1", "www.test.com");
      echo $item1->createSmallTile();
    ?>

    <?php
      $item2 = new RegistryItem("./images/TEST.png", "test 2", "long test 2", "testItem2", "www.test.com");
      echo $item2->createSmallTile();
    ?>

    <?php
      $item2 = new RegistryItem("./images/TEST.png", "test 2", "long test 2", "testItem2", "www.test.com");
      echo $item2->createSmallTile();
    ?>

    <?php
      $item2 = new RegistryItem("./images/TEST.png", "test 2", "long test 2", "testItem2", "www.test.com");
      echo $item2->createSmallTile();
    ?>

    <?php
      $item2 = new RegistryItem("./images/TEST.png", "test 2", "long test 2", "testItem2", "www.test.com");
      echo $item2->createSmallTile();
    ?>

    <?php
      $item2 = new RegistryItem("./images/TEST.png", "test 2", "long test 2", "testItem2", "www.test.com");
      echo $item2->createSmallTile();
    ?>

    <?php
      $item2 = new RegistryItem("./images/TEST.png", "test 2", "long test 2", "testItem2", "www.test.com");
      echo $item2->createSmallTile();
    ?>

    <?php
      $item2 = new RegistryItem("./images/TEST.png", "test 2", "long test 2", "testItem2", "www.test.com");
      echo $item2->createSmallTile();
    ?>

    <?php
      $item2 = new RegistryItem("./images/TEST.png", "test 2", "long test 2", "testItem2", "www.test.com");
      echo $item2->createSmallTile();
    ?>

    <?php
      $item2 = new RegistryItem("./images/TEST.png", "test 2", "long test 2", "testItem2", "www.test.com");
      echo $item2->createSmallTile();
    ?>
<!---->
    <br style="clear:both;"/>
  </div> <!-- end item grid -->

<?php subPageBottom(); ?>