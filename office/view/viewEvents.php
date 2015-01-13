<? php 

	// TITLE: Office ViewEvents view 
	// FILE: office/view/viewEvent.php
	// AUTHOR: sbkedia

			//Title | Date | Type [may be hidden] | GuestList | Time | Address | Committee [may be hidden] | Sponsor

	?>

<script type="text/javascript">
	function retrieve(n) {
		document.getElementById("eventId").value=n;
		document.getElementById("viewEventForm").submit();
			}
</script>

<style>
#alignment
{
position:relative;
float:left;
width:65%;
}
</style>

<div id="alignment">
<h2>All Events</h2>
<hr>

<center><input type="button"  class="btn btn-primary btn-sm" onclick="history.back();" value="Back"></center>

    <form id="viewEventForm" action="index.php" method="GET">
            <input name="dir" id="dir" type="hidden" value="<?php echo $dir; ?>" >
            <input name="sub" id="sub" type="hidden" value="<?php echo $sub; ?>" >
            <input name="act" id="act" type="hidden" value="viewEvent" >

    <br/><br/>

            <input type="hidden" name="eventId" id="eventId" value="0">
    <h3><u>Upcoming Events </u></hr></br></h3>
        <table class="table table-striped table-hover " style="width:100%">
            <tr>
                <th>Title</th>
                <th>Date</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Type</th>
                <th>Guest List</th> 
                <th>Address</th> 
                <th>Sponsor</th>

            </tr>
            <?php 
            $Event= readEvents();
            $Event_type= readEvent_Types();
            $pastEventFlag=0;
            print(date("Y-m-d"));

            foreach ($Event as $EventItem) { 
                    if($pastEventFlag==0){
                        if($EventItem->getDate()<date('Y/m/d')) {
                            echo '</table> <h3><u>Past Events </u></hr></br> <table class="table table-striped table-hover " style="width:100%">';
                            echo '<tr>
                                            <th>Title</th>
                                            <th>Date</th>
                                            <th>Start Time</th>
                                            <th>End Time</th>
                                            <th>Type</th>
                                            <th>Guest List</th>
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
                <td><?php echo $EventItem->getEnd_time(); ?></td>
                <td><?php echo $EventItem->getType()->getTitle(); ?></td> 	
                <td>
                        <?php 
                        $EventNumberOfGuests = countEventGuest($EventItem->getId());	//Number of Guests attending the event
                        echo $EventNumberOfGuests; ?> 
                </td>
                <td>
                <?php 
                echo $EventItem->getAddress_id()->getStreet1() . " , "
                        . $EventItem->getAddress_id()->getStreet2() . " , "
                        . $EventItem->getAddress_id()->getCity() . " , "
                        . $EventItem->getAddress_id()->getState()->getTitle() . " , "
                        . $EventItem->getAddress_id()->getZip();
                ?>
                </td>
                <!--<td><?php echo $EventItem->getCommittee(); ?></td> -->
                <td><?php echo $EventItem->getSponsored(); ?></td>
            </tr>
            <?php }// end foreach ?>
        </table> 
    </form>
</div>

