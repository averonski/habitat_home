<?php

	// TITLE: event Class
	// FILE: class/event.php
	// AUTHOR: AUTOGEN

	class Event {

		// ATTRIBUTES //

		private $id;
		private $title;
		private $date;
		private $start_time;
		private $end_time;
		private $address;
		private $type;
		private $max_num_guests;
		private $committee;
		private $sponsored;


		// CONSTRUCTOR //

		public function __construct() {}


		// METHODS //

		public function getId() {return $this->id;}
		public function getTitle() {return $this->title;}
		public function getDate() {return $this->date;}
		public function getStart_time() {return $this->start_time;}
		public function getEnd_time() {return $this->end_time;}
		public function getAddress_id() {return $this->address;}
		public function getType() {return $this->type;}
		public function getMax_num_guests() {return $this->max_num_guests;}
		public function getCommittee() {return $this->committee;}
		public function getSponsored() {return $this->sponsored;}

		public function setId($id) {$this->id = $id;}
		public function setTitle($title) {$this->title = $title;}
		public function setDate($date) {$this->date = $date;}
		public function setStart_time($start_time) {$this->start_time = $start_time;}
		public function setEnd_time($end_time) {$this->end_time = $end_time;}
		public function setAddress_id($address) {$this->address = $address;}
		public function setType($type) {$this->type = $type;}
		public function setMax_num_guests($max_num_guests) {$this->max_num_guests = $max_num_guests;}
		public function setCommittee($committee) {$this->committee = $committee;}
		public function setSponsored($sponsored) {$this->sponsored = $sponsored;}

	}// end class

?>
