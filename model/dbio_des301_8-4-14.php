Database: homes_db

<?php

	// TITLE: Database Model
	// FILE: model/dbio.php
	// AUTHOR: AUTOGEN


	// account // --------------------

	public function createAccount($account) {
		global $con;
		$fieldsString = csvObject($account);
		$valuesString = csvString($account);
		$sql = 'INSERT INTO ' . $tableTitle . '(' . $fieldsString . ') VALUES (' . $valuesString . ')';
		$this->open();
		$result = mysql_query($sql, $con);
		$id = ($result) ? mysql_insert_id() : $result;
		$this->close();
		return $id;
	}// end function

	public function readAccount($id) {
		global $con;
		$sql = 'SELECT * FROM account WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		if ($result) {
			$account = new Account();
			$account->setId(result[0]);
			$account->setEmail(result[1]);
			$account->setPassword(result[2]);
			$account->setCreated(result[3]);
			$account->setStatus_id(result[4]);
			$account->setPerson_id(result[5]);
		} else {
			$account = false
		}
		return $account;
	}// end function

	public function updateAccount($account) {
		global $con;
		$fieldsString = csvString($fields);
		$sql = 'INSERT INTO account VALUES (' . $valueString . ')  WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		return $result;
	}// end function

	public function deleteAccount($id) {
		global $con;
		$sql = 'DELETE FROM account WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		return $result;
	}// end function

	public function listAccount() {
		global $con;
		$sql = 'SELECT * FROM account';
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		if ($result) {
			$accounts = array();
			while($result = mysql_fetch_array($results)) {
				$account = new Account();
				$account->setId(result[0]);
				$account->setEmail(result[1]);
				$account->setPassword(result[2]);
				$account->setCreated(result[3]);
				$account->setStatus(readStatus(result[4]));
				$account->setPerson(readPerson(result[5]));
				$accounts[] = $account;
			}// end while
		} else {
			$account = false
		}
		return $account;
	}// end function

	// account_recovery // --------------------

	public function createAccount_recovery($account_recovery) {
		global $con;
		$fieldsString = csvObject($account_recovery);
		$valuesString = csvString($account_recovery);
		$sql = 'INSERT INTO ' . $tableTitle . '(' . $fieldsString . ') VALUES (' . $valuesString . ')';
		$this->open();
		$result = mysql_query($sql, $con);
		$id = ($result) ? mysql_insert_id() : $result;
		$this->close();
		return $id;
	}// end function

	public function readAccount_recovery($id) {
		global $con;
		$sql = 'SELECT * FROM account_recovery WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		if ($result) {
			$account_recovery = new Account_recovery();
			$account_recovery->setAccount_id(result[0]);
			$account_recovery->setCode(result[1]);
			$account_recovery->setDate(result[2]);
			$account_recovery->setTime(result[3]);
		} else {
			$account_recovery = false
		}
		return $account_recovery;
	}// end function

	public function updateAccount_recovery($account_recovery) {
		global $con;
		$fieldsString = csvString($fields);
		$sql = 'INSERT INTO account_recovery VALUES (' . $valueString . ')  WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		return $result;
	}// end function

	public function deleteAccount_recovery($id) {
		global $con;
		$sql = 'DELETE FROM account_recovery WHERE account_id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		return $result;
	}// end function

	public function listAccount_recovery() {
		global $con;
		$sql = 'SELECT * FROM account_recovery';
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		if ($result) {
			$account_recoverys = array();
			while($result = mysql_fetch_array($results)) {
				$account_recovery = new Account_recovery();
				$account_recovery->setAccount(readAccount(result[0]));
				$account_recovery->setCode(result[1]);
				$account_recovery->setDate(result[2]);
				$account_recovery->setTime(result[3]);
				$account_recoverys[] = $account_recovery;
			}// end while
		} else {
			$account_recovery = false
		}
		return $account_recovery;
	}// end function

	// account_status // --------------------

	public function createAccount_status($account_status) {
		global $con;
		$fieldsString = csvObject($account_status);
		$valuesString = csvString($account_status);
		$sql = 'INSERT INTO ' . $tableTitle . '(' . $fieldsString . ') VALUES (' . $valuesString . ')';
		$this->open();
		$result = mysql_query($sql, $con);
		$id = ($result) ? mysql_insert_id() : $result;
		$this->close();
		return $id;
	}// end function

	public function readAccount_status($id) {
		global $con;
		$sql = 'SELECT * FROM account_status WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		if ($result) {
			$account_status = new Account_status();
			$account_status->setId(result[0]);
			$account_status->setTitle(result[1]);
			$account_status->setDescription(result[2]);
		} else {
			$account_status = false
		}
		return $account_status;
	}// end function

	public function updateAccount_status($account_status) {
		global $con;
		$fieldsString = csvString($fields);
		$sql = 'INSERT INTO account_status VALUES (' . $valueString . ')  WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		return $result;
	}// end function

	public function deleteAccount_status($id) {
		global $con;
		$sql = 'DELETE FROM account_status WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		return $result;
	}// end function

	public function listAccount_status() {
		global $con;
		$sql = 'SELECT * FROM account_status';
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		if ($result) {
			$account_statuss = array();
			while($result = mysql_fetch_array($results)) {
				$account_status = new Account_status();
				$account_status->setId(result[0]);
				$account_status->setTitle(result[1]);
				$account_status->setDescription(result[2]);
				$account_statuss[] = $account_status;
			}// end while
		} else {
			$account_status = false
		}
		return $account_status;
	}// end function

	// address // --------------------

	public function createAddress($address) {
		global $con;
		$fieldsString = csvObject($address);
		$valuesString = csvString($address);
		$sql = 'INSERT INTO ' . $tableTitle . '(' . $fieldsString . ') VALUES (' . $valuesString . ')';
		$this->open();
		$result = mysql_query($sql, $con);
		$id = ($result) ? mysql_insert_id() : $result;
		$this->close();
		return $id;
	}// end function

	public function readAddress($id) {
		global $con;
		$sql = 'SELECT * FROM address WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		if ($result) {
			$address = new Address();
			$address->setId(result[0]);
			$address->setStreet1(result[1]);
			$address->setStreet2(result[2]);
			$address->setCity(result[3]);
			$address->setState_id(result[4]);
			$address->setZip(result[5]);
		} else {
			$address = false
		}
		return $address;
	}// end function

	public function updateAddress($address) {
		global $con;
		$fieldsString = csvString($fields);
		$sql = 'INSERT INTO address VALUES (' . $valueString . ')  WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		return $result;
	}// end function

	public function deleteAddress($id) {
		global $con;
		$sql = 'DELETE FROM address WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		return $result;
	}// end function

	public function listAddress() {
		global $con;
		$sql = 'SELECT * FROM address';
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		if ($result) {
			$addresss = array();
			while($result = mysql_fetch_array($results)) {
				$address = new Address();
				$address->setId(result[0]);
				$address->setStreet1(result[1]);
				$address->setStreet2(result[2]);
				$address->setCity(result[3]);
				$address->setState(readState(result[4]));
				$address->setZip(result[5]);
				$addresss[] = $address;
			}// end while
		} else {
			$address = false
		}
		return $address;
	}// end function

	// admin // --------------------

	public function createAdmin($admin) {
		global $con;
		$fieldsString = csvObject($admin);
		$valuesString = csvString($admin);
		$sql = 'INSERT INTO ' . $tableTitle . '(' . $fieldsString . ') VALUES (' . $valuesString . ')';
		$this->open();
		$result = mysql_query($sql, $con);
		$id = ($result) ? mysql_insert_id() : $result;
		$this->close();
		return $id;
	}// end function

	public function readAdmin($id) {
		global $con;
		$sql = 'SELECT * FROM admin WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		if ($result) {
			$admin = new Admin();
			$admin->setId(result[0]);
			$admin->setPerson_id(result[1]);
		} else {
			$admin = false
		}
		return $admin;
	}// end function

	public function updateAdmin($admin) {
		global $con;
		$fieldsString = csvString($fields);
		$sql = 'INSERT INTO admin VALUES (' . $valueString . ')  WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		return $result;
	}// end function

	public function deleteAdmin($id) {
		global $con;
		$sql = 'DELETE FROM admin WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		return $result;
	}// end function

	public function listAdmin() {
		global $con;
		$sql = 'SELECT * FROM admin';
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		if ($result) {
			$admins = array();
			while($result = mysql_fetch_array($results)) {
				$admin = new Admin();
				$admin->setId(result[0]);
				$admin->setPerson(readPerson(result[1]));
				$admins[] = $admin;
			}// end while
		} else {
			$admin = false
		}
		return $admin;
	}// end function

	// ambassador // --------------------

	public function createAmbassador($ambassador) {
		global $con;
		$fieldsString = csvObject($ambassador);
		$valuesString = csvString($ambassador);
		$sql = 'INSERT INTO ' . $tableTitle . '(' . $fieldsString . ') VALUES (' . $valuesString . ')';
		$this->open();
		$result = mysql_query($sql, $con);
		$id = ($result) ? mysql_insert_id() : $result;
		$this->close();
		return $id;
	}// end function

	public function readAmbassador($id) {
		global $con;
		$sql = 'SELECT * FROM ambassador WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		if ($result) {
			$ambassador = new Ambassador();
			$ambassador->setVolunteer_id(result[0]);
			$ambassador->setOrganization_id(result[1]);
			$ambassador->setChurch_ambassador(result[2]);
			$ambassador->setAffiliation(result[3]);
		} else {
			$ambassador = false
		}
		return $ambassador;
	}// end function

	public function updateAmbassador($ambassador) {
		global $con;
		$fieldsString = csvString($fields);
		$sql = 'INSERT INTO ambassador VALUES (' . $valueString . ')  WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		return $result;
	}// end function

	public function deleteAmbassador($id) {
		global $con;
		$sql = 'DELETE FROM ambassador WHERE volunteer_id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		return $result;
	}// end function

	public function listAmbassador() {
		global $con;
		$sql = 'SELECT * FROM ambassador';
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		if ($result) {
			$ambassadors = array();
			while($result = mysql_fetch_array($results)) {
				$ambassador = new Ambassador();
				$ambassador->setVolunteer(readVolunteer(result[0]));
				$ambassador->setOrganization(readOrganization(result[1]));
				$ambassador->setChurch_ambassador(result[2]);
				$ambassador->setAffiliation(result[3]);
				$ambassadors[] = $ambassador;
			}// end while
		} else {
			$ambassador = false
		}
		return $ambassador;
	}// end function

	// auction // --------------------

	public function createAuction($auction) {
		global $con;
		$fieldsString = csvObject($auction);
		$valuesString = csvString($auction);
		$sql = 'INSERT INTO ' . $tableTitle . '(' . $fieldsString . ') VALUES (' . $valuesString . ')';
		$this->open();
		$result = mysql_query($sql, $con);
		$id = ($result) ? mysql_insert_id() : $result;
		$this->close();
		return $id;
	}// end function

	public function readAuction($id) {
		global $con;
		$sql = 'SELECT * FROM auction WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		if ($result) {
			$auction = new Auction();
			$auction->setId(result[0]);
			$auction->setEvent_id(result[1]);
		} else {
			$auction = false
		}
		return $auction;
	}// end function

	public function updateAuction($auction) {
		global $con;
		$fieldsString = csvString($fields);
		$sql = 'INSERT INTO auction VALUES (' . $valueString . ')  WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		return $result;
	}// end function

	public function deleteAuction($id) {
		global $con;
		$sql = 'DELETE FROM auction WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		return $result;
	}// end function

	public function listAuction() {
		global $con;
		$sql = 'SELECT * FROM auction';
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		if ($result) {
			$auctions = array();
			while($result = mysql_fetch_array($results)) {
				$auction = new Auction();
				$auction->setId(result[0]);
				$auction->setEvent(readEvent(result[1]));
				$auctions[] = $auction;
			}// end while
		} else {
			$auction = false
		}
		return $auction;
	}// end function

	// auction_item // --------------------

	public function createAuction_item($auction_item) {
		global $con;
		$fieldsString = csvObject($auction_item);
		$valuesString = csvString($auction_item);
		$sql = 'INSERT INTO ' . $tableTitle . '(' . $fieldsString . ') VALUES (' . $valuesString . ')';
		$this->open();
		$result = mysql_query($sql, $con);
		$id = ($result) ? mysql_insert_id() : $result;
		$this->close();
		return $id;
	}// end function

	public function readAuction_item($id) {
		global $con;
		$sql = 'SELECT * FROM auction_item WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		if ($result) {
			$auction_item = new Auction_item();
			$auction_item->setId(result[0]);
			$auction_item->setAuction_id(result[1]);
			$auction_item->setItem_num(result[2]);
			$auction_item->setTitle(result[3]);
			$auction_item->setDescription(result[4]);
			$auction_item->setValue(result[5]);
			$auction_item->setPrice(result[6]);
			$auction_item->setPerson_id(result[7]);
			$auction_item->setDonation_id(result[8]);
		} else {
			$auction_item = false
		}
		return $auction_item;
	}// end function

	public function updateAuction_item($auction_item) {
		global $con;
		$fieldsString = csvString($fields);
		$sql = 'INSERT INTO auction_item VALUES (' . $valueString . ')  WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		return $result;
	}// end function

	public function deleteAuction_item($id) {
		global $con;
		$sql = 'DELETE FROM auction_item WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		return $result;
	}// end function

	public function listAuction_item() {
		global $con;
		$sql = 'SELECT * FROM auction_item';
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		if ($result) {
			$auction_items = array();
			while($result = mysql_fetch_array($results)) {
				$auction_item = new Auction_item();
				$auction_item->setId(result[0]);
				$auction_item->setAuction(readAuction(result[1]));
				$auction_item->setItem_num(result[2]);
				$auction_item->setTitle(result[3]);
				$auction_item->setDescription(result[4]);
				$auction_item->setValue(result[5]);
				$auction_item->setPrice(result[6]);
				$auction_item->setPerson(readPerson(result[7]));
				$auction_item->setDonation(readDonation(result[8]));
				$auction_items[] = $auction_item;
			}// end while
		} else {
			$auction_item = false
		}
		return $auction_item;
	}// end function

	// board_member // --------------------

	public function createBoard_member($board_member) {
		global $con;
		$fieldsString = csvObject($board_member);
		$valuesString = csvString($board_member);
		$sql = 'INSERT INTO ' . $tableTitle . '(' . $fieldsString . ') VALUES (' . $valuesString . ')';
		$this->open();
		$result = mysql_query($sql, $con);
		$id = ($result) ? mysql_insert_id() : $result;
		$this->close();
		return $id;
	}// end function

	public function readBoard_member($id) {
		global $con;
		$sql = 'SELECT * FROM board_member WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		if ($result) {
			$board_member = new Board_member();
			$board_member->setVolunteer_id(result[0]);
			$board_member->setIs_board_member(result[1]);
		} else {
			$board_member = false
		}
		return $board_member;
	}// end function

	public function updateBoard_member($board_member) {
		global $con;
		$fieldsString = csvString($fields);
		$sql = 'INSERT INTO board_member VALUES (' . $valueString . ')  WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		return $result;
	}// end function

	public function deleteBoard_member($id) {
		global $con;
		$sql = 'DELETE FROM board_member WHERE volunteer_id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		return $result;
	}// end function

	public function listBoard_member() {
		global $con;
		$sql = 'SELECT * FROM board_member';
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		if ($result) {
			$board_members = array();
			while($result = mysql_fetch_array($results)) {
				$board_member = new Board_member();
				$board_member->setVolunteer(readVolunteer(result[0]));
				$board_member->setIs_board_member(result[1]);
				$board_members[] = $board_member;
			}// end while
		} else {
			$board_member = false
		}
		return $board_member;
	}// end function

	// city // --------------------

	public function createCity($city) {
		global $con;
		$fieldsString = csvObject($city);
		$valuesString = csvString($city);
		$sql = 'INSERT INTO ' . $tableTitle . '(' . $fieldsString . ') VALUES (' . $valuesString . ')';
		$this->open();
		$result = mysql_query($sql, $con);
		$id = ($result) ? mysql_insert_id() : $result;
		$this->close();
		return $id;
	}// end function

	public function readCity($id) {
		global $con;
		$sql = 'SELECT * FROM city WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		if ($result) {
			$city = new City();
			$city->setId(result[0]);
			$city->setTitle(result[1]);
			$city->setState_id(result[2]);
		} else {
			$city = false
		}
		return $city;
	}// end function

	public function updateCity($city) {
		global $con;
		$fieldsString = csvString($fields);
		$sql = 'INSERT INTO city VALUES (' . $valueString . ')  WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		return $result;
	}// end function

	public function deleteCity($id) {
		global $con;
		$sql = 'DELETE FROM city WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		return $result;
	}// end function

	public function listCity() {
		global $con;
		$sql = 'SELECT * FROM city';
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		if ($result) {
			$citys = array();
			while($result = mysql_fetch_array($results)) {
				$city = new City();
				$city->setId(result[0]);
				$city->setTitle(result[1]);
				$city->setState(readState(result[2]));
				$citys[] = $city;
			}// end while
		} else {
			$city = false
		}
		return $city;
	}// end function

	// committee // --------------------

	public function createCommittee($committee) {
		global $con;
		$fieldsString = csvObject($committee);
		$valuesString = csvString($committee);
		$sql = 'INSERT INTO ' . $tableTitle . '(' . $fieldsString . ') VALUES (' . $valuesString . ')';
		$this->open();
		$result = mysql_query($sql, $con);
		$id = ($result) ? mysql_insert_id() : $result;
		$this->close();
		return $id;
	}// end function

	public function readCommittee($id) {
		global $con;
		$sql = 'SELECT * FROM committee WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		if ($result) {
			$committee = new Committee();
			$committee->setId(result[0]);
			$committee->setTitle(result[1]);
		} else {
			$committee = false
		}
		return $committee;
	}// end function

	public function updateCommittee($committee) {
		global $con;
		$fieldsString = csvString($fields);
		$sql = 'INSERT INTO committee VALUES (' . $valueString . ')  WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		return $result;
	}// end function

	public function deleteCommittee($id) {
		global $con;
		$sql = 'DELETE FROM committee WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		return $result;
	}// end function

	public function listCommittee() {
		global $con;
		$sql = 'SELECT * FROM committee';
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		if ($result) {
			$committees = array();
			while($result = mysql_fetch_array($results)) {
				$committee = new Committee();
				$committee->setId(result[0]);
				$committee->setTitle(result[1]);
				$committees[] = $committee;
			}// end while
		} else {
			$committee = false
		}
		return $committee;
	}// end function

	// committee_attendance // --------------------

	public function createCommittee_attendance($committee_attendance) {
		global $con;
		$fieldsString = csvObject($committee_attendance);
		$valuesString = csvString($committee_attendance);
		$sql = 'INSERT INTO ' . $tableTitle . '(' . $fieldsString . ') VALUES (' . $valuesString . ')';
		$this->open();
		$result = mysql_query($sql, $con);
		$id = ($result) ? mysql_insert_id() : $result;
		$this->close();
		return $id;
	}// end function

	public function readCommittee_attendance($id) {
		global $con;
		$sql = 'SELECT * FROM committee_attendance WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		if ($result) {
			$committee_attendance = new Committee_attendance();
			$committee_attendance->setAttendance_id(result[0]);
			$committee_attendance->setCommittee_id(result[1]);
			$committee_attendance->setVolunteer_id(result[2]);
			$committee_attendance->setStatus(result[3]);
		} else {
			$committee_attendance = false
		}
		return $committee_attendance;
	}// end function

	public function updateCommittee_attendance($committee_attendance) {
		global $con;
		$fieldsString = csvString($fields);
		$sql = 'INSERT INTO committee_attendance VALUES (' . $valueString . ')  WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		return $result;
	}// end function

	public function deleteCommittee_attendance($id) {
		global $con;
		$sql = 'DELETE FROM committee_attendance WHERE attendance_id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		return $result;
	}// end function

	public function listCommittee_attendance() {
		global $con;
		$sql = 'SELECT * FROM committee_attendance';
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		if ($result) {
			$committee_attendances = array();
			while($result = mysql_fetch_array($results)) {
				$committee_attendance = new Committee_attendance();
				$committee_attendance->setAttendance(readAttendance(result[0]));
				$committee_attendance->setCommittee(readCommittee(result[1]));
				$committee_attendance->setVolunteer(readVolunteer(result[2]));
				$committee_attendance->setStatus(result[3]);
				$committee_attendances[] = $committee_attendance;
			}// end while
		} else {
			$committee_attendance = false
		}
		return $committee_attendance;
	}// end function

	// contact // --------------------

	public function createContact($contact) {
		global $con;
		$fieldsString = csvObject($contact);
		$valuesString = csvString($contact);
		$sql = 'INSERT INTO ' . $tableTitle . '(' . $fieldsString . ') VALUES (' . $valuesString . ')';
		$this->open();
		$result = mysql_query($sql, $con);
		$id = ($result) ? mysql_insert_id() : $result;
		$this->close();
		return $id;
	}// end function

	public function readContact($id) {
		global $con;
		$sql = 'SELECT * FROM contact WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		if ($result) {
			$contact = new Contact();
			$contact->setId(result[0]);
			$contact->setAddress_id(result[1]);
			$contact->setPhone(result[2]);
			$contact->setPhone2(result[3]);
			$contact->setEmail(result[4]);
		} else {
			$contact = false
		}
		return $contact;
	}// end function

	public function updateContact($contact) {
		global $con;
		$fieldsString = csvString($fields);
		$sql = 'INSERT INTO contact VALUES (' . $valueString . ')  WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		return $result;
	}// end function

	public function deleteContact($id) {
		global $con;
		$sql = 'DELETE FROM contact WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		return $result;
	}// end function

	public function listContact() {
		global $con;
		$sql = 'SELECT * FROM contact';
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		if ($result) {
			$contacts = array();
			while($result = mysql_fetch_array($results)) {
				$contact = new Contact();
				$contact->setId(result[0]);
				$contact->setAddress(readAddress(result[1]));
				$contact->setPhone(result[2]);
				$contact->setPhone2(result[3]);
				$contact->setEmail(result[4]);
				$contacts[] = $contact;
			}// end while
		} else {
			$contact = false
		}
		return $contact;
	}// end function

	// demographic_type // --------------------

	public function createDemographic_type($demographic_type) {
		global $con;
		$fieldsString = csvObject($demographic_type);
		$valuesString = csvString($demographic_type);
		$sql = 'INSERT INTO ' . $tableTitle . '(' . $fieldsString . ') VALUES (' . $valuesString . ')';
		$this->open();
		$result = mysql_query($sql, $con);
		$id = ($result) ? mysql_insert_id() : $result;
		$this->close();
		return $id;
	}// end function

	public function readDemographic_type($id) {
		global $con;
		$sql = 'SELECT * FROM demographic_type WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		if ($result) {
			$demographic_type = new Demographic_type();
			$demographic_type->setId(result[0]);
			$demographic_type->setTitle(result[1]);
			$demographic_type->setDescription(result[2]);
		} else {
			$demographic_type = false
		}
		return $demographic_type;
	}// end function

	public function updateDemographic_type($demographic_type) {
		global $con;
		$fieldsString = csvString($fields);
		$sql = 'INSERT INTO demographic_type VALUES (' . $valueString . ')  WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		return $result;
	}// end function

	public function deleteDemographic_type($id) {
		global $con;
		$sql = 'DELETE FROM demographic_type WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		return $result;
	}// end function

	public function listDemographic_type() {
		global $con;
		$sql = 'SELECT * FROM demographic_type';
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		if ($result) {
			$demographic_types = array();
			while($result = mysql_fetch_array($results)) {
				$demographic_type = new Demographic_type();
				$demographic_type->setId(result[0]);
				$demographic_type->setTitle(result[1]);
				$demographic_type->setDescription(result[2]);
				$demographic_types[] = $demographic_type;
			}// end while
		} else {
			$demographic_type = false
		}
		return $demographic_type;
	}// end function

	// donation // --------------------

	public function createDonation($donation) {
		global $con;
		$fieldsString = csvObject($donation);
		$valuesString = csvString($donation);
		$sql = 'INSERT INTO ' . $tableTitle . '(' . $fieldsString . ') VALUES (' . $valuesString . ')';
		$this->open();
		$result = mysql_query($sql, $con);
		$id = ($result) ? mysql_insert_id() : $result;
		$this->close();
		return $id;
	}// end function

	public function readDonation($id) {
		global $con;
		$sql = 'SELECT * FROM donation WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		if ($result) {
			$donation = new Donation();
			$donation->setId(result[0]);
			$donation->setDate(result[1]);
			$donation->setTime(result[2]);
			$donation->setDetails(result[3]);
			$donation->setWhen_entered(result[4]);
			$donation->setDonor_id(result[5]);
			$donation->setOffice_id(result[6]);
			$donation->setDonation_type_id(result[7]);
			$donation->setPledge(result[8]);
			$donation->setAdmin_id(result[9]);
		} else {
			$donation = false
		}
		return $donation;
	}// end function

	public function updateDonation($donation) {
		global $con;
		$fieldsString = csvString($fields);
		$sql = 'INSERT INTO donation VALUES (' . $valueString . ')  WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		return $result;
	}// end function

	public function deleteDonation($id) {
		global $con;
		$sql = 'DELETE FROM donation WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		return $result;
	}// end function

	public function listDonation() {
		global $con;
		$sql = 'SELECT * FROM donation';
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		if ($result) {
			$donations = array();
			while($result = mysql_fetch_array($results)) {
				$donation = new Donation();
				$donation->setId(result[0]);
				$donation->setDate(result[1]);
				$donation->setTime(result[2]);
				$donation->setDetails(result[3]);
				$donation->setWhen_entered(result[4]);
				$donation->setDonor(readDonor(result[5]));
				$donation->setOffice(readOffice(result[6]));
				$donation->setDonation_type(readDonation_type(result[7]));
				$donation->setPledge(result[8]);
				$donation->setAdmin(readAdmin(result[9]));
				$donations[] = $donation;
			}// end while
		} else {
			$donation = false
		}
		return $donation;
	}// end function

	// donation_type // --------------------

	public function createDonation_type($donation_type) {
		global $con;
		$fieldsString = csvObject($donation_type);
		$valuesString = csvString($donation_type);
		$sql = 'INSERT INTO ' . $tableTitle . '(' . $fieldsString . ') VALUES (' . $valuesString . ')';
		$this->open();
		$result = mysql_query($sql, $con);
		$id = ($result) ? mysql_insert_id() : $result;
		$this->close();
		return $id;
	}// end function

	public function readDonation_type($id) {
		global $con;
		$sql = 'SELECT * FROM donation_type WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		if ($result) {
			$donation_type = new Donation_type();
			$donation_type->setId(result[0]);
			$donation_type->setTitle(result[1]);
			$donation_type->setDescription(result[2]);
		} else {
			$donation_type = false
		}
		return $donation_type;
	}// end function

	public function updateDonation_type($donation_type) {
		global $con;
		$fieldsString = csvString($fields);
		$sql = 'INSERT INTO donation_type VALUES (' . $valueString . ')  WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		return $result;
	}// end function

	public function deleteDonation_type($id) {
		global $con;
		$sql = 'DELETE FROM donation_type WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		return $result;
	}// end function

	public function listDonation_type() {
		global $con;
		$sql = 'SELECT * FROM donation_type';
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		if ($result) {
			$donation_types = array();
			while($result = mysql_fetch_array($results)) {
				$donation_type = new Donation_type();
				$donation_type->setId(result[0]);
				$donation_type->setTitle(result[1]);
				$donation_type->setDescription(result[2]);
				$donation_types[] = $donation_type;
			}// end while
		} else {
			$donation_type = false
		}
		return $donation_type;
	}// end function

	// email // --------------------

	public function createEmail($email) {
		global $con;
		$fieldsString = csvObject($email);
		$valuesString = csvString($email);
		$sql = 'INSERT INTO ' . $tableTitle . '(' . $fieldsString . ') VALUES (' . $valuesString . ')';
		$this->open();
		$result = mysql_query($sql, $con);
		$id = ($result) ? mysql_insert_id() : $result;
		$this->close();
		return $id;
	}// end function

	public function readEmail($id) {
		global $con;
		$sql = 'SELECT * FROM email WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		if ($result) {
			$email = new Email();
			$email->setId(result[0]);
			$email->setEmail(result[1]);
			$email->setPerson_id(result[2]);
		} else {
			$email = false
		}
		return $email;
	}// end function

	public function updateEmail($email) {
		global $con;
		$fieldsString = csvString($fields);
		$sql = 'INSERT INTO email VALUES (' . $valueString . ')  WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		return $result;
	}// end function

	public function deleteEmail($id) {
		global $con;
		$sql = 'DELETE FROM email WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		return $result;
	}// end function

	public function listEmail() {
		global $con;
		$sql = 'SELECT * FROM email';
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		if ($result) {
			$emails = array();
			while($result = mysql_fetch_array($results)) {
				$email = new Email();
				$email->setId(result[0]);
				$email->setEmail(result[1]);
				$email->setPerson(readPerson(result[2]));
				$emails[] = $email;
			}// end while
		} else {
			$email = false
		}
		return $email;
	}// end function

	// event // --------------------

	public function createEvent($event) {
		global $con;
		$fieldsString = csvObject($event);
		$valuesString = csvString($event);
		$sql = 'INSERT INTO ' . $tableTitle . '(' . $fieldsString . ') VALUES (' . $valuesString . ')';
		$this->open();
		$result = mysql_query($sql, $con);
		$id = ($result) ? mysql_insert_id() : $result;
		$this->close();
		return $id;
	}// end function

	public function readEvent($id) {
		global $con;
		$sql = 'SELECT * FROM event WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		if ($result) {
			$event = new Event();
			$event->setId(result[0]);
			$event->setTitle(result[1]);
			$event->setDate(result[2]);
			$event->setStart_time(result[3]);
			$event->setEnd_time(result[4]);
			$event->setAddress_id(result[5]);
			$event->setType_id(result[6]);
			$event->setMax_num_guests(result[7]);
			$event->setCommittee_id(result[8]);
			$event->setSponsored_id(result[9]);
		} else {
			$event = false
		}
		return $event;
	}// end function

	public function updateEvent($event) {
		global $con;
		$fieldsString = csvString($fields);
		$sql = 'INSERT INTO event VALUES (' . $valueString . ')  WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		return $result;
	}// end function

	public function deleteEvent($id) {
		global $con;
		$sql = 'DELETE FROM event WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		return $result;
	}// end function

	public function listEvent() {
		global $con;
		$sql = 'SELECT * FROM event';
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		if ($result) {
			$events = array();
			while($result = mysql_fetch_array($results)) {
				$event = new Event();
				$event->setId(result[0]);
				$event->setTitle(result[1]);
				$event->setDate(result[2]);
				$event->setStart_time(result[3]);
				$event->setEnd_time(result[4]);
				$event->setAddress(readAddress(result[5]));
				$event->setType(readType(result[6]));
				$event->setMax_num_guests(result[7]);
				$event->setCommittee(readCommittee(result[8]));
				$event->setSponsored(readSponsored(result[9]));
				$events[] = $event;
			}// end while
		} else {
			$event = false
		}
		return $event;
	}// end function

	// event_expenses // --------------------

	public function createEvent_expenses($event_expenses) {
		global $con;
		$fieldsString = csvObject($event_expenses);
		$valuesString = csvString($event_expenses);
		$sql = 'INSERT INTO ' . $tableTitle . '(' . $fieldsString . ') VALUES (' . $valuesString . ')';
		$this->open();
		$result = mysql_query($sql, $con);
		$id = ($result) ? mysql_insert_id() : $result;
		$this->close();
		return $id;
	}// end function

	public function readEvent_expenses($id) {
		global $con;
		$sql = 'SELECT * FROM event_expenses WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		if ($result) {
			$event_expenses = new Event_expenses();
			$event_expenses->setId(result[0]);
			$event_expenses->setEvent_id(result[1]);
			$event_expenses->setTitle(result[2]);
			$event_expenses->setDescription(result[3]);
			$event_expenses->setAmount(result[4]);
			$event_expenses->setWhen_entered(result[5]);
			$event_expenses->setOffice_id(result[6]);
			$event_expenses->setWhen_authorized(result[7]);
			$event_expenses->setAdmin_id(result[8]);
		} else {
			$event_expenses = false
		}
		return $event_expenses;
	}// end function

	public function updateEvent_expenses($event_expenses) {
		global $con;
		$fieldsString = csvString($fields);
		$sql = 'INSERT INTO event_expenses VALUES (' . $valueString . ')  WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		return $result;
	}// end function

	public function deleteEvent_expenses($id) {
		global $con;
		$sql = 'DELETE FROM event_expenses WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		return $result;
	}// end function

	public function listEvent_expenses() {
		global $con;
		$sql = 'SELECT * FROM event_expenses';
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		if ($result) {
			$event_expensess = array();
			while($result = mysql_fetch_array($results)) {
				$event_expenses = new Event_expenses();
				$event_expenses->setId(result[0]);
				$event_expenses->setEvent(readEvent(result[1]));
				$event_expenses->setTitle(result[2]);
				$event_expenses->setDescription(result[3]);
				$event_expenses->setAmount(result[4]);
				$event_expenses->setWhen_entered(result[5]);
				$event_expenses->setOffice(readOffice(result[6]));
				$event_expenses->setWhen_authorized(result[7]);
				$event_expenses->setAdmin(readAdmin(result[8]));
				$event_expensess[] = $event_expenses;
			}// end while
		} else {
			$event_expenses = false
		}
		return $event_expenses;
	}// end function

	// event_sponsor // --------------------

	public function createEvent_sponsor($event_sponsor) {
		global $con;
		$fieldsString = csvObject($event_sponsor);
		$valuesString = csvString($event_sponsor);
		$sql = 'INSERT INTO ' . $tableTitle . '(' . $fieldsString . ') VALUES (' . $valuesString . ')';
		$this->open();
		$result = mysql_query($sql, $con);
		$id = ($result) ? mysql_insert_id() : $result;
		$this->close();
		return $id;
	}// end function

	public function readEvent_sponsor($id) {
		global $con;
		$sql = 'SELECT * FROM event_sponsor WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		if ($result) {
			$event_sponsor = new Event_sponsor();
			$event_sponsor->setId(result[0]);
			$event_sponsor->setEvent_id(result[1]);
			$event_sponsor->setPerson_id(result[2]);
			$event_sponsor->setOrganization_id(result[3]);
		} else {
			$event_sponsor = false
		}
		return $event_sponsor;
	}// end function

	public function updateEvent_sponsor($event_sponsor) {
		global $con;
		$fieldsString = csvString($fields);
		$sql = 'INSERT INTO event_sponsor VALUES (' . $valueString . ')  WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		return $result;
	}// end function

	public function deleteEvent_sponsor($id) {
		global $con;
		$sql = 'DELETE FROM event_sponsor WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		return $result;
	}// end function

	public function listEvent_sponsor() {
		global $con;
		$sql = 'SELECT * FROM event_sponsor';
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		if ($result) {
			$event_sponsors = array();
			while($result = mysql_fetch_array($results)) {
				$event_sponsor = new Event_sponsor();
				$event_sponsor->setId(result[0]);
				$event_sponsor->setEvent(readEvent(result[1]));
				$event_sponsor->setPerson(readPerson(result[2]));
				$event_sponsor->setOrganization(readOrganization(result[3]));
				$event_sponsors[] = $event_sponsor;
			}// end while
		} else {
			$event_sponsor = false
		}
		return $event_sponsor;
	}// end function

	// event_type // --------------------

	public function createEvent_type($event_type) {
		global $con;
		$fieldsString = csvObject($event_type);
		$valuesString = csvString($event_type);
		$sql = 'INSERT INTO ' . $tableTitle . '(' . $fieldsString . ') VALUES (' . $valuesString . ')';
		$this->open();
		$result = mysql_query($sql, $con);
		$id = ($result) ? mysql_insert_id() : $result;
		$this->close();
		return $id;
	}// end function

	public function readEvent_type($id) {
		global $con;
		$sql = 'SELECT * FROM event_type WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		if ($result) {
			$event_type = new Event_type();
			$event_type->setId(result[0]);
			$event_type->setTitle(result[1]);
			$event_type->setDescription(result[2]);
		} else {
			$event_type = false
		}
		return $event_type;
	}// end function

	public function updateEvent_type($event_type) {
		global $con;
		$fieldsString = csvString($fields);
		$sql = 'INSERT INTO event_type VALUES (' . $valueString . ')  WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		return $result;
	}// end function

	public function deleteEvent_type($id) {
		global $con;
		$sql = 'DELETE FROM event_type WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		return $result;
	}// end function

	public function listEvent_type() {
		global $con;
		$sql = 'SELECT * FROM event_type';
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		if ($result) {
			$event_types = array();
			while($result = mysql_fetch_array($results)) {
				$event_type = new Event_type();
				$event_type->setId(result[0]);
				$event_type->setTitle(result[1]);
				$event_type->setDescription(result[2]);
				$event_types[] = $event_type;
			}// end while
		} else {
			$event_type = false
		}
		return $event_type;
	}// end function

	// expense_type // --------------------

	public function createExpense_type($expense_type) {
		global $con;
		$fieldsString = csvObject($expense_type);
		$valuesString = csvString($expense_type);
		$sql = 'INSERT INTO ' . $tableTitle . '(' . $fieldsString . ') VALUES (' . $valuesString . ')';
		$this->open();
		$result = mysql_query($sql, $con);
		$id = ($result) ? mysql_insert_id() : $result;
		$this->close();
		return $id;
	}// end function

	public function readExpense_type($id) {
		global $con;
		$sql = 'SELECT * FROM expense_type WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		if ($result) {
			$expense_type = new Expense_type();
			$expense_type->setId(result[0]);
			$expense_type->setTitle(result[1]);
			$expense_type->setDescription(result[2]);
		} else {
			$expense_type = false
		}
		return $expense_type;
	}// end function

	public function updateExpense_type($expense_type) {
		global $con;
		$fieldsString = csvString($fields);
		$sql = 'INSERT INTO expense_type VALUES (' . $valueString . ')  WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		return $result;
	}// end function

	public function deleteExpense_type($id) {
		global $con;
		$sql = 'DELETE FROM expense_type WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		return $result;
	}// end function

	public function listExpense_type() {
		global $con;
		$sql = 'SELECT * FROM expense_type';
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		if ($result) {
			$expense_types = array();
			while($result = mysql_fetch_array($results)) {
				$expense_type = new Expense_type();
				$expense_type->setId(result[0]);
				$expense_type->setTitle(result[1]);
				$expense_type->setDescription(result[2]);
				$expense_types[] = $expense_type;
			}// end while
		} else {
			$expense_type = false
		}
		return $expense_type;
	}// end function

	// foh // --------------------

	public function createFoh($foh) {
		global $con;
		$fieldsString = csvObject($foh);
		$valuesString = csvString($foh);
		$sql = 'INSERT INTO ' . $tableTitle . '(' . $fieldsString . ') VALUES (' . $valuesString . ')';
		$this->open();
		$result = mysql_query($sql, $con);
		$id = ($result) ? mysql_insert_id() : $result;
		$this->close();
		return $id;
	}// end function

	public function readFoh($id) {
		global $con;
		$sql = 'SELECT * FROM foh WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		if ($result) {
			$foh = new Foh();
			$foh->setEvent_id(result[0]);
			$foh->setPerson_id(result[1]);
		} else {
			$foh = false
		}
		return $foh;
	}// end function

	public function updateFoh($foh) {
		global $con;
		$fieldsString = csvString($fields);
		$sql = 'INSERT INTO foh VALUES (' . $valueString . ')  WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		return $result;
	}// end function

	public function deleteFoh($id) {
		global $con;
		$sql = 'DELETE FROM foh WHERE event_id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		return $result;
	}// end function

	public function listFoh() {
		global $con;
		$sql = 'SELECT * FROM foh';
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		if ($result) {
			$fohs = array();
			while($result = mysql_fetch_array($results)) {
				$foh = new Foh();
				$foh->setEvent(readEvent(result[0]));
				$foh->setPerson(readPerson(result[1]));
				$fohs[] = $foh;
			}// end while
		} else {
			$foh = false
		}
		return $foh;
	}// end function

	// guest_list // --------------------

	public function createGuest_list($guest_list) {
		global $con;
		$fieldsString = csvObject($guest_list);
		$valuesString = csvString($guest_list);
		$sql = 'INSERT INTO ' . $tableTitle . '(' . $fieldsString . ') VALUES (' . $valuesString . ')';
		$this->open();
		$result = mysql_query($sql, $con);
		$id = ($result) ? mysql_insert_id() : $result;
		$this->close();
		return $id;
	}// end function

	public function readGuest_list($id) {
		global $con;
		$sql = 'SELECT * FROM guest_list WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		if ($result) {
			$guest_list = new Guest_list();
			$guest_list->setEvent_id(result[0]);
			$guest_list->setPerson_id(result[1]);
			$guest_list->setAttended(result[2]);
		} else {
			$guest_list = false
		}
		return $guest_list;
	}// end function

	public function updateGuest_list($guest_list) {
		global $con;
		$fieldsString = csvString($fields);
		$sql = 'INSERT INTO guest_list VALUES (' . $valueString . ')  WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		return $result;
	}// end function

	public function deleteGuest_list($id) {
		global $con;
		$sql = 'DELETE FROM guest_list WHERE event_id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		return $result;
	}// end function

	public function listGuest_list() {
		global $con;
		$sql = 'SELECT * FROM guest_list';
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		if ($result) {
			$guest_lists = array();
			while($result = mysql_fetch_array($results)) {
				$guest_list = new Guest_list();
				$guest_list->setEvent(readEvent(result[0]));
				$guest_list->setPerson(readPerson(result[1]));
				$guest_list->setAttended(result[2]);
				$guest_lists[] = $guest_list;
			}// end while
		} else {
			$guest_list = false
		}
		return $guest_list;
	}// end function

	// habitat_employee // --------------------

	public function createHabitat_employee($habitat_employee) {
		global $con;
		$fieldsString = csvObject($habitat_employee);
		$valuesString = csvString($habitat_employee);
		$sql = 'INSERT INTO ' . $tableTitle . '(' . $fieldsString . ') VALUES (' . $valuesString . ')';
		$this->open();
		$result = mysql_query($sql, $con);
		$id = ($result) ? mysql_insert_id() : $result;
		$this->close();
		return $id;
	}// end function

	public function readHabitat_employee($id) {
		global $con;
		$sql = 'SELECT * FROM habitat_employee WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		if ($result) {
			$habitat_employee = new Habitat_employee();
			$habitat_employee->setId(result[0]);
			$habitat_employee->setPerson_id(result[1]);
			$habitat_employee->setStart_date(result[2]);
			$habitat_employee->setEnd_date(result[3]);
		} else {
			$habitat_employee = false
		}
		return $habitat_employee;
	}// end function

	public function updateHabitat_employee($habitat_employee) {
		global $con;
		$fieldsString = csvString($fields);
		$sql = 'INSERT INTO habitat_employee VALUES (' . $valueString . ')  WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		return $result;
	}// end function

	public function deleteHabitat_employee($id) {
		global $con;
		$sql = 'DELETE FROM habitat_employee WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		return $result;
	}// end function

	public function listHabitat_employee() {
		global $con;
		$sql = 'SELECT * FROM habitat_employee';
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		if ($result) {
			$habitat_employees = array();
			while($result = mysql_fetch_array($results)) {
				$habitat_employee = new Habitat_employee();
				$habitat_employee->setId(result[0]);
				$habitat_employee->setPerson(readPerson(result[1]));
				$habitat_employee->setStart_date(result[2]);
				$habitat_employee->setEnd_date(result[3]);
				$habitat_employees[] = $habitat_employee;
			}// end while
		} else {
			$habitat_employee = false
		}
		return $habitat_employee;
	}// end function

	// ho_asset // --------------------

	public function createHo_asset($ho_asset) {
		global $con;
		$fieldsString = csvObject($ho_asset);
		$valuesString = csvString($ho_asset);
		$sql = 'INSERT INTO ' . $tableTitle . '(' . $fieldsString . ') VALUES (' . $valuesString . ')';
		$this->open();
		$result = mysql_query($sql, $con);
		$id = ($result) ? mysql_insert_id() : $result;
		$this->close();
		return $id;
	}// end function

	public function readHo_asset($id) {
		global $con;
		$sql = 'SELECT * FROM ho_asset WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		if ($result) {
			$ho_asset = new Ho_asset();
			$ho_asset->setId(result[0]);
			$ho_asset->setPerson_id(result[1]);
			$ho_asset->setTitle(result[2]);
			$ho_asset->setDescription(result[3]);
			$ho_asset->setValue(result[4]);
		} else {
			$ho_asset = false
		}
		return $ho_asset;
	}// end function

	public function updateHo_asset($ho_asset) {
		global $con;
		$fieldsString = csvString($fields);
		$sql = 'INSERT INTO ho_asset VALUES (' . $valueString . ')  WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		return $result;
	}// end function

	public function deleteHo_asset($id) {
		global $con;
		$sql = 'DELETE FROM ho_asset WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		return $result;
	}// end function

	public function listHo_asset() {
		global $con;
		$sql = 'SELECT * FROM ho_asset';
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		if ($result) {
			$ho_assets = array();
			while($result = mysql_fetch_array($results)) {
				$ho_asset = new Ho_asset();
				$ho_asset->setId(result[0]);
				$ho_asset->setPerson(readPerson(result[1]));
				$ho_asset->setTitle(result[2]);
				$ho_asset->setDescription(result[3]);
				$ho_asset->setValue(result[4]);
				$ho_assets[] = $ho_asset;
			}// end while
		} else {
			$ho_asset = false
		}
		return $ho_asset;
	}// end function

	// ho_debt // --------------------

	public function createHo_debt($ho_debt) {
		global $con;
		$fieldsString = csvObject($ho_debt);
		$valuesString = csvString($ho_debt);
		$sql = 'INSERT INTO ' . $tableTitle . '(' . $fieldsString . ') VALUES (' . $valuesString . ')';
		$this->open();
		$result = mysql_query($sql, $con);
		$id = ($result) ? mysql_insert_id() : $result;
		$this->close();
		return $id;
	}// end function

	public function readHo_debt($id) {
		global $con;
		$sql = 'SELECT * FROM ho_debt WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		if ($result) {
			$ho_debt = new Ho_debt();
			$ho_debt->setId(result[0]);
			$ho_debt->setPerson_id(result[1]);
			$ho_debt->setMonthly_payment(result[2]);
			$ho_debt->setBalance(result[3]);
		} else {
			$ho_debt = false
		}
		return $ho_debt;
	}// end function

	public function updateHo_debt($ho_debt) {
		global $con;
		$fieldsString = csvString($fields);
		$sql = 'INSERT INTO ho_debt VALUES (' . $valueString . ')  WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		return $result;
	}// end function

	public function deleteHo_debt($id) {
		global $con;
		$sql = 'DELETE FROM ho_debt WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		return $result;
	}// end function

	public function listHo_debt() {
		global $con;
		$sql = 'SELECT * FROM ho_debt';
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		if ($result) {
			$ho_debts = array();
			while($result = mysql_fetch_array($results)) {
				$ho_debt = new Ho_debt();
				$ho_debt->setId(result[0]);
				$ho_debt->setPerson(readPerson(result[1]));
				$ho_debt->setMonthly_payment(result[2]);
				$ho_debt->setBalance(result[3]);
				$ho_debts[] = $ho_debt;
			}// end while
		} else {
			$ho_debt = false
		}
		return $ho_debt;
	}// end function

	// ho_group // --------------------

	public function createHo_group($ho_group) {
		global $con;
		$fieldsString = csvObject($ho_group);
		$valuesString = csvString($ho_group);
		$sql = 'INSERT INTO ' . $tableTitle . '(' . $fieldsString . ') VALUES (' . $valuesString . ')';
		$this->open();
		$result = mysql_query($sql, $con);
		$id = ($result) ? mysql_insert_id() : $result;
		$this->close();
		return $id;
	}// end function

	public function readHo_group($id) {
		global $con;
		$sql = 'SELECT * FROM ho_group WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		if ($result) {
			$ho_group = new Ho_group();
			$ho_group->setPerson_id(result[0]);
			$ho_group->setHo_id(result[1]);
			$ho_group->setDemographic_id(result[2]);
			$ho_group->setPrimary_ho(result[3]);
		} else {
			$ho_group = false
		}
		return $ho_group;
	}// end function

	public function updateHo_group($ho_group) {
		global $con;
		$fieldsString = csvString($fields);
		$sql = 'INSERT INTO ho_group VALUES (' . $valueString . ')  WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		return $result;
	}// end function

	public function deleteHo_group($id) {
		global $con;
		$sql = 'DELETE FROM ho_group WHERE person_id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		return $result;
	}// end function

	public function listHo_group() {
		global $con;
		$sql = 'SELECT * FROM ho_group';
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		if ($result) {
			$ho_groups = array();
			while($result = mysql_fetch_array($results)) {
				$ho_group = new Ho_group();
				$ho_group->setPerson(readPerson(result[0]));
				$ho_group->setHo(readHo(result[1]));
				$ho_group->setDemographic(readDemographic(result[2]));
				$ho_group->setPrimary_ho(result[3]);
				$ho_groups[] = $ho_group;
			}// end while
		} else {
			$ho_group = false
		}
		return $ho_group;
	}// end function

	// ho_income // --------------------

	public function createHo_income($ho_income) {
		global $con;
		$fieldsString = csvObject($ho_income);
		$valuesString = csvString($ho_income);
		$sql = 'INSERT INTO ' . $tableTitle . '(' . $fieldsString . ') VALUES (' . $valuesString . ')';
		$this->open();
		$result = mysql_query($sql, $con);
		$id = ($result) ? mysql_insert_id() : $result;
		$this->close();
		return $id;
	}// end function

	public function readHo_income($id) {
		global $con;
		$sql = 'SELECT * FROM ho_income WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		if ($result) {
			$ho_income = new Ho_income();
			$ho_income->setId(result[0]);
			$ho_income->setPerson_id(result[1]);
			$ho_income->setGross(result[2]);
			$ho_income->setChild_support(result[3]);
			$ho_income->setDisability(result[4]);
			$ho_income->setUnemployment(result[5]);
		} else {
			$ho_income = false
		}
		return $ho_income;
	}// end function

	public function updateHo_income($ho_income) {
		global $con;
		$fieldsString = csvString($fields);
		$sql = 'INSERT INTO ho_income VALUES (' . $valueString . ')  WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		return $result;
	}// end function

	public function deleteHo_income($id) {
		global $con;
		$sql = 'DELETE FROM ho_income WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		return $result;
	}// end function

	public function listHo_income() {
		global $con;
		$sql = 'SELECT * FROM ho_income';
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		if ($result) {
			$ho_incomes = array();
			while($result = mysql_fetch_array($results)) {
				$ho_income = new Ho_income();
				$ho_income->setId(result[0]);
				$ho_income->setPerson(readPerson(result[1]));
				$ho_income->setGross(result[2]);
				$ho_income->setChild_support(result[3]);
				$ho_income->setDisability(result[4]);
				$ho_income->setUnemployment(result[5]);
				$ho_incomes[] = $ho_income;
			}// end while
		} else {
			$ho_income = false
		}
		return $ho_income;
	}// end function

	// ho_requirement // --------------------

	public function createHo_requirement($ho_requirement) {
		global $con;
		$fieldsString = csvObject($ho_requirement);
		$valuesString = csvString($ho_requirement);
		$sql = 'INSERT INTO ' . $tableTitle . '(' . $fieldsString . ') VALUES (' . $valuesString . ')';
		$this->open();
		$result = mysql_query($sql, $con);
		$id = ($result) ? mysql_insert_id() : $result;
		$this->close();
		return $id;
	}// end function

	public function readHo_requirement($id) {
		global $con;
		$sql = 'SELECT * FROM ho_requirement WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		if ($result) {
			$ho_requirement = new Ho_requirement();
			$ho_requirement->setPerson_id(result[0]);
			$ho_requirement->setRequirement_id(result[1]);
			$ho_requirement->setWhen_entered(result[2]);
			$ho_requirement->setWhen_completed(result[3]);
			$ho_requirement->setOffice_id(result[4]);
			$ho_requirement->setWhen_authorized(result[5]);
			$ho_requirement->setAdmin_id(result[6]);
		} else {
			$ho_requirement = false
		}
		return $ho_requirement;
	}// end function

	public function updateHo_requirement($ho_requirement) {
		global $con;
		$fieldsString = csvString($fields);
		$sql = 'INSERT INTO ho_requirement VALUES (' . $valueString . ')  WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		return $result;
	}// end function

	public function deleteHo_requirement($id) {
		global $con;
		$sql = 'DELETE FROM ho_requirement WHERE person_id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		return $result;
	}// end function

	public function listHo_requirement() {
		global $con;
		$sql = 'SELECT * FROM ho_requirement';
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		if ($result) {
			$ho_requirements = array();
			while($result = mysql_fetch_array($results)) {
				$ho_requirement = new Ho_requirement();
				$ho_requirement->setPerson(readPerson(result[0]));
				$ho_requirement->setRequirement(readRequirement(result[1]));
				$ho_requirement->setWhen_entered(result[2]);
				$ho_requirement->setWhen_completed(result[3]);
				$ho_requirement->setOffice(readOffice(result[4]));
				$ho_requirement->setWhen_authorized(result[5]);
				$ho_requirement->setAdmin(readAdmin(result[6]));
				$ho_requirements[] = $ho_requirement;
			}// end while
		} else {
			$ho_requirement = false
		}
		return $ho_requirement;
	}// end function

	// ho_status // --------------------

	public function createHo_status($ho_status) {
		global $con;
		$fieldsString = csvObject($ho_status);
		$valuesString = csvString($ho_status);
		$sql = 'INSERT INTO ' . $tableTitle . '(' . $fieldsString . ') VALUES (' . $valuesString . ')';
		$this->open();
		$result = mysql_query($sql, $con);
		$id = ($result) ? mysql_insert_id() : $result;
		$this->close();
		return $id;
	}// end function

	public function readHo_status($id) {
		global $con;
		$sql = 'SELECT * FROM ho_status WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		if ($result) {
			$ho_status = new Ho_status();
			$ho_status->setId(result[0]);
			$ho_status->setTitle(result[1]);
			$ho_status->setCode(result[2]);
			$ho_status->setDescription(result[3]);
		} else {
			$ho_status = false
		}
		return $ho_status;
	}// end function

	public function updateHo_status($ho_status) {
		global $con;
		$fieldsString = csvString($fields);
		$sql = 'INSERT INTO ho_status VALUES (' . $valueString . ')  WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		return $result;
	}// end function

	public function deleteHo_status($id) {
		global $con;
		$sql = 'DELETE FROM ho_status WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		return $result;
	}// end function

	public function listHo_status() {
		global $con;
		$sql = 'SELECT * FROM ho_status';
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		if ($result) {
			$ho_statuss = array();
			while($result = mysql_fetch_array($results)) {
				$ho_status = new Ho_status();
				$ho_status->setId(result[0]);
				$ho_status->setTitle(result[1]);
				$ho_status->setCode(result[2]);
				$ho_status->setDescription(result[3]);
				$ho_statuss[] = $ho_status;
			}// end while
		} else {
			$ho_status = false
		}
		return $ho_status;
	}// end function

	// home_owner // --------------------

	public function createHome_owner($home_owner) {
		global $con;
		$fieldsString = csvObject($home_owner);
		$valuesString = csvString($home_owner);
		$sql = 'INSERT INTO ' . $tableTitle . '(' . $fieldsString . ') VALUES (' . $valuesString . ')';
		$this->open();
		$result = mysql_query($sql, $con);
		$id = ($result) ? mysql_insert_id() : $result;
		$this->close();
		return $id;
	}// end function

	public function readHome_owner($id) {
		global $con;
		$sql = 'SELECT * FROM home_owner WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		if ($result) {
			$home_owner = new Home_owner();
			$home_owner->setPerson_id(result[0]);
			$home_owner->setStatus_id(result[1]);
			$home_owner->setBank_id(result[2]);
			$home_owner->setSocial_security(result[3]);
		} else {
			$home_owner = false
		}
		return $home_owner;
	}// end function

	public function updateHome_owner($home_owner) {
		global $con;
		$fieldsString = csvString($fields);
		$sql = 'INSERT INTO home_owner VALUES (' . $valueString . ')  WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		return $result;
	}// end function

	public function deleteHome_owner($id) {
		global $con;
		$sql = 'DELETE FROM home_owner WHERE person_id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		return $result;
	}// end function

	public function listHome_owner() {
		global $con;
		$sql = 'SELECT * FROM home_owner';
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		if ($result) {
			$home_owners = array();
			while($result = mysql_fetch_array($results)) {
				$home_owner = new Home_owner();
				$home_owner->setPerson(readPerson(result[0]));
				$home_owner->setStatus(readStatus(result[1]));
				$home_owner->setBank(readBank(result[2]));
				$home_owner->setSocial_security(result[3]);
				$home_owners[] = $home_owner;
			}// end while
		} else {
			$home_owner = false
		}
		return $home_owner;
	}// end function

	// interest // --------------------

	public function createInterest($interest) {
		global $con;
		$fieldsString = csvObject($interest);
		$valuesString = csvString($interest);
		$sql = 'INSERT INTO ' . $tableTitle . '(' . $fieldsString . ') VALUES (' . $valuesString . ')';
		$this->open();
		$result = mysql_query($sql, $con);
		$id = ($result) ? mysql_insert_id() : $result;
		$this->close();
		return $id;
	}// end function

	public function readInterest($id) {
		global $con;
		$sql = 'SELECT * FROM interest WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		if ($result) {
			$interest = new Interest();
			$interest->setId(result[0]);
			$interest->setType_id(result[1]);
			$interest->setTitle(result[2]);
			$interest->setDescription(result[3]);
		} else {
			$interest = false
		}
		return $interest;
	}// end function

	public function updateInterest($interest) {
		global $con;
		$fieldsString = csvString($fields);
		$sql = 'INSERT INTO interest VALUES (' . $valueString . ')  WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		return $result;
	}// end function

	public function deleteInterest($id) {
		global $con;
		$sql = 'DELETE FROM interest WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		return $result;
	}// end function

	public function listInterest() {
		global $con;
		$sql = 'SELECT * FROM interest';
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		if ($result) {
			$interests = array();
			while($result = mysql_fetch_array($results)) {
				$interest = new Interest();
				$interest->setId(result[0]);
				$interest->setType(readType(result[1]));
				$interest->setTitle(result[2]);
				$interest->setDescription(result[3]);
				$interests[] = $interest;
			}// end while
		} else {
			$interest = false
		}
		return $interest;
	}// end function

	// interest_type // --------------------

	public function createInterest_type($interest_type) {
		global $con;
		$fieldsString = csvObject($interest_type);
		$valuesString = csvString($interest_type);
		$sql = 'INSERT INTO ' . $tableTitle . '(' . $fieldsString . ') VALUES (' . $valuesString . ')';
		$this->open();
		$result = mysql_query($sql, $con);
		$id = ($result) ? mysql_insert_id() : $result;
		$this->close();
		return $id;
	}// end function

	public function readInterest_type($id) {
		global $con;
		$sql = 'SELECT * FROM interest_type WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		if ($result) {
			$interest_type = new Interest_type();
			$interest_type->setId(result[0]);
			$interest_type->setTitle(result[1]);
			$interest_type->setDescription(result[2]);
		} else {
			$interest_type = false
		}
		return $interest_type;
	}// end function

	public function updateInterest_type($interest_type) {
		global $con;
		$fieldsString = csvString($fields);
		$sql = 'INSERT INTO interest_type VALUES (' . $valueString . ')  WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		return $result;
	}// end function

	public function deleteInterest_type($id) {
		global $con;
		$sql = 'DELETE FROM interest_type WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		return $result;
	}// end function

	public function listInterest_type() {
		global $con;
		$sql = 'SELECT * FROM interest_type';
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		if ($result) {
			$interest_types = array();
			while($result = mysql_fetch_array($results)) {
				$interest_type = new Interest_type();
				$interest_type->setId(result[0]);
				$interest_type->setTitle(result[1]);
				$interest_type->setDescription(result[2]);
				$interest_types[] = $interest_type;
			}// end while
		} else {
			$interest_type = false
		}
		return $interest_type;
	}// end function

	// interested_in // --------------------

	public function createInterested_in($interested_in) {
		global $con;
		$fieldsString = csvObject($interested_in);
		$valuesString = csvString($interested_in);
		$sql = 'INSERT INTO ' . $tableTitle . '(' . $fieldsString . ') VALUES (' . $valuesString . ')';
		$this->open();
		$result = mysql_query($sql, $con);
		$id = ($result) ? mysql_insert_id() : $result;
		$this->close();
		return $id;
	}// end function

	public function readInterested_in($id) {
		global $con;
		$sql = 'SELECT * FROM interested_in WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		if ($result) {
			$interested_in = new Interested_in();
			$interested_in->setVolunteer_id(result[0]);
			$interested_in->setInterest_id(result[1]);
		} else {
			$interested_in = false
		}
		return $interested_in;
	}// end function

	public function updateInterested_in($interested_in) {
		global $con;
		$fieldsString = csvString($fields);
		$sql = 'INSERT INTO interested_in VALUES (' . $valueString . ')  WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		return $result;
	}// end function

	public function deleteInterested_in($id) {
		global $con;
		$sql = 'DELETE FROM interested_in WHERE volunteer_id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		return $result;
	}// end function

	public function listInterested_in() {
		global $con;
		$sql = 'SELECT * FROM interested_in';
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		if ($result) {
			$interested_ins = array();
			while($result = mysql_fetch_array($results)) {
				$interested_in = new Interested_in();
				$interested_in->setVolunteer(readVolunteer(result[0]));
				$interested_in->setInterest(readInterest(result[1]));
				$interested_ins[] = $interested_in;
			}// end while
		} else {
			$interested_in = false
		}
		return $interested_in;
	}// end function

	// labor // --------------------

	public function createLabor($labor) {
		global $con;
		$fieldsString = csvObject($labor);
		$valuesString = csvString($labor);
		$sql = 'INSERT INTO ' . $tableTitle . '(' . $fieldsString . ') VALUES (' . $valuesString . ')';
		$this->open();
		$result = mysql_query($sql, $con);
		$id = ($result) ? mysql_insert_id() : $result;
		$this->close();
		return $id;
	}// end function

	public function readLabor($id) {
		global $con;
		$sql = 'SELECT * FROM labor WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		if ($result) {
			$labor = new Labor();
			$labor->setDonation_id(result[0]);
			$labor->setAmount(result[1]);
			$labor->setMethod(result[2]);
			$labor->setProject_id(result[3]);
		} else {
			$labor = false
		}
		return $labor;
	}// end function

	public function updateLabor($labor) {
		global $con;
		$fieldsString = csvString($fields);
		$sql = 'INSERT INTO labor VALUES (' . $valueString . ')  WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		return $result;
	}// end function

	public function deleteLabor($id) {
		global $con;
		$sql = 'DELETE FROM labor WHERE donation_id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		return $result;
	}// end function

	public function listLabor() {
		global $con;
		$sql = 'SELECT * FROM labor';
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		if ($result) {
			$labors = array();
			while($result = mysql_fetch_array($results)) {
				$labor = new Labor();
				$labor->setDonation(readDonation(result[0]));
				$labor->setAmount(result[1]);
				$labor->setMethod(result[2]);
				$labor->setProject(readProject(result[3]));
				$labors[] = $labor;
			}// end while
		} else {
			$labor = false
		}
		return $labor;
	}// end function

	// marital_status // --------------------

	public function createMarital_status($marital_status) {
		global $con;
		$fieldsString = csvObject($marital_status);
		$valuesString = csvString($marital_status);
		$sql = 'INSERT INTO ' . $tableTitle . '(' . $fieldsString . ') VALUES (' . $valuesString . ')';
		$this->open();
		$result = mysql_query($sql, $con);
		$id = ($result) ? mysql_insert_id() : $result;
		$this->close();
		return $id;
	}// end function

	public function readMarital_status($id) {
		global $con;
		$sql = 'SELECT * FROM marital_status WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		if ($result) {
			$marital_status = new Marital_status();
			$marital_status->setId(result[0]);
			$marital_status->setTitle(result[1]);
			$marital_status->setDescription(result[2]);
		} else {
			$marital_status = false
		}
		return $marital_status;
	}// end function

	public function updateMarital_status($marital_status) {
		global $con;
		$fieldsString = csvString($fields);
		$sql = 'INSERT INTO marital_status VALUES (' . $valueString . ')  WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		return $result;
	}// end function

	public function deleteMarital_status($id) {
		global $con;
		$sql = 'DELETE FROM marital_status WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		return $result;
	}// end function

	public function listMarital_status() {
		global $con;
		$sql = 'SELECT * FROM marital_status';
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		if ($result) {
			$marital_statuss = array();
			while($result = mysql_fetch_array($results)) {
				$marital_status = new Marital_status();
				$marital_status->setId(result[0]);
				$marital_status->setTitle(result[1]);
				$marital_status->setDescription(result[2]);
				$marital_statuss[] = $marital_status;
			}// end while
		} else {
			$marital_status = false
		}
		return $marital_status;
	}// end function

	// material // --------------------

	public function createMaterial($material) {
		global $con;
		$fieldsString = csvObject($material);
		$valuesString = csvString($material);
		$sql = 'INSERT INTO ' . $tableTitle . '(' . $fieldsString . ') VALUES (' . $valuesString . ')';
		$this->open();
		$result = mysql_query($sql, $con);
		$id = ($result) ? mysql_insert_id() : $result;
		$this->close();
		return $id;
	}// end function

	public function readMaterial($id) {
		global $con;
		$sql = 'SELECT * FROM material WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		if ($result) {
			$material = new Material();
			$material->setDonation_id(result[0]);
			$material->setValue(result[1]);
			$material->setDescription(result[2]);
		} else {
			$material = false
		}
		return $material;
	}// end function

	public function updateMaterial($material) {
		global $con;
		$fieldsString = csvString($fields);
		$sql = 'INSERT INTO material VALUES (' . $valueString . ')  WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		return $result;
	}// end function

	public function deleteMaterial($id) {
		global $con;
		$sql = 'DELETE FROM material WHERE donation_id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		return $result;
	}// end function

	public function listMaterial() {
		global $con;
		$sql = 'SELECT * FROM material';
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		if ($result) {
			$materials = array();
			while($result = mysql_fetch_array($results)) {
				$material = new Material();
				$material->setDonation(readDonation(result[0]));
				$material->setValue(result[1]);
				$material->setDescription(result[2]);
				$materials[] = $material;
			}// end while
		} else {
			$material = false
		}
		return $material;
	}// end function

	// money // --------------------

	public function createMoney($money) {
		global $con;
		$fieldsString = csvObject($money);
		$valuesString = csvString($money);
		$sql = 'INSERT INTO ' . $tableTitle . '(' . $fieldsString . ') VALUES (' . $valuesString . ')';
		$this->open();
		$result = mysql_query($sql, $con);
		$id = ($result) ? mysql_insert_id() : $result;
		$this->close();
		return $id;
	}// end function

	public function readMoney($id) {
		global $con;
		$sql = 'SELECT * FROM money WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		if ($result) {
			$money = new Money();
			$money->setDonation_id(result[0]);
			$money->setAmount(result[1]);
			$money->setMethod(result[2]);
		} else {
			$money = false
		}
		return $money;
	}// end function

	public function updateMoney($money) {
		global $con;
		$fieldsString = csvString($fields);
		$sql = 'INSERT INTO money VALUES (' . $valueString . ')  WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		return $result;
	}// end function

	public function deleteMoney($id) {
		global $con;
		$sql = 'DELETE FROM money WHERE donation_id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		return $result;
	}// end function

	public function listMoney() {
		global $con;
		$sql = 'SELECT * FROM money';
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		if ($result) {
			$moneys = array();
			while($result = mysql_fetch_array($results)) {
				$money = new Money();
				$money->setDonation(readDonation(result[0]));
				$money->setAmount(result[1]);
				$money->setMethod(result[2]);
				$moneys[] = $money;
			}// end while
		} else {
			$money = false
		}
		return $money;
	}// end function

	// mortgage // --------------------

	public function createMortgage($mortgage) {
		global $con;
		$fieldsString = csvObject($mortgage);
		$valuesString = csvString($mortgage);
		$sql = 'INSERT INTO ' . $tableTitle . '(' . $fieldsString . ') VALUES (' . $valuesString . ')';
		$this->open();
		$result = mysql_query($sql, $con);
		$id = ($result) ? mysql_insert_id() : $result;
		$this->close();
		return $id;
	}// end function

	public function readMortgage($id) {
		global $con;
		$sql = 'SELECT * FROM mortgage WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		if ($result) {
			$mortgage = new Mortgage();
			$mortgage->setId(result[0]);
			$mortgage->setPerson_id(result[1]);
			$mortgage->setAmount(result[2]);
			$mortgage->setStatus(result[3]);
			$mortgage->setProject_id(result[4]);
			$mortgage->setBank_id(result[5]);
		} else {
			$mortgage = false
		}
		return $mortgage;
	}// end function

	public function updateMortgage($mortgage) {
		global $con;
		$fieldsString = csvString($fields);
		$sql = 'INSERT INTO mortgage VALUES (' . $valueString . ')  WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		return $result;
	}// end function

	public function deleteMortgage($id) {
		global $con;
		$sql = 'DELETE FROM mortgage WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		return $result;
	}// end function

	public function listMortgage() {
		global $con;
		$sql = 'SELECT * FROM mortgage';
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		if ($result) {
			$mortgages = array();
			while($result = mysql_fetch_array($results)) {
				$mortgage = new Mortgage();
				$mortgage->setId(result[0]);
				$mortgage->setPerson(readPerson(result[1]));
				$mortgage->setAmount(result[2]);
				$mortgage->setStatus(result[3]);
				$mortgage->setProject(readProject(result[4]));
				$mortgage->setBank(readBank(result[5]));
				$mortgages[] = $mortgage;
			}// end while
		} else {
			$mortgage = false
		}
		return $mortgage;
	}// end function

	// municipality // --------------------

	public function createMunicipality($municipality) {
		global $con;
		$fieldsString = csvObject($municipality);
		$valuesString = csvString($municipality);
		$sql = 'INSERT INTO ' . $tableTitle . '(' . $fieldsString . ') VALUES (' . $valuesString . ')';
		$this->open();
		$result = mysql_query($sql, $con);
		$id = ($result) ? mysql_insert_id() : $result;
		$this->close();
		return $id;
	}// end function

	public function readMunicipality($id) {
		global $con;
		$sql = 'SELECT * FROM municipality WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		if ($result) {
			$municipality = new Municipality();
			$municipality->setId(result[0]);
			$municipality->setTitle(result[1]);
		} else {
			$municipality = false
		}
		return $municipality;
	}// end function

	public function updateMunicipality($municipality) {
		global $con;
		$fieldsString = csvString($fields);
		$sql = 'INSERT INTO municipality VALUES (' . $valueString . ')  WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		return $result;
	}// end function

	public function deleteMunicipality($id) {
		global $con;
		$sql = 'DELETE FROM municipality WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		return $result;
	}// end function

	public function listMunicipality() {
		global $con;
		$sql = 'SELECT * FROM municipality';
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		if ($result) {
			$municipalitys = array();
			while($result = mysql_fetch_array($results)) {
				$municipality = new Municipality();
				$municipality->setId(result[0]);
				$municipality->setTitle(result[1]);
				$municipalitys[] = $municipality;
			}// end while
		} else {
			$municipality = false
		}
		return $municipality;
	}// end function

	// office // --------------------

	public function createOffice($office) {
		global $con;
		$fieldsString = csvObject($office);
		$valuesString = csvString($office);
		$sql = 'INSERT INTO ' . $tableTitle . '(' . $fieldsString . ') VALUES (' . $valuesString . ')';
		$this->open();
		$result = mysql_query($sql, $con);
		$id = ($result) ? mysql_insert_id() : $result;
		$this->close();
		return $id;
	}// end function

	public function readOffice($id) {
		global $con;
		$sql = 'SELECT * FROM office WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		if ($result) {
			$office = new Office();
			$office->setId(result[0]);
			$office->setPerson_id(result[1]);
		} else {
			$office = false
		}
		return $office;
	}// end function

	public function updateOffice($office) {
		global $con;
		$fieldsString = csvString($fields);
		$sql = 'INSERT INTO office VALUES (' . $valueString . ')  WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		return $result;
	}// end function

	public function deleteOffice($id) {
		global $con;
		$sql = 'DELETE FROM office WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		return $result;
	}// end function

	public function listOffice() {
		global $con;
		$sql = 'SELECT * FROM office';
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		if ($result) {
			$offices = array();
			while($result = mysql_fetch_array($results)) {
				$office = new Office();
				$office->setId(result[0]);
				$office->setPerson(readPerson(result[1]));
				$offices[] = $office;
			}// end while
		} else {
			$office = false
		}
		return $office;
	}// end function

	// organization // --------------------

	public function createOrganization($organization) {
		global $con;
		$fieldsString = csvObject($organization);
		$valuesString = csvString($organization);
		$sql = 'INSERT INTO ' . $tableTitle . '(' . $fieldsString . ') VALUES (' . $valuesString . ')';
		$this->open();
		$result = mysql_query($sql, $con);
		$id = ($result) ? mysql_insert_id() : $result;
		$this->close();
		return $id;
	}// end function

	public function readOrganization($id) {
		global $con;
		$sql = 'SELECT * FROM organization WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		if ($result) {
			$organization = new Organization();
			$organization->setId(result[0]);
			$organization->setName(result[1]);
			$organization->setContact_id(result[2]);
		} else {
			$organization = false
		}
		return $organization;
	}// end function

	public function updateOrganization($organization) {
		global $con;
		$fieldsString = csvString($fields);
		$sql = 'INSERT INTO organization VALUES (' . $valueString . ')  WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		return $result;
	}// end function

	public function deleteOrganization($id) {
		global $con;
		$sql = 'DELETE FROM organization WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		return $result;
	}// end function

	public function listOrganization() {
		global $con;
		$sql = 'SELECT * FROM organization';
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		if ($result) {
			$organizations = array();
			while($result = mysql_fetch_array($results)) {
				$organization = new Organization();
				$organization->setId(result[0]);
				$organization->setName(result[1]);
				$organization->setContact(readContact(result[2]));
				$organizations[] = $organization;
			}// end while
		} else {
			$organization = false
		}
		return $organization;
	}// end function

	// organization_contact // --------------------

	public function createOrganization_contact($organization_contact) {
		global $con;
		$fieldsString = csvObject($organization_contact);
		$valuesString = csvString($organization_contact);
		$sql = 'INSERT INTO ' . $tableTitle . '(' . $fieldsString . ') VALUES (' . $valuesString . ')';
		$this->open();
		$result = mysql_query($sql, $con);
		$id = ($result) ? mysql_insert_id() : $result;
		$this->close();
		return $id;
	}// end function

	public function readOrganization_contact($id) {
		global $con;
		$sql = 'SELECT * FROM organization_contact WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		if ($result) {
			$organization_contact = new Organization_contact();
			$organization_contact->setOrganization_id(result[0]);
			$organization_contact->setPerson_id(result[1]);
			$organization_contact->setPhone(result[2]);
			$organization_contact->setExt(result[3]);
			$organization_contact->setFax(result[4]);
		} else {
			$organization_contact = false
		}
		return $organization_contact;
	}// end function

	public function updateOrganization_contact($organization_contact) {
		global $con;
		$fieldsString = csvString($fields);
		$sql = 'INSERT INTO organization_contact VALUES (' . $valueString . ')  WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		return $result;
	}// end function

	public function deleteOrganization_contact($id) {
		global $con;
		$sql = 'DELETE FROM organization_contact WHERE organization_id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		return $result;
	}// end function

	public function listOrganization_contact() {
		global $con;
		$sql = 'SELECT * FROM organization_contact';
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		if ($result) {
			$organization_contacts = array();
			while($result = mysql_fetch_array($results)) {
				$organization_contact = new Organization_contact();
				$organization_contact->setOrganization(readOrganization(result[0]));
				$organization_contact->setPerson(readPerson(result[1]));
				$organization_contact->setPhone(result[2]);
				$organization_contact->setExt(result[3]);
				$organization_contact->setFax(result[4]);
				$organization_contacts[] = $organization_contact;
			}// end while
		} else {
			$organization_contact = false
		}
		return $organization_contact;
	}// end function

	// organization_donation // --------------------

	public function createOrganization_donation($organization_donation) {
		global $con;
		$fieldsString = csvObject($organization_donation);
		$valuesString = csvString($organization_donation);
		$sql = 'INSERT INTO ' . $tableTitle . '(' . $fieldsString . ') VALUES (' . $valuesString . ')';
		$this->open();
		$result = mysql_query($sql, $con);
		$id = ($result) ? mysql_insert_id() : $result;
		$this->close();
		return $id;
	}// end function

	public function readOrganization_donation($id) {
		global $con;
		$sql = 'SELECT * FROM organization_donation WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		if ($result) {
			$organization_donation = new Organization_donation();
			$organization_donation->setId(result[0]);
			$organization_donation->setDonation_id(result[1]);
			$organization_donation->setOrganization_id(result[2]);
		} else {
			$organization_donation = false
		}
		return $organization_donation;
	}// end function

	public function updateOrganization_donation($organization_donation) {
		global $con;
		$fieldsString = csvString($fields);
		$sql = 'INSERT INTO organization_donation VALUES (' . $valueString . ')  WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		return $result;
	}// end function

	public function deleteOrganization_donation($id) {
		global $con;
		$sql = 'DELETE FROM organization_donation WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		return $result;
	}// end function

	public function listOrganization_donation() {
		global $con;
		$sql = 'SELECT * FROM organization_donation';
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		if ($result) {
			$organization_donations = array();
			while($result = mysql_fetch_array($results)) {
				$organization_donation = new Organization_donation();
				$organization_donation->setId(result[0]);
				$organization_donation->setDonation(readDonation(result[1]));
				$organization_donation->setOrganization(readOrganization(result[2]));
				$organization_donations[] = $organization_donation;
			}// end while
		} else {
			$organization_donation = false
		}
		return $organization_donation;
	}// end function

	// payment // --------------------

	public function createPayment($payment) {
		global $con;
		$fieldsString = csvObject($payment);
		$valuesString = csvString($payment);
		$sql = 'INSERT INTO ' . $tableTitle . '(' . $fieldsString . ') VALUES (' . $valuesString . ')';
		$this->open();
		$result = mysql_query($sql, $con);
		$id = ($result) ? mysql_insert_id() : $result;
		$this->close();
		return $id;
	}// end function

	public function readPayment($id) {
		global $con;
		$sql = 'SELECT * FROM payment WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		if ($result) {
			$payment = new Payment();
			$payment->setId(result[0]);
			$payment->setPerson_id(result[1]);
			$payment->setMortgage_id(result[2]);
			$payment->setAmount(result[3]);
			$payment->setDate(result[4]);
			$payment->setTime(result[5]);
			$payment->setOffice_id(result[6]);
			$payment->setWhen_authorized(result[7]);
			$payment->setAdmin_id(result[8]);
		} else {
			$payment = false
		}
		return $payment;
	}// end function

	public function updatePayment($payment) {
		global $con;
		$fieldsString = csvString($fields);
		$sql = 'INSERT INTO payment VALUES (' . $valueString . ')  WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		return $result;
	}// end function

	public function deletePayment($id) {
		global $con;
		$sql = 'DELETE FROM payment WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		return $result;
	}// end function

	public function listPayment() {
		global $con;
		$sql = 'SELECT * FROM payment';
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		if ($result) {
			$payments = array();
			while($result = mysql_fetch_array($results)) {
				$payment = new Payment();
				$payment->setId(result[0]);
				$payment->setPerson(readPerson(result[1]));
				$payment->setMortgage(readMortgage(result[2]));
				$payment->setAmount(result[3]);
				$payment->setDate(result[4]);
				$payment->setTime(result[5]);
				$payment->setOffice(readOffice(result[6]));
				$payment->setWhen_authorized(result[7]);
				$payment->setAdmin(readAdmin(result[8]));
				$payments[] = $payment;
			}// end while
		} else {
			$payment = false
		}
		return $payment;
	}// end function

	// person // --------------------

	public function createPerson($person) {
		global $con;
		$fieldsString = csvObject($person);
		$valuesString = csvString($person);
		$sql = 'INSERT INTO ' . $tableTitle . '(' . $fieldsString . ') VALUES (' . $valuesString . ')';
		$this->open();
		$result = mysql_query($sql, $con);
		$id = ($result) ? mysql_insert_id() : $result;
		$this->close();
		return $id;
	}// end function

	public function readPerson($id) {
		global $con;
		$sql = 'SELECT * FROM person WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		if ($result) {
			$person = new Person();
			$person->setId(result[0]);
			$person->setTitle(result[1]);
			$person->setFirst_name(result[2]);
			$person->setLast_name(result[3]);
			$person->setGender(result[4]);
			$person->setDob(result[5]);
			$person->setMarital_status_id(result[6]);
			$person->setContact_id(result[7]);
		} else {
			$person = false
		}
		return $person;
	}// end function

	public function updatePerson($person) {
		global $con;
		$fieldsString = csvString($fields);
		$sql = 'INSERT INTO person VALUES (' . $valueString . ')  WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		return $result;
	}// end function

	public function deletePerson($id) {
		global $con;
		$sql = 'DELETE FROM person WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		return $result;
	}// end function

	public function listPerson() {
		global $con;
		$sql = 'SELECT * FROM person';
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		if ($result) {
			$persons = array();
			while($result = mysql_fetch_array($results)) {
				$person = new Person();
				$person->setId(result[0]);
				$person->setTitle(result[1]);
				$person->setFirst_name(result[2]);
				$person->setLast_name(result[3]);
				$person->setGender(result[4]);
				$person->setDob(result[5]);
				$person->setMarital_status(readMarital_status(result[6]));
				$person->setContact(readContact(result[7]));
				$persons[] = $person;
			}// end while
		} else {
			$person = false
		}
		return $person;
	}// end function

	// personal_donation // --------------------

	public function createPersonal_donation($personal_donation) {
		global $con;
		$fieldsString = csvObject($personal_donation);
		$valuesString = csvString($personal_donation);
		$sql = 'INSERT INTO ' . $tableTitle . '(' . $fieldsString . ') VALUES (' . $valuesString . ')';
		$this->open();
		$result = mysql_query($sql, $con);
		$id = ($result) ? mysql_insert_id() : $result;
		$this->close();
		return $id;
	}// end function

	public function readPersonal_donation($id) {
		global $con;
		$sql = 'SELECT * FROM personal_donation WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		if ($result) {
			$personal_donation = new Personal_donation();
			$personal_donation->setId(result[0]);
			$personal_donation->setDonation_id(result[1]);
			$personal_donation->setPerson_id(result[2]);
		} else {
			$personal_donation = false
		}
		return $personal_donation;
	}// end function

	public function updatePersonal_donation($personal_donation) {
		global $con;
		$fieldsString = csvString($fields);
		$sql = 'INSERT INTO personal_donation VALUES (' . $valueString . ')  WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		return $result;
	}// end function

	public function deletePersonal_donation($id) {
		global $con;
		$sql = 'DELETE FROM personal_donation WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		return $result;
	}// end function

	public function listPersonal_donation() {
		global $con;
		$sql = 'SELECT * FROM personal_donation';
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		if ($result) {
			$personal_donations = array();
			while($result = mysql_fetch_array($results)) {
				$personal_donation = new Personal_donation();
				$personal_donation->setId(result[0]);
				$personal_donation->setDonation(readDonation(result[1]));
				$personal_donation->setPerson(readPerson(result[2]));
				$personal_donations[] = $personal_donation;
			}// end while
		} else {
			$personal_donation = false
		}
		return $personal_donation;
	}// end function

	// photo_id // --------------------

	public function createPhoto_id($photo_id) {
		global $con;
		$fieldsString = csvObject($photo_id);
		$valuesString = csvString($photo_id);
		$sql = 'INSERT INTO ' . $tableTitle . '(' . $fieldsString . ') VALUES (' . $valuesString . ')';
		$this->open();
		$result = mysql_query($sql, $con);
		$id = ($result) ? mysql_insert_id() : $result;
		$this->close();
		return $id;
	}// end function

	public function readPhoto_id($id) {
		global $con;
		$sql = 'SELECT * FROM photo_id WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		if ($result) {
			$photo_id = new Photo_id();
			$photo_id->setPerson_id(result[0]);
			$photo_id->setPhoto_id(result[1]);
		} else {
			$photo_id = false
		}
		return $photo_id;
	}// end function

	public function updatePhoto_id($photo_id) {
		global $con;
		$fieldsString = csvString($fields);
		$sql = 'INSERT INTO photo_id VALUES (' . $valueString . ')  WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		return $result;
	}// end function

	public function deletePhoto_id($id) {
		global $con;
		$sql = 'DELETE FROM photo_id WHERE person_id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		return $result;
	}// end function

	public function listPhoto_id() {
		global $con;
		$sql = 'SELECT * FROM photo_id';
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		if ($result) {
			$photo_ids = array();
			while($result = mysql_fetch_array($results)) {
				$photo_id = new Photo_id();
				$photo_id->setPerson(readPerson(result[0]));
				$photo_id->setPhoto(readPhoto(result[1]));
				$photo_ids[] = $photo_id;
			}// end while
		} else {
			$photo_id = false
		}
		return $photo_id;
	}// end function

	// project // --------------------

	public function createProject($project) {
		global $con;
		$fieldsString = csvObject($project);
		$valuesString = csvString($project);
		$sql = 'INSERT INTO ' . $tableTitle . '(' . $fieldsString . ') VALUES (' . $valuesString . ')';
		$this->open();
		$result = mysql_query($sql, $con);
		$id = ($result) ? mysql_insert_id() : $result;
		$this->close();
		return $id;
	}// end function

	public function readProject($id) {
		global $con;
		$sql = 'SELECT * FROM project WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		if ($result) {
			$project = new Project();
			$project->setId(result[0]);
			$project->setIs_active(result[1]);
			$project->setMunicipality_id(result[2]);
			$project->setSponsor_id(result[3]);
			$project->setDate_of_origin(result[4]);
			$project->setStart_date(result[5]);
			$project->setEstimated_completion_date(result[6]);
			$project->setActual_completion_date(result[7]);
			$project->setDescription(result[8]);
			$project->setExtimated_valutation(result[9]);
			$project->setEstimated_purchase(result[10]);
			$project->setEstimated_rehab(result[11]);
			$project->setEstimated_Pre-Acq(result[12]);
			$project->setActual_pre_acq(result[13]);
			$project->setEstimated_sponser_value(result[14]);
			$project->setEstimated_donation_value(result[15]);
			$project->setEstimated_sell_price(result[16]);
			$project->setEstimated_volunteer_hours(result[17]);
			$project->setEstimated_purchase_cost(result[18]);
			$project->setActual_purchase_cost(result[19]);
			$project->setMaterials_budger(result[20]);
			$project->setLabor_budget(result[21]);
			$project->setSubContract_budget(result[22]);
			$project->setIndirectAllocation_budget(result[23]);
			$project->setBuyer_hours_required(result[24]);
			$project->setEstimated_selling_price(result[25]);
			$project->setActual_appraisal_value(result[26]);
			$project->setActual_sell_price(result[27]);
		} else {
			$project = false
		}
		return $project;
	}// end function

	public function updateProject($project) {
		global $con;
		$fieldsString = csvString($fields);
		$sql = 'INSERT INTO project VALUES (' . $valueString . ')  WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		return $result;
	}// end function

	public function deleteProject($id) {
		global $con;
		$sql = 'DELETE FROM project WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		return $result;
	}// end function

	public function listProject() {
		global $con;
		$sql = 'SELECT * FROM project';
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		if ($result) {
			$projects = array();
			while($result = mysql_fetch_array($results)) {
				$project = new Project();
				$project->setId(result[0]);
				$project->setIs_active(result[1]);
				$project->setMunicipality(readMunicipality(result[2]));
				$project->setSponsor(readSponsor(result[3]));
				$project->setDate_of_origin(result[4]);
				$project->setStart_date(result[5]);
				$project->setEstimated_completion_date(result[6]);
				$project->setActual_completion_date(result[7]);
				$project->setDescription(result[8]);
				$project->setExtimated_valutation(result[9]);
				$project->setEstimated_purchase(result[10]);
				$project->setEstimated_rehab(result[11]);
				$project->setEstimated_Pre-Acq(result[12]);
				$project->setActual_pre_acq(result[13]);
				$project->setEstimated_sponser_value(result[14]);
				$project->setEstimated_donation_value(result[15]);
				$project->setEstimated_sell_price(result[16]);
				$project->setEstimated_volunteer_hours(result[17]);
				$project->setEstimated_purchase_cost(result[18]);
				$project->setActual_purchase_cost(result[19]);
				$project->setMaterials_budger(result[20]);
				$project->setLabor_budget(result[21]);
				$project->setSubContract_budget(result[22]);
				$project->setIndirectAllocation_budget(result[23]);
				$project->setBuyer_hours_required(result[24]);
				$project->setEstimated_selling_price(result[25]);
				$project->setActual_appraisal_value(result[26]);
				$project->setActual_sell_price(result[27]);
				$projects[] = $project;
			}// end while
		} else {
			$project = false
		}
		return $project;
	}// end function

	// project_donation // --------------------

	public function createProject_donation($project_donation) {
		global $con;
		$fieldsString = csvObject($project_donation);
		$valuesString = csvString($project_donation);
		$sql = 'INSERT INTO ' . $tableTitle . '(' . $fieldsString . ') VALUES (' . $valuesString . ')';
		$this->open();
		$result = mysql_query($sql, $con);
		$id = ($result) ? mysql_insert_id() : $result;
		$this->close();
		return $id;
	}// end function

	public function readProject_donation($id) {
		global $con;
		$sql = 'SELECT * FROM project_donation WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		if ($result) {
			$project_donation = new Project_donation();
			$project_donation->setId(result[0]);
			$project_donation->setProject_id(result[1]);
			$project_donation->setDonation_id(result[2]);
		} else {
			$project_donation = false
		}
		return $project_donation;
	}// end function

	public function updateProject_donation($project_donation) {
		global $con;
		$fieldsString = csvString($fields);
		$sql = 'INSERT INTO project_donation VALUES (' . $valueString . ')  WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		return $result;
	}// end function

	public function deleteProject_donation($id) {
		global $con;
		$sql = 'DELETE FROM project_donation WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		return $result;
	}// end function

	public function listProject_donation() {
		global $con;
		$sql = 'SELECT * FROM project_donation';
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		if ($result) {
			$project_donations = array();
			while($result = mysql_fetch_array($results)) {
				$project_donation = new Project_donation();
				$project_donation->setId(result[0]);
				$project_donation->setProject(readProject(result[1]));
				$project_donation->setDonation(readDonation(result[2]));
				$project_donations[] = $project_donation;
			}// end while
		} else {
			$project_donation = false
		}
		return $project_donation;
	}// end function

	// project_event // --------------------

	public function createProject_event($project_event) {
		global $con;
		$fieldsString = csvObject($project_event);
		$valuesString = csvString($project_event);
		$sql = 'INSERT INTO ' . $tableTitle . '(' . $fieldsString . ') VALUES (' . $valuesString . ')';
		$this->open();
		$result = mysql_query($sql, $con);
		$id = ($result) ? mysql_insert_id() : $result;
		$this->close();
		return $id;
	}// end function

	public function readProject_event($id) {
		global $con;
		$sql = 'SELECT * FROM project_event WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		if ($result) {
			$project_event = new Project_event();
			$project_event->setEvent_id(result[0]);
			$project_event->setProject_id(result[1]);
		} else {
			$project_event = false
		}
		return $project_event;
	}// end function

	public function updateProject_event($project_event) {
		global $con;
		$fieldsString = csvString($fields);
		$sql = 'INSERT INTO project_event VALUES (' . $valueString . ')  WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		return $result;
	}// end function

	public function deleteProject_event($id) {
		global $con;
		$sql = 'DELETE FROM project_event WHERE event_id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		return $result;
	}// end function

	public function listProject_event() {
		global $con;
		$sql = 'SELECT * FROM project_event';
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		if ($result) {
			$project_events = array();
			while($result = mysql_fetch_array($results)) {
				$project_event = new Project_event();
				$project_event->setEvent(readEvent(result[0]));
				$project_event->setProject(readProject(result[1]));
				$project_events[] = $project_event;
			}// end while
		} else {
			$project_event = false
		}
		return $project_event;
	}// end function

	// project_expenses // --------------------

	public function createProject_expenses($project_expenses) {
		global $con;
		$fieldsString = csvObject($project_expenses);
		$valuesString = csvString($project_expenses);
		$sql = 'INSERT INTO ' . $tableTitle . '(' . $fieldsString . ') VALUES (' . $valuesString . ')';
		$this->open();
		$result = mysql_query($sql, $con);
		$id = ($result) ? mysql_insert_id() : $result;
		$this->close();
		return $id;
	}// end function

	public function readProject_expenses($id) {
		global $con;
		$sql = 'SELECT * FROM project_expenses WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		if ($result) {
			$project_expenses = new Project_expenses();
			$project_expenses->setId(result[0]);
			$project_expenses->setTitle(result[1]);
			$project_expenses->setDescription(result[2]);
			$project_expenses->setProject_id(result[3]);
			$project_expenses->setType_id(result[4]);
			$project_expenses->setAmount(result[5]);
			$project_expenses->setWhen_entered(result[6]);
			$project_expenses->setOffice_id(result[7]);
			$project_expenses->setWhen_authorized(result[8]);
			$project_expenses->setAdmin_id(result[9]);
		} else {
			$project_expenses = false
		}
		return $project_expenses;
	}// end function

	public function updateProject_expenses($project_expenses) {
		global $con;
		$fieldsString = csvString($fields);
		$sql = 'INSERT INTO project_expenses VALUES (' . $valueString . ')  WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		return $result;
	}// end function

	public function deleteProject_expenses($id) {
		global $con;
		$sql = 'DELETE FROM project_expenses WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		return $result;
	}// end function

	public function listProject_expenses() {
		global $con;
		$sql = 'SELECT * FROM project_expenses';
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		if ($result) {
			$project_expensess = array();
			while($result = mysql_fetch_array($results)) {
				$project_expenses = new Project_expenses();
				$project_expenses->setId(result[0]);
				$project_expenses->setTitle(result[1]);
				$project_expenses->setDescription(result[2]);
				$project_expenses->setProject(readProject(result[3]));
				$project_expenses->setType(readType(result[4]));
				$project_expenses->setAmount(result[5]);
				$project_expenses->setWhen_entered(result[6]);
				$project_expenses->setOffice(readOffice(result[7]));
				$project_expenses->setWhen_authorized(result[8]);
				$project_expenses->setAdmin(readAdmin(result[9]));
				$project_expensess[] = $project_expenses;
			}// end while
		} else {
			$project_expenses = false
		}
		return $project_expenses;
	}// end function

	// project_status // --------------------

	public function createProject_status($project_status) {
		global $con;
		$fieldsString = csvObject($project_status);
		$valuesString = csvString($project_status);
		$sql = 'INSERT INTO ' . $tableTitle . '(' . $fieldsString . ') VALUES (' . $valuesString . ')';
		$this->open();
		$result = mysql_query($sql, $con);
		$id = ($result) ? mysql_insert_id() : $result;
		$this->close();
		return $id;
	}// end function

	public function readProject_status($id) {
		global $con;
		$sql = 'SELECT * FROM project_status WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		if ($result) {
			$project_status = new Project_status();
			$project_status->setId(result[0]);
			$project_status->setTitle(result[1]);
			$project_status->setDescription(result[2]);
			$project_status->setAbbreviation(result[3]);
		} else {
			$project_status = false
		}
		return $project_status;
	}// end function

	public function updateProject_status($project_status) {
		global $con;
		$fieldsString = csvString($fields);
		$sql = 'INSERT INTO project_status VALUES (' . $valueString . ')  WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		return $result;
	}// end function

	public function deleteProject_status($id) {
		global $con;
		$sql = 'DELETE FROM project_status WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		return $result;
	}// end function

	public function listProject_status() {
		global $con;
		$sql = 'SELECT * FROM project_status';
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		if ($result) {
			$project_statuss = array();
			while($result = mysql_fetch_array($results)) {
				$project_status = new Project_status();
				$project_status->setId(result[0]);
				$project_status->setTitle(result[1]);
				$project_status->setDescription(result[2]);
				$project_status->setAbbreviation(result[3]);
				$project_statuss[] = $project_status;
			}// end while
		} else {
			$project_status = false
		}
		return $project_status;
	}// end function

	// recovery_log // --------------------

	public function createRecovery_log($recovery_log) {
		global $con;
		$fieldsString = csvObject($recovery_log);
		$valuesString = csvString($recovery_log);
		$sql = 'INSERT INTO ' . $tableTitle . '(' . $fieldsString . ') VALUES (' . $valuesString . ')';
		$this->open();
		$result = mysql_query($sql, $con);
		$id = ($result) ? mysql_insert_id() : $result;
		$this->close();
		return $id;
	}// end function

	public function readRecovery_log($id) {
		global $con;
		$sql = 'SELECT * FROM recovery_log WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		if ($result) {
			$recovery_log = new Recovery_log();
			$recovery_log->setAccount_id(result[0]);
			$recovery_log->setDate(result[1]);
			$recovery_log->setTime(result[2]);
		} else {
			$recovery_log = false
		}
		return $recovery_log;
	}// end function

	public function updateRecovery_log($recovery_log) {
		global $con;
		$fieldsString = csvString($fields);
		$sql = 'INSERT INTO recovery_log VALUES (' . $valueString . ')  WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		return $result;
	}// end function

	public function deleteRecovery_log($id) {
		global $con;
		$sql = 'DELETE FROM recovery_log WHERE account_id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		return $result;
	}// end function

	public function listRecovery_log() {
		global $con;
		$sql = 'SELECT * FROM recovery_log';
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		if ($result) {
			$recovery_logs = array();
			while($result = mysql_fetch_array($results)) {
				$recovery_log = new Recovery_log();
				$recovery_log->setAccount(readAccount(result[0]));
				$recovery_log->setDate(result[1]);
				$recovery_log->setTime(result[2]);
				$recovery_logs[] = $recovery_log;
			}// end while
		} else {
			$recovery_log = false
		}
		return $recovery_log;
	}// end function

	// requirement // --------------------

	public function createRequirement($requirement) {
		global $con;
		$fieldsString = csvObject($requirement);
		$valuesString = csvString($requirement);
		$sql = 'INSERT INTO ' . $tableTitle . '(' . $fieldsString . ') VALUES (' . $valuesString . ')';
		$this->open();
		$result = mysql_query($sql, $con);
		$id = ($result) ? mysql_insert_id() : $result;
		$this->close();
		return $id;
	}// end function

	public function readRequirement($id) {
		global $con;
		$sql = 'SELECT * FROM requirement WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		if ($result) {
			$requirement = new Requirement();
			$requirement->setId(result[0]);
			$requirement->setTitle(result[1]);
			$requirement->setDescription(result[2]);
		} else {
			$requirement = false
		}
		return $requirement;
	}// end function

	public function updateRequirement($requirement) {
		global $con;
		$fieldsString = csvString($fields);
		$sql = 'INSERT INTO requirement VALUES (' . $valueString . ')  WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		return $result;
	}// end function

	public function deleteRequirement($id) {
		global $con;
		$sql = 'DELETE FROM requirement WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		return $result;
	}// end function

	public function listRequirement() {
		global $con;
		$sql = 'SELECT * FROM requirement';
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		if ($result) {
			$requirements = array();
			while($result = mysql_fetch_array($results)) {
				$requirement = new Requirement();
				$requirement->setId(result[0]);
				$requirement->setTitle(result[1]);
				$requirement->setDescription(result[2]);
				$requirements[] = $requirement;
			}// end while
		} else {
			$requirement = false
		}
		return $requirement;
	}// end function

	// schedule // --------------------

	public function createSchedule($schedule) {
		global $con;
		$fieldsString = csvObject($schedule);
		$valuesString = csvString($schedule);
		$sql = 'INSERT INTO ' . $tableTitle . '(' . $fieldsString . ') VALUES (' . $valuesString . ')';
		$this->open();
		$result = mysql_query($sql, $con);
		$id = ($result) ? mysql_insert_id() : $result;
		$this->close();
		return $id;
	}// end function

	public function readSchedule($id) {
		global $con;
		$sql = 'SELECT * FROM schedule WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		if ($result) {
			$schedule = new Schedule();
			$schedule->setId(result[0]);
			$schedule->setSchedule_id(result[1]);
			$schedule->setStart_time(result[2]);
			$schedule->setEnd_time(result[3]);
			$schedule->setDescription(result[4]);
			$schedule->setInterest_id(result[5]);
			$schedule->setMax_num_people(result[6]);
		} else {
			$schedule = false
		}
		return $schedule;
	}// end function

	public function updateSchedule($schedule) {
		global $con;
		$fieldsString = csvString($fields);
		$sql = 'INSERT INTO schedule VALUES (' . $valueString . ')  WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		return $result;
	}// end function

	public function deleteSchedule($id) {
		global $con;
		$sql = 'DELETE FROM schedule WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		return $result;
	}// end function

	public function listSchedule() {
		global $con;
		$sql = 'SELECT * FROM schedule';
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		if ($result) {
			$schedules = array();
			while($result = mysql_fetch_array($results)) {
				$schedule = new Schedule();
				$schedule->setId(result[0]);
				$schedule->setSchedule(readSchedule(result[1]));
				$schedule->setStart_time(result[2]);
				$schedule->setEnd_time(result[3]);
				$schedule->setDescription(result[4]);
				$schedule->setInterest(readInterest(result[5]));
				$schedule->setMax_num_people(result[6]);
				$schedules[] = $schedule;
			}// end while
		} else {
			$schedule = false
		}
		return $schedule;
	}// end function

	// serves_on // --------------------

	public function createServes_on($serves_on) {
		global $con;
		$fieldsString = csvObject($serves_on);
		$valuesString = csvString($serves_on);
		$sql = 'INSERT INTO ' . $tableTitle . '(' . $fieldsString . ') VALUES (' . $valuesString . ')';
		$this->open();
		$result = mysql_query($sql, $con);
		$id = ($result) ? mysql_insert_id() : $result;
		$this->close();
		return $id;
	}// end function

	public function readServes_on($id) {
		global $con;
		$sql = 'SELECT * FROM serves_on WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		if ($result) {
			$serves_on = new Serves_on();
			$serves_on->setVolunteer_id(result[0]);
			$serves_on->setCommittee_id(result[1]);
			$serves_on->setIs_officer(result[2]);
		} else {
			$serves_on = false
		}
		return $serves_on;
	}// end function

	public function updateServes_on($serves_on) {
		global $con;
		$fieldsString = csvString($fields);
		$sql = 'INSERT INTO serves_on VALUES (' . $valueString . ')  WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		return $result;
	}// end function

	public function deleteServes_on($id) {
		global $con;
		$sql = 'DELETE FROM serves_on WHERE volunteer_id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		return $result;
	}// end function

	public function listServes_on() {
		global $con;
		$sql = 'SELECT * FROM serves_on';
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		if ($result) {
			$serves_ons = array();
			while($result = mysql_fetch_array($results)) {
				$serves_on = new Serves_on();
				$serves_on->setVolunteer(readVolunteer(result[0]));
				$serves_on->setCommittee(readCommittee(result[1]));
				$serves_on->setIs_officer(result[2]);
				$serves_ons[] = $serves_on;
			}// end while
		} else {
			$serves_on = false
		}
		return $serves_on;
	}// end function

	// state // --------------------

	public function createState($state) {
		global $con;
		$fieldsString = csvObject($state);
		$valuesString = csvString($state);
		$sql = 'INSERT INTO ' . $tableTitle . '(' . $fieldsString . ') VALUES (' . $valuesString . ')';
		$this->open();
		$result = mysql_query($sql, $con);
		$id = ($result) ? mysql_insert_id() : $result;
		$this->close();
		return $id;
	}// end function

	public function readState($id) {
		global $con;
		$sql = 'SELECT * FROM state WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		if ($result) {
			$state = new State();
			$state->setId(result[0]);
			$state->setAbbreviation(result[1]);
			$state->setTitle(result[2]);
		} else {
			$state = false
		}
		return $state;
	}// end function

	public function updateState($state) {
		global $con;
		$fieldsString = csvString($fields);
		$sql = 'INSERT INTO state VALUES (' . $valueString . ')  WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		return $result;
	}// end function

	public function deleteState($id) {
		global $con;
		$sql = 'DELETE FROM state WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		return $result;
	}// end function

	public function listState() {
		global $con;
		$sql = 'SELECT * FROM state';
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		if ($result) {
			$states = array();
			while($result = mysql_fetch_array($results)) {
				$state = new State();
				$state->setId(result[0]);
				$state->setAbbreviation(result[1]);
				$state->setTitle(result[2]);
				$states[] = $state;
			}// end while
		} else {
			$state = false
		}
		return $state;
	}// end function

	// status_change // --------------------

	public function createStatus_change($status_change) {
		global $con;
		$fieldsString = csvObject($status_change);
		$valuesString = csvString($status_change);
		$sql = 'INSERT INTO ' . $tableTitle . '(' . $fieldsString . ') VALUES (' . $valuesString . ')';
		$this->open();
		$result = mysql_query($sql, $con);
		$id = ($result) ? mysql_insert_id() : $result;
		$this->close();
		return $id;
	}// end function

	public function readStatus_change($id) {
		global $con;
		$sql = 'SELECT * FROM status_change WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		if ($result) {
			$status_change = new Status_change();
			$status_change->setProject_id(result[0]);
			$status_change->setStatus_id(result[1]);
			$status_change->setWhen_changed(result[2]);
		} else {
			$status_change = false
		}
		return $status_change;
	}// end function

	public function updateStatus_change($status_change) {
		global $con;
		$fieldsString = csvString($fields);
		$sql = 'INSERT INTO status_change VALUES (' . $valueString . ')  WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		return $result;
	}// end function

	public function deleteStatus_change($id) {
		global $con;
		$sql = 'DELETE FROM status_change WHERE project_id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		return $result;
	}// end function

	public function listStatus_change() {
		global $con;
		$sql = 'SELECT * FROM status_change';
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		if ($result) {
			$status_changes = array();
			while($result = mysql_fetch_array($results)) {
				$status_change = new Status_change();
				$status_change->setProject(readProject(result[0]));
				$status_change->setStatus(readStatus(result[1]));
				$status_change->setWhen_changed(result[2]);
				$status_changes[] = $status_change;
			}// end while
		} else {
			$status_change = false
		}
		return $status_change;
	}// end function

	// tickets // --------------------

	public function createTickets($tickets) {
		global $con;
		$fieldsString = csvObject($tickets);
		$valuesString = csvString($tickets);
		$sql = 'INSERT INTO ' . $tableTitle . '(' . $fieldsString . ') VALUES (' . $valuesString . ')';
		$this->open();
		$result = mysql_query($sql, $con);
		$id = ($result) ? mysql_insert_id() : $result;
		$this->close();
		return $id;
	}// end function

	public function readTickets($id) {
		global $con;
		$sql = 'SELECT * FROM tickets WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		if ($result) {
			$tickets = new Tickets();
			$tickets->setEvent_id(result[0]);
			$tickets->setId(result[1]);
			$tickets->setTicket_price(result[2]);
			$tickets->setMax_num(result[3]);
			$tickets->setCurrent_num(result[4]);
		} else {
			$tickets = false
		}
		return $tickets;
	}// end function

	public function updateTickets($tickets) {
		global $con;
		$fieldsString = csvString($fields);
		$sql = 'INSERT INTO tickets VALUES (' . $valueString . ')  WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		return $result;
	}// end function

	public function deleteTickets($id) {
		global $con;
		$sql = 'DELETE FROM tickets WHERE event_id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		return $result;
	}// end function

	public function listTickets() {
		global $con;
		$sql = 'SELECT * FROM tickets';
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		if ($result) {
			$ticketss = array();
			while($result = mysql_fetch_array($results)) {
				$tickets = new Tickets();
				$tickets->setEvent(readEvent(result[0]));
				$tickets->setId(result[1]);
				$tickets->setTicket_price(result[2]);
				$tickets->setMax_num(result[3]);
				$tickets->setCurrent_num(result[4]);
				$ticketss[] = $tickets;
			}// end while
		} else {
			$tickets = false
		}
		return $tickets;
	}// end function

	// volunteer // --------------------

	public function createVolunteer($volunteer) {
		global $con;
		$fieldsString = csvObject($volunteer);
		$valuesString = csvString($volunteer);
		$sql = 'INSERT INTO ' . $tableTitle . '(' . $fieldsString . ') VALUES (' . $valuesString . ')';
		$this->open();
		$result = mysql_query($sql, $con);
		$id = ($result) ? mysql_insert_id() : $result;
		$this->close();
		return $id;
	}// end function

	public function readVolunteer($id) {
		global $con;
		$sql = 'SELECT * FROM volunteer WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		if ($result) {
			$volunteer = new Volunteer();
			$volunteer->setId(result[0]);
			$volunteer->setPerson_id(result[1]);
			$volunteer->setConsent_age(result[2]);
			$volunteer->setConsent_video(result[3]);
			$volunteer->setConsent_waiver(result[4]);
			$volunteer->setConsent_photo(result[5]);
			$volunteer->setConsent_minor(result[6]);
			$volunteer->setConsent_safety(result[7]);
			$volunteer->setAvail_day(result[8]);
			$volunteer->setAvail_eve(result[9]);
			$volunteer->setAvail_wkend(result[10]);
			$volunteer->setEmergency_name(result[11]);
			$volunteer->setEmergency_phone(result[12]);
		} else {
			$volunteer = false
		}
		return $volunteer;
	}// end function

	public function updateVolunteer($volunteer) {
		global $con;
		$fieldsString = csvString($fields);
		$sql = 'INSERT INTO volunteer VALUES (' . $valueString . ')  WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		return $result;
	}// end function

	public function deleteVolunteer($id) {
		global $con;
		$sql = 'DELETE FROM volunteer WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		return $result;
	}// end function

	public function listVolunteer() {
		global $con;
		$sql = 'SELECT * FROM volunteer';
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		if ($result) {
			$volunteers = array();
			while($result = mysql_fetch_array($results)) {
				$volunteer = new Volunteer();
				$volunteer->setId(result[0]);
				$volunteer->setPerson(readPerson(result[1]));
				$volunteer->setConsent_age(result[2]);
				$volunteer->setConsent_video(result[3]);
				$volunteer->setConsent_waiver(result[4]);
				$volunteer->setConsent_photo(result[5]);
				$volunteer->setConsent_minor(result[6]);
				$volunteer->setConsent_safety(result[7]);
				$volunteer->setAvail_day(result[8]);
				$volunteer->setAvail_eve(result[9]);
				$volunteer->setAvail_wkend(result[10]);
				$volunteer->setEmergency_name(result[11]);
				$volunteer->setEmergency_phone(result[12]);
				$volunteers[] = $volunteer;
			}// end while
		} else {
			$volunteer = false
		}
		return $volunteer;
	}// end function

	// work // --------------------

	public function createWork($work) {
		global $con;
		$fieldsString = csvObject($work);
		$valuesString = csvString($work);
		$sql = 'INSERT INTO ' . $tableTitle . '(' . $fieldsString . ') VALUES (' . $valuesString . ')';
		$this->open();
		$result = mysql_query($sql, $con);
		$id = ($result) ? mysql_insert_id() : $result;
		$this->close();
		return $id;
	}// end function

	public function readWork($id) {
		global $con;
		$sql = 'SELECT * FROM work WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		if ($result) {
			$work = new Work();
			$work->setId(result[0]);
			$work->setVolunteer_id(result[1]);
			$work->setDate(result[2]);
			$work->setEvent_id(result[3]);
			$work->setWhen_entered(result[4]);
			$work->setOffice_id(result[5]);
			$work->setWhen_authorized(result[6]);
			$work->setAdmin_id(result[7]);
			$work->setHours_worked(result[8]);
		} else {
			$work = false
		}
		return $work;
	}// end function

	public function updateWork($work) {
		global $con;
		$fieldsString = csvString($fields);
		$sql = 'INSERT INTO work VALUES (' . $valueString . ')  WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		return $result;
	}// end function

	public function deleteWork($id) {
		global $con;
		$sql = 'DELETE FROM work WHERE id = ' . $id;
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		return $result;
	}// end function

	public function listWork() {
		global $con;
		$sql = 'SELECT * FROM work';
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		if ($result) {
			$works = array();
			while($result = mysql_fetch_array($results)) {
				$work = new Work();
				$work->setId(result[0]);
				$work->setVolunteer(readVolunteer(result[1]));
				$work->setDate(result[2]);
				$work->setEvent(readEvent(result[3]));
				$work->setWhen_entered(result[4]);
				$work->setOffice(readOffice(result[5]));
				$work->setWhen_authorized(result[6]);
				$work->setAdmin(readAdmin(result[7]));
				$work->setHours_worked(result[8]);
				$works[] = $work;
			}// end while
		} else {
			$work = false
		}
		return $work;
	}// end function


?>