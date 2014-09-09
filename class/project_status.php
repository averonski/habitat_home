<?php

	// TITLE: project_status Class
	// FILE: class/project_status.php
	// AUTHOR: AUTOGEN

	class Project_status {

		// ATTRIBUTES //

		private $id;
		private $title;
		private $description;
		private $abbreviation;


		// CONSTRUCTOR //

		public function __construct() {}


		// METHODS //

		public function getId() {return $this->id;}
		public function getTitle() {return $this->title;}
		public function getDescription() {return $this->description;}
		public function getAbbreviation() {return $this->abbreviation;}

		public function setId($id) {$this->id = $id;}
		public function setTitle($title) {$this->title = $title;}
		public function setDescription($description) {$this->description = $description;}
		public function setAbbreviation($abbreviation) {$this->abbreviation = $abbreviation;}

	}// end class

?>
