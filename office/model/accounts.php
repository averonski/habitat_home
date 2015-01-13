<?php

	// TITLE: Office Accounts Model
	// FILE: office/model/accounts.php
	// AUTHOR: AUTOGEN
	
	
        //lsists all accounts
	function read(){
		global $dbio;
		$tableinfo = $dbio->listAccount();
		return $tableinfo;
	}

        //reads accounts based on name or organization name
	function search() {
            global $dbio;
            if($_GET['searchBy'] == 'name'){
                $fname = $_GET['input1'];
                $lname =  $_GET['input2'];
                $tableinfo = $dbio->readAccountByName($fname,$lname);	
                    }
            elseif ($_GET['searchBy'] == 'organization') {
                $org = $_GET['input1'];
                $tableinfo = $dbio->searchAccountorg($org);
            }
            return $tableinfo;
	}
        
        //not used
	function create() {}
        
        //setups page for account edit
	function edit() {
		global $dbio;
		$accountId = $_GET['accid'];
                print($accountId);
		$account = $dbio->readAccount_by_account($accountId);
		return $account;
	}
        
        
        //updates an account
	function update() {
            global $dbio;
            $person = new Person();
            $contact = new Contact();
            $address = new Address();

            //person obj
            $pid = $_GET['pid'];
            $person->setTitle($_GET['title']);
            $person->setFirst_name($_GET['fName']);
            $person->setLast_name($_GET['lName']);
            $person->setDob($_GET['dob']);

            //contact obj
            $contact->setPhone($_GET['phone']);
            $contact->setEmail($_GET['email']);
            $contact->setPhone2($_GET['workPhone']);
            $contact->setExtension($_GET['workExt']);

            //address obj
            $address->setStreet1($_GET['street1']);
            $address->setStreet2($_GET['street2']);
            $address->setCity($_GET['city']);
            $address->setState($_GET['state']);
            $address->setZip($_GET['zip']);

            $updated = $dbio->updateInfo($pid,$person,$contact,$address);
            return $updated;
	}
?>
