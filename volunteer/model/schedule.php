<?php

	// TITLE: Volunteer Schedule Model
	// FILE: volunteer/model/schedule.php
	// AUTHOR: AUTOGEN
        
        //variables; sets volunteer id based on person id
        $person_id = $_SESSION['personid'];
        $volId = $dbio->readVolunteerByPid($person_id)->getId();
 
        //reads a volunteers work
        function getWork(){
            global $dbio;
            global $volId;
                $work= $dbio->readWorkByVid($volId);
            return $work;
        }
        
        //reads events a person has done (likely depreciated)
	function readPersonEvents($personId) {
		global $dbio;
		$personSchedules = $dbio->readScheduleByName($personId);
		return $personSchedules;
	}
	
        //creates a guestlist
        function createGuestList($eventId, $personId) {
            global $dbio;
            $return = $dbio->createGuest_list($eventId, $personId);
            return $return;
        }
        
        //reads guests list for person
        function readGuestList() {
            global $dbio;
            $guestList = $dbio->readGuest_list($_SESSION['personid']);
            return $guestList;
        }
	
        //lists all events
	function listEvent() {
		global $dbio;
		$events = $dbio->listEvent();
		return $events;
	}
	
?>
