<?php

	// TITLE: ho_debt Class
	// FILE: class/ho_debt.php
	// AUTHOR: AUTOGEN

	class Ho_debt {

		// ATTRIBUTES //

		private $id;
		private $person;
		private $monthly_payment;
		private $balance;


		// CONSTRUCTOR //

		public function __construct() {}


		// METHODS //

		public function getId() {return $this->id;}
		public function getPerson() {return $this->person;}
		public function getMonthly_payment() {return $this->monthly_payment;}
		public function getBalance() {return $this->balance;}

		public function setId($id) {$this->id = $id;}
		public function setPerson($person) {$this->person = $person;}
		public function setMonthly_payment($monthly_payment) {$this->monthly_payment = $monthly_payment;}
		public function setBalance($balance) {$this->balance = $balance;}

	}// end class

?>
