<?php

	// TITLE: Office Donations Model
	// FILE: office/model/donations.php
	// AUTHOR: AUTOGEN
	

	function search() {}
        
        //creates a new donation
	function create() {
        global $dbio;
        $eventid = isset($_GET['eventid']) ? $_GET['eventid'] : '';
        $pid = isset($_GET['[pid]']) ? $_GET['pid'] : '';
        $oid = isset($_GET['oid']) ? $_GET['oid'] : '';
        $personid = $_SESSION['personid'];

        $donation = new Donation();
        $donation->setDate($_GET['date']);
        $donation->setTime($_GET['time']);
        $donation->setDetails($_GET['details']);
        $donation->setType($_GET['type']);
        $donation->setValue($_GET['value']);
        $donation->setEvent($eventid);
        $donation->setPerson_person($personid);
     
        $updated = $dbio->createDonation($donation);
        return $updated;
	}
        
        //lists donation and doner
	function read() {
		global $dbio;
		$tableinfo = array();
		$donations = $dbio->listDonation();
		$donors = $dbio->listPersonal_donation();
		$tableinfo[] = $donations;
		$tableinfo[] = $donors;
		return $tableinfo;
	}
        
        //updates a donation
	function update() {
        $donation = new Donation();
        $donation->setDate($_GET['date']);
        $donation->setTime($_GET['time']);
        $donation->setDetails($_GET['details']);
        $donation->setType($_GET['types']);
        $donation->setValue($_GET['value']);
        $donation->setDonation_id($_GET['did']);
        global $dbio;
        $updated = $dbio->updateDonations($donation);
        return $updated;
	}
        
        //edits a donation
	function edit() {
            global $dbio;
            $did = $_GET['did'];
            $donation = $dbio->readDonation($did);
            return $donation;
	}

        //reads event from id
	function getEvent() {
            global $dbio;
            $eventid = $_GET['eventid'];
            $event= $dbio->readEvent($eventid);
            return $event;
	}
	
        //reads person from id
	function getPerson() {
            global $dbio;
            $pid = $_GET['pid'];
            $person = $dbio->readPerson($pid);
            return $person;
	}

        //reads org from id
	function getOrg() {
            global $dbio;
            if(isset($_GET['oid'])) {
                $oid = $_GET['oid'];
                $org = $dbio->getOrgById($oid);
            }
             if(isset($org)) {
                return $org;
            } else {
                return '';
            }
	}
        
        //lists all donation types
        function listDonationTypes() {
            global $dbio;
            $donationTypes = $dbio->listDonation_type();
            return $donationTypes;
        }

?>
