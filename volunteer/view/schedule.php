<?php
    //SCW5137, bmw5285
    //shows volunteer the events they've worked, signed up for and all other events.
    //allows volunteer to sign up for event

?>

<!--sets event id to what event you click on and submits form-->
<script>
//	function dropDown() {
//		var searchBy = document.getElementById("searchBy").value;
//		if (searchBy === "all") {
//			document.getElementById("all").style.display="inline";
//			document.getElementById("interest").style.display="none";
//		}
//		if (searchBy === "interest") {
//			document.getElementById("all").style.display="none";
//			document.getElementById("interest").style.display="inline";
//		}
//	}
	
	function retrieveId(m) {
		document.getElementById("eventId").value=m;
		document.getElementById("viewSchedule").submit();
	}
</script>

form for viewing a person schedule
<h2>Volunteer Schedule</h2>
<hr>

<h4>Your Past Events</h4>
<table class="table table-striped table-hover " style="width:100%">
	<tr><th>Event Name</th><th>Event Date</th><th>Event Time</th><th>Event Location</th><th>Event Type</th></tr>
<?php
$personSchedules = getWork();
	foreach($personSchedules as $personSchedule)
	{
		if($personSchedule->getEvent()->getDate() < date('Y-m-d'))
		{
			$eventTitle = $personSchedule->getEvent()->getTitle();
                        $eventDate = $personSchedule->getDate();
                        $eventTime = $personSchedule->getEvent()->getStart_time();
                        $addressStreet1 = $personSchedule->getEvent()->getAddress_id()->getStreet1();
                        $addressStreet2 = $personSchedule->getEvent()->getAddress_id()->getStreet2();
                        $addressCity = $personSchedule->getEvent()->getAddress_id()->getCity();
                        $addressState = $personSchedule->getEvent()->getAddress_id()->getState()->getTitle();
                        $addressZip = $personSchedule->getEvent()->getAddress_id()->getZip();
                        $eventType = $personSchedule->getEvent()->getType()->getTitle();

			echo '<tr>';
				echo "<td>{$eventTitle}</td>";
				echo "<td>{$eventDate}</td>";
				echo "<td>{$eventTime}</td>";
				echo "<td>{$addressStreet1} {$addressStreet2} {$addressCity}, {$addressState}, {$addressZip}</td>";
				echo "<td>{$eventType}</td>";
			echo "</tr>";
		}
	}
 ?>
</table>
<hr>

<h4>Your Upcoming Events<h4>
<table class="table table-striped table-hover " style="width:100%">
	<tr><th>Event Name</th><th>Event Date</th><th>Event Time</th><th>Event Location</th><th>Event Type</th></tr>
<?php
$guestList = readGuestList();
$i=0;
$j=0;
	foreach($guestList as $personSchedule)
	{
		if($personSchedule->getEvent()->getDate() >= date('Y-m-d')) {
                    $i++;
                    if($i>0)
                    {
                            //if($eventId !== $personSchedule->getEvent()->getId())
                            //{
                                    $eventTitle = $personSchedule->getEvent()->getTitle();
                                    $eventDate = $personSchedule->getEvent()->getDate();
                                    $eventTime = $personSchedule->getEvent()->getStart_time();
                                    $addressStreet1 = $personSchedule->getEvent()->getAddress_id()->getStreet1();
                                    $addressStreet2 = $personSchedule->getEvent()->getAddress_id()->getStreet2();
                                    $addressCity = $personSchedule->getEvent()->getAddress_id()->getCity();
                                    $addressState = $personSchedule->getEvent()->getAddress_id()->getState()->getTitle();
                                    $addressZip = $personSchedule->getEvent()->getAddress_id()->getZip();
                                    $eventType = $personSchedule->getEvent()->getType()->getTitle();

                                    echo '<tr>';
                                            echo "<td>{$eventTitle}</td>";
                                            echo "<td>{$eventDate}</td>";
                                            echo "<td>{$eventTime}</td>";
                                            echo "<td>{$addressStreet1} {$addressStreet2} {$addressCity}, {$addressState}, {$addressZip}</td>";
                                            echo "<td>{$eventType}</td>";
                                    echo "</tr>";
                            //}
                    }
                    else
                    {
                            $j++;
                            if($j==0)
                            {
                                    echo '<td colspan="5">You have no upcoming events scheduled</td>';
                            }
                    }
                }
	}

 ?>
</table>
<hr>


<h4>New Events</h4>
<!--<select id="searchBy" onclick="dropDown()">
	<option value="all">all</option>
	<option value="interest">your interests</option>
</select>-->

<form id = "viewSchedule" action="index.php" method="GET">
	<input name="dir" id="dir" type="hidden" value="<?php echo $dir; ?>" >
	<input name="sub" id="sub" type="hidden" value="<?php echo $sub; ?>" >
	<input name="act" id="act" type="hidden" value="viewSchedule" >
	<input name="eventId" id="eventId" type="hidden" value="0" >
	
<!--<div id="interest" style="display:none">
	<table class="table table-striped table-hover " style="width:100%">
		<tr><th>Details</th><th>Event Name</th><th>Event Date</th><th>Event Time</th><th>Event Location</th><th>Event Type</th></tr>
			//<?php
//				$eventsByVolunteerInterest = readEventsByVolunteerInterest();
//				foreach ($eventsByVolunteerInterest as $event) {
//					if($event->getDate()>date('Y-m-d'))
//					{
//						$eventId = $event->getId();
//                                                $eventTitle = $event->getTitle();
//                                                $eventDate = $event->getDate();
//                                                $eventTime = $event->getStart_time();
//
//                                                $addressStreet1 = $event->getAddress_id()->getStreet1();
//                                                $addressStreet2 = $event->getAddress_id()->getStreet2();
//                                                $addressCity = $event->getAddress_id()->getCity();
//                                                $addressState = $event->getAddress_id()->getState()->getTitle();
//                                                $addessZip = $event->getAddress_id()->getZip();
//
//                                                $eventType = $event->getType()->getTitle();
//						?><tr onclick="retrieveId(<?php //echo $eventId; ?>)"><?php
//							echo "<td><button>view</button></td>";
//							echo "<td>{$eventTitle}</td>";
//							echo "<td>{$eventDate}</td>";
//							echo "<td>{$eventTime}</td>";
//							echo "<td>{$addressStreet1} {$addressStreet2} {$addressCity}, {$addressState}, {$addessZip}</td>";
//							echo "<td>{$eventType}</td>";
//							//echo "<td>{$interest_title}</td>";
//							//echo "<td>'{$description}'</td>";
//						echo "</tr>";
//					}
//				}
//			?>
	</table>
</div>-->
    <div id="all" style="display:inline">
        <table class="table table-striped table-hover " style="width:100%">
            <tr><th>Details</th><th>Event Name</th><th>Event Date</th><th>Event Time</th><th>Event Location</th><th>Event Type</th></tr>
                <?php
                    $events = listEvent();
                    foreach ($events as $event) {
                        if($event->getDate()>date('Y-m-d'))
                        {
                            $eventId = $event->getId();
                            $eventTitle = $event->getTitle();
                            $eventDate = $event->getDate();
                            $eventTime = $event->getStart_time();

                            $addressStreet1 = $event->getAddress_id()->getStreet1();
                            $addressStreet2 = $event->getAddress_id()->getStreet2();
                            $addressCity = $event->getAddress_id()->getCity();
                            $addressState = $event->getAddress_id()->getState()->getTitle();
                            $addessZip = $event->getAddress_id()->getZip();

                            $eventType = $event->getType()->getTitle();
                            ?><tr onclick="retrieveId(<?php echo $eventId; ?>)"><?php
                                    echo "<td><button>view</button></td>";
                                    echo "<td>{$eventTitle}</td>";
                                    echo "<td>{$eventDate}</td>";
                                    echo "<td>{$eventTime}</td>";
                                    echo "<td>{$addressStreet1} {$addressStreet2} {$addressCity}, {$addressState}, {$addessZip}</td>";
                                    echo "<td>{$eventType}</td>";
                                    //echo "<td>{$interest_title}</td>";
                                    //echo "<td>'{$description}'</td>";
                            echo "</tr>";
                        }
                    }
                ?>
        </table>	
    </div>
</form>

<hr>
<span class="note">
    Here is the list of events you are signed up for <br>
    You can make changes to your schedule here as well
</span>

<?php
/*foreach($schedules as $schedule) {
    
    if($schedule->getEventStatus() == 0) {
	echo '<form action="index.php" method="GET">';
	echo '<input type="hidden" name="dir" value="' . $dir . '"/>';
	echo '<input type="hidden" name="sub" value="' . $sub . '"/>';
	echo '<input type="hidden" name="act" value="' . $act . '"/>';
	echo '<input type="hidden" name="changeStatus" class="Signedup" value="1"/>';
	echo '<input type="hidden" name="eventId" class="Signedup" value="' . $schedule->getEventId(). '"/>';
	echo '<tr>';
	echo '<td><input type="submit" name="update" class="signedUp" value="Drop Event" /></td>';
	echo '<td class="eventName"><a href="index.php?dir=' .$dir . '&sub=' . $sub . '&act=eventDescription&eventId=' . $schedule->getEventId(). '">' . $schedule->getEventTitle() . '</a></td>';
	echo '<td>' . $schedule->getEventDate() . '</td>';
	echo '<td style="width: 100px;">' . $schedule->getEventTime() . '</td>';
	echo '<td>' . $schedule->getEventLocation() . '</td>';
	echo '<td  style="width: 100px;">' . $dbio->getEventType($schedule->getEventType_Id()) . '</td>';
	echo '</tr>';
	echo '</form>';
    }// end if
 }// end foreach*/
//echo $_SESSION['id'];
//$personSchedules = $dbio->readScheduleByName($_SESSION['id']);
?>

