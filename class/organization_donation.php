<?php

	// TITLE: organization_donation Class
	// FILE: class/organization_donation.php
	// AUTHOR: AUTOGEN

	class Organization_donation {

		// ATTRIBUTES //

		private $id;
		private $donation;
		private $organization;


		// CONSTRUCTOR //

		public function __construct() {}


		// METHODS //

		public function getId() {return $this->id;}
		public function getDonation() {return $this->donation;}
		public function getOrganization() {return $this->organization;}

		public function setId($id) {$this->id = $id;}
		public function setDonation($donation) {$this->donation = $donation;}
		public function setOrganization($organization) {$this->organization = $organization;}

	}// end class

?>
