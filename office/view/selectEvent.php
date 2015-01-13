

<script type="text/javascript">
	function retrieve(n) {
		document.getElementById("eventId").value=n;
		document.getElementById("viewEventForm").submit();
			}
</script>


<center><input type="button"  class="btn btn-primary btn-sm" onclick="history.back();" value="Back"></center>

<form id="viewEventForm" action="index.php" method="GET">
	<input name="dir" id="dir" type="hidden" value="<?php echo $dir; ?>" >
	<input name="sub" id="sub" type="hidden" value="<?php echo $sub; ?>" >
	<input name="act" id="act" type="hidden" value="selectPerson" >
	<legend> Select an Event<legend>
	<br>
	<input type="submit" value="None"><br>

<br/><br/>

	<input type="hidden" name="eventId" id="eventId" value="0">
<h3><u>Upcoming Events </u></hr></br>
<table class="table table-striped table-hover " style="width:100%">
	<tr>
		<th>Title</th>
		<th>Date</th>
		<th>Time</th>
		<th>Type</th>
		<th>Guest List</th>
		<th>Address</th> 
		<th>Sponsor</th>
		
	</tr>
	<?php 
	$Event = readEvents();
	$pastEventFlag=0;

	foreach ($Event as $EventItem) { 

		if($pastEventFlag==0){
			
			if($EventItem->getDate()<date('Y-m-d')) {
				echo '</table> <h3><u>Past Events </u></hr></br> <table class="table table-striped table-hover " style="width:100%">';
				echo '<tr>
						<th>Title</th>
						<th>Date</th>
						<th>Time</th>
						<th>Type</th>
						<th>Guest List</th> <!-- make this a button to pull up  a table showing the guest list -->
						<th>Address</th> 
						<th>Sponsor</th>
					</tr>';
					
				$pastEventFlag=1;
			}
		}?>

	<tr onclick="retrieve(<?php echo $EventItem->getId(); ?>);">

		<td><?php echo $EventItem->getTitle(); ?></td>
		<td><?php echo $EventItem->getDate(); ?></td>
		<td><?php echo $EventItem->getStart_time(); ?></td>
			
                <td><?php echo $EventItem->getType()->getTitle(); ?></td> 
		<td>
                    <?php 
                    $EventNumberOfGuests = countEventGuest($EventItem->getId());	//Number of Guests attending the event
                    echo $EventNumberOfGuests; ?> 
		</td>

		<td>
		<?php 
		$Address = $EventItem->getAddress_id();

		echo $Address->getStreet1() . " , " . $Address->getStreet2() . " , " . $Address->getCity() . " , " . $Address->getState()->getTitle() . " , " . $Address->getZip();
		?>
		</td>
		<!--<td><?php echo $EventItem->getCommittee(); ?></td> -->
		<td><?php echo $EventItem->getSponsored_id(); ?></td>
	</tr>
	<?php }// end foreach ?>


</table> 

</form>

