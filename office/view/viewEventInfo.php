<?php

	// TITLE: Office ViewEvents view 
	// FILE: office/view/viewEventInfo.php
	// AUTHOR: sbkedia


	?>

<style>

	.bold {font-weight: bold;}
	.note {font-size: 10pt; color: grey;}
	.mandatory {color: crimson;}


    td
    {
        padding-left: 10px;
        padding-bottom: 10px;
        
    }

    div.show {display: block;}
	div.hide {display: none;}
	h4+div{border: 1px solid black;
	}
	

</style>

<script>
    //hides and shows the div if clicked on
    function swap(divNo) {
    	e=document.getElementById("div"+divNo);
    	eButton=document.getElementById("button"+divNo);
    	
		if (e.className === "hide") {
	    	   e.className = "show";
	    	   eButton.value="Hide";
		} 
		else {
	       e.className = "hide";
	       eButton.value="Show";
		}// end if-else
    }// end function

    //vaidates text input for event creation using regex
    function validate(evt) {
  var theEvent = evt || window.event;
  var key = theEvent.keyCode || theEvent.which;
  key = String.fromCharCode( key );
  var regex = /[0-9]|\./;
  if( !regex.test(key) ) {
    theEvent.returnValue = false;
    if(theEvent.preventDefault) theEvent.preventDefault();
  }
}

//gets the value of person and schedule id, opens an alert box then asks if the user wants to delete
    function retrieveScheduleSlot(m,n) {
	document.getElementById("scheduleSlotId").value=m;
	document.getElementById("personId").value=n;
	var deleteScheduleSlot=confirm("Are you sure you want to\ndelete this volunteer\nfrom this schedule");
	if (deleteScheduleSlot===true)
		{
			document.getElementById("deleteScheduleSlot").submit();
		}
}

//gets the value of schedule id, opens an alert box then asks if the user wants to edit or delete
function retrieveSchedule(n) {
	document.getElementById("scheduleId").value=n;
	var editSchedule=prompt("Press OK to edit,\n or\n type DELETE and press OK to delete","edit");
	if (editSchedule ==="delete")
	{
		document.getElementById("actSchedule").value="deleteSchedule";
		document.getElementById("editSchedule").submit();
	}
	if (editSchedule === "edit")
	{
		document.getElementById("actSchedule").value="editSchedule";
		document.getElementById("editSchedule").submit();
	}	
}

</script>


<h2 class="bold">Edit Event</h2>
<hr>

<?php if($act=="updateInfo")
		echo '<div class="alert alert-dismissable alert-success"><button type="button" class="close" data-dismiss="alert">×</button><strong>UPDATED</strong> You successfully updated the information.</div>'; ?>


<h4>Information
	<input type="button" id="button1" onclick="swap(1);" value="Show"> </h4>

	<div class="hide" id="div1">
	<form action="index.php" method="GET">
		<input name="dir" id="dir" type="hidden" value="<?php echo $dir; ?>" >
		<input name="sub" id="sub" type="hidden" value="<?php echo $sub; ?>" >
		<input name="act" id="act" type="hidden" value="updateInfo" >
	 

		<?php 
		$event_id= isset($_SESSION['eventId']) ? $_SESSION['eventId'] : 'null';
		$event= readEventByID($event_id);
		$event_type= readEvent_Types();
?>
		
		<input type="hidden" name="eventId" id="eventId" value=<?php echo $event_id ?> >
		<table cellspacing="10" class="intTable">
			<tr>
				<td>Title:<span class="mandatory">*</span></td>
				<td><input type="text" name="title" id="title" value="<?php echo $event->getTitle(); ?>" ></td>
			<tr>
			
			<tr>	
				<td>Type: <span class="mandatory">*</span></td>
				<td><select name="type">
						<option value ="" selected="selected">Choose Type</option>
						<?php
						foreach ($event_type as $eventTypeItem){ ?>
                                                    <option value= <?php echo $eventTypeItem->getId(); echo " ";
                                                        if($event->getType()->getId()==$eventTypeItem->getId()) {
                                                            echo "selected"; } ?> > 
                                                                <?php echo $eventTypeItem->getTitle() ?> </option>		
						<?php }// end foreach ?>

					</select>
				</td>

				<td>Committee: </td>
				<td><select name="committee">
						<option value ="">Choose Committee</option>
			 			<?php
						$committes= listCommittees(); 
						foreach ($committes as $committeItem){ ?>
							<option value= <?php echo $committeItem->getId(); echo " "; if($e->getCommittee()->getId()==$committeItem->getId()) {echo "selected"; }?> > <?php echo $committeItem->getTitle() ?> </option>		
						<?php }// end foreach ?>
					</select>
				</td>
			</tr>

			
			<tr><td>Date: <span class="mandatory">*</span></td><td><input type="text" name="date" value="<?php echo $event->getDate(); ?>"> <label>YYYY-MM-DD</label></td></tr>
			<tr><td>Start Time: <span class="mandatory">*</span></td><td><input type="text" name="time" value="<?php echo $event->getStart_time(); ?>"> <label>HH:MM:SS</label></td></tr>
			<tr><td>End Time: <span class="mandatory">*</span></td><td><input type="text" name="endTime" value="<?php echo $event->getEnd_time(); ?>"> <label>HH:MM:SS</label></td></tr>

			<?php 
                            $Address = $event->getAddress_id();
                        ?>

			<input type="hidden" name="addressId" id="addressId" value=<?php echo $Address->getId(); ?> >

			<tr><td>Street 1: <span class="mandatory">*</span></td><td><input type="text" name="street1" id="street2" value="<?php echo $Address->getStreet1(); ?>"></td></tr>
			<tr><td>Street 2: </td><td><input type="text" name="street2" id="street2" value="<?php echo $Address->getStreet2(); ?>" ></td></tr>
			<tr><td>City: <span class="mandatory">*</span></td><td><input type="text" name="city" id="city" value="<?php echo $Address->getCity(); ?>"></td></tr>
			<tr><td>State: <span class="mandatory">*</span></td><td><input type="text" name="state" id="state" value="<?php echo $Address->getState()->getTitle(); ?>"></td></tr>
			<tr><td>Zip code: <span class="mandatory">*</span></td><td><input type="text" name="zipcode" id="zipcode" value="<?php echo $Address->getZip(); ?>"></td></tr>

			<tr><td>Sponsor: <span class="mandatory">*</span></td><td><input type="text" name="sponsor" id="sponsor" value="<?php echo $event->getSponsored(); ?>"></td></tr>

		</table> 

		<input type="submit" value="update"> </form>	
	</div>
	<hr>

<h4>Guest Information
	<input type="button" id="button2" onclick="swap(2);" value="Show"> </h4>

	<div class="hide" id="div2">
		<table class="table table-striped table-hover " style="width:100%">
			<tr>
				<th>Title </th>
				<th>First Name </th>
				<th>Last Name </th>
				<th>Gender </th>
				<th>Dob </th>
			</tr>
		
		<?php $Guests = readGuestsByEvent($event_id);
		foreach($Guests as $guests){
                    $guest = $guests->getPerson();
			?>
			<tr>
				<td><?php echo $guest->getTitle(); ?> </td>
				<td><?php echo $guest->getFirst_name(); ?> </td>
				<td><?php echo $guest->getLast_name(); ?> </td>
				<td><?php echo $guest->getGender(); ?> </td>
				<td><?php echo $guest->getDob(); ?> </td>

			</tr>
		<?php } ?>
		</table>
	</div>
<hr>

<h4>Schedule
	
	<input type="button" id="button3" onclick="swap(3);" value="Show"> </h4>

	<div class="hide" id="div3">
		<table class="table table-striped table-hover " style="width:100%">
			<tr>
				<th>Description</th>
				<th>Start Time</th>
				<th>End Time</th>
				<!--<th>Interests</th>-->
				<th>Max Number Of People</th>
			</tr>

			<form id="editSchedule" action="index.php" method="GET">
				<input name="dir" id="dir" type="hidden" value="<?php echo $dir; ?>" >
				<input name="sub" id="sub" type="hidden" value="<?php echo $sub; ?>" >
				<input name="act" id="actSchedule" type="hidden" value="0" >
				<input name="scheduleId" type="hidden" id="scheduleId" value="0">
				<?php $EventSchedule= getEventSchedules($event_id);
				foreach ($EventSchedule as $EventScheduleItem){
//				$interest = readInterest($EventScheduleItem->getInterest_interest_id());
				?>
			
				<tr onclick="retrieveSchedule(<?php echo $EventScheduleItem->getId(); ?>)">
			</form>
				<td> <?php echo $EventScheduleItem->getDescription(); ?> </td>
				<td> <?php echo $EventScheduleItem->getStart_time(); ?> </td>
				<td> <?php echo $EventScheduleItem->getEnd_time(); ?> </td>
				<!--<td> <?php // echo $interest->getInterest_title(); ?> </td>-->
				<td> <?php echo $EventScheduleItem->getMax_num_people(); ?> </td>
			</tr>
			
			<form id="deleteScheduleSlot" action="index.php" method="GET">
				<input name="dir" id="dir" type="hidden" value="<?php echo $dir; ?>" >
				<input name="sub" id="sub" type="hidden" value="<?php echo $sub; ?>" >
				<input name="act" id="act" type="hidden" value="deleteScheduleSlot" >
				<input name="scheduleId" id="scheduleSlotId" type="hidden" value="<?php echo $EventScheduleItem->getId(); ?>">
				<input name="personId" type="hidden" id="personId" value="0">
				<?php $eventScheduleSlots = getEventScheduleSlots($EventScheduleItem->getId());
					$volSet=0;
					$i=0;
					foreach ($eventScheduleSlots as $eventScheduleSlot) {
					?>
					
						<tr onclick="retrieveScheduleSlot(<?php echo $EventScheduleItem->getId(). ","; echo $eventScheduleSlot->getPerson_id(); ?>);">
							<td></td>
								<?php if($volSet == 0){?> <td><b>volunteers</b></td> <?php $volSet = 1;}else{echo "<td></td>";}?>
									<td>
										<?php
											$personId = $eventScheduleSlot->getPerson_id();
											echo $eventScheduleSlot->getTitle(). " "; 
											echo $eventScheduleSlot->getFirst_name(). " "; 
											echo $eventScheduleSlot->getLast_name();
										?>
									</td>
							<td></td><td></td>
						</tr>
			</form>
						<?php $i++;
					} 
						if($i<$EventScheduleItem->getMax_num_people() || is_null($EventScheduleItem->getMax_num_people())) {
							?>
							<form name="input" action="index.php" method="get">
								<input name="dir" type="hidden" value="<?php echo $dir; ?>" >
								<input name="sub" type="hidden" value="<?php echo $sub; ?>" >
								<input name="act" type="hidden" value="createScheduleSlot" >
								<input name="eventId" type="hidden" value="<?php echo $event_id; ?>">
								<tr>
									<td></td><td></td><td>
										<select name="person">
											<option value="null">-Select Volunteer-</option>
											<?php 
												$volunteers = getVolunteers();
												foreach($volunteers as $volunteer) {
													?> <option value="<?php echo $volunteer->getId(); ?>" name="volunteer"><?php echo $volunteer->getFirst_name() . " " . $volunteer->getLast_name(); ?></option>
												<?php } ?>
										</select>
									</td>
										<td>
											<button type='submit' name='createScheduleSlot' value="<?php echo $EventScheduleItem->getId(); ?>" >add volunteer</button>
										</td><td></td>
								</tr>
							</form>
						<?php } ?>
				<?php }?>
					<form name="input" action="index.php" method="get">
						<input name="dir" type="hidden" value="<?php echo $dir; ?>" >
						<input name="sub" type="hidden" value="<?php echo $sub; ?>" >
						<input name="act" type="hidden" value="addSchedule" >
						<input name="eventId" type="hidden" value="<?php echo $event_id; ?>">
						<tr>
							<td>
								<button type='submit'>add schedule</button>
							</td><td></td><td></td><td></td><td></td>
						</tr>
						<!--<tr>
							<td> <input type='text' name='description'> </td>
							<td> <input type='text' name='timeStart'> </td>
							<td> <input type='text' name='timeEnd'> </td>
							<td> <select id="interest" name="interest">
								<option value="null">-Select Interest-</option>
								<?php $interests = getInterests();
								foreach ($interests as $interest) {
									?> <option value="<?php echo $interest->getId(); ?>" name="interest"><?php echo substr($interest->getTitle(), 0, 10). "..."; ?></option>
								<?php } ?> </td>
							<td> <input type="text" name="maxNumPeople"> </td>
						</tr>-->
				</form>
		</table>
	</div>
<hr>

<h4>Auction
	<input type="button" id="button4" onclick="swap(4);" value="Show"> </h4>

	<div class="hide" id="div4">
		<table class="table table-striped table-hover " style="width:100%">
			<tr>
				<th>Title</th>
				<th>Description</th>
				<th>Price</th>
				<th>Buyer</th>
			</tr>
			<?php $AuctionItems=readAuctionItems($event_id);
			 foreach ($AuctionItems as $auctionItem) { ?>
			 <tr>
				 <td> <?php echo $auctionItem->getTitle(); ?> </td>
				 <td> <?php echo $auctionItem->getDescription(); ?> </td>
				 <td> <?php echo $auctionItem->getPrice(); ?> </td>
				 <td> <?php echo $auctionItem->getPerson(); ?> </td>
			</tr>
			 <?php }?>
		</table>
	</div>
<hr>

<?php if($EventItem->getDate()<date('Y-m-d')){ ?>
<h4>Process
	<input type="button" id="button5" onclick="swap(5);" value="Show"> </h4>
	<div class="hide" id="div5">

	<form action="index.php" method="GET">
		<input name="dir" id="dir" type="hidden" value="<?php echo $dir; ?>" >
		<input name="sub" id="sub" type="hidden" value="<?php echo $sub; ?>" >
		<input name="act" id="act" type="hidden" value="submitHours" >
		<input type="hidden" name="eventId" id="eventId" value=<?php echo $event_id ?> >
	
		<table class="table table-striped table-hover ">
			<tr>
				<th>Volunteer Name</th>
				<th>Enter Hours</th>
				
			</tr>

			<?php $VolunteerSchedule= getVolunteerSchedule($event_id);
			foreach ($VolunteerSchedule as $VolunteerScheduleItem){
				$VolunteerDetails = getVolunteerById($VolunteerScheduleItem->getVolunteerId());
			?>

			<tr>
				<td> <?php echo $VolunteerDetails->getTitle(). " " .$VolunteerDetails->getFirst_name(). " " .$VolunteerDetails->getLast_name();  ?> </td>
				
				<?php $isProcessed=checkVolunteerProcessing($VolunteerScheduleItem->getVolunteerId(), $event_id);
				if($isProcessed){
					?>
					<td> <label>Processed for this Event </label> </td>
					<?php }
				else {
					?>
					<td> <input type='text' name ="hours<?php echo $VolunteerScheduleItem->getVolunteerId(); ?>" id="hours<?php echo $VolunteerScheduleItem->getVolunteerId(); ?>" maxlength=5 onkeypress='validate(event)' /> </td>
				<?php } ?>	
			</tr>


			<?php } 
			?>
			<tr><td></td><td><input type="submit" value="Submit"></td></tr>
		</table>
	 	</form>
	</div>
<hr>
<?php } ?>
