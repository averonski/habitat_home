<?php

	// TITLE: serves_on Class
	// FILE: class/serves_on.php
	// AUTHOR: AUTOGEN

	class Serves_on {

		// ATTRIBUTES //

		private $volunteer;
		private $committee;
		private $is_officer;


		// CONSTRUCTOR //

		public function __construct() {}


		// METHODS //

		public function getVolunteer() {return $this->volunteer;}
		public function getCommittee() {return $this->committee;}
		public function getIs_officer() {return $this->is_officer;}

		public function setVolunteer($volunteer) {$this->volunteer = $volunteer;}
		public function setCommittee($committee) {$this->committee = $committee;}
		public function setIs_officer($is_officer) {$this->is_officer = $is_officer;}

	}// end class

?>
