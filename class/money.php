<?php

	// TITLE: money Class
	// FILE: class/money.php
	// AUTHOR: AUTOGEN

	class Money {

		// ATTRIBUTES //

		private $donation;
		private $amount;
		private $method;


		// CONSTRUCTOR //

		public function __construct() {}


		// METHODS //

		public function getDonation() {return $this->donation;}
		public function getAmount() {return $this->amount;}
		public function getMethod() {return $this->method;}

		public function setDonation($donation) {$this->donation = $donation;}
		public function setAmount($amount) {$this->amount = $amount;}
		public function setMethod($method) {$this->method = $method;}

	}// end class

?>
