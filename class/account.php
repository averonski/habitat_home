<?php

class Account
{
	  
	// ATTRIBUTES //
	// Account Info
	private $title;
	private $fName;
	private $lName;
	private $street1;
	private $street2;
        private $city;
        private $state;
        private $zip;
        private $phone;
        private $email;
        private $ssn;
        private $employer;
        private $workPhone;
        private $jobTitle;

        // Account Preferences
        private $preferenceOption1;
        private $preferenceOption2;
        private $preferenceOption3;
        private $preference1;
        private $preference2;
        private $preference3;
        private $preferenceCallUpdate;
        private $preferenceMailUpdate;
        private $preferenceEmailUpdate;



	// CONSTRUCTOR //

	public function __construct() {}


	// METHOD //
	// Account Info functions
	public function getAccountTitle() {return $this->title;}
	public function getAccountFname() {return $this->fName;}
	public function getAccountLname() {return $this->lName;}
	public function getAccountStreet1() {return $this->street1;}
	public function getAccountStreet2() {return $this->street2;}
        public function getAccountCity() {return $this->city;}
        public function getAccountState() {return $this->state;}
	public function getAccountZip() {return $this->zip;}
	public function getAccountPhone() {return $this->phone;}
	public function getAccountEmail() {return $this->email;}
	public function getAccountSSN() {return $this->ssn;}
	public function getAccountEmployer() {return $this->employer;}
	public function getAccountWorkPhone() {return $this->workPhone;}
        public function getAccountJobTitle() {return $this->jobTitle;}

        public function setAccountTitle($title) {$this->title = $title;}
	public function setAccountFname($fName) {$this->fName = $fName;}
	public function setAccountLname($lName) {$this->lName = $lName;}
	public function setAccountStreet1($street1) {$this->street1 = $street1;}
	public function setAccountStreet2($street2) {$this->street2 = $street2;}
        public function setAccountCity($city) {$this->city = $city;}
        public function setAccountState($state) {$this->state = $state;}
	public function setAccountZip($zip) {$this->zip = $zip;}
	public function setAccountPhone($phone) {$this->phone = $phone;}
	public function setAccountEmail($email) {$this->email = $email;}
	public function setAccountSSN($ssn) {$this->ssn = $ssn;}
	public function setAccountEmployer($employer) {$this->employer = $employer;}
	public function setAccountWorkPhone($workPhone) {$this->workPhone = $workPhone;}
        public function setAccountJobTitle($jobTitle) {$this->jobTitle = $jobTitle;}

        // Account Preferences functions
        public function getPreferenceOption1() {return $this->preferenceOption1;}
        public function getPreferenceOption2() {return $this->preferenceOption2;}
        public function getPreferenceOption3() {return $this->preferenceOption3;}

        public function setPreferenceOption1($preferenceOption1) {$this->preferenceOption1 = $preferenceOption1;}
        public function setPreferenceOption2($preferenceOption2) {$this->preferenceOption2 = $preferenceOption2;}
        public function setPreferenceOption3($preferenceOption3) {$this->preferenceOption3 = $preferenceOption3;}

        public function getPreference1() {return $this->preference1;}
        public function getPreference2() {return $this->preference2;}
        public function getPreference3() {return $this->preference3;}

        public function setPreference1($preference1) {$this->preference1 = $preference1;}
        public function setPreference2($preference2) {$this->preference2 = $preference2;}
        public function setPreference3($preference3) {$this->preference3 = $preference3;}

        public function getPreferenceCall(){return $this->preferenceCallUpdate;}
        public function getPreferenceMail(){return $this->preferenceMailUpdate;}
        public function getPreferenceEmail(){return $this->preferenceEmailUpdate;}

        public function setPreferenceCall($preferenceCallUpdate){$this->preferenceCallUpdate = $preferenceCallUpdate;}
        public function setPreferenceMail($preferenceMailUpdate){$this->preferenceMailUpdate = $preferenceMailUpdate;}
        public function setPreferenceEmail($preferenceEmailUpdate){$this->preferenceEmailUpdate = $preferenceEmailUpdate;}

}// end class
?>