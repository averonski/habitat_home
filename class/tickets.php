<?php

	// TITLE: tickets Class
	// FILE: class/tickets.php
	// AUTHOR: AUTOGEN

	class Tickets {

		// ATTRIBUTES //

		private $event;
		private $id;
		private $ticket_price;
		private $max_num;
		private $current_num;


		// CONSTRUCTOR //

		public function __construct() {}


		// METHODS //

		public function getEvent() {return $this->event;}
		public function getId() {return $this->id;}
		public function getTicket_price() {return $this->ticket_price;}
		public function getMax_num() {return $this->max_num;}
		public function getCurrent_num() {return $this->current_num;}

		public function setEvent($event) {$this->event = $event;}
		public function setId($id) {$this->id = $id;}
		public function setTicket_price($ticket_price) {$this->ticket_price = $ticket_price;}
		public function setMax_num($max_num) {$this->max_num = $max_num;}
		public function setCurrent_num($current_num) {$this->current_num = $current_num;}

	}// end class

?>
