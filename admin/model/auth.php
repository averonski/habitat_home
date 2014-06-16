<?php

	// admin/model/auth.php
	// AUTHOR: sbkedia
	
	//gets all pending hours for work authorizations 
	function readHours(){
		global $dbio;
		$workAuthorization = $dbio->readPendingWorkAuthorization();
		return $workAuthorization;
	}
	//gets person info from person id
	function readPerson($personId){
		global $dbio;
		$personDetails = $dbio->readPerson($personId);
		return $personDetails;
	}
	//gets event info from event id
	function readEvent($eventId){
		global $dbio;
		$eventDetails = $dbio->readEvent($eventId);
		return $eventDetails;
	}
	//gets donation info for donation authorizations
	function readDonations(){
		global $dbio;
		$donationInfo = $dbio->readPendingDonationAuthorizations();
		return $donationInfo;
	}

	function search() {}
	function create() {}
	function read() {}
	function update() {}
	function delete() {}
	//function list() {}

?>
