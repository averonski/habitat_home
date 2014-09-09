<?php

	// TITLE: organization_contact Class
	// FILE: class/organization_contact.php
	// AUTHOR: AUTOGEN

	class Organization_contact {

		// ATTRIBUTES //

		private $organization;
		private $person;
		private $phone;
		private $ext;
		private $fax;


		// CONSTRUCTOR //

		public function __construct() {}


		// METHODS //

		public function getOrganization() {return $this->organization;}
		public function getPerson() {return $this->person;}
		public function getPhone() {return $this->phone;}
		public function getExt() {return $this->ext;}
		public function getFax() {return $this->fax;}

		public function setOrganization($organization) {$this->organization = $organization;}
		public function setPerson($person) {$this->person = $person;}
		public function setPhone($phone) {$this->phone = $phone;}
		public function setExt($ext) {$this->ext = $ext;}
		public function setFax($fax) {$this->fax = $fax;}

	}// end class

?>
