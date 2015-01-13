<?php

    // FILE: Volunteer Interest Model
    // AUTHOR: des301
    
   //updates a volunteers interests
   //this section has not been tested due to the view not working
   function update() {
        global $dbio;

        $deleteAll = $dbio->deleteInterestsByVolunteer($_SESSION['personid']);
        $updated = $dbio->addInterestByVolunteer($_SESSION['personid'], $_SESSION['interestVolunteer']);
               
        return $updated;
    }
    
    //im not sure what this graveyard is, it was here when I arrived. May it RIP in peace
   /* 
    $vid = $_GET['vid'];
    $userInterests = $_GET['int[]'];
    $dbInterests = $dbio->getVolunteerInterestsBy($vid);
    
    $intIds = array();
    
    foreach ($userInterests as $ui) {
	if (!in_array($ui, $dbInterests)) {
	    $intIds[] = $ui;
	}// end if
    }// end foreach
    
    $dbio->setVolunteerInterests($vid, $intIds);
    
    unset($intIds);
    
    foreach ($dbInterests as $dbi) {
	if (!in_array($dbi, $userInterests)) {
	    $intIds[] = $dbi;
	}// end if
    }// end foreach

    $dbio->unsetVolunteerInterests($vid, $intIds);

    $name = $dbio->getVolunteerName($vid);
    
    $msg = 'Volunteer, ' . $name . '\'s Interests have been updated.' */
	    
?>
