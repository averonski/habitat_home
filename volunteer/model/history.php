<?php

	// TITLE: Volunteer Work History Model
	// FILE: volunteer/model/history.php
	// AUTHOR: dum5002
    global $dbio;
    global $person_id;
    //global $event_id;

    $person_id=$_SESSION['personid'];
    $volIdH = $dbio->readVolunteerByPid($person_id);
    $volId = $volIdH->getId();
    $event_idh=$dbio->readWorkByVid($volId);
    $event_id= $event_idh[0]->getEvent()->getId();
    
    function getEventId(){
        global $volId;
        global $dbio;
    	$event_id=$dbio->readWorkByVid($volId);
    	return $event_id;
    }

    function getEvents(){
        global $dbio;
        //global $volId;
        global $event_id;
        //$event_idh=$dbio->readWorkByVid($volId);
        $dbevent= $dbio->readEvent($event_id);
        //print_r($dbevent);
        return $dbevent;
    }

    function getDates(){
        global $dbio;
        global $event_id;
        $dbdate= $dbio->readEvent($event_id);
        //print_r($dbdate->getDate());
        return $dbdate->getDate();
    }

    function getHours(){
        global $dbio;
        global $volId;
        $dbHours= $dbio->readWorkByVid($volId);
       // print_r($dbHours[0]);
        return $dbHours;
    }

    
?>
