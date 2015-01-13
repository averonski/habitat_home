<?php

	// TITLE: Office Organizations Model
	// FILE: office/model/orgs.php
	// AUTHOR: AUTOGEN

        //reads an organization based on its name
	function search() {
		$orgname = $_GET['orgname'];
		global $dbio;
		$tableinfo = $dbio->readOrganizationByName($orgname);
		return $tableinfo;
	}
        
        //creates an organization
	function create() {
		$organization = new Organization();
		//$contact = new Contact();
		$address = new Address();
		$organization->setName($_GET['orgname']);
		//$contact->setPhone($_GET['phone']);
		//$contact->setEmail($_GET['email']);
		//$contact->setPhone2($_GET['workPhone']);
		//$contact->setExtension($_GET['workExt']);

		$address->setStreet1($_GET['street1']);
		$address->setStreet2($_GET['street2']);
		$address->setCity($_GET['city']);
		$address->setState($_GET['state']);
		$address->setZip($_GET['zip']);
		global $dbio;
                
		$id = $dbio->createAddress($address);
                if (is_numeric($id)) {
                    $organization->setAddress($id);
                    $dbio->createOrganization($organization);
                    return true;
                } else {
                    return false;
                }
	}
        
        //lists all organizations
	function read() {
		global $dbio;
		$tableinfo = $dbio->listOrganization();
		return $tableinfo;
	}
        
        //updates an organziation
	function update() {
		$oid = $_GET['oid'];
		$organization = new Organization();
		$contact = new Contact();
		$address = new Address();
		$organization->setName($_GET['orgname']);
		$contact->setPhone($_GET['phone']);
		$contact->setEmail($_GET['email']);
		$contact->setPhone2($_GET['workPhone']);
		$contact->setExtension($_GET['workExt']);

		$address->setStreet1($_GET['street1']);
		$address->setStreet2($_GET['street2']);
		$address->setCity($_GET['city']);
		$address->setState($_GET['state']);
		$address->setZip($_GET['zip']);
		global $dbio;
		$updated = $dbio->updateOrg($oid,$organization,$contact,$address);
		return $updated;
	}
        
        //setups edit page for organization
	function edit() {
		$oid = $_GET['oid'];
		global $dbio;
		$orgObj = $dbio->getOrgById($oid);
		return $orgObj;
	}
        
        //lsists all states
        function listState() {
            global $dbio;
            $state = $dbio->listState();
            return $state;
        }
?>
