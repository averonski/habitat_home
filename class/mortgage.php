<?php

	// TITLE: mortgage Class
	// FILE: class/mortgage.php
	// AUTHOR: AUTOGEN

	class Mortgage {

		// ATTRIBUTES //

		private $id;
		private $person;
		private $amount;
		private $status;
		private $project;
		private $bank;


		// CONSTRUCTOR //

		public function __construct() {}


		// METHODS //

		public function getId() {return $this->id;}
		public function getPerson() {return $this->person;}
		public function getAmount() {return $this->amount;}
		public function getStatus() {return $this->status;}
		public function getProject() {return $this->project;}
		public function getBank() {return $this->bank;}

		public function setId($id) {$this->id = $id;}
		public function setPerson($person) {$this->person = $person;}
		public function setAmount($amount) {$this->amount = $amount;}
		public function setStatus($status) {$this->status = $status;}
		public function setProject($project) {$this->project = $project;}
		public function setBank($bank) {$this->bank = $bank;}

	}// end class

?>
