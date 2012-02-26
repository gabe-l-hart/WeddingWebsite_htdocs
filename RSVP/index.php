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


  <script>
  var $overlay_wrapper;
  var $overlay_panel;

  function show_overlay() {
      if ( !$overlay_wrapper ) append_overlay();
      $overlay_wrapper.fadeIn(700);
      $overlay_panel.fadeIn(0);
      fixOverlayHeight();
  }

  function hide_overlay() {
      $overlay_wrapper.fadeOut(500);
  }

  function append_overlay() {
      $overlay_wrapper = $("<div class='overlay' id='overlayBG'></div>").appendTo( $("BODY") );
      $overlay_panel = $("<div class='overlayPanel' id='overlayPanel'>\
        <div id='overlayBG'>\
          <div class='overlayPanelTop'></div>\
          <div class='overlayPanelBody'>\
          <div class='overlayExit'>\
            <a href='#' class='hide-overlay '><img src='../images/closePanel.png'></a>\
          </div>" +
<?php
  if (isset($_POST['success_names'])) {
    if ($_POST['attending']) {
      echo "\"<p class='rsvpSuccessMsg'>Thank you! We can't wait to see you in August!</p>\" +";
    } else {
      echo "\"<p class='rsvpSuccessMsg'>We're so sorry to hear you won't be able to attend. You will be missed.</p>\" +";
    }
  }
?>
          "</div>\
          <div class='overlayPanelBottom'></div>\
        </div>\
      </div>").appendTo( $overlay_wrapper );
      attach_overlay_events();
  }

  function attach_overlay_events() {
      $("A.hide-overlay", $overlay_wrapper).click( function(ev) {
          ev.preventDefault();
          hide_overlay();
      });
  }

  $(function() {
      $("A.show-overlay").click( function(ev) {
          ev.preventDefault();
          show_overlay();
          fixOverlayHeight();
      });
  });

<?php
  if (isset($_POST['success_names'])) {
    echo "show_overlay();";
  }
?>

	// Fix the overlay background height
  function fixOverlayHeight() {
    var bodyH = $(document).height();
    var overlayH = $("#overlayPanel").height();
    if (bodyH > overlayH) {
      document.getElementById("overlayBG").style.height = bodyH + "px";
    } else {
      document.getElementById("overlayBG").style.height = overlayH + "px";
    }
  }

  </script>





  <!-- RSVP Card -->
  <div class="rsvpCard">
    <div class="rsvpCardContainer">
      <p class="dateLine">Please reply by May 1<sup>st</sup></p>
      <form id="rsvp_card" action="scripts/submitRSVP.php" method="post">
        <div class="nameInputPair">
          <label for="names">Guest Name(s)</label>
          <input type="text" name="names" class="rsvpCardInput" size="23">
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