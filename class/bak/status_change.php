<?php

	// TITLE: status_change Class
	// FILE: class/status_change.php
	// AUTHOR: AUTOGEN

	class Status_change {

		// ATTRIBUTES //

		private $project;
		private $status;
		private $when_changed;


		// CONSTRUCTOR //

		public function __construct() {}


		// METHODS //

		public function getProject() {return $this->project;}
		public function getStatus() {return $this->status;}
		public function getWhen_changed() {return $this->when_changed;}

		public function setProject($project) {$this->project = $project;}
		public function setStatus($status) {$this->status = $status;}
		public function setWhen_changed($when_changed) {$this->when_changed = $when_changed;}

	}// end class

?>
