<?php require '../scripts/utils.php'; ?>

<?php pageHeader("..", "Colorado"); ?>
<?php subPageTop(); ?>


  <p class="subPageTitle">Things to do in Colorado</p>

  <!--Float the content to avoid being squashed to the left-->
  <div style="float:left;">

  <style type="text/css">
  .coloradoCaption {
    font-size:24px;
  }
  </style>

  <!--Surrounding Area-->
  <p class="coloradoCaption">Surrounding Area</p>
  <ul class="activityList">
    <li class="activityBullet">Hiking</li>
    <li class="activityBullet">Horse-Back Riding</li>
    <li class="activityBullet">White-Water Rafting</li>
    <li class="activityBullet">Camping</li>
    <li class="activityBullet">Fishing</li>
  </ul>

  <!--Denver-->
  <p class="coloradoCaption">Denver</p>
  <ul class="activityList">
    <li class="activityBullet">Colorado Rockies Game</li>
    <li class="activityBullet">Denver Zoo</li>
    <li class="activityBullet">Performing Arts Center</li>
    <li class="activityBullet">Denver Art Museum</li>
    <li class="activityBullet">Favorite Restaurants:</li>
      <ul class="activityList">
        <li class="activityBullet">Cafe Bar</li>
        <li class="activityBullet">Root Down</li>
        <li class="activityBullet">Park Burger</li>
        <li class="activityBullet">Sushi Den</li>
        <li class="activityBullet">Jelly (brunch)</li>
        <li class="activityBullet">Snooze (brunch)</li>
      </ul>
  </ul>

  <!--End the floated div so the rest will end up properly to the left-->
  </div>

  <!--Clear to expand for floated content-->
  <div style="clear:both;"></div>

  <div style="float:left;">

  <!--DEBUG-->
  <p class="coloradoCaption">Surrounding Area</p>
  <ul class="activityList">
    <li class="activityBullet">Hiking</li>
    <li class="activityBullet">Horse-Back Riding</li>
    <li class="activityBullet">White-Water Rafting</li>
    <li class="activityBullet">Camping</li>
    <li class="activityBullet">Fishing</li>
  </ul>

  </div>

  <!--Clear to expand for floated content-->
  <div style="clear:both;"></div>

<?php subPageBottom(); ?>