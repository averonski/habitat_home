<?php

	// TITLE: Account Personal Info Model
	// FILE: account/model/info.php
	// AUTHOR: AUTOGEN
	
	$pid = $_SESSION['personid']; // gets the logged in persons id from session
	$account = new Account();
	$account = $dbio->readAccount($pid); //gets account info from person id


	//read person from account
	$person = new Person();
	$person = $dbio->readPerson($pid); 

	//read contact from person
	$contact = new Contact();
        //print_r($person->getContact()->getId());
	$contact = $dbio->readContact($person->getContact()->getId());  
	
	//read address from contact
	$address = new Address();
        //print_r($contact->getAddress()[0]->getId());
	$address = $dbio->readAddress($contact->getAddress()->getId());

?>
