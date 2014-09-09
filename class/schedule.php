<?php

	// TITLE: schedule Class
	// FILE: class/schedule.php
	// AUTHOR: AUTOGEN

	class Schedule {

		// ATTRIBUTES //

		private $id;
		private $schedule;
		private $start_time;
		private $end_time;
		private $description;
		private $interest_id;
		private $max_num_people;


		// CONSTRUCTOR //

		public function __construct() {}


		// METHODS //

		public function getId() {return $this->id;}
		public function getSchedule() {return $this->schedule;}
		public function getStart_time() {return $this->start_time;}
		public function getEnd_time() {return $this->end_time;}
		public function getDescription() {return $this->description;}
		public function getInterest_id() {return $this->interest_id;}
		public function getMax_num_people() {return $this->max_num_people;}

		public function setId($id) {$this->id = $id;}
		public function setSchedule($schedule) {$this->schedule = $schedule;}
		public function setStart_time($start_time) {$this->start_time = $start_time;}
		public function setEnd_time($end_time) {$this->end_time = $end_time;}
		public function setDescription($description) {$this->description = $description;}
		public function setInterest_id($interest_id) {$this->interest_id = $interest_id;}
		public function setMax_num_people($max_num_people) {$this->max_num_people = $max_num_people;}

	}// end class

?>
