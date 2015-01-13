<h2>Your Availabilities</h2>
<hr>
<form action="index.php">
    <h4><strong>I am available to work: </strong></h4>

<?php

	// TITLE: Volunteer Availability View
	// FILE: volunteer/view/availability.php
	// AUTHOR: Logan Gurreri
        //show volunteer their availabilty and lets them edit it
        
        //variables
        global $dir;
        global $sub;
        global $act;
        global $msg;
        global $checkedDay;
        global $checkedEvening;
        global $checkedWeekend;
        $act='updateAvailability';

        $avail=getAvailability();

        $dbDay=$avail->getAvail_day();
        $dbEve=$avail->getAvail_eve();
        $dbWend=$avail->getAvail_wkend();

        

        if($dbDay=="1"){
            $checkedDay = 'Yes';
        }

        else{
            $checkedDay= 'No';
        }

        if($dbEve=="1"){
            $checkedEvening= 'Yes';
        }

        else{
            $checkedEvening= 'No';
        }

        if($dbWend=="1")
        {
            $checkedWeekend="Yes";
        }

        else{
            $checkedWeekend="No";
        }
        
        
        $checkedDay = ($checkedDay == 'Yes') ? 'checked= "checked"' : '';
        $checkedEvening = ($checkedEvening == 'Yes') ? 'checked= "checked"' : '';
        $checkedWeekend = ($checkedWeekend == 'Yes') ? 'checked= "checked"' : '';

?>
    
<!--    form shows volunteer their availability, and lets them update it-->
    <input name="act" type="hidden" value="updateAvailability" >
    <input name="dir" type="hidden" value="<?php echo $dir; ?>" >
    <input name="sub" type="hidden" value="<?php echo $sub; ?>" >
    <input name="day" type="checkbox" value="0" <?php echo $checkedDay; ?> /> Days<br>
    <input name="evening" type="checkbox" value="1" <?php echo $checkedEvening; ?> /> Evenings<br>
    <input name="weekend" type="checkbox" value="2" <?php echo $checkedWeekend; ?> /> Weekends<br><br>
    <button>Save Changes</button>
</form>
<hr>
<span class="note">
    Here is where your availabilities are displayed.<br><br>
    You can also make changes to your availabilities here.
</span>
