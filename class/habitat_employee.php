<?php

	// TITLE: habitat_employee Class
	// FILE: class/habitat_employee.php
	// AUTHOR: AUTOGEN

	class Habitat_employee {

		// ATTRIBUTES //

		private $id;
		private $person;
		private $start_date;
		private $end_date;


		// CONSTRUCTOR //

		public function __construct() {}


		// METHODS //

		public function getId() {return $this->id;}
		public function getPerson() {return $this->person;}
		public function getStart_date() {return $this->start_date;}
		public function getEnd_date() {return $this->end_date;}

		public function setId($id) {$this->id = $id;}
		public function setPerson($person) {$this->person = $person;}
		public function setStart_date($start_date) {$this->start_date = $start_date;}
		public function setEnd_date($end_date) {$this->end_date = $end_date;}

	}// end class

?>
