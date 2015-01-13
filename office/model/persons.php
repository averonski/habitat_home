<?php

	// TITLE: Office Donations Model
	// FILE: office/model/donations.php
	// AUTHOR: AUTOGEN

        //reads persons based on their name or organization they're from
	function search() {
            global $dbio;
            if($_GET['searchBy'] == 'name'){
                            $fname = $_GET['input1'];
                            $lname =  $_GET['input2'];
                            $tableinfo = $dbio->readPersonByName($fname,$lname);
            } elseif ($_GET['searchBy'] == 'organization') {
                $org = $_GET['input1'];
                $tableinfo = $dbio->readPersonByOrg($org);
            }
            return $tableinfo;
	}
        
        //creates a person
	function create() {
                global $dbio;
		$person = new Person();
		$contact = new Contact();
		$address = new Address();
		$event = new Event();
                
                //set NULLS -- will need revised
                $gender = NULL;
                $dob = NULL;
                $prefEmail = $prefMail = $prefPhone = NULL;
                
                // Person table
		$id = ($_SESSION['personid']);
		$title = ($_GET['title']);
		$fName = ($_GET['fName']);
		$lName = ($_GET['lName']);
		$maritalStatus = ($_GET['maritial']);
		//$person->setEmployer($_GET['employer']);
                //$person->setJobtitle($_GET['jobtitle']);
                
                //email table
		$email = ($_GET['email']);
                
                //contact table
                $phoneNumber = $_GET['phone'];
		$phoneNumber2 = ($_GET['workPhone']);
		$ext = ($_GET['workExt']);
                
                //address table
		$street1 = ($_GET['street1']);
		$street2 = ($_GET['street2']);
		$city = ($_GET['city']);
		$state = ($_GET['state']);
		$zip = ($_GET['zip']);
		$event->setId(isset($_GET['events']) ? $_GET['events'] : null);
		$updated = $dbio->createNewPerson($street1, $street2, $city, $state, $zip, $phoneNumber, $email, $phoneNumber2, $ext, $title, $fName, $lName, $gender, $dob, $maritalStatus, $prefEmail,$prefMail,$prefPhone);
                
                if ($dbio->createPerson($person))
		
		if($event->getEvent_id() != null){
			$person_id = $updated;
			$updated= $dbio->createFOH($event,$person_id);
		}
		return $updated;
	}
	
        //lists person
	function read() {
		global $dbio;
		$tableinfo = $dbio->listPerson();
		return $tableinfo;
	}
        
        //updates a person
	function update() {
		$pid = $_GET['pid'];
		$person = new Person();
		$contact = new Contact();
		$address = new Address();
		$event = new Event();
		$person->setTitle($_GET['title']);
		$person->setFirst_name($_GET['fName']);
		$person->setLast_name($_GET['lName']);
		$person->setEmployer($_GET['employer']);
    	$person->setJobtitle($_GET['jobtitle']);

		$contact->setPhone($_GET['phone']);
		$contact->setEmail($_GET['email']);
		$contact->setPhone2($_GET['workPhone']);
		$contact->setExtension($_GET['workExt']);

		$address->setStreet1($_GET['street1']);
		$address->setStreet2($_GET['street2']);
		$address->setCity($_GET['city']);
		$address->setState($_GET['state']);
		$address->setZip($_GET['zip']);
		$event->setEvent_id(isset($_GET['events']) ? $_GET['events'] : null);
		global $dbio;
		$updated = $dbio->updatePerson($pid,$person,$contact,$address,$event);
		return $updated;
	}
        
        //edits a person
	function edit() {

		$pid = $_GET['pid'];
		global $dbio;
		$person = $dbio->readPerson($pid);
                
		if($dbio->readFOH_by_person($pid)) {
                    $foh = $dbio->readFOH_by_Person($pid);
                }
		$isVol = $dbio->readVolunteerByPid($pid);
                    if ($isVol != false) {$isvol = 1;}
		$tableinfo = array($person,$foh,$isVol);
		return $tableinfo;
	}

        //makes a person a volunteer
	function migrate(){
		global $dbio;
		$pid = $_GET['pid'];
		$updated = $dbio->makeVolunteer($pid);
		return $updated;
	}

?>
