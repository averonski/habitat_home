<?php

	// TITLE: Home Home Model
	// FILE: home/model/home.php
	// AUTHOR: AUTOGEN


	function search() {}
	function create() {}
	function read() {}
	function update() {}
	function delete() {}
	//function list() {}

	// gets person information based on username
	function getPerson($userName){
		global $dbio;
		//$accountId=$dbio->getAccountId($userName);
		$personId=$dbio->getPersonIdByUserName($userName);
		$person= $dbio->readPerson($personId);
		return $person;
		
	}
	
	// gets personId based on username
	function getPersonid($userName){

	global $dbio;
	$personId=$dbio->getPersonIdByUserName($userName);
	$_SESSION['personid'] = $personId;
	return $personId;	
	}
?>
