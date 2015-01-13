<?php

	// TITLE: account Class
	// FILE: class/account.php
	// AUTHOR: AUTOGEN

	class Account {

		// ATTRIBUTES //

		private $id;
		private $email;
		private $password;
		private $created;
		private $status;
		private $person;


		// CONSTRUCTOR //

		public function __construct() {}


		// METHODS //

		public function getId() {return $this->id;}
		public function getEmail() {return $this->email;}
		public function getPassword() {return $this->password;}
		public function getCreated() {return $this->created;}
		public function getStatus() {return $this->status;}
		public function getPerson() {return $this->person;}

		public function setId($id) {$this->id = $id;}
		public function setEmail($email) {$this->email = $email;}
		public function setPassword($password) {$this->password = $password;}
		public function setCreated($created) {$this->created = $created;}
		public function setStatus($status) {$this->status = $status;}
		public function setPerson($person) {$this->person = $person;}

	}// end class

?>
