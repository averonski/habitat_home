<?php

	// TITLE: event_expenses Class
	// FILE: class/event_expenses.php
	// AUTHOR: AUTOGEN

	class Event_expenses {

		// ATTRIBUTES //

		private $id;
		private $event;
		private $title;
		private $description;
		private $amount;
		private $when_entered;
		private $office;
		private $when_authorized;
		private $admin;


		// CONSTRUCTOR //

		public function __construct() {}


		// METHODS //

		public function getId() {return $this->id;}
		public function getEvent() {return $this->event;}
		public function getTitle() {return $this->title;}
		public function getDescription() {return $this->description;}
		public function getAmount() {return $this->amount;}
		public function getWhen_entered() {return $this->when_entered;}
		public function getOffice() {return $this->office;}
		public function getWhen_authorized() {return $this->when_authorized;}
		public function getAdmin() {return $this->admin;}

		public function setId($id) {$this->id = $id;}
		public function setEvent($event) {$this->event = $event;}
		public function setTitle($title) {$this->title = $title;}
		public function setDescription($description) {$this->description = $description;}
		public function setAmount($amount) {$this->amount = $amount;}
		public function setWhen_entered($when_entered) {$this->when_entered = $when_entered;}
		public function setOffice($office) {$this->office = $office;}
		public function setWhen_authorized($when_authorized) {$this->when_authorized = $when_authorized;}
		public function setAdmin($admin) {$this->admin = $admin;}

	}// end class

?>
