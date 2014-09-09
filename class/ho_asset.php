<?php

	// TITLE: ho_asset Class
	// FILE: class/ho_asset.php
	// AUTHOR: AUTOGEN

	class Ho_asset {

		// ATTRIBUTES //

		private $id;
		private $person;
		private $title;
		private $description;
		private $value;


		// CONSTRUCTOR //

		public function __construct() {}


		// METHODS //

		public function getId() {return $this->id;}
		public function getPerson() {return $this->person;}
		public function getTitle() {return $this->title;}
		public function getDescription() {return $this->description;}
		public function getValue() {return $this->value;}

		public function setId($id) {$this->id = $id;}
		public function setPerson($person) {$this->person = $person;}
		public function setTitle($title) {$this->title = $title;}
		public function setDescription($description) {$this->description = $description;}
		public function setValue($value) {$this->value = $value;}

	}// end class

?>
