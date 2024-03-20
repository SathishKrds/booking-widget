<?php
$events = get_field('events');
$checkin = get_field('check_in');
$checkout = get_field('check_out');
$rooms = get_field('rooms');
$min_adult = get_field('min_adult');
$max_adult = get_field('max_adult');
$min_child = get_field('min_child');
$max_child = get_field('max_child');
$child_age = get_field('child_age');
?>

<!DOCTYPE html>

<head>
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

	<style>
		.title {
			font-size: 11px;
			color: black;
		}

		.container-widget {
			display: flex;
			padding: 39px;
			background-color: white;
			border-radius: 100px;
			align-items: center;
			justify-content: center;
			width: 100%;
			height: 50px;
			margin: auto;
			gap: 1em;

		}

		.age_dropdown {
			display: flex;
			width: -webkit-fill-available;
			justify-content: center;
			align-items: center;
		}

		.step {
			padding: 25px;
			border-radius: 100px;
			align-items: center;
			justify-content: center;
			line-height: 20px;
		}

		.language-toggle-container {
			display: flex;
			padding: 11px;
			border-radius: 105px;
		}

		.language-toggle-link {
			text-decoration: none;
			padding: 10px;
		}

		.language-toggle-link.selected {
			background-color: rgb(215, 215, 215);
			color: black;
		}

		.language-toggle-link:not(.selected) {
			background-color: rgb(235, 235, 235);
			color: black;
		}

		#engLink {
			border-top-left-radius: 100px;
			border-bottom-left-radius: 100px;
		}

		#arLink {
			border-top-right-radius: 100px;
			border-bottom-right-radius: 100px;
		}

		.search-button {
			background-color: rgb(80, 145, 153);
			padding: 12px;
			border-radius: 100px;
			width: 100px;
			border: 0px;
			color: white;
		}

		.daterangepicker .calendar-table {
			font-family: 'Mont-Book';
		}

		.daterangepicker.show-calendar .drp-buttons {
			font-family: 'Mont-Book';
		}

		.dropdown {
			position: relative;
			display: inline-block;

		}

		.dropdown-content {
			display: none;
			margin-top: 10px;
			position: absolute;
			min-width: 278px;
			z-index: 1;
		}

		.dropdown.active .dropdown-content {
			display: block;
		}

		.counter {
			display: flex;
			align-items: center;
			margin-bottom: 5px;
			justify-content: space-around;
		}

		.counter span {
			margin: 0 10px;
		}

		.decrement {
			background-color: rgb(203, 203, 203);
		}

		.increment {
			background-color: rgb(80, 145, 153);
		}

		.counter button {
			color: white;
			border: none;
			padding: 3px 10px;
			text-align: center;
			text-decoration: none;
			display: inline-block;
			font-size: 16px;
			margin: 2px 2px;
			cursor: pointer;
			background-color: #cacaca !important;
			border-radius: 16px;
		}

		.add-room-btn {
			background-color: rgb(80, 145, 153);
			color: white;
			border: none;
			padding: 10px 20px;
			text-align: center;
			text-decoration: none;
			display: inline-block;
			font-size: 16px;
			margin-top: 10px;
			cursor: pointer;
			margin-left: 123px;
			position: absolute;
			border-radius: 20px;
		}

		.child-ages {
			margin-top: 5px;
		}

		.room {
			display: flex;
			flex-direction: column;
			margin-top: 10px;
			position: relative;
			border: 1px solid #ddd;
			padding: 10px;
			background-color: #f9f9f9;
			border-radius: 0px 0px 22px 22px;
			gap: 1em;

		}

		.close-button {
			position: absolute;
			top: 5px;
			right: 5px;
			cursor: pointer;
			color: black;
			border: none;
			border-radius: 50%;
			padding: 5px;
			background: none;
		}

		.date {
			border-right: 1px solid #cacaca;
		}

		.daterangepicker {
			top: 357.703px !important;
			left: auto !important;
			right: 425.984px !important;
			display: block;
			border-radius: 10px;
		}

		.daterangepicker select.monthselect select.yearselect {
			background-color: #f9f9f9 !important;
		}

		.current-date,
		.inactive {
			color: lightgray !important;
			pointer-events: none;
			/* Disable selection */
		}

		.current-date {
			background-color: lightgreen !important;
		}

		.on,
		.off {
			position: unset;
		}

		.daterangepicker td.disabled,
		.daterangepicker option.disabled {
			text-decoration: none !important;
		}

		.daterangepicker .drp-calendar {
			max-width: none !important;
		}

		.daterangepicker .drp-calendar.right {
			padding: 20px 20px 27px 24px !important;
			width: 500px !important;
		}

		.daterangepicker .drp-calendar.left {
			padding: 20px 20px 27px 24px !important;
			width: 500px !important;
		}

		.daterangepicker select.monthselect,
		.daterangepicker select.yearselect {
			background-color: white;
		}

		.mode-toggle {
			margin-top: 20px;
			/* gap: 10px; */
		}

		.mode-button {
			padding: 10px 20px;
			border: 0;
			background-color: rgba(255, 255, 255, 0.87);
			color: rgb(80, 145, 153);
			cursor: pointer;
		}

		#vacationMode {
			border-top-left-radius: 20px;
			border-bottom-left-radius: 20px;
		}

		#experiencesMode {
			border-top-right-radius: 20px;
			border-bottom-right-radius: 20px;
		}

		.mode-button.selected {
			background-color: rgb(80, 145, 153);
			color: white;
		}

		.daterangepicker.ltr.auto-apply.single.opensleft.show-calendar {
			right: 892.984px !important;

		}

		.error-container {
			display: none;
			background: white;
			color: #509199;
			padding: 10px;
			border-radius: 34px;
			margin-top: 10px;
			text-align: center;

		}

		.experience-text {
			background-color: rgba(255, 255, 255, 0.65);
			color: rgba(0, 0, 0, 0.5);
			text-align: center;
			padding: 10px;
			border-radius: 34px;
			margin-top: 10px;
			width: 132%;
		}
	</style>
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
</head>

<body>
	<div class="mode-toggle" style="display: flex; justify-content: left; margin-bottom: 20px;">
		<button id="vacationMode" class="mode-button selected" onclick="switchMode('VACATION')">VACATION</button>
		<button id="experiencesMode" class="mode-button" onclick="switchMode('EXPERIENCES')">EXPERIENCES</button>
	</div>

	<div class="container-widget">
		<div class="step">
			<div class="date">
				<span class="title"> Choose your Holiday </span> <br>
				<!-- <span style="color: rgb(128,128,128);">STAY & PLAY</span> -->
				<select name="custom_field_select" style="background: none;">
					<?php
					foreach ($events as $event) {
						echo "<option value='$event' $selected>$event</option>";
					}
					?>
				</select>
			</div>
		</div>
		<div class="step">
			<div class="date">
				<span class="title"> Choose your Dates </span> <br>
				<!-- CHECK-IN- CHECK-OUT -->
				<input type="text" name="datefilter" id="date" placeholder="CHECK-IN- CHECK-OUT " style="background: none;width: 180px;" value="" autocomplete="off" readonly />
			</div>
		</div>
		<div class="dropdown" onclick="toggleDropdown(event)">
			<div class="date">
				<label class="title">Choose Guest & rooms</label>
				<input type="text" style="border-top: 0; border-left: 0; border-right: 0" name="guest-room" id="guestRoom" placeholder="ADULT DETAILS" autocomplete="off" readonly>
				<div class="dropdown-content" onclick="stopPropagation(event)">
					<div id="room1" class="room">
						<span style="font-weight: bold; text-align:left;">Room 1</span>
						<button class="close-button" onclick="closeRoom(1)">X</button>
						<div class="counter">
							<div>
								<span style="font-size: 13px;">ADULTS (12 YRS +)</span>
							</div>
							<div>
								<button class="decrement" onclick="decrement('adult', 1)">-</button>
								<span id="adultCount1">1</span>
								<button class="increment" onclick="increment('adult', 1)">+</button>
							</div>
						</div>
						<div class="counter">
							<div>
								<span style="font-size: 13px;">CHILD</span>
							</div>
							<div style="margin-left: 65px;">
								<button class="decrement" onclick="decrement('child', 1)">-</button>
								<span id="childCount1">0</span>
								<button class="increment" onclick="increment('child', 1)">+</button>
							</div>
						</div>

						<div class="child-ages" id="childAges1">

						</div>
					</div>
					<button class="add-room-btn" onclick="addRoom()">ADD ROOM &nbsp; +</button>
				</div>
			</div>
		</div>
		<input class="search-button" type="button" value="SEARCH">
	</div>
	<div id="errorContainer" class="error-container"></div>
	<div id="experienceText" class="experience-text" style="display: none;">
		Select the corresponding event date to start booking your experience.
	</div>
	<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
	<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
	<!-- <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script> -->
	<script>
		let roomCount = 1;
		let totalMembers = 1;
		let mode = 'VACATION';

		$('.search-button').on('click', function() {
			// Extract values from the date input field
			const dateInput = $('input[name="datefilter"]').val();
			const dateRange = dateInput.split(' - ');
			const fromDate = dateRange[0]; // Make sure the date format aligns with your PHP and external API expectations
			const toDate = dateRange[1];

			// Extract total numbers and age details of guests from the user input
			const totalAdults = getTotalAdults();
			const totalChildren = getTotalChildren();
			const childAges = getChildAgesFromInput(); // Function to extract child ages

			// Constructing the endpoint for the PHP script
			const phpScriptUrl = 'apiRequest.php';

			// Building the query string with data to send
			const queryString = $.param({
				from: fromDate,
				to: toDate,
				adult: totalAdults,
				child: totalChildren,
				childAges: childAges,
				rooms: roomCount
			});

			window.open(`${phpScriptUrl}?${queryString}`, '_blank');
		});


		// Function to calculate total adults from all rooms
		function getTotalAdults() {
			let totalAdults = 0;
			for (let i = 1; i <= roomCount; i++) {
				totalAdults += parseInt($('#adultCount' + i).text(), 10);
			}
			return totalAdults;
		}

		// Function to calculate total children from all rooms
		function getTotalChildren() {
			let totalChildren = 0;
			for (let i = 1; i <= roomCount; i++) {
				totalChildren += parseInt($('#childCount' + i).text(), 10);
			}
			return totalChildren;
		}

		// Function to gather ages of all children
		function getChildAgesFromInput() {
			// Get the value of the guest-room input
			const guestRoomValue = $('#guestRoom').val();

			// Find the part of the string that contains child ages
			const childAgesPart = guestRoomValue.split('Child Ages:')[1];

			// Check if there is a part containing child ages
			if (childAgesPart) {
				// Remove any leading or trailing spaces and split by comma to get individual ages
				const ages = childAgesPart.trim().split(',').map(age => age.trim());
				return ages.join(',');
			} else {
				// Return an empty string if there are no child ages
				return '';
			}
		}

		function toggleDropdown(event) {
			const dropdown = document.querySelector('.dropdown');
			dropdown.classList.toggle('active');
			event.stopPropagation();
		}

		function stopPropagation(event) {
			event.stopPropagation();
		}

		function addRoom() {
			const totalAdults = parseInt(document.getElementById('adultCount1').innerText);
			const totalChildren = parseInt(document.getElementById('childCount1').innerText);
			const roomMembers = totalAdults + totalChildren;

			const existingRooms = document.querySelectorAll('.room');
    		const newRoomNumber = existingRooms.length + 1;

			if (roomCount < 9 && roomMembers <= 4) {
				roomCount = newRoomNumber;
        		totalMembers += roomMembers;

				const container = document.querySelector('.dropdown-content');
				const newRoom = document.createElement("div");
				newRoom.classList.add("room");
				newRoom.id = `room${newRoomNumber}`;
				newRoom.innerHTML = `
            <span style="font-weight: bold;">Room ${newRoomNumber}</span>
            <button class="close-button" onclick="closeRoom(${newRoomNumber})">X</button>
            <div class="counter">
                <div>
                    <span style="font-size: 13px;">ADULTS (12 YRS +)</span>
                </div>
                <div>
                    <button class="decrement" onclick="decrement('adult', ${newRoomNumber})">-</button>
                    <span id="adultCount${newRoomNumber}">1</span>
                    <button class="increment" onclick="increment('adult', ${newRoomNumber})">+</button>
                </div>
            </div>
            <div class="counter">
                <div>
                    <span style="font-size: 13px;">CHILD</span>
                </div>
                <div style="margin-left: 65px;">
                    <button class="decrement" onclick="decrement('child', ${newRoomNumber})">-</button>
                    <span id="childCount${newRoomNumber}">0</span>
                    <button class="increment" onclick="increment('child', ${newRoomNumber})">+</button>
                </div>
            </div>
            <div class="child-ages" id="childAges${newRoomNumber}"></div>
        `;
				container.insertBefore(newRoom, document.querySelector('.add-room-btn'));

				updateTotalCount();
			} else {
				alert("You can only add up to 15 rooms, and the total number of members should not exceed 60. Each room can have a maximum of 4 members (adults + children).");
			}
		}

		function updateTotalCount() {
			let totalAdults = 0;
			let totalChildren = 0;
			let childAges = [];

			for (let i = 1; i <= roomCount; i++) {
				totalAdults += parseInt(document.getElementById(`adultCount${i}`).innerText);
				totalChildren += parseInt(document.getElementById(`childCount${i}`).innerText);

				const childAgeDropdowns = document.getElementById(`room${i}`).querySelectorAll('select');
				childAgeDropdowns.forEach(dropdown => {
					if (dropdown.value !== "") {
						childAges.push(parseInt(dropdown.value));
					}
				});
			}

			// Define maxTotalGuests based on mode to maintain flexibility for future changes
			const maxTotalGuests = mode === 'EXPERIENCES' ? 70 : roomCount * 4;
			if (totalAdults + totalChildren > maxTotalGuests) {
				alert(`Maximum of ${maxTotalGuests} guests allowed in ${mode} mode.`);
				return; // Exit without updating the display if over limit
			}

			const guestRoomInput = document.getElementById('guestRoom');
			// Format for displaying guest information stays consistent between modes
			guestRoomInput.value = `${totalAdults} Adults - ${totalChildren} Children - ${roomCount} Rooms`;

			// Add child ages if available, this line remains outside the mode check as it applies to both
			if (childAges.length > 0) {
				guestRoomInput.value += `, Child Ages: ${childAges.join(', ')}`;
			}
		}

		function validateRoom() {
			const totalAdults = parseInt(document.getElementById('adultCount1').innerText);
			const totalChildren = parseInt(document.getElementById('childCount1').innerText);

			if (roomCount < <?php echo esc_js($rooms); ?> &&
				totalAdults <= <?php echo esc_js($max_adult); ?> &&
				totalChildren <= <?php echo esc_js($max_child); ?>) {
				addRoom();
			} else {
				alert("Invalid room configuration. Please check the maximum limits.");
			}
		}

		function increment(type, roomNumber) {
			const adultCount = parseInt(document.getElementById(`adultCount${roomNumber}`).innerText);
			const childCount = parseInt(document.getElementById(`childCount${roomNumber}`).innerText);
			const total = adultCount + childCount;

			// Adjust maximum number of guests based on the mode
			const maxGuests = mode === 'EXPERIENCES' ? 70 : 4;
			const maxChildrenPerRoom = mode === 'EXPERIENCES' ? 70 : 3; // Assuming in EXPERIENCES mode we can also have more children, adjust as needed

			if (type === 'child') {
				// Check conditions based on selected mode
				if (childCount < maxChildrenPerRoom && total < maxGuests) {
					document.getElementById(`childCount${roomNumber}`).innerText = childCount + 1;
					addChildAgeDropdown(roomNumber, childCount + 1);
				} else {
					displayErrorMessage(`Maximum of ${maxChildrenPerRoom} children or total ${maxGuests} guests allowed per room.`);
				}
			} else if (type === 'adult') {
				// Allow adding an adult only if total number of people is less than maxGuests
				if (total < maxGuests) {
					document.getElementById(`adultCount${roomNumber}`).innerText = adultCount + 1;
				} else {
					displayErrorMessage(`Maximum of ${maxGuests} guests allowed per room.`);
				}
			}

			updateTotalCount(); // Update the total count displayed to the user
		}

		function displayErrorMessage(message) {
			const errorContainer = document.getElementById("errorContainer");
			if (!errorContainer) {
				const container = document.createElement("div");
				container.id = "errorContainer";
				container.className = "error-container";
				container.textContent = message;
				container.style.color = "#509199";
				container.style.display = "block"; // Show the container
				document.getElementById("container-widget").appendChild(container);
			} else {
				errorContainer.textContent = message;
				errorContainer.style.display = "block"; // Show the container
			}
		}


		function decrement(type, roomNumber) {
			const adultCount = parseInt(document.getElementById(`adultCount${roomNumber}`).innerText);
			const childCount = parseInt(document.getElementById(`childCount${roomNumber}`).innerText);

			// Decrement the count based on the type
			if (type === 'adult') {
				if (adultCount > 1) {
					document.getElementById(`adultCount${roomNumber}`).innerText = adultCount - 1;
				}
			} else if (type === 'child') {
				if (childCount > 0) {
					document.getElementById(`childCount${roomNumber}`).innerText = childCount - 1;
					// Remove the last child age dropdown corresponding to the decremented child
					removeChildAgeDropdown(roomNumber, childCount);
				}
			}

			// Hide the error message if it exists
			hideErrorMessage();
			updateTotalCount(); // Update the total count displayed to the user
		}


		function hideErrorMessage() {
			const errorContainer = document.getElementById("errorContainer");
			if (errorContainer) {
				errorContainer.style.display = "none"; // Hide the error container
			}
		}


		function addChildAgeDropdown(roomNumber, childNumber) {
			const container = document.getElementById(`room${roomNumber}`);

			// Create a div to wrap the label and dropdown
			const divWrapper = document.createElement("div");
			divWrapper.id = `child${childNumber}Age${roomNumber}_wrapper`;
			divWrapper.className = `age_dropdown`;
			divWrapper.style.textAlign = "center";
			divWrapper.style.marginTop = "10px";

			const label = document.createElement("span");
			label.textContent = `CHILD ${childNumber}: `;
			label.style.padding = "0 10px";
			divWrapper.appendChild(label);

			const dropdown = document.createElement("select");
			dropdown.id = `child${childNumber}Age${roomNumber}`;
			dropdown.style.marginLeft = "30px";
			dropdown.style.width = "52%";
			dropdown.style.height = "29px";
			dropdown.style.textAlign = "center";
			dropdown.style.color = "white";
			dropdown.style.backgroundColor = "rgb(175, 175, 175)";
			dropdown.style.borderRadius = "20px";
			dropdown.innerHTML = '<option value="" disabled selected>AGE</option>';

			for (let i = 1; i <= 12; i++) {
				const option = document.createElement("option");
				option.value = i;
				option.text = i;
				dropdown.appendChild(option);
			}

			dropdown.addEventListener('change', function() {
				displayChildAges(roomNumber);
			});

			divWrapper.appendChild(dropdown);

			// Append the divWrapper to the container
			container.appendChild(divWrapper);
		}

		function removeChildAgeDropdown(roomNumber, childNumber) {
			const dropdownWrapperId = `child${childNumber}Age${roomNumber}_wrapper`;
			const dropdownWrapper = document.getElementById(dropdownWrapperId);

			if (dropdownWrapper) {
				dropdownWrapper.remove();
			}
		}

		function displayChildAges(roomNumber) {
			const container = document.getElementById(`room${roomNumber}`);
			const childAgesContainer = document.getElementById(`childAges${roomNumber}`);
			const childAgeDropdowns = container.querySelectorAll('select');
			const selectedAges = Array.from(childAgeDropdowns)
				.filter(dropdown => dropdown.value !== "")
				.map(dropdown => dropdown.value);

			// childAgesContainer.innerText = `Child Ages: ${selectedAges.join(', ')}`;
			updateTotalCount();
		}

		function closeRoom(roomNumber) {
			if (roomNumber !== 1) {
				const room = document.getElementById(`room${roomNumber}`);
				const roomMembers = parseInt(document.getElementById(`adultCount${roomNumber}`).innerText) +
					parseInt(document.getElementById(`childCount${roomNumber}`).innerText);
				totalMembers -= roomMembers;
				room.remove();
				roomCount--;
				updateTotalCount();
			}
		}

		function convertDateFormat(inputDate) {
			var parts = inputDate.split("/");
			if (parts.length === 3) {
				return parts[2] + "-" + parts[1] + "-" + parts[0];
			} else {
				// Handle invalid date format
				console.error("Invalid date format: " + inputDate);
				return null;
			}
		}

		function changeLanguage(language) {
			document.getElementById('engLink').classList.remove('selected');
			document.getElementById('arLink').classList.remove('selected');

			if (language === 'en') {
				document.getElementById('engLink').classList.add('selected');
			} else if (language === 'ar') {
				document.getElementById('arLink').classList.add('selected');
			}
		}

		$(function() {
			// Function to update the daterangepicker based on the mode
			function updateDatepickerMode() {
				var today = moment();
				var startDate = moment('2024-01-01'); // Adjust as necessary

				var pickerOptions = {
					autoUpdateInput: false,
					singleDatePicker: mode === 'EXPERIENCES',
					locale: {
						cancelLabel: 'Clear',
						format: 'MM/DD/YYYY',
						separator: ' - ',
						applyLabel: 'Apply',
						cancelLabel: 'Cancel',
						fromLabel: 'From',
						toLabel: 'To',
						customRangeLabel: 'Custom',
						weekLabel: 'W',
						daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
						monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
						firstDay: 0 // Sunday is the first day of the week
					},
					startDate: today, // Start from today
					minDate: startDate, // Set minDate to January 2024
					showDropdowns: true, // Show dropdowns for month and year selection
					isInvalidDate: function(date) {
						// Disable past and current dates
						return date.isBefore(today) || date.isSame(today, 'day');
					},
					// Custom classes for styling
					"opens": "left",
					"showCustomRangeLabel": false,
					"drops": "down",
					"autoApply": true,
					"startDateClass": "start-date",
					"endDateClass": "end-date",
					"linkedCalendars": true,
					"showWeekNumbers": true,
					"minYear": 2024,
					"maxYear": 2025,
					"numberOfMonths": 2, // Show two months in one calendar
					"showTopbar": false // Hide the top bar with buttons
				};

				// Remove any existing data pickers to avoid conflicts
				$('input[name="datefilter"]').daterangepicker('destroy');

				// Initialize the date range picker with new settings
				$('input[name="datefilter"]').daterangepicker(pickerOptions);

				// Handle apply and cancel events for daterangepicker
				$('input[name="datefilter"]').off('apply.daterangepicker cancel.daterangepicker'); // Remove old event handlers
				$('input[name="datefilter"]').on('apply.daterangepicker', function(ev, picker) {
					var displayValue = picker.startDate.format('MM/DD/YYYY');
					if (mode === 'VACATION') {
						displayValue += ' - ' + picker.endDate.format('MM/DD/YYYY');
					}
					$(this).val(displayValue);
				}).on('cancel.daterangepicker', function(ev, picker) {
					$(this).val('');
				});
			}

			// Call this function to initialize the picker according to the default mode
			updateDatepickerMode();

			function switchMode(newMode) {
				// Update the global mode variable
				mode = newMode;
				updateDatepickerMode();

				// Reset selected styles for mode buttons
				document.getElementById('vacationMode').classList.remove('selected');
				document.getElementById('experiencesMode').classList.remove('selected');
				// Clear the ADULT DETAILS input
				var guestRoomInput = document.getElementById('guestRoom');
				guestRoomInput.value = '';

				var dateInput = document.getElementById('date');
				dateInput.value = '';

				// Find all adult and child count inputs and reset their values
				var adultCounts = document.querySelectorAll('[id^="adultCount"]');
				var childCounts = document.querySelectorAll('[id^="childCount"]');

				// Reset adult counts to the default value, typically 1 for adults
				adultCounts.forEach(function(adultCount) {
					adultCount.innerText = '1'; // Assuming the default value is 1
				});

				// Reset child counts to 0 as default
				childCounts.forEach(function(childCount) {
					childCount.innerText = '0'; // Assuming the default value is 0
				});

				// Reset all child age selections to the placeholder option
				var childAgeSelects = document.querySelectorAll('.age_dropdown select');
				childAgeSelects.forEach(function(select) {
					select.selectedIndex = 0; // Set to the first option, typically the placeholder
				});

				// remove the age dropdowns
				var ageDropdowns = document.querySelectorAll('.age_dropdown');
				ageDropdowns.forEach(function(dropdown) {
					dropdown.parentNode.removeChild(dropdown); // Remove each child age dropdown
				});

				// Clear out all child age wrappers in all rooms
				$('.age_dropdown').each(function() {
					$(this).empty(); // Remove child age dropdowns
				});

				var container = document.querySelector('.container-widget');
				var experienceText = document.querySelector('.experience-text');
				var guestRoomInput = document.getElementById('guestRoom');

				// Remove all rooms except for the first one
				const allRooms = document.querySelectorAll('.room');
				allRooms.forEach((room, index) => {
					if (room.id !== 'room1') {
						room.remove();
					}
				});

				// Reset form values and UI elements based on the new mode
				if (mode === 'VACATION') {
					document.getElementById('vacationMode').classList.add('selected');
					$('.step:first').show(); // Show "Choose your Holiday"
					$('.add-room-btn').show(); // Show "Add Room" button
					var dateInput = document.getElementById('date');
					dateInput.placeholder = 'CHECK-IN - CHECK-OUT';
					container.style.justifyContent = 'center';
					container.style.width = '100%';
					experienceText.style.display = 'none'; // Hide experience text
				} else if (mode === 'EXPERIENCES') {
					document.getElementById('experiencesMode').classList.add('selected');
					$('.step:first').hide(); // Hide "Choose your Holiday"
					$('.add-room-btn').hide(); // Hide "Add Room" button
					var dateInput = document.getElementById('date');
					guestRoomInput.value = ''; // Set value to empty to show placeholder
					container.style.justifyContent = 'space-evenly';
					container.style.width = '132%';
					dateInput.placeholder = 'SELECT DATE';
					experienceText.style.display = 'block'; // Show experience text
				}

				// Close the dropdown if it's open
				$('.dropdown').removeClass('active');

				// Additional resets as needed (e.g., clearing error messages or alerts)
			}

			// Assuming you have a way to switch modes, e.g., buttons
			$('#vacationMode').click(function() {
				switchMode('VACATION');
			});
			$('#experiencesMode').click(function() {
				switchMode('EXPERIENCES');
			});
		});
		// JavaScript to handle navigation between steps
		let currentStep = 0;
		const steps = document.querySelectorAll('.step');

		function nextStep() {
			steps[currentStep].classList.remove('active');
			currentStep = (currentStep + 1) % steps.length;
			steps[currentStep].classList.add('active');
		}
	</script>
</body>
</html>