<?php

	// TITLE: committee_attendance Class
	// FILE: class/committee_attendance.php
	// AUTHOR: AUTOGEN

	class Committee_attendance {

		// ATTRIBUTES //

		private $attendance_id;
		private $committee;
		private $volunteer;
		private $status;


		// CONSTRUCTOR //

		public function __construct() {}


		// METHODS //

		public function getAttendance_id() {return $this->attendance_id;}
		public function getCommittee() {return $this->committee;}
		public function getVolunteer() {return $this->volunteer;}
		public function getStatus() {return $this->status;}

		public function setAttendance_id($attendance_id) {$this->attendance_id = $attendance_id;}
		public function setCommittee($committee) {$this->committee = $committee;}
		public function setVolunteer($volunteer) {$this->volunteer = $volunteer;}
		public function setStatus($status) {$this->status = $status;}

	}// end class

?>
