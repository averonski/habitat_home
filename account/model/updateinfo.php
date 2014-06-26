<?php
	// TITLE: Home Home Controller
	// FILE: account/model/updateinfo.php
	// AUTHOR: 
	//updates a persons perosnal information, contact information, and address

	//initializes the person, contact, and address class
	$person = new Person();
	$contact = new Contact();
	$address = new Address();

	//gets information submitted in the form
	//person
	$pid = $_GET['pid'];
	$person->setTitle($_GET['title']);
	$person->setFirst_name($_GET['fName']);
	$person->setLast_name($_GET['lName']);
	$person->setEmployer($_GET['employer']);
	$person->setJobtitle($_GET['jobTitle']);
	//contact
	$contact->setPhone($_GET['phone']);
	$contact->setEmail($_GET['email']);
	$contact->setPhone2($_GET['workPhone']);
	$contact->setExtension($_GET['workExt']);
	//address
	$address->setStreet1($_GET['street1']);
	$address->setStreet2($_GET['street2']);
	$address->setCity($_GET['city']);
	$address->setState($_GET['state']);
	$address->setZip($_GET['zip']);
	//updates database
	$update = $dbio->updateInfo($pid,$person,$contact,$address);


?>
