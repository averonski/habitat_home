<?php

	// TITLE: volunteer Class
	// FILE: class/volunteer.php
	// AUTHOR: AUTOGEN

	class Volunteer {

		// ATTRIBUTES //

		private $id;
		private $person;
		private $consent_age;
		private $consent_video;
		private $consent_waiver;
		private $consent_photo;
		private $consent_minor;
		private $consent_safety;
		private $avail_day;
		private $avail_eve;
		private $avail_wkend;
		private $emergency_name;
		private $emergency_phone;


		// CONSTRUCTOR //

		public function __construct() {}


		// METHODS //

		public function getId() {return $this->id;}
		public function getPerson() {return $this->person;}
		public function getConsent_age() {return $this->consent_age;}
		public function getConsent_video() {return $this->consent_video;}
		public function getConsent_waiver() {return $this->consent_waiver;}
		public function getConsent_photo() {return $this->consent_photo;}
		public function getConsent_minor() {return $this->consent_minor;}
		public function getConsent_safety() {return $this->consent_safety;}
		public function getAvail_day() {return $this->avail_day;}
		public function getAvail_eve() {return $this->avail_eve;}
		public function getAvail_wkend() {return $this->avail_wkend;}
		public function getEmergency_name() {return $this->emergency_name;}
		public function getEmergency_phone() {return $this->emergency_phone;}

		public function setId($id) {$this->id = $id;}
		public function setPerson($person) {$this->person = $person;}
		public function setConsent_age($consent_age) {$this->consent_age = $consent_age;}
		public function setConsent_video($consent_video) {$this->consent_video = $consent_video;}
		public function setConsent_waiver($consent_waiver) {$this->consent_waiver = $consent_waiver;}
		public function setConsent_photo($consent_photo) {$this->consent_photo = $consent_photo;}
		public function setConsent_minor($consent_minor) {$this->consent_minor = $consent_minor;}
		public function setConsent_safety($consent_safety) {$this->consent_safety = $consent_safety;}
		public function setAvail_day($avail_day) {$this->avail_day = $avail_day;}
		public function setAvail_eve($avail_eve) {$this->avail_eve = $avail_eve;}
		public function setAvail_wkend($avail_wkend) {$this->avail_wkend = $avail_wkend;}
		public function setEmergency_name($emergency_name) {$this->emergency_name = $emergency_name;}
		public function setEmergency_phone($emergency_phone) {$this->emergency_phone = $emergency_phone;}

	}// end class

?>
