<?php

	// TITLE: work Class
	// FILE: class/work.php
	// AUTHOR: AUTOGEN

	class Work {

		// ATTRIBUTES //

		private $id;
		private $volunteer;
		private $date;
		private $event;
		private $when_entered;
		private $office;
		private $when_authorized;
		private $admin;
		private $hours_worked;


		// CONSTRUCTOR //

		public function __construct() {}


		// METHODS //

		public function getId() {return $this->id;}
		public function getVolunteer() {return $this->volunteer;}
		public function getDate() {return $this->date;}
		public function getEvent() {return $this->event;}
		public function getWhen_entered() {return $this->when_entered;}
		public function getOffice() {return $this->office;}
		public function getWhen_authorized() {return $this->when_authorized;}
		public function getAdmin() {return $this->admin;}
		public function getHours_worked() {return $this->hours_worked;}

		public function setId($id) {$this->id = $id;}
		public function setVolunteer($volunteer) {$this->volunteer = $volunteer;}
		public function setDate($date) {$this->date = $date;}
		public function setEvent($event) {$this->event = $event;}
		public function setWhen_entered($when_entered) {$this->when_entered = $when_entered;}
		public function setOffice($office) {$this->office = $office;}
		public function setWhen_authorized($when_authorized) {$this->when_authorized = $when_authorized;}
		public function setAdmin($admin) {$this->admin = $admin;}
		public function setHours_worked($hours_worked) {$this->hours_worked = $hours_worked;}

	}// end class

?>
