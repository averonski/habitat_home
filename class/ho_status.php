<?php

	// TITLE: ho_status Class
	// FILE: class/ho_status.php
	// AUTHOR: AUTOGEN

	class Ho_status {

		// ATTRIBUTES //

		private $id;
		private $title;
		private $code;
		private $description;


		// CONSTRUCTOR //

		public function __construct() {}


		// METHODS //

		public function getId() {return $this->id;}
		public function getTitle() {return $this->title;}
		public function getCode() {return $this->code;}
		public function getDescription() {return $this->description;}

		public function setId($id) {$this->id = $id;}
		public function setTitle($title) {$this->title = $title;}
		public function setCode($code) {$this->code = $code;}
		public function setDescription($description) {$this->description = $description;}

	}// end class

?>
