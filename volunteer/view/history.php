<h2>Work History</h2>
<hr>

<?php
        global $dir;
        global $sub;
        global $act;
        global $msg;
        global $person_id;
    

        $person_id=$_SESSION['personid'];
        //var_dump($person_id);
        
       // $dbevent = getEvent();
        $dbevent= getEvents();

        // foreach($dbevent as $a){
        //     echo $a;
        // }
        
        $dbdate = getDates();
        

        $result = getHours();
        //$person_id='8';
        //$result=$dbio->getWorkHistory($person_id);
        //var_dump($result);
        
        

        

        
        

       
        //$dbevent = $dbio->getEventDate($event);
        //var_dump($dbevent);
    
	// TITLE: Volunteer Work History View
	// FILE: volunteer/view/history.php
	// AUTHOR: Logan Gurreri

        $workHistory = array('1', '2', '3', '4', '5');
        global $workHistory2;
        
        //$association = array('Penn State Build', 'Charity Event', 'Dinner', 'Meeting', 'Fundraiser');

       // $association = array($dbevent);

        //$date = array('20140305', '20140309', '20140313', '20140315','20140401');

        $date = array($dbdate);

        // $start = array('1100', '0800', '0800', '0700','0700');

       // $start = array($dbStartTime);

        // $end = array('1230', '0830', '0900', '0830', '0800');

       // $end = array($dbEndTime);

        $auth = array('No', 'No', 'No', 'Yes', 'Yes');
        
        $month;
        $day;
        $year;
        
        $startHours;
        $endHours;
        $startMins;
        $endMins;
        
        $timeOfDay;
        $timeOfDay2;
        
        global $totalHours;
        global $totalEndMin;
        global $totalStartMin;
        global $totalMin;
        
        $totalHours = 0;
        $totalEndMin = 0;
        $totalStartMin = 0;
        $totalMin = 0;
         
?>



<form>
<table class="table table-striped table-hover " style="width:100%">
    <tr>
        <th>Event/Project</th>
        <th>Date</th>
        <th>Hours Worked</th>
        
        <!-- <th>Authorized</th> -->
    </tr>
    
    <?php
      foreach ($result as $workHistory) {
            echo "<tr>";
            echo "<td>" . $workHistory->getEvent() . "</td>";
            echo "<td>" . $workHistory->getDate() . "</td>";
            echo "<td>" . $workHistory->getTime() . "</td>";
            echo "<tr>";
        }
        
        
    ?>
   
</table><br><br>

<div class="panel panel-danger">
  <div class="panel-heading">
    <h3 class="panel-title">Total Hours Worked:</h3>
  </div>
  <div class="panel-body">
    <?php
        $a=0;
        foreach($result as $abc){
            $a=$a+$abc->getTime();
        }

        echo $a." Hours";

         ?>
  </div>
</div>

    
    
    
</form>
<hr>

