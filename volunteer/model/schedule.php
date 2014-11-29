<?php

	// TITLE: Volunteer Schedule Model
	// FILE: volunteer/model/schedule.php
	// AUTHOR: AUTOGEN


	//function search() {}
	//function create() {}
	//function read() {}
	//function update() {}
	//function delete() {}
	//function list() {}
        
        //variables
        $person_id = $_SESSION['personid'];
        $volIdH = $dbio->readVolunteerByPid($person_id);
        $volId = $volIdH->getId();
        $event_idh=$dbio->readWorkByVid($volId);
        $event_id= $event_idh[0]->getEvent()->getId();
        
        
        
        function getWork(){
            global $dbio;
            global $volId;
                $work= $dbio->readWorkByVid($volId);
            //print_r($work);
            return $work;
        }
        
	function readPersonEvents($personId) {
		global $dbio;
		$personSchedules = $dbio->readScheduleByName($personId);
		return $personSchedules;
	}
	
	function readEventsByInterest($interestIds) {
		global $dbio;
		$events = $dbio->readEventByInterest($interestIds);
		return $events;
	}
	
	function readInterestByPerson($personId) {
		global $dbio;
		$interestIds = $dbio->readInterestByPerson($personId);
		foreach ($interestIds as $interestId) {
			$interest = $interestId->getInterest();
			$interests[] = $interest;
		}
		$interestIds = implode(',',$interests);
		return $interestIds;
	}
	
	function readEventAll() {
		global $dbio;
		$events = $dbio->readEventAll();
		return $events;
	}
	
?>
