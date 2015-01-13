<?php

	// TITLE: home_owner Class
	// FILE: class/home_owner.php
	// AUTHOR: AUTOGEN

	class Home_owner {

		// ATTRIBUTES //

		private $person;
		private $status;
		private $bank;
		private $social_security;


		// CONSTRUCTOR //

		public function __construct() {}


		// METHODS //

		public function getPerson() {return $this->person;}
		public function getStatus() {return $this->status;}
		public function getBank() {return $this->bank;}
		public function getSocial_security() {return $this->social_security;}

		public function setPerson($person) {$this->person = $person;}
		public function setStatus($status) {$this->status = $status;}
		public function setBank($bank) {$this->bank = $bank;}
		public function setSocial_security($social_security) {$this->social_security = $social_security;}

	}// end class

?>
