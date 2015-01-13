<?php
//bmw5285
//shows volunteer what is happening during an event
?>

<script>
function check() {
	var a=confirm("You are about to sign up for an event");
		if (a===true)
		{
			document.getElementById("personSchedule").submit();
		}
}
</script>

<!--schedule of an event-->
<h4>Schedule</h4>
	<div>
		<table class="table table-striped table-hover " style="width:100%">
			<tr>
				<!--<th>Select</th>-->
				<th>Description</th>
				<th>Start Time</th>
				<th>End Time</th>
				<th>Interest</th>
				<!--<th></th>-->
			</tr>
			<form id="personSchedule" action="index.php" method="GET">
				<input name="dir" id="dir" type="hidden" value="<?php echo $dir; ?>" >
				<input name="sub" id="sub" type="hidden" value="<?php echo $sub; ?>" >
				<input name="act" id="act" type="hidden" value="personSchedule" >
				<input name="personId" type="hidden" value="<?php echo $_SESSION['personid']; ?>" >
                                <input name="eventId" type="hidden" value="<?php echo $_GET['eventId']; ?>" >
			<?php $EventSchedule= getEventSchedules($_GET['eventId']);
                            foreach ($EventSchedule as $EventScheduleItem){
				$interest = readInterest($EventScheduleItem->getInterest_id()->getId());
                        ?>
			<tr>	
				<!--<td> <input type="checkBox" name="check_list[]" value="<?php //echo $EventScheduleItem->getId(); ?>"> </td>-->
				<td> <?php echo $EventScheduleItem->getDescription(); ?> </td>
				<td> <?php echo $EventScheduleItem->getStart_time(); ?> </td>
				<td> <?php echo $EventScheduleItem->getEnd_time(); ?> </td>
				<td> <?php echo $interest->getTitle(); ?> </td>
			</tr>
				<?php }?>
		</table>
	</div>
<hr>
<button onclick="check()">Sign up</button>
