<?php

//admin/controller/auth.php

	// initializes dbio and sets authorized to false 
	global $dbio;
	$isAuthorized = false;

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
		//allows authoization of donations based on person id and donation id
		case 'authorizedonation':
			if(!empty($_GET['authorized'])){

			foreach(($_GET['authorized']) as $donationId) {

 			$isAuthorized=$dbio->authorizeDonation($_SESSION['personid'], $donationId);
 			}

 			include 'admin/model/auth.php';
			$page = $dir . '/view/' . (($sub) ? $sub : $dir) . '.php';
		}
			break;
		//allows authorization of work hours by person id 
		case 'authorizework':	

			if(!empty($_GET['authorize'])){

			foreach(($_GET['authorize']) as $workId) {

 			$result=$dbio->authorizeByAdmin($_SESSION['personid'], $workId);
 			$isAuthorized=true;
 			}

 			include 'admin/model/auth.php';
			$page = $dir . '/view/' . (($sub) ? $sub : $dir) . '.php';
			
		}
		$_SESSION['interestVolunteer'] = ($items);

			break;

		default:
			include 'admin/model/auth.php';
			$page = $dir . '/view/' . (($sub) ? $sub : $dir) . '.php';
			break;


	}// end switch

?>
