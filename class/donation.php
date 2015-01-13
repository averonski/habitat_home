<?php

	// TITLE: donation Class
	// FILE: class/donation.php
	// AUTHOR: AUTOGEN

	class Donation {

		// ATTRIBUTES //

		private $id;
		private $date;
		private $time;
		private $details;
		private $when_entered;
		private $donor_id;
		private $office;
		private $donation_type;
		private $pledge;
		private $admin;


		// CONSTRUCTOR //

		public function __construct() {}


		// METHODS //

		public function getId() {return $this->id;}
		public function getDate() {return $this->date;}
		public function getTime() {return $this->time;}
		public function getDetails() {return $this->details;}
		public function getWhen_entered() {return $this->when_entered;}
		public function getDonor() {return $this->donor_id;}
		public function getOffice() {return $this->office;}
		public function getDonation_type() {return $this->donation_type;}
		public function getPledge() {return $this->pledge;}
		public function getAdmin() {return $this->admin;}

		public function setId($id) {$this->id = $id;}
		public function setDate($date) {$this->date = $date;}
		public function setTime($time) {$this->time = $time;}
		public function setDetails($details) {$this->details = $details;}
		public function setWhen_entered($when_entered) {$this->when_entered = $when_entered;}
		public function setDonor($donor_id) {$this->donor_id = $donor_id;}
		public function setOffice($office) {$this->office = $office;}
		public function setDonation_type($donation_type) {$this->donation_type = $donation_type;}
		public function setPledge($pledge) {$this->pledge = $pledge;}
		public function setAdmin($admin) {$this->admin = $admin;}

	}// end class

?>
