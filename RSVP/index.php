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

	function checkRadio (frmName, rbGroupName) { 
 		var radios = document[frmName].elements[rbGroupName]; 
 		for (var i=0; i <radios.length; i++) { 
  		if (radios[i].checked) { 
   			return true; 
  		} 
 		} 
 		return false; 
	} 

	// Validate RSVP form
	function validateRSVP() {
		var nameVal = document.rsvp_card.elements.names.value;
		var attendValid = checkRadio("rsvp_card", "attend");
		if (nameVal == null || nameVal == "" || attendValid == false) {
			alert("Pease provide your name(s) and indicate whether or not you will attend.");
			return false;
		}
		else {
			return true;
		}
	}

  </script>





  <!-- RSVP Card -->
  <div class="rsvpCard">
    <div class="rsvpCardContainer">
      <p class="dateLine">Please reply by May 1<sup>st</sup></p>
      <form name="rsvp_card" onsubmit="return validateRSVP()" action="scripts/submitRSVP.php" method="post">
        <div class="nameInputPair">
          <label for="names">Guest Name(s)</label>
          <input type="text" name="names" class="rsvpCardInput" size="23">
        </div>
        <div class="attendDiv">
          <input type="radio" name="attend" class="rsvpRadio" value="1">Accept with pleasure<br />
          <input type="radio" name="attend" class="rsvpRadio" value="0">Decline with regret
        </div>
        <div class="rsvpSendDiv">
          <input type="submit" class="rsvpButton" value="Send">
        </div>
      </form>
    </div>
  </div>

  <!-- Additional infor form scripts -->
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

		// Make sure the combination of answers is valid
		function validateInfoForm() {

			// Check common fields
			var valid = true;
			if (document.additionalInfoForm.elements.nameField.value == "") {
				valid = false;
				$(".nameInput").css("color","red");
			} else {
				$(".nameInput").css("color","#CFCFCF");
			}
			var travelType = $('input:radio[name=travel_type]:checked').val();
			if (travelType != "flying" && travelType != "driving") {
				alert("Please either \"Flying\" or \"Driving\".");
				return false;
			}
			if ($("#song1").val() == "") {
				valid = false;
				$("#song1Caption").css("color","red");
			} else {
				$("#song1Caption").css("color","#CFCFCF");
			}

			// Check flying Path
			if (travelType == "flying") {

				// Airport
				if (checkRadio("additionalInfoForm", "airport") == false) {
					valid = false;
					$("#airportCaption").css("color","red");
				} else {
					$("#airportCaption").css("color","#CFCFCF");
					var otherRadio = $('#airport_other_radio');
					var otherVal = $('#airport_other').val();
					if (otherRadio.attr("checked") != "undefined" &&
						  otherRadio.attr("checked") == "checked" &&
						  otherVal == "") {
						valid = false;
						$("#airportOtherCaption").css("color","red");
					} else {
						$("#airportOtherCaption").css("color","#CFCFCF");
					}
				}

				// Arrival
				var month = $('#airport_arrival_date_Month_ID').val();
				var day = $('#airport_arrival_date_Day_ID').val();
				var time = $('#flying_arrival_time').val();
				var currentTime = new Date();
				if ((month == currentTime.getMonth() && day == currentTime.getDate()) ||
					  time == null || time == "") {
					valid = false;
					$("#arrivingCaption").css("color","red");
				} else {
					$("#arrivingCaption").css("color","#CFCFCF");
				}

				// Departure
				month = $('#airport_depart_date_Month_ID').val();
				day = $('#airport_depart_date_Day_ID').val();
				time = $('#flying_depart_time').val();
				if ((month == currentTime.getMonth() && day == currentTime.getDate()) ||
					  time == null || time == "") {
					valid = false;
					$("#departingCaption").css("color","red");
				} else {
					$("#departingCaption").css("color","#CFCFCF");
				}
			}

			// Check driving Path
			else if (travelType == "driving") {
				var drivingArrival = $('#driving_arrival').val();
				if (drivingArrival == "" || drivingArrival == null) {
					valid = false;
					$('#drivingArrivalCaption').css("color","red");
				} else {
					$("#drivingArrivalCaption").css("color","#CFCFCF");
				}
			}

			// Alert if not valid, otherwise return true
			if (valid == false) {
				alert("Please fill out required fields (marked in red)");
			}
			return valid;
		}
  </script>

  <!-- Travel Info Form -->
  <div class="additionalInfoContainer">
    <form class="additionalInfoForm" name="additionalInfoForm" onsubmit="return validateInfoForm()" action="" method="post">

      <div class="songFieldContainer">
      	<div class="borderSection">
	        <fieldset class="songFields">
	          <div class="fieldCaption">
	            As part of our reception we hope you will join us in dancing. Everyone has favorite
	            songs to dance to and we want to hear yours! Please help us build the perfect reception
	            playlist by telling us three of your favorite (possibly romantic) songs. If you realy
	            don't have any songs to recommend, just enter "None" in the first box.
	        	</div>
	          <div id="song1Caption">Song 1: </div>
	        	<input class="songField" id="song1" name="song1" size="90" /><br />
	          <div id="song2Caption">Song 2: </div>
	          <input class="songField" id="song2" name="song2" size="90" /><br />
	          <div id="song3Caption">Song 3: </div>
	          <input class="songField" id="song3" name="song3" size="90" />
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
		          <div id="airportCaption">What airport will you be flying into?</div><br />
		          <input class="flyingField" type="radio" name="airport" value="Denver" />Denver<br />
		          <input class="flyingField" type="radio" name="airport" value="ColoradoSprings" />
		            Colorado Springs<br />
		          <input class="flyingField" type="radio" name="airport" id="airport_other_radio" value="Other" /><span id="airportOtherCaption">Other</span> 
		          <input class="flyingField" type="text" name="airport_other" id="airport_other" size="10" /><br /><br />
		          <div id="arrivingCaption">What date and time will you be arriving?</div>
		          <script>DateInput('airport_arrival_date', true, 'DD-MON-YYYY')</script>
		          <input class="flyingField" id="flying_arrival_time" name="flying_arrival_time" size="10" autocomplete="off" />
		          <script type="text/javascript" >$("#flying_arrival_time").timePicker({show24Hours:false});</script><br /><br />
		          <div id="departingCaption">What date and time will you be departing?</div>
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
		          <div class="fieldCaption" id="drivingArrivalCaption">
		            When do you plan to arrive? Please be as specific as possible so we can coordinate meeting you when you get here!
		          </div>
		          <textarea class="drivingField" id="driving_arrival" name="driving_arrival" rows="2" /></textarea><br /><br />
		          <div class="fieldCaption">
		            Do you plan to extend your stay in Colorado by arriving early or staying after the wedding? If so, what are your travel plans? (optional)
		          </div>
		          <textarea class="drivingField" name="driving_extendedTravel" rows="4" /></textarea><br />
		      	</fieldset>
		      </div>

					<div style="clear:both;"></div>
				</div>
			</div>

		<input type="submit" class="rsvpButton otherInfoSubmit" value="Submit"/>
		<div class="nameInput">
			Name: <input type="text" name="nameField" />
		</div>

    </form>
  	<div style="clear:both;"></div>
  </div>

  <div style="clear:both;"></div>

<?php subPageBottom(); ?>