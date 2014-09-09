<?php

	// TITLE: ho_group Class
	// FILE: class/ho_group.php
	// AUTHOR: AUTOGEN

	class Ho_group {

		// ATTRIBUTES //

		private $person;
		private $ho_id;
		private $demographic;
		private $primary_ho;


		// CONSTRUCTOR //

		public function __construct() {}


		// METHODS //

		public function getPerson() {return $this->person;}
		public function getHo_id() {return $this->ho_id;}
		public function getDemographic() {return $this->demographic;}
		public function getPrimary_ho() {return $this->primary_ho;}

		public function setPerson($person) {$this->person = $person;}
		public function setHo_id($ho_id) {$this->ho_id = $ho_id;}
		public function setDemographic($demographic) {$this->demographic = $demographic;}
		public function setPrimary_ho($primary_ho) {$this->primary_ho = $primary_ho;}

	}// end class

?>
