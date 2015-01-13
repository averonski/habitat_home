<?php

	// TITLE: Volunteer Consent Model
	// FILE: volunteer/model/consent.php
	// AUTHOR: rwg5215


    //updates volunteers consent    
    function setVolunteerConsent($vid, $age, $photo, $agree, $video) {
        $dbio->setVolunteerConsent($vid, $age, $photo, $agree, $video);
    }
    
    //reads volunteers consent based on person id
    function getVolunteerConsent() {
        global $dbio;
        $pid=$_SESSION['personid'];
        $dbConsent = $dbio->readVolunteerByPid($pid);
        return $dbConsent;
     
    
    }
?>
