<?php

	// TITLE: city Class
	// FILE: class/city.php
	// AUTHOR: AUTOGEN

	class City {

		// ATTRIBUTES //

		private $id;
		private $title;
		private $state;


		// CONSTRUCTOR //

		public function __construct() {}


		// METHODS //

		public function getId() {return $this->id;}
		public function getTitle() {return $this->title;}
		public function getState() {return $this->state;}

		public function setId($id) {$this->id = $id;}
		public function setTitle($title) {$this->title = $title;}
		public function setState($state) {$this->state = $state;}

	}// end class

?>
