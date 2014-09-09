<?php

	// TITLE: event_sponsor Class
	// FILE: class/event_sponsor.php
	// AUTHOR: AUTOGEN

	class Event_sponsor {

		// ATTRIBUTES //

		private $id;
		private $event;
		private $person;
		private $organization;


		// CONSTRUCTOR //

		public function __construct() {}


		// METHODS //

		public function getId() {return $this->id;}
		public function getEvent() {return $this->event;}
		public function getPerson() {return $this->person;}
		public function getOrganization() {return $this->organization;}

		public function setId($id) {$this->id = $id;}
		public function setEvent($event) {$this->event = $event;}
		public function setPerson($person) {$this->person = $person;}
		public function setOrganization($organization) {$this->organization = $organization;}

	}// end class

?>
