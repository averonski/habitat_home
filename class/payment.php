<?php

	// TITLE: payment Class
	// FILE: class/payment.php
	// AUTHOR: AUTOGEN

	class Payment {

		// ATTRIBUTES //

		private $id;
		private $person;
		private $mortgage;
		private $amount;
		private $date;
		private $time;
		private $office;
		private $when_authorized;
		private $admin;


		// CONSTRUCTOR //

		public function __construct() {}


		// METHODS //

		public function getId() {return $this->id;}
		public function getPerson() {return $this->person;}
		public function getMortgage() {return $this->mortgage;}
		public function getAmount() {return $this->amount;}
		public function getDate() {return $this->date;}
		public function getTime() {return $this->time;}
		public function getOffice() {return $this->office;}
		public function getWhen_authorized() {return $this->when_authorized;}
		public function getAdmin() {return $this->admin;}

		public function setId($id) {$this->id = $id;}
		public function setPerson($person) {$this->person = $person;}
		public function setMortgage($mortgage) {$this->mortgage = $mortgage;}
		public function setAmount($amount) {$this->amount = $amount;}
		public function setDate($date) {$this->date = $date;}
		public function setTime($time) {$this->time = $time;}
		public function setOffice($office) {$this->office = $office;}
		public function setWhen_authorized($when_authorized) {$this->when_authorized = $when_authorized;}
		public function setAdmin($admin) {$this->admin = $admin;}

	}// end class

?>
