<?php
	// TITLE: update account personal info
	// FILE: account/model/updateinfo.php
	// AUTHOR: 
	//updates a persons perosnal information, contact information, and address

	//initializes the person, contact, and address class
	$person = new Person();
	$contact = new Contact();
	$address = new Address();
        
        //gets needed IDs for update
        $ids = $dbio->readPerson($_GET['pid']);
        $contactId = $ids->getContact()->getId();
        $addressId = $ids->getContact()->getAddress()->getId();
        print_r($addressId);
        
        //gets email id
        $email = $_GET['email'];
        $emailId = $dbio->readEmailbyEmail($_SESSION['username']);

	//gets information submitted in the form
	//person
	$pid = $_GET['pid'];
	$person->setTitle($_GET['title']);
	$person->setFirst_name($_GET['fName']);
	$person->setLast_name($_GET['lName']);
            //$person->setEmployer($_GET['employer']);
            //$person->setJobtitle($_GET['jobTitle']);
        
	//contact
	$contact->setPhone($_GET['phone']);
	//$contact->setPhone2($_GET['workPhone']);
        //$contact->setExtension($_GET['workExt']);
            
	//address
	$address->setStreet1($_GET['street1']);
	$address->setStreet2($_GET['street2']);
	$address->setCity($_GET['city']);
	$address->setState($_GET['state']);
	$address->setZip($_GET['zip']);
        
	//updates database
        $dbio->updateEmail($emailId->getId(), $email);
            $_SESSION['username'] = $email;
        $dbio->updatePerson($pid, $person);
        $dbio->updateContact($contactId, $contact);
        $dbio->updateAddress($addressId, $address);
        
?>
