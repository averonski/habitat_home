<?php

	// TITLE: board_member Class
	// FILE: class/board_member.php
	// AUTHOR: AUTOGEN

	class Board_member {

		// ATTRIBUTES //

		private $volunteer;
		private $is_board_member;


		// CONSTRUCTOR //

		public function __construct() {}


		// METHODS //

		public function getVolunteer() {return $this->volunteer;}
		public function getIs_board_member() {return $this->is_board_member;}

		public function setVolunteer($volunteer) {$this->volunteer = $volunteer;}
		public function setIs_board_member($is_board_member) {$this->is_board_member = $is_board_member;}

	}// end class

?>
