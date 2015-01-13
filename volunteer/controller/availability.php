<?php

	// TITLE: Volunteer Availability Controller
	// FILE: volunteer/controller/availability.php
	// AUTHOR: rwg5215

        global $act;
        global $msg;
        global $dir;
         
        $act = (isset($_GET['act'])) ? $_GET['act'] : '';
        $msg = (isset($_GET['msg'])) ? $_GET['msg'] : '';
        
        $personId= $_SESSION['personid'];

        //updates DB or defaults to base page
	switch ($act) {
                
                //updates volunteers availability
		case 'updateAvailability':
                   
                    //sets and gets volunteer availibility
                    $day = (isset($_GET['day'])) ? $_GET['day'] : '';
                    if($day=="0"){
                        $dayChecked="1";
                    }
                    else{
                        $dayChecked="0";
                    }

                    $eve = (isset($_GET['evening'])) ? $_GET['evening'] : '';
                    if($eve=="1"){
                        $eveChecked="1";
                    }
                    else{
                        $eveChecked="0";
                    }

                    $wend = (isset($_GET['weekend'])) ? $_GET['weekend'] : '';
                    if($wend=="2"){
                        $wendChecked="1";
                    }
                    else{
                        $wendChecked="0";
                    }
                    
                    //updates DB
                    $updateVolunteerAvailability= $dbio->updateVolunteerAvailability($personId,$dayChecked,$eveChecked,$wendChecked);
                    if($updateVolunteerAvailability==true){
                        print_r($personId);
                        print_r($dayChecked);
                        print_r($eveChecked);
                        print_r($wendChecked);
                        include ($dir . '/model/availability.php');
                        $page = 'volunteer/view/availability.php';
                        print '<script type="text/javascript">'; 
                        print 'alert("You Account is updated with the changes")'; 
                        print '</script>';
                    }
                break;

                default:
                    include ($dir . '/model/availability.php');
                    $page = $dir . '/view/' . $sub. '.php';
                break;

	}// end switch
?>
