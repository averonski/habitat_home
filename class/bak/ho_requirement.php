<?php

	// TITLE: ho_requirement Class
	// FILE: class/ho_requirement.php
	// AUTHOR: AUTOGEN

	class Ho_requirement {

		// ATTRIBUTES //

		private $person;
		private $requirement;
		private $when_entered;
		private $when_completed;
		private $office;
		private $when_authorized;
		private $admin;


		// CONSTRUCTOR //

		public function __construct() {}


		// METHODS //

		public function getPerson() {return $this->person;}
		public function getRequirement() {return $this->requirement;}
		public function getWhen_entered() {return $this->when_entered;}
		public function getWhen_completed() {return $this->when_completed;}
		public function getOffice() {return $this->office;}
		public function getWhen_authorized() {return $this->when_authorized;}
		public function getAdmin() {return $this->admin;}

		public function setPerson($person) {$this->person = $person;}
		public function setRequirement($requirement) {$this->requirement = $requirement;}
		public function setWhen_entered($when_entered) {$this->when_entered = $when_entered;}
		public function setWhen_completed($when_completed) {$this->when_completed = $when_completed;}
		public function setOffice($office) {$this->office = $office;}
		public function setWhen_authorized($when_authorized) {$this->when_authorized = $when_authorized;}
		public function setAdmin($admin) {$this->admin = $admin;}

	}// end class

?>
