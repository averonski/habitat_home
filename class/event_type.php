<?php

	// TITLE: event_type Class
	// FILE: class/event_type.php
	// AUTHOR: AUTOGEN

	class Event_type {

		// ATTRIBUTES //

		private $id;
		private $title;
		private $description;


		// CONSTRUCTOR //

		public function __construct() {}


		// METHODS //

		public function getId() {return $this->id;}
		public function getTitle() {return $this->title;}
		public function getDescription() {return $this->description;}

		public function setId($id) {$this->id = $id;}
		public function setTitle($title) {$this->title = $title;}
		public function setDescription($description) {$this->description = $description;}

	}// end class

?>
