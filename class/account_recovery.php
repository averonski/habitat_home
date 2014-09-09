<?php

	// TITLE: account_recovery Class
	// FILE: class/account_recovery.php
	// AUTHOR: AUTOGEN

	class Account_recovery {

		// ATTRIBUTES //

		private $account;
		private $code;
		private $date;
		private $time;


		// CONSTRUCTOR //

		public function __construct() {}


		// METHODS //

		public function getAccount() {return $this->account;}
		public function getCode() {return $this->code;}
		public function getDate() {return $this->date;}
		public function getTime() {return $this->time;}

		public function setAccount($account) {$this->account = $account;}
		public function setCode($code) {$this->code = $code;}
		public function setDate($date) {$this->date = $date;}
		public function setTime($time) {$this->time = $time;}

	}// end class

?>
