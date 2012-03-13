<?php require '../scripts/utils.php'; ?>

<?php pageHeader("..", "RSVP"); ?>

<link rel="stylesheet" type="text/css" href="./css/rsvp.css">
<?php subPageTop(); ?>

<!-- Calander Script -->
<script type="text/javascript" src="./scripts/calendarDateInput.js">

/***********************************************
* Jason's Date Input Calendar- By Jason Moon http://calendar.moonscript.com/dateinput.cfm
* Script featured on and available at http://www.dynamicdrive.com
* Keep this notice intact for use.
***********************************************/

</script>

<!-- Time Picker Script -->
<script type="text/javascript" src="./scripts/jquery.timePicker.js"></script>
<style type="text/css" media="all">@import "./css/timePicker.css";</style>

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

			$(".flyingFields").css("background-color","transparent");
			$(".drivingFields").css("background-color","#AAAAAA");

      //$(".flyingFields").css("border-color","#CFCFCF");
      //$(".flyingFields").css("border-size","3px");

      //$(".drivingFields").css("border-color","#050505");
      //$(".drivingFields").css("border-size","3px");
    }
    function enableDriving() {
      $(".flyingField").prop('disabled', true);
      $(".drivingField").prop('disabled', false);

			$(".flyingFields").css("background-color","#AAAAAA");
			$(".drivingFields").css("background-color","transparent");

      //$(".drivingFields").css("border-color","#CFCFCF");
      //$(".drivingFields").css("border-size","3px");

      //$(".flyingFields").css("border-color","#010101");
      //$(".flyingFields").css("border-size","3px");
    }

    // Start with flying enabled
    var tmpFunc = window.onload;
    window.onload = function() { 
      tmpFunc();
      enableFlying();
      document.getElementById("travel_flying").checked = true;
    }
  </script>

  <!-- Travel Info Form -->
  <div class="additionalInfoContainer">
    <form class="additionalInfoForm" action="" method="post">

      <div class="songFieldContainer">
      	<div class="borderSection">
	        <fieldset class="songFields">
	          <div class="fieldCaption">
	            As part of our reception we hope you will join us in dancing. Everyone has favorite songs to dance to and we want to hear yours! Please help us build the perfect reception playlist by telling us three of your favorite (possibly romantic) songs.
	        	</div>
	          Song 1: <input class="songField" name="song1" size="90" /><br />
	          Song 2: <input class="songField" name="song2" size="90" /><br />
	          Song 3: <input class="songField" name="song3" size="90" />
	      	</fieldset>
      	</div>
      </div>
			<br />
			<div class="travelFieldsContainer">
				<div class="travelFieldsInner borderSection">
					<div class="travelCaption">
		    		In an effort to coordinate travel for all of our guests, please let us know what your travel plans are (driving or flying) along with some details about when you'll be arriving/departing.
					</div>
		      <div class="flyingFieldsContainer">

		        <div class="sectionCaption">
		          <input type="radio" name="travel_type" id="travel_flying" checked="checked" value="flying" onclick="enableFlying()" />Flying?
		        </div>
		        <fieldset class="flyingFields">
		          What airport will you be flying into?<br />
		          <input class="flyingField" type="radio" name="airport" value="Denver" />Denver<br />
		          <input class="flyingField" type="radio" name="airport" value="ColoradoSprings" />
		            Colorado Springs<br />
		          <input class="flyingField" type="radio" name="airport" value="Other" />Other 
		          <input class="flyingField" type="text" name="airport_other" size="10" /><br /><br />
		          What date and time will you be arriving?
		          <script>DateInput('airport_arrival_date', true, 'DD-MON-YYYY')</script>
		          <input class="flyingField" id="flying_arrival_time" name="flying_arrival_time" size="10" autocomplete="off" />
		          <script type="text/javascript" >$("#flying_arrival_time").timePicker({show24Hours:false});</script><br /><br />
		          What date and time will you be departing?
		          <script>DateInput('airport_depart_date', true, 'DD-MON-YYYY')</script>
		          <input class="flyingField" id="flying_depart_time" name="flying_depart_time" size="10" autocomplete="off" />
		          <script type="text/javascript" >$("#flying_depart_time").timePicker({show24Hours:false});</script>
		        </fieldset>
		      </div>

		      <div class="drivingFieldsContainer">
		        <div class="sectionCaption">
		          <input type="radio" name="travel_type" id="travel_driving" value="driving" onclick="enableDriving()" />Driving?
		        </div>
		        <fieldset class="drivingFields">
		          <div class="fieldCaption">
		            When do you plan to arrive? Please be as specific as possible so we can coordinate meeting you when you get here!
		          </div>
		          <textarea class="drivingField" name="driving_arrival" rows="2" /></textarea><br /><br />
		          <div class="fieldCaption">
		            Do you plan to extend your stay in Colorado by arriving early or staying after the wedding? If so, what are your travel plans?
		          </div>
		          <textarea class="drivingField" name="driving_extendedTravel" rows="4" /></textarea><br />
		      </fieldset>
		      </div>

					<div style="clear:both;"></div>
				</div>
			</div>

    </form>
  </div>

  <div style="clear:both;"></div>

<?php subPageBottom(); ?>