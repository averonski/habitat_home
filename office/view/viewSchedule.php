<?php
  //Author: bmw5285; copied from j*p*
  
  echo '<center><input type="button"  class="btn btn-primary btn-sm" onclick="history.back();" value="Back"></center>';
  echo "<br><br>";
  
if($_GET['act'] == "viewSchedule")
  {
  	viewSchedule();
  }
if($_GET['act'] == "viewScheduleSlot")
	{
		viewScheduleSlot();
	}
?>
