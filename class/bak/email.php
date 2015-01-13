<?php

	// TITLE: email Class
	// FILE: class/email.php
	// AUTHOR: AUTOGEN

	class Email {

		// ATTRIBUTES //

		private $id;
		private $email;
		private $person;


		// CONSTRUCTOR //

		public function __construct() {}


		// METHODS //

		public function getId() {return $this->id;}
		public function getEmail() {return $this->email;}
		public function getPerson() {return $this->person;}

		public function setId($id) {$this->id = $id;}
		public function setEmail($email) {$this->email = $email;}
		public function setPerson($person) {$this->person = $person;}

	}// end class

?>
