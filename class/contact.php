<?php

	// TITLE: contact Class
	// FILE: class/contact.php
	// AUTHOR: AUTOGEN

	class Contact {

		// ATTRIBUTES //

		private $id;
		private $address;
		private $phone;
		private $phone2;
		private $email;


		// CONSTRUCTOR //

		public function __construct() {}


		// METHODS //

		public function getId() {return $this->id;}
		public function getAddress() {return $this->address;}
		public function getPhone() {return $this->phone;}
		public function getPhone2() {return $this->phone2;}
		public function getEmail() {return $this->email;}

		public function setId($id) {$this->id = $id;}
		public function setAddress($address) {$this->address = $address;}
		public function setPhone($phone) {$this->phone = $phone;}
		public function setPhone2($phone2) {$this->phone2 = $phone2;}
		public function setEmail($email) {$this->email = $email;}

	}// end class

?>
