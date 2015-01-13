<?php

	// TITLE: guest_list Class
	// FILE: class/guest_list.php
	// AUTHOR: AUTOGEN

	class Guest_list {

		// ATTRIBUTES //

		private $event;
		private $person;
		private $attended;


		// CONSTRUCTOR //

		public function __construct() {}


		// METHODS //

		public function getEvent() {return $this->event;}
		public function getPerson() {return $this->person;}
		public function getAttended() {return $this->attended;}

		public function setEvent($event) {$this->event = $event;}
		public function setPerson($person) {$this->person = $person;}
		public function setAttended($attended) {$this->attended = $attended;}

	}// end class

?>
