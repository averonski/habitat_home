<?php

	// TITLE: personal_donation Class
	// FILE: class/personal_donation.php
	// AUTHOR: AUTOGEN

	class Personal_donation {

		// ATTRIBUTES //

		private $id;
		private $donation;
		private $person;


		// CONSTRUCTOR //

		public function __construct() {}


		// METHODS //

		public function getId() {return $this->id;}
		public function getDonation() {return $this->donation;}
		public function getPerson() {return $this->person;}

		public function setId($id) {$this->id = $id;}
		public function setDonation($donation) {$this->donation = $donation;}
		public function setPerson($person) {$this->person = $person;}

	}// end class

?>
