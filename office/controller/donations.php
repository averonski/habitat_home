<?php

	// TITLE: Office Donations Controller
	// FILE: office/controller/donations.php
	// AUTHOR: AUTOGEN


	switch ($act) {

		case 'search':
			// CODE HERE
			break;

		case 'create':
			// CODE HERE
			break;

		case 'read':
			// CODE HERE
			break;

		case 'update':
			// CODE HERE
			break;

		case 'delete':
			// CODE HERE
			break;

		case 'list':
			include_once 'office/model/donations.php';
			$donations = read();
			$page = $dir . '/view/viewDonations.php';
			break;

		default:
			$page = $dir . '/view/' . (($sub) ? $sub : $dir) . '.php';
			break;


	}// end switch

?>
