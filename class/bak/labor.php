<?php

	// TITLE: labor Class
	// FILE: class/labor.php
	// AUTHOR: AUTOGEN

	class Labor {

		// ATTRIBUTES //

		private $donation;
		private $amount;
		private $method;
		private $project;


		// CONSTRUCTOR //

		public function __construct() {}


		// METHODS //

		public function getDonation() {return $this->donation;}
		public function getAmount() {return $this->amount;}
		public function getMethod() {return $this->method;}
		public function getProject() {return $this->project;}

		public function setDonation($donation) {$this->donation = $donation;}
		public function setAmount($amount) {$this->amount = $amount;}
		public function setMethod($method) {$this->method = $method;}
		public function setProject($project) {$this->project = $project;}

	}// end class

?>
