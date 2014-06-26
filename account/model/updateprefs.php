<?php
	// TITLE: Home Home Controller
	// FILE: account/model/updateprefs.php
	// AUTHOR: 
	//updates a persons preferences
	
	//initailizes person class
	$person = new Person();
	
	//sets preferences
	$person->setPerson_id($_GET['pid']);
	$person->setPrefEmail($_GET['email']);
	$person->setPrefMail($_GET['mail']);
	$person->setPrefPhone($_GET['calls']);
	
	//updates database
	$update = $dbio->updatePrefs($person);

?>
