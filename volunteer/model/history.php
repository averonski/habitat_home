<?php

	// TITLE: Volunteer Work History Model
	// FILE: volunteer/model/history.php
	// AUTHOR: dum5002
        //this sections has 4 functions with 2 that are repeats

    global $dbio;
    global $person_id;
    //global $event_id;

    //variables used
    $person_id=$_SESSION['personid'];
    $volIdH = $dbio->readVolunteerByPid($person_id);
    $volId = $volIdH->getId();
    
    //gets events done by volunteer
    function getEventId(){
        global $volId;
        global $dbio;
    	$event_id=$dbio->readWorkByVid($volId);
    	return $event_id;
    }

    //reads event based on id
    function getEvents(){
        global $dbio;
        global $event_id;
        $dbevent= $dbio->readEvent($event_id);
        return $dbevent;
    }

//    does the same thing as above. this needs deleted, but view will need fixed
    function getDates(){
        global $dbio;
        global $event_id;
        $dbdate=$dbio->readEvent($event_id);
        return $dbdate;
    }

    //does the same thing as the first function
    function getHours(){
        global $dbio;
        global $volId;
        $dbHours= $dbio->readWorkByVid($volId);
        return $dbHours;
    }

    
?>
