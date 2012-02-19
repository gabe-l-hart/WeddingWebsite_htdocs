<?php require '../scripts/utils.php'; ?>

<?php pageHeader("..", "RSVP"); ?>

<link rel="stylesheet" type="text/css" href="./css/rsvp.css">
<?php subPageTop(); ?>

  <!-- Title -->
  <p class="subPageTitle">RSVP</p>

  <!-- Descriptive Text -->
  <div style="margin:10px;">
  <p>This is some really nifty descriptive text about the RSVP process.</p>
  </div>

  <!-- RSVP Card -->
  <div class="rsvpCard">
    <div class="rsvpCardContainer">
      <p class="dateLine">Please reply by May 1<sup>st</sup></p>
      <form id="rsvp_card">
        <div class="nameInputPair">
          <label for="name">Guest Name(s)</label>
          <input type="text" class="rsvpCardInput" size="23">
        </div>
        <div class="attendDiv">
          <input type="radio" name="attend" class="rsvpRadio" value="1">Accept with pleasure<br />
          <input type="radio" name="attend" class="rsvpRadio" value="0">Decline with regret
        </div>
        <div class="rsvpSendDiv">
          <input type="submit" class="rsvpSendButton" value="Send">
        </div>
      </form>
    </div>
  </div>

<?php subPageBottom(); ?>