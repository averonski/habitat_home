<?php

	// TITLE: material Class
	// FILE: class/material.php
	// AUTHOR: AUTOGEN

	class Material {

		// ATTRIBUTES //

		private $donation;
		private $value;
		private $description;


		// CONSTRUCTOR //

		public function __construct() {}


		// METHODS //

		public function getDonation() {return $this->donation;}
		public function getValue() {return $this->value;}
		public function getDescription() {return $this->description;}

		public function setDonation($donation) {$this->donation = $donation;}
		public function setValue($value) {$this->value = $value;}
		public function setDescription($description) {$this->description = $description;}

	}// end class

?>
