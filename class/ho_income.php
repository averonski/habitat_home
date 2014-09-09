<?php

	// TITLE: ho_income Class
	// FILE: class/ho_income.php
	// AUTHOR: AUTOGEN

	class Ho_income {

		// ATTRIBUTES //

		private $id;
		private $person;
		private $gross;
		private $child_support;
		private $disability;
		private $unemployment;


		// CONSTRUCTOR //

		public function __construct() {}


		// METHODS //

		public function getId() {return $this->id;}
		public function getPerson() {return $this->person;}
		public function getGross() {return $this->gross;}
		public function getChild_support() {return $this->child_support;}
		public function getDisability() {return $this->disability;}
		public function getUnemployment() {return $this->unemployment;}

		public function setId($id) {$this->id = $id;}
		public function setPerson($person) {$this->person = $person;}
		public function setGross($gross) {$this->gross = $gross;}
		public function setChild_support($child_support) {$this->child_support = $child_support;}
		public function setDisability($disability) {$this->disability = $disability;}
		public function setUnemployment($unemployment) {$this->unemployment = $unemployment;}

	}// end class

?>
