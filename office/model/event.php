<?php

	// TITLE: Office Events Model
	// FILE: office/model/event.php
	// AUTHOR: sbkedia
	
	
	function readEvents() {
		global $dbio;
		$events = $dbio->listEvent();
		return $events;
	}

	function readEvent_Types(){
		global $dbio;
		$event_types = $dbio->listEvent_type();
		return $event_types;
	}

	function countEventGuest($event_id){
		global $dbio;
		$eventNumberGuests = $dbio->countGuest_list($event_id);
		return $eventNumberGuests;
	}

	function searchEvent($event_type_id) {
		global $dbio;
		$events = $dbio->searchEventByType($event_type_id);
		return $events;
	}
	
	function listCommittees(){
		global $dbio;
		$committees = $dbio->listCommittee();
		return $committees;
	}

	function readAddressByID($addressID){
		global $dbio;
		$address = $dbio->readAddress($addressID);
		return $address;
	}

	function readEventByID($event_id){
		global $dbio;
		$event= $dbio->readEvent($event_id);
		return $event;
	}

	function readGuestsByEvent($event_id){
		global $dbio;
		$guests= $dbio->readGuest_list_by_event($event_id);
		return $guests;
	}

	function getEventSchedules($event_id){
		global $dbio;
		$eventSchedules= $dbio->readSchedule_by_event($event_id);
		return $eventSchedules;
	}

	function getVolunteerSchedule($event_id){
		global $dbio;
		$volunteerSchedules= $dbio->readVolunteerScheduleByEvent($event_id);
		return $volunteerSchedules;
	}

	function getVolunteerById($volId){
		global $dbio;
		$volunteerDetails = $dbio->readPerson($volId);
		return $volunteerDetails;
	}
	
	function getEventScheduleSlots($scheduleId) {
		global $dbio;
		$eventScheduleSlots= $dbio->readSchedule($scheduleId);
		return $eventScheduleSlots;
	}
	
	function createScheduleSlot($personId,$scheduleId) {
		global $dbio;
		$dbio->createScheduleSlot($personId,$scheduleId);
	}
	
	function createSchedule($timeStart, $timeEnd, $eventId, $description, $interestId, $maxNumPeople) {
		global $dbio;
		$dbio->createSchedule($timeStart, $timeEnd, $eventId, $description, $interestId, $maxNumPeople);
	}
	
	function getVolunteers() {
		global $dbio;
		$volunteers = $dbio->listPerson();
		return $volunteers;
	}
	
	function getInterests() {
		global $dbio;
		$interests = $dbio->listInterest();
		return $interests;
	}
	
	function deleteScheduleSlot($scheduleId, $personId) {
		global $dbio;
		$dbio->deleteScheduleSlot($scheduleId, $personId);
	}
	
	function deleteSchedule($scheduleId) {
		global $dbio;
		$dbio->deleteSchedule($scheduleId);
	}
	
	function readScheduleByScheduleId($scheduleId) {
		global $dbio;
		$schedules = $dbio->readScheduleByScheduleId($scheduleId);
		return $schedules;
	}
	
	function readInterest($interestId) {
		global $dbio;
		$interest = $dbio->readInterest($interestId);
		return $interest;
	}
	
	function updateSchedule($scheduleId, $timeStart, $timeEnd, $description, $interestId, $maxNumPeople) {
		global $dbio;
		$dbio->updateSchedule($scheduleId, $timeStart, $timeEnd, $description, $interestId, $maxNumPeople);
	}

	function checkVolunteerProcessing($volId, $eventId){
		global $dbio;
		$isProcessed=$dbio->checkVolunteerProcessing($volId, $eventId);
		return $isProcessed;
	}

	function readAuctionItems($eventId){
		global $dbio;
		$auctionItems= $dbio->readAuctionForEvent($eventId);
		return $auctionItems;
	}
	function create() {}

	
	function update() {}
	function delete() {}
	//function list() {}

?>
