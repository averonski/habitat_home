<!--author: unknown-->
<!--allows volunteer to view the hours they have worked total and for each event-->

<h2>Work History</h2>
<hr>

<?php
        global $dir;
        global $sub;
        global $act;
        global $msg;
        global $person_id;
    
        //variables
        $person_id=$_SESSION['personid'];
        $dbevent= getEvents();
        $dbdate = getDates();
        $result = getHours();
        $date = array($dbdate);
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


<!--shows volunteer what work they have done-->
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
            echo "<td>" . $workHistory->getEvent()->getTitle() . "</td>";
            echo "<td>" . $workHistory->getEvent()->getDate() . "</td>";
            echo "<td>" . $workHistory->getHours_worked() . "</td>";
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
            $a=$a+$abc->getHours_worked();
        }

        echo $a." Hours";

         ?>
  </div>
</div>

    
    
    
</form>
<hr>

