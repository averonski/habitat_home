<?php

	// TITLE: state Class
	// FILE: class/state.php
	// AUTHOR: AUTOGEN

	class State {

		// ATTRIBUTES //

		private $id;
		private $abbreviation;
		private $title;


		// CONSTRUCTOR //

		public function __construct() {}


		// METHODS //

		public function getId() {return $this->id;}
		public function getAbbreviation() {return $this->abbreviation;}
		public function getTitle() {return $this->title;}

		public function setId($id) {$this->id = $id;}
		public function setAbbreviation($abbreviation) {$this->abbreviation = $abbreviation;}
		public function setTitle($title) {$this->title = $title;}

	}// end class

?>
