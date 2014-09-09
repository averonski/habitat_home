<?php

	// TITLE: ambassador Class
	// FILE: class/ambassador.php
	// AUTHOR: AUTOGEN

	class Ambassador {

		// ATTRIBUTES //

		private $volunteer;
		private $organization;
		private $church_ambassador;
		private $affiliation;


		// CONSTRUCTOR //

		public function __construct() {}


		// METHODS //

		public function getVolunteer() {return $this->volunteer;}
		public function getOrganization() {return $this->organization;}
		public function getChurch_ambassador() {return $this->church_ambassador;}
		public function getAffiliation() {return $this->affiliation;}

		public function setVolunteer($volunteer) {$this->volunteer = $volunteer;}
		public function setOrganization($organization) {$this->organization = $organization;}
		public function setChurch_ambassador($church_ambassador) {$this->church_ambassador = $church_ambassador;}
		public function setAffiliation($affiliation) {$this->affiliation = $affiliation;}

	}// end class

?>
