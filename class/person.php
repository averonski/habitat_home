<?php

	// TITLE: person Class
	// FILE: class/person.php
	// AUTHOR: AUTOGEN

	class Person {

		// ATTRIBUTES //

		private $id;
		private $title;
		private $first_name;
		private $last_name;
		private $gender;
		private $dob;
		private $marital_status;
		private $contact;


		// CONSTRUCTOR //

		public function __construct() {}


		// METHODS //

		public function getId() {return $this->id;}
		public function getTitle() {return $this->title;}
		public function getFirst_name() {return $this->first_name;}
		public function getLast_name() {return $this->last_name;}
		public function getGender() {return $this->gender;}
		public function getDob() {return $this->dob;}
		public function getMarital_status() {return $this->marital_status;}
		public function getContact() {return $this->contact;}

		public function setId($id) {$this->id = $id;}
		public function setTitle($title) {$this->title = $title;}
		public function setFirst_name($first_name) {$this->first_name = $first_name;}
		public function setLast_name($last_name) {$this->last_name = $last_name;}
		public function setGender($gender) {$this->gender = $gender;}
		public function setDob($dob) {$this->dob = $dob;}
		public function setMarital_status($marital_status) {$this->marital_status = $marital_status;}
		public function setContact($contact) {$this->contact = $contact;}

	}// end class

?>
