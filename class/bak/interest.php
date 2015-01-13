<?php

	// TITLE: interest Class
	// FILE: class/interest.php
	// AUTHOR: AUTOGEN

	class Interest {

		// ATTRIBUTES //

		private $id;
		private $type;
		private $title;
		private $description;


		// CONSTRUCTOR //

		public function __construct() {}


		// METHODS //

		public function getId() {return $this->id;}
		public function getType() {return $this->type;}
		public function getTitle() {return $this->title;}
		public function getDescription() {return $this->description;}

		public function setId($id) {$this->id = $id;}
		public function setType($type) {$this->type = $type;}
		public function setTitle($title) {$this->title = $title;}
		public function setDescription($description) {$this->description = $description;}

	}// end class

?>
