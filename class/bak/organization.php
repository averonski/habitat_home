<?php

	// TITLE: organization Class
	// FILE: class/organization.php
	// AUTHOR: AUTOGEN

	class Organization {

		// ATTRIBUTES //

		private $id;
		private $name;
		private $contact;


		// CONSTRUCTOR //

		public function __construct() {}


		// METHODS //

		public function getId() {return $this->id;}
		public function getName() {return $this->name;}
		public function getAddress() {return $this->contact;}

		public function setId($id) {$this->id = $id;}
		public function setName($name) {$this->name = $name;}
		public function setAddress($contact) {$this->contact = $contact;}

	}// end class

?>
