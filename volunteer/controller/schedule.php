<?php

	// TITLE: Volunteer Schedule Controller
	// FILE: volunteer/controller/schedule.php
	// AUTHOR: AUTOGEN


	switch ($act) {

                //views event schedule
		case 'viewSchedule':
			include 'office/model/event.php';
			include 'volunteer/model/schedule.php';
			$page = $dir . '/view/eventSchedule.php';
			break;
		
                //views volunteer schedule
		case'personSchedule':
			include 'volunteer/model/schedule.php';
                        $guestList = new Guest_list();
                        $guestList->setEvent($_GET['eventId']);
                        $guestList->setPerson($_GET['personId']);
                        $update = createGuestList($guestList);
			$page = $dir . '/view/schedule.php';
			break;

		default:
			include 'volunteer/model/schedule.php';
			$page = $dir . '/view/' . (($sub) ? $sub : $dir) . '.php';
			break;


	}// end switch

?>
