
<?php

	session_start();
	
	//hello
	//----- SESSION

	require_once 'root/config.php'; // CONFIG
	

	// REQUIRES/INCLUDES
	/*require_once('class/accnt.php');
	require_once('class/donationtype.php');
	require_once('class/organization.php');
	require_once('class/foh.php');
	require_once('class/person.php');
	require_once('class/donatedby.php');
	require_once('class/contact.php');
	include_once ('class/donation.php');
	require_once('class/address.php');
	require_once ('class/link.php');
	require_once ('class/item.php');
	require_once ('class/interest.php');
	include_once ('class/interest_type.php');
	require_once ('class/event.php');
	require_once ('class/event_type.php');
	require_once ('class/committee.php');
	require_once('class/availability.php');
	require_once('class/consent.php');
	require_once('class/volunteerEvents.php');
	require_once('class/schedule.php');
	require_once('class/volunteer_has_schedule.php');
	require_once('class/work.php');
	require_once ('class/volunteerInterest.php');
	require_once ('class/auction_item.php');
	require_once ('model/dbio_des301.php');
	require_once ('class/volunteer.php');
	require_once ('class/volunteer_has_interest.php');
	require_once('class/workHistory.php');
	//require_once('model/databaseio.php');
	//require_once('model/urlio.php');
	//require_once('model/sessionio.php');*/
        
        require_once ('model/dbio_des301_9-13-2014.php');
        
        require_once('class/account_recovery.php');
        require_once('class/account_status.php');
        require_once('class/address.php');
        require_once('class/admin.php');
        require_once('class/ambassador.php');
        require_once('class/auction.php');
        require_once('class/auction_item.php');
        require_once('class/board_member.php');
        require_once('class/city.php');
        require_once('class/committee.php');
        require_once('class/committee_attendance.php');
        require_once('class/contact.php');
        require_once('class/demographic_type.php');
        require_once('class/donation.php');
        require_once('class/donation_type.php');
        require_once('class/email.php');
        require_once('class/event.php');
        require_once('class/event_expenses.php');
        require_once('class/event_sponsor.php');
        require_once('class/event_type.php');
        require_once('class/expense_type.php');
        require_once('class/foh.php');
        require_once('class/guest_list.php');
        require_once('class/habitat_employee.php');
        require_once('class/ho_asset.php');
        require_once('class/ho_debt.php');
        require_once('class/ho_group.php');
        require_once('class/ho_income.php');
        require_once('class/ho_requirement.php');
        require_once('class/ho_status.php');
        require_once('class/home_owner.php');
        require_once('class/interest.php');
        require_once('class/interest_type.php');
        require_once('class/interested_in.php');
        require_once('class/labor.php');
        require_once('class/marital_status.php');
        require_once('class/material.php');
        require_once('class/money.php');
        require_once('class/mortgage.php');
        require_once('class/municipality.php');
        require_once('class/office.php');
        require_once('class/organization.php');
        require_once('class/organization_contact.php');
        require_once('class/organization_donation.php');
        require_once('class/payment.php');
        require_once('class/person.php');
        require_once('class/personal_donation.php');
        require_once('class/photo_id.php');
        require_once('class/project.php');
        require_once('class/project_donation.php');
        require_once('class/project_event.php');
        require_once('class/project_expenses.php');
        require_once('class/project_status.php');
        require_once('class/recovery_log.php');
        require_once('class/requirement.php');
        require_once('class/schedule.php');
        require_once('class/serves_on.php');
        require_once('class/state.php');
        require_once('class/status_change.php');
        require_once('class/tickets.php');
        require_once('class/volunteer.php');
        require_once('class/work.php');
	
	$dbio = new DBIO();
	
	$dir = isset($_GET['dir']) ? $_GET['dir'] : DEFAULT_DIR;
    $sub = isset($_GET['sub']) ? $_GET['sub'] : false;
    $act = isset($_GET['act']) ? $_GET['act'] : false;
    $msg = isset($_GET['msg']) ? $_GET['msg'] : false;
	
	$page = $dir . '/controller/' . (($sub) ? $sub : $dir) . '.php';
	
	// gateway(); // GATEWAY
	
	include $page; // controller call
	
	$scriptFile = $dir . '/script.php';
	$styleFile = $dir . '/style.php';
	if (file_exists($styleFile)) {include $styleFile;}
	if (file_exists($scriptFile)) {include $scriptFile;}
	
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="css/default.css" media="screen">
		<link rel="stylesheet" href="css/nav.css" >
		<link rel="stylesheet" href="css/color.css" >
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css"> 
		<link rel="stylesheet" href="css/defaultprintcss.css" media="print">
		<link rel="alternative stylesheet" href="css/defaultprintingcss-preview.css" media="screen" title="Print Preview">
		<link rel="stylesheet" type="text/css" href="css/print.css" media="print">
		<script src="js/print.js"></script>
	 
		<?php
			// <link rel="stylesheet" href="css/nav.css" >
			if (isset($styles)) {
				foreach ($styles as $style) {
					echo '<link rel="stylesheet" href="css/' . $style . '.css" >';
				}
			}
		?>
		<style></style>
		<?php
			// <script src="js/FILENAME.js"></script>
			if (isset($scripts)) {
				foreach ($scripts as $script) {
					echo '<script src="js/' . $script . '.js" >';
				}
			}
		?>
		<script></script>
	</head>
	<body>
		<div id="page">
			<header>
				<h1><?php echo APP_TITLE; ?></h1>
				
			</header>
			<div id="body">
			<div id="mainnav">
			<div id="mainNav">
                            <?php 
                            if ($dir!='login') {

                                $isAdmin = false;
                                $isOffice = false;
                                $isVolunteer = true;

                                $clearance= $dbio->getAccountType($_SESSION['personid']); //Getting clearance value

                                switch ($clearance) { //Setting clearance for person
                                        case '1':
                                                $isAdmin = true;
                                                $isOffice = true;
                                                break;

                                        case '2':
                                                $isOffice = true;
                                                $isVolunteer= true;
                                                break;

                                        case '3':	
                                                $isVolunteer = true;
                                                break;

                                        default:
                                                var_dump('Invalid clearance');
                                                break;
                                }	
                                    include 'root/nav.php';
                            } 
                            ?>
                        </div>
                        </div>
				<?php //if (file_exists($dir . '/menu.php')) {include 'root/subNav.php';} ?>
				<div id="content">
                                    <!--<a id="printpage" href="#" onclick="print_preview(); return false;">Print this page</a>-->
                                    <?php include $page; // view call ?>
				</div>
			</div>
		</div>
	</body>
</html>
