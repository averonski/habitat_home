<?php

	// TITLE: Volunteer Availability Model
	// FILE: volunteer/model/availability.php
	// AUTHOR: dum5002
        global $msg;
        global $dbio;
        $pid = $_SESSION['personid'];

        //sets volunteer availability
        function setVolunteerAvailability($vid, $day, $eve, $wend) {
            $dbio->setVolunteerAvailability($vid, $day, $eve, $wend);
        }
        
        //gets volunteers availability
        function getAvailability() {
            global $dbio;
            $pid = $_SESSION['personid'];
            $dbAvailability = $dbio->readVolunteerByPid($pid);
            return $dbAvailability;


     
    
    }
?>
