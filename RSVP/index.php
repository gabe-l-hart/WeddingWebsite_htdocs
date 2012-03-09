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

  <!-- Driving/Flying script -->
  <script type="text/javascript">

    function enableFlying() {
      $(".drivingField").prop('disabled', true);
      $(".flyingField").prop('disabled', false);

      $(".flyingFields").css("border-color","#CFCFCF");
      $(".flyingFields").css("border-size","3px");

      $(".drivingFields").css("border-color","#050505");
      $(".drivingFields").css("border-size","3px");
    }
    function enableDriving() {
      $(".flyingField").prop('disabled', true);
      $(".drivingField").prop('disabled', false);

      $(".drivingFields").css("border-color","#CFCFCF");
      $(".drivingFields").css("border-size","3px");

      $(".flyingFields").css("border-color","#010101");
      $(".flyingFields").css("border-size","3px");
    }

    // Start with flying enabled
    var tmpFunc = window.onload;
    window.onload = function() { 
      tmpFunc();
      enableFlying();
    }
  </script>

  <!-- Travel Info Form -->
  <div class="travelContainer"">
    <form class="travelForm" action="" method="post">

      <div class="flyingFieldsContainer">
        <div class="sectionCaption">
          <input type="radio" name="travel_type" checked="checked" value="flying" onclick="enableFlying()" />Flying?
        </div>
        <fieldset class="flyingFields">
          What airport will you be flying into?<br />
          <input class="flyingField" type="radio" name="airport" value="Denver" />Denver<br />
          <input class="flyingField" type="radio" name="airport" value="ColoradoSprings" />
            Colorado Springs<br />
          <input class="flyingField" type="radio" name="airport" value="Other" />Other 
          <input class="flyingField" type="text" name="airport_other" size="10" />
        </fieldset>
      </div>

      <div class="drivingFieldsContainer">
        <div class="sectionCaption">
          <input type="radio" name="travel_type" id="travel_driving" value="driving" onclick="enableDriving()" />Driving?
        </div>
        <fieldset class="drivingFields">
          When do you plan to arrive? Please be as specific as possible.<br />
          <textarea class="drivingField" name="driving_arrival" rows="2" cols="38" /></textarea><br />
      </fieldset>
      </div>
    </form>
  </div>

  <div style="clear:both;"></div>

<?php subPageBottom(); ?>