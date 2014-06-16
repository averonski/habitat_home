<?php

	// TITLE: Account Personal Info Model
	// FILE: account/model/info.php
	// AUTHOR: AUTOGEN
	
	$pid = $_SESSION['personid']; // gets the logged in persons id from session
	$account = new Account();
	$account = $dbio->readAccountInfo($pid); //gets account info from person id


	//read person from account
	$person = new Person();
	$person = $dbio->readPerson($account->getPerson()); 

	//read contact from person
	$contact = new Contact();
	$contact = $dbio->readContact($person->getContact());  
	
	//read address from contact
	$address = new Address();
	$address = $dbio->readAddress($contact->getAddress());

?>
