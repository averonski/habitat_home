<?php

    // TITLE: Database Model
    // FILE: model/dbio.php
    // AUTHOR: AUTOGEN


    class DBIO {
        
        // ATTRIBUTES /////////////////////////////////////////////////////////////////////////////

        protected $con;


        // CONSTRUCTOR ////////////////////////////////////////////////////////////////////////////

        public function __construct() {}


        // METHODS ////////////////////////////////////////////////////////////////////////////////

        //This open function is used to connect to the habitat mySQL database.
        //This is connected to a computer that was running at penn state york
        //untill that machine is again running. The database will be located on averonski's pc
        /*function open() {
                $hostname="128.118.31.16:3306";
                $username="remote";
                $password="password";
                $dbname="homes_db";

                 global $con;
                 $con = mysql_connect($hostname,$username, $password) or die ("no worky");
                 mysql_select_db($dbname);
        }// END*/

        function open() {
                $hostname="73.52.51.66";
                $username="habitat";
                $password="habitat";
                $dbname="homes_db";

                 global $con;
                 $con = mysql_connect($hostname,$username,$password) or die ("no worky");
                 mysql_select_db($dbname);
        }// END


        function close() {
                global $con;
                mysql_close($con);
        }// END




        /*
                requires: array of values, left char, right char: most often the left and right chars will be the same
                returns: sring of CSV
                the $l and $r are the left and right chars that will contain the data
                EXAMPLE: 'a', 'b', 'c', 'd'OR- 1, 2, 3, 4OR- ('a'), ('b'), ('c'), ('d')
                use '\'' to enclose the data in single quotes
        */
        function superStringIt($values, $l, $r) {
                $size = count($values);
                if ($size > 0) {
                        $itemString = ($l . $values[0] . $r);
                        for ($i = 1; $i < $size; $i++) {
                                $itemString .= (',' . $l . $values[$i] . $r);
                        }
                } else {
                        echo 'ERROR: dbio.stringIt.$size <= 0';
                        exit();
                }
                return $itemString;
        }// end function
        
        // login // ---------------------
        //This section likely will need to be comepletly be redone. there are all kind of issues with the logic.
        public function getLogin($user,$pw){
            if(empty($user) || empty($pw)) {
                return 1;
            }
            $this->open();
            global $con;
            $sql='SELECT id, email FROM email where email ="'.$user.'"';
            $result=mysql_query($sql,$con);
            $hold=mysql_fetch_row($result);
            $id=$hold[0];
            $email=$hold[1];
            
            $sql2='SELECT email,password FROM account WHERE email="'.$id.'" AND password="'.$pw.'"';
            $results=mysql_query($sql2,$con);
            $final=mysql_fetch_row($results);
            $status=$final[0];
            $this->close();
            
            if (empty($status)){
                return null;
            }else{
                return $email;
            }
        }
        
        public function getPersonIdByUserName($user){

            global $con;
            $this->open();
            
            $sql='SELECT id, email FROM email where email ="'.$user.'"';
            $result=mysql_query($sql,$con);
            $hold=mysql_fetch_row($result);
            $id=$hold[0];
            
            $sql='SELECT person_id FROM Account WHERE email="'. $id .'"';
            $result=mysql_query($sql,$con);
            while($row = mysql_fetch_array($result)) {
                    $pid = $row[0];
            }
            if (empty($pid)) {
                $error = mysql_error();
                return $error;
            }
            $this->close();
            return $pid;
            
        }
        
        public function getAccountType($person_id){

            global $con;
            $sql1='SELECT COUNT(*) FROM admin WHERE person_id="' .$person_id . '"';
            $sql2='SELECT COUNT(*) FROM office WHERE person_id="' .$person_id . '"';
            //$sql3='SELECT isVolunteer FROM Account WHERE person_id=' .$personId;

            $this->open();
            $results1 = mysql_query($sql1,$con);
                $row1 = mysql_fetch_array($results1);
            $results2= mysql_query($sql2,$con);
                $row2 = mysql_fetch_array($results2);
            $this->close();

            if ($row1[0] > 0) {
                    return '1';
            
            }else{
                if($row2[0] > 0){
                //var_dump($rows[0]);
                //if($rows[0]=='1'){
                    return '2';                
                }else{
                    return '3';
                }
            }
        }

        
        // account // --------------------

	public function createAccount($account, $array) {
		global $con;
		$sql = "INSERT INTO account (id, email, password, created, status_id, person_id) VALUES ({$array})";
		$this->open();
		$results = mysql_query($sql, $con);
		$id = ($results) ? mysql_insert_id() : $results;
		$this->close();
		return $id;
	}// end function

	public function readAccount($id) {
		global $con;
		$sql = 'SELECT * FROM account WHERE person_id = ' . $id . '';
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		if ($result) {
				$account = new Account();
				$account->setId($result[0]);
				$account->setEmail($result[1]);
				$account->setPassword($result[2]);
				$account->setCreated($result[3]);
				$account->setStatus($this->readStatus_change($result[4]));
				$account->setPerson($this->readPerson($result[5]));
		} else {
			$account = false;
		}
		return $account;
	}// end function
        
        public function readAccountByName($fName, $lName) {
		global $con;
                if (empty($fName)) {$fName = '%';}
                if (empty($lName)) {$lName = '%';}
                $persons = $this->readPersonByName($fName, $lName);
                    foreach ($persons as $person) {
                        $ids[] = $person->getId();
                    }
                $id = implode(",", $ids);
                $sql = "SELECT * FROM account WHERE person_id IN ({$id})";
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
                    while($result = mysql_fetch_array($results)) {
                        $account = new Account();
                        $account->setId($result[0]);
                        $account->setEmail($this->readEmail($result[1]));
                        $account->setPassword($result[2]);
                        $account->setCreated($result[3]);
                        $account->setStatus($this->readStatus_change($result[4]));
                        $account->setPerson($this->readPerson($result[5]));
                        $accounts[] = $account;
                    }
		} else {
                    $accounts = false;
		}
		return $accounts;
	}// end function

	public function updateAccount($account) {
		global $con;
		$sql = 'UPDATE account SET ($array) WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		return $results;
	}// end function

	public function deleteAccount($id) {
		global $con;
		$sql = 'DELETE FROM account WHERE id = WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		return $results;
	}// end function

	public function listAccount() {
		global $con;
		$sql = 'SELECT * FROM account';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$accounts = array();
			while($result = mysql_fetch_array($results)) {
				$account = new Account();
				$account->setId($result[0]);
				$account->setEmail($this->readEmail($result[1]));
				$account->setPassword($result[2]);
				$account->setCreated($result[3]);
				$account->setStatus($this->readStatus_change($result[4]));
				$account->setPerson($this->readPerson($result[5]));
				$accounts[] = $account;
			}// end while
		} else {
			$accounts = false;
		}
		return $accounts;
	}// end function

	// account_recovery // --------------------

	public function createAccount_recovery($account_recovery, $array) {
		global $con;
		$sql = "INSERT INTO account_recovery (account_id, code, date, time) VALUES ({$array})";
		$this->open();
		$results = mysql_query($sql, $con);
		$id = ($results) ? mysql_insert_id() : $results;
		$this->close();
		return $id;
	}// end function

	public function readAccount_recovery($id) {
		global $con;
		$sql = 'SELECT * FROM account_recovery WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$account_recoverys = array();
			while($result = mysql_fetch_array($results)) {
				$account_recovery = new Account_recovery();
				$account_recovery->setAccount(readAccount($result[0]));
				$account_recovery->setCode($result[1]);
				$account_recovery->setDate($result[2]);
				$account_recovery->setTime($result[3]);
				$account_recoverys[] = $account_recovery;
			}// end while
		} else {
			$account_recovery = false;
		}
		return $account_recovery;
	}// end function

	public function updateAccount_recovery($account_recovery) {
		global $con;
		$sql = 'UPDATE account_recovery SET ($array) WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		return $results;
	}// end function

	public function deleteAccount_recovery($id) {
		global $con;
		$sql = 'DELETE FROM account_recovery WHERE account_id = WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		return $results;
	}// end function

	public function listAccount_recovery() {
		global $con;
		$sql = 'SELECT * FROM account_recovery';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$account_recoverys = array();
			while($result = mysql_fetch_array($results)) {
				$account_recovery = new Account_recovery();
				$account_recovery->setAccount(readAccount($result[0]));
				$account_recovery->setCode($result[1]);
				$account_recovery->setDate($result[2]);
				$account_recovery->setTime($result[3]);
				$account_recoverys[] = $account_recovery;
			}// end while
		} else {
			$account_recovery = false;
		}
		return $account_recovery;
	}// end function

	// account_status // --------------------

	public function createAccount_status($account_status, $array) {
		global $con;
		$sql = "INSERT INTO account_status (id, title, description) VALUES ({$array})";
		$this->open();
		$results = mysql_query($sql, $con);
		$id = ($results) ? mysql_insert_id() : $results;
		$this->close();
		return $id;
	}// end function

	public function readAccount_status($id) {
		global $con;
		$sql = 'SELECT * FROM account_status WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$account_statuss = array();
			while($result = mysql_fetch_array($results)) {
				$account_status = new Account_status();
				$account_status->setId($result[0]);
				$account_status->setTitle($result[1]);
				$account_status->setDescription($result[2]);
				$account_statuss[] = $account_status;
			}// end while
		} else {
			$account_status = false;
		}
		return $account_status;
	}// end function

	public function updateAccount_status($account_status) {
		global $con;
		$sql = 'UPDATE account_status SET ($array) WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		return $results;
	}// end function

	public function deleteAccount_status($id) {
		global $con;
		$sql = 'DELETE FROM account_status WHERE id = WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		return $results;
	}// end function

	public function listAccount_status() {
		global $con;
		$sql = 'SELECT * FROM account_status';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$account_statuss = array();
			while($result = mysql_fetch_array($results)) {
				$account_status = new Account_status();
				$account_status->setId($result[0]);
				$account_status->setTitle($result[1]);
				$account_status->setDescription($result[2]);
				$account_statuss[] = $account_status;
			}// end while
		} else {
			$account_status = false;
		}
		return $account_status;
	}// end function

	// address // --------------------

	public function createAddress($address, $array) {
		global $con;
		$sql = "INSERT INTO address (id, street1, street2, city, state_id, zip) VALUES ({$array})";
		$this->open();
		$results = mysql_query($sql, $con);
		$id = ($results) ? mysql_insert_id() : $results;
		$this->close();
		return $id;
	}// end function

	public function readAddress($id) {
		global $con;
		$sql = 'SELECT * FROM address WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			while($result = mysql_fetch_array($results)) {
				$address = new Address();
				$address->setId($result[0]);
				$address->setStreet1($result[1]);
				$address->setStreet2($result[2]);
				$address->setCity($result[3]);
				$address->setState($this->readState($result[4]));
				$address->setZip($result[5]);
			}// end while
		} else {
			$address = false;
		}
		return $address;
	}// end function

	public function updateAddress($addressId, $address) {
		global $con;
                $street1 = $address->getStreet1();
                $street2 = $address->getStreet2();
                $city = $address->getCity();
                $zip = $address->getZip();
                $stateId = $address->getState();
                $sql = "UPDATE address SET street1 = '{$street1}', street2 = '{$street2}', city = '{$city}', zip = '{$zip}', state_id = '{$stateId}' WHERE id = '{$addressId}';";
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		return $results;
	}// end function

	public function deleteAddress($id) {
		global $con;
		$sql = 'DELETE FROM address WHERE id = WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		return $results;
	}// end function

	public function listAddress() {
		global $con;
		$sql = 'SELECT * FROM address';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$addresss = array();
			while($result = mysql_fetch_array($results)) {
				$address = new Address();
				$address->setId($result[0]);
				$address->setStreet1($result[1]);
				$address->setStreet2($result[2]);
				$address->setCity($result[3]);
				$address->setState($this->readState($result[4]));
				$address->setZip($result[5]);
				$addresss[] = $address;
			}// end while
		} else {
			$address = false;
		}
		return $address;
	}// end function

	// admin // --------------------

	public function createAdmin($admin, $array) {
		global $con;
		$sql = "INSERT INTO admin (id, person_id) VALUES ({$array})";
		$this->open();
		$results = mysql_query($sql, $con);
		$id = ($results) ? mysql_insert_id() : $results;
		$this->close();
		return $id;
	}// end function

	public function readAdmin($id) {
		global $con;
		$sql = 'SELECT * FROM admin WHERE id = ' . $id . '';
		$this->open();
		$result = mysql_query($sql, $con);
		$this->close();
		if ($result) {
				$admin = new Admin();
				$admin->setId($result[0]);
				$admin->setPerson($this->readPerson($result[1]));
		} else {
			$admin = false;
		}
		return $admin;
	}// end function
        
        public function readAdminByPid($pid) {
		global $con;
		$sql = 'SELECT * FROM admin WHERE person_id = ' . $pid . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
                    $result = mysql_fetch_array($results);
				$admin = new Admin();
				$admin->setId($result[0]);
				$admin->setPerson($this->readPerson($result[1]));
		} else {
			$admin = false;
		}
		return $admin;
	}// end function

	public function updateAdmin($admin) {
		global $con;
		$sql = 'UPDATE admin SET ($array) WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		return $results;
	}// end function

	public function deleteAdmin($id) {
		global $con;
		$sql = 'DELETE FROM admin WHERE id = WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		return $results;
	}// end function

	public function listAdmin() {
		global $con;
		$sql = 'SELECT * FROM admin';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$admins = array();
			while($result = mysql_fetch_array($results)) {
				$admin = new Admin();
				$admin->setId($result[0]);
				$admin->setPerson($this->readPerson($result[1]));
				$admins[] = $admin;
			}// end while
		} else {
			$admin = false;
		}
		return $admin;
	}// end function

	// ambassador // --------------------

	public function createAmbassador($ambassador, $array) {
		global $con;
		$sql = "INSERT INTO ambassador (volunteer_id, organization_id, church_ambassador, affiliation) VALUES ({$array})";
		$this->open();
		$results = mysql_query($sql, $con);
		$id = ($results) ? mysql_insert_id() : $results;
		$this->close();
		return $id;
	}// end function

	public function readAmbassador($id) {
		global $con;
		$sql = 'SELECT * FROM ambassador WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$ambassadors = array();
			while($result = mysql_fetch_array($results)) {
				$ambassador = new Ambassador();
				$ambassador->setVolunteer($this->readVolunteer($result[0]));
				$ambassador->setOrganization(readOrganization($result[1]));
				$ambassador->setChurch_ambassador($result[2]);
				$ambassador->setAffiliation($result[3]);
				$ambassadors[] = $ambassador;
			}// end while
		} else {
			$ambassador = false;
		}
		return $ambassador;
	}// end function

	public function updateAmbassador($ambassador) {
		global $con;
		$sql = 'UPDATE ambassador SET ($array) WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		return $results;
	}// end function

	public function deleteAmbassador($id) {
		global $con;
		$sql = 'DELETE FROM ambassador WHERE volunteer_id = WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		return $results;
	}// end function

	public function listAmbassador() {
		global $con;
		$sql = 'SELECT * FROM ambassador';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$ambassadors = array();
			while($result = mysql_fetch_array($results)) {
				$ambassador = new Ambassador();
				$ambassador->setVolunteer($this->readVolunteer($result[0]));
				$ambassador->setOrganization(readOrganization($result[1]));
				$ambassador->setChurch_ambassador($result[2]);
				$ambassador->setAffiliation($result[3]);
				$ambassadors[] = $ambassador;
			}// end while
		} else {
			$ambassador = false;
		}
		return $ambassador;
	}// end function

	// auction // --------------------

	public function createAuction($auction, $array) {
		global $con;
		$sql = "INSERT INTO auction (id, event_id) VALUES ({$array})";
		$this->open();
		$results = mysql_query($sql, $con);
		$id = ($results) ? mysql_insert_id() : $results;
		$this->close();
		return $id;
	}// end function

	public function readAuction($id) {
		global $con;
		$sql = 'SELECT * FROM auction WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$auctions = array();
			while($result = mysql_fetch_array($results)) {
				$auction = new Auction();
				$auction->setId($result[0]);
				$auction->setEvent($this->readEvent($result[1]));
				$auctions[] = $auction;
			}// end while
		} else {
			$auction = false;
		}
		return $auction;
	}// end function

	public function updateAuction($auction) {
		global $con;
		$sql = 'UPDATE auction SET ($array) WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		return $results;
	}// end function

	public function deleteAuction($id) {
		global $con;
		$sql = 'DELETE FROM auction WHERE id = WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		return $results;
	}// end function

	public function listAuction() {
		global $con;
		$sql = 'SELECT * FROM auction';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$auctions = array();
			while($result = mysql_fetch_array($results)) {
				$auction = new Auction();
				$auction->setId($result[0]);
				$auction->setEvent($this->readEvent($result[1]));
				$auctions[] = $auction;
			}// end while
		} else {
			$auction = false;
		}
		return $auction;
	}// end function

	// auction_item // --------------------

	public function createAuction_item($auction_item, $array) {
		global $con;
		$sql = "INSERT INTO auction_item (id, auction_id, item_num, title, description, value, price, person_id, donation_id) VALUES ({$array})";
		$this->open();
		$results = mysql_query($sql, $con);
		$id = ($results) ? mysql_insert_id() : $results;
		$this->close();
		return $id;
	}// end function

	public function readAuction_item($id) {
		global $con;
		$sql = 'SELECT * FROM auction_item WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$auction_items = array();
			while($result = mysql_fetch_array($results)) {
				$auction_item = new Auction_item();
				$auction_item->setId($result[0]);
				$auction_item->setAuction(readAuction($result[1]));
				$auction_item->setItem_num($result[2]);
				$auction_item->setTitle($result[3]);
				$auction_item->setDescription($result[4]);
				$auction_item->setValue($result[5]);
				$auction_item->setPrice($result[6]);
				$auction_item->setPerson($this->readPerson($result[7]));
				$auction_item->setDonation(readDonation($result[8]));
				$auction_items[] = $auction_item;
			}// end while
		} else {
			$auction_item = false;
		}
		return $auction_item;
	}// end function

	public function updateAuction_item($auction_item) {
		global $con;
		$sql = 'UPDATE auction_item SET ($array) WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		return $results;
	}// end function

	public function deleteAuction_item($id) {
		global $con;
		$sql = 'DELETE FROM auction_item WHERE id = WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		return $results;
	}// end function

	public function listAuction_item() {
		global $con;
		$sql = 'SELECT * FROM auction_item';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$auction_items = array();
			while($result = mysql_fetch_array($results)) {
				$auction_item = new Auction_item();
				$auction_item->setId($result[0]);
				$auction_item->setAuction(readAuction($result[1]));
				$auction_item->setItem_num($result[2]);
				$auction_item->setTitle($result[3]);
				$auction_item->setDescription($result[4]);
				$auction_item->setValue($result[5]);
				$auction_item->setPrice($result[6]);
				$auction_item->setPerson($this->readPerson($result[7]));
				$auction_item->setDonation(readDonation($result[8]));
				$auction_items[] = $auction_item;
			}// end while
		} else {
			$auction_item = false;
		}
		return $auction_item;
	}// end function

	// board_member // --------------------

	public function createBoard_member($board_member, $array) {
		global $con;
		$sql = "INSERT INTO board_member (volunteer_id, is_board_member) VALUES ({$array})";
		$this->open();
		$results = mysql_query($sql, $con);
		$id = ($results) ? mysql_insert_id() : $results;
		$this->close();
		return $id;
	}// end function

	public function readBoard_member($id) {
		global $con;
		$sql = 'SELECT * FROM board_member WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$board_members = array();
			while($result = mysql_fetch_array($results)) {
				$board_member = new Board_member();
				$board_member->setVolunteer($this->readVolunteer($result[0]));
				$board_member->setIs_board_member($result[1]);
				$board_members[] = $board_member;
			}// end while
		} else {
			$board_member = false;
		}
		return $board_member;
	}// end function

	public function updateBoard_member($board_member) {
		global $con;
		$sql = 'UPDATE board_member SET ($array) WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		return $results;
	}// end function

	public function deleteBoard_member($id) {
		global $con;
		$sql = 'DELETE FROM board_member WHERE volunteer_id = WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		return $results;
	}// end function

	public function listBoard_member() {
		global $con;
		$sql = 'SELECT * FROM board_member';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$board_members = array();
			while($result = mysql_fetch_array($results)) {
				$board_member = new Board_member();
				$board_member->setVolunteer($this->readVolunteer($result[0]));
				$board_member->setIs_board_member($result[1]);
				$board_members[] = $board_member;
			}// end while
		} else {
			$board_member = false;
		}
		return $board_member;
	}// end function

	// city // --------------------

	public function createCity($city, $array) {
		global $con;
		$sql = "INSERT INTO city (id, title, state_id) VALUES ({$array})";
		$this->open();
		$results = mysql_query($sql, $con);
		$id = ($results) ? mysql_insert_id() : $results;
		$this->close();
		return $id;
	}// end function

	public function readCity($id) {
		global $con;
		$sql = 'SELECT * FROM city WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$citys = array();
			while($result = mysql_fetch_array($results)) {
				$city = new City();
				$city->setId($result[0]);
				$city->setTitle($result[1]);
				$city->setState($this->readState($result[2]));
				$citys[] = $city;
			}// end while
		} else {
			$city = false;
		}
		return $city;
	}// end function

	public function updateCity($city) {
		global $con;
		$sql = 'UPDATE city SET ($array) WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		return $results;
	}// end function

	public function deleteCity($id) {
		global $con;
		$sql = 'DELETE FROM city WHERE id = WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		return $results;
	}// end function

	public function listCity() {
		global $con;
		$sql = 'SELECT * FROM city';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$citys = array();
			while($result = mysql_fetch_array($results)) {
				$city = new City();
				$city->setId($result[0]);
				$city->setTitle($result[1]);
				$city->setState($this->readState($result[2]));
				$citys[] = $city;
			}// end while
		} else {
			$city = false;
		}
		return $city;
	}// end function

	// committee // --------------------

	public function createCommittee($committee, $array) {
		global $con;
		$sql = "INSERT INTO committee (id, title) VALUES ({$array})";
		$this->open();
		$results = mysql_query($sql, $con);
		$id = ($results) ? mysql_insert_id() : $results;
		$this->close();
		return $id;
	}// end function

	public function readCommittee($id) {
		global $con;
		$sql = 'SELECT * FROM committee WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$committees = array();
			while($result = mysql_fetch_array($results)) {
				$committee = new Committee();
				$committee->setId($result[0]);
				$committee->setTitle($result[1]);
				$committees[] = $committee;
			}// end while
		} else {
			$committee = false;
		}
		return $committee;
	}// end function

	public function updateCommittee($committee) {
		global $con;
		$sql = 'UPDATE committee SET ($array) WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		return $results;
	}// end function

	public function deleteCommittee($id) {
		global $con;
		$sql = 'DELETE FROM committee WHERE id = WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		return $results;
	}// end function

	public function listCommittee() {
		global $con;
		$sql = 'SELECT * FROM committee';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$committees = array();
			while($result = mysql_fetch_array($results)) {
				$committee = new Committee();
				$committee->setId($result[0]);
				$committee->setTitle($result[1]);
				$committees[] = $committee;
			}// end while
		} else {
			$committee = false;
		}
		return $committee;
	}// end function

	// committee_attendance // --------------------

	public function createCommittee_attendance($committee_attendance, $array) {
		global $con;
		$sql = "INSERT INTO committee_attendance (attendance_id, committee_id, volunteer_id, status) VALUES ({$array})";
		$this->open();
		$results = mysql_query($sql, $con);
		$id = ($results) ? mysql_insert_id() : $results;
		$this->close();
		return $id;
	}// end function

	public function readCommittee_attendance($id) {
		global $con;
		$sql = 'SELECT * FROM committee_attendance WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$committee_attendances = array();
			while($result = mysql_fetch_array($results)) {
				$committee_attendance = new Committee_attendance();
				$committee_attendance->setAttendance($this->readAttendance($result[0]));
				$committee_attendance->setCommittee($this->readCommittee($result[1]));
				$committee_attendance->setVolunteer($this->readVolunteer($result[2]));
				$committee_attendance->setStatus($result[3]);
				$committee_attendances[] = $committee_attendance;
			}// end while
		} else {
			$committee_attendance = false;
		}
		return $committee_attendance;
	}// end function

	public function updateCommittee_attendance($committee_attendance) {
		global $con;
		$sql = 'UPDATE committee_attendance SET ($array) WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		return $results;
	}// end function

	public function deleteCommittee_attendance($id) {
		global $con;
		$sql = 'DELETE FROM committee_attendance WHERE attendance_id = WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		return $results;
	}// end function

	public function listCommittee_attendance() {
		global $con;
		$sql = 'SELECT * FROM committee_attendance';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$committee_attendances = array();
			while($result = mysql_fetch_array($results)) {
				$committee_attendance = new Committee_attendance();
				$committee_attendance->setAttendance($this->readAttendance($result[0]));
				$committee_attendance->setCommittee($this->readCommittee($result[1]));
				$committee_attendance->setVolunteer($this->readVolunteer($result[2]));
				$committee_attendance->setStatus($result[3]);
				$committee_attendances[] = $committee_attendance;
			}// end while
		} else {
			$committee_attendance = false;
		}
		return $committee_attendance;
	}// end function

	// contact // --------------------

	public function createContact($contact, $array) {
		global $con;
		$sql = "INSERT INTO contact (id, address_id, phone, phone2, email) VALUES ({$array})";
		$this->open();
		$results = mysql_query($sql, $con);
		$id = ($results) ? mysql_insert_id() : $results;
		$this->close();
		return $id;
	}// end function

	public function readContact($id) {
		global $con;
		$sql = "SELECT * FROM contact WHERE id = '{$id}'";
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
                    $result = mysql_fetch_array($results); 
                        $contact = new Contact();
                        $contact->setId($result[0]);
                        $contact->setAddress($this->readAddress($result[1]));
                        $contact->setPhone($result[2]);
                        $contact->setPhone2($result[3]);
                        $contact->setEmail($this->readEmail($result[4]));
		} else {
                    $contact = false;
		}
		return $contact;
	}// end function

	public function updateContact($email_id, $contact) {
		global $con;
                $sql = "UPDATE contact SET phone = '{$contact->getPhone()}' WHERE email_id = {$email_id} ";
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		return $results;
	}// end function

	public function deleteContact($id) {
		global $con;
		$sql = 'DELETE FROM contact WHERE id = WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		return $results;
	}// end function

	public function listContact() {
		global $con;
		$sql = 'SELECT * FROM contact';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$contacts = array();
			while($result = mysql_fetch_array($results)) {
				$contact = new Contact();
				$contact->setId($result[0]);
				$contact->setAddress($this->readAddress($result[1]));
				$contact->setPhone($result[2]);
				$contact->setPhone2($result[3]);
				$contact->setEmail($result[4]);
				$contacts[] = $contact;
			}// end while
		} else {
			$contact = false;
		}
		return $contact;
	}// end function

	// demographic_type // --------------------

	public function createDemographic_type($demographic_type, $array) {
		global $con;
		$sql = "INSERT INTO demographic_type (id, title, description) VALUES ({$array})";
		$this->open();
		$results = mysql_query($sql, $con);
		$id = ($results) ? mysql_insert_id() : $results;
		$this->close();
		return $id;
	}// end function

	public function readDemographic_type($id) {
		global $con;
		$sql = 'SELECT * FROM demographic_type WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$demographic_types = array();
			while($result = mysql_fetch_array($results)) {
				$demographic_type = new Demographic_type();
				$demographic_type->setId($result[0]);
				$demographic_type->setTitle($result[1]);
				$demographic_type->setDescription($result[2]);
				$demographic_types[] = $demographic_type;
			}// end while
		} else {
			$demographic_type = false;
		}
		return $demographic_type;
	}// end function

	public function updateDemographic_type($demographic_type) {
		global $con;
		$sql = 'UPDATE demographic_type SET ($array) WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		return $results;
	}// end function

	public function deleteDemographic_type($id) {
		global $con;
		$sql = 'DELETE FROM demographic_type WHERE id = WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		return $results;
	}// end function

	public function listDemographic_type() {
		global $con;
		$sql = 'SELECT * FROM demographic_type';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$demographic_types = array();
			while($result = mysql_fetch_array($results)) {
				$demographic_type = new Demographic_type();
				$demographic_type->setId($result[0]);
				$demographic_type->setTitle($result[1]);
				$demographic_type->setDescription($result[2]);
				$demographic_types[] = $demographic_type;
			}// end while
		} else {
			$demographic_type = false;
		}
		return $demographic_type;
	}// end function

	// donation // --------------------

	public function createDonation($donation, $array) {
		global $con;
		$sql = "INSERT INTO donation (id, date, time, details, when_entered, donor_id, office_id, donation_type_id, pledge, admin_id) VALUES ({$array})";
		$this->open();
		$results = mysql_query($sql, $con);
		$id = ($results) ? mysql_insert_id() : $results;
		$this->close();
		return $id;
	}// end function

	public function readDonation($id) {
		global $con;
		$sql = 'SELECT * FROM donation WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$donations = array();
			while($result = mysql_fetch_array($results)) {
				$donation = new Donation();
				$donation->setId($result[0]);
				$donation->setDate($result[1]);
				$donation->setTime($result[2]);
				$donation->setDetails($result[3]);
				$donation->setWhen_entered($result[4]);
				$donation->setDonor(readDonor($result[5]));
				$donation->setOffice($this->readOffice($result[6]));
				$donation->setDonation_type(readDonation_type($result[7]));
				$donation->setPledge($result[8]);
				$donation->setAdmin($this->readAdmin($result[9]));
				$donations[] = $donation;
			}// end while
		} else {
			$donation = false;
		}
		return $donation;
	}// end function

	public function updateDonation($donation) {
		global $con;
		$sql = 'UPDATE donation SET ($array) WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		return $results;
	}// end function

	public function deleteDonation($id) {
		global $con;
		$sql = 'DELETE FROM donation WHERE id = WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		return $results;
	}// end function

	public function listDonation() {
		global $con;
		$sql = 'SELECT * FROM donation';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$donations = array();
			while($result = mysql_fetch_array($results)) {
				$donation = new Donation();
				$donation->setId($result[0]);
				$donation->setDate($result[1]);
				$donation->setTime($result[2]);
				$donation->setDetails($result[3]);
				$donation->setWhen_entered($result[4]);
				$donation->setDonor(readDonor($result[5]));
				$donation->setOffice($this->readOffice($result[6]));
				$donation->setDonation_type(readDonation_type($result[7]));
				$donation->setPledge($result[8]);
				$donation->setAdmin($this->readAdmin($result[9]));
				$donations[] = $donation;
			}// end while
		} else {
			$donation = false;
		}
		return $donations;
	}// end function

	// donation_type // --------------------

	public function createDonation_type($donation_type, $array) {
		global $con;
		$sql = "INSERT INTO donation_type (id, title, description) VALUES ({$array})";
		$this->open();
		$results = mysql_query($sql, $con);
		$id = ($results) ? mysql_insert_id() : $results;
		$this->close();
		return $id;
	}// end function

	public function readDonation_type($id) {
		global $con;
		$sql = 'SELECT * FROM donation_type WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$donation_types = array();
			while($result = mysql_fetch_array($results)) {
				$donation_type = new Donation_type();
				$donation_type->setId($result[0]);
				$donation_type->setTitle($result[1]);
				$donation_type->setDescription($result[2]);
				$donation_types[] = $donation_type;
			}// end while
		} else {
			$donation_type = false;
		}
		return $donation_type;
	}// end function

	public function updateDonation_type($donation_type) {
		global $con;
		$sql = 'UPDATE donation_type SET ($array) WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		return $results;
	}// end function

	public function deleteDonation_type($id) {
		global $con;
		$sql = 'DELETE FROM donation_type WHERE id = WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		return $results;
	}// end function

	public function listDonation_type() {
		global $con;
		$sql = 'SELECT * FROM donation_type';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$donation_types = array();
			while($result = mysql_fetch_array($results)) {
				$donation_type = new Donation_type();
				$donation_type->setId($result[0]);
				$donation_type->setTitle($result[1]);
				$donation_type->setDescription($result[2]);
				$donation_types[] = $donation_type;
			}// end while
		} else {
			$donation_type = false;
		}
		return $donation_type;
	}// end function

	// email // --------------------

	public function createEmail($email, $array) {
		global $con;
		$sql = "INSERT INTO email (id, email, person_id) VALUES ({$array})";
		$this->open();
		$results = mysql_query($sql, $con);
		$id = ($results) ? mysql_insert_id() : $results;
		$this->close();
		return $id;
	}// end function

	public function readEmail($id) {
		global $con;
		$sql = 'SELECT * FROM email WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
                    $result = mysql_fetch_array($results);
                        $email = new Email();
                        $email->setId($result[0]);
                        $email->setEmail($result[1]);
		} else {
			$email = false;
		}
		return $email;
	}// end function
        
        public function readEmailByEmail($email) {
            global $con;
            $sql = "SELECT * FROM email WHERE email = '{$email}'";
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
                    $result = mysql_fetch_array($results);
                        $email = new Email();
                        $email->setId($result[0]);
                        $email->setEmail($result[1]);
		} else {
			$email = false;
		}
		return $email;
	}// end function

	public function updateEmail($email_id, $email) {
		global $con;
		$sql = "UPDATE email SET email= '{$email}' WHERE id = '{$email_id}'";
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		return $results;
	}// end function

	public function deleteEmail($id) {
		global $con;
		$sql = 'DELETE FROM email WHERE id = WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		return $results;
	}// end function

	public function listEmail() {
		global $con;
		$sql = 'SELECT * FROM email';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$emails = array();
			while($result = mysql_fetch_array($results)) {
				$email = new Email();
				$email->setId($result[0]);
				$email->setEmail($result[1]);
				$email->setPerson($this->readPerson($result[2]));
				$emails[] = $email;
			}// end while
		} else {
			$email = false;
		}
		return $email;
	}// end function

	// event // --------------------

	public function createEvent($event, $array) {
		global $con;
		$sql = "INSERT INTO event (id, title, date, start_time, end_time, address_id, type_id, max_num_guests, committee_id, sponsored_id) VALUES ({$array})";
		$this->open();
		$results = mysql_query($sql, $con);
		$id = ($results) ? mysql_insert_id() : $results;
		$this->close();
		return $id;
	}// end function

	public function readEvent($id) {
		global $con;
		$sql = 'SELECT * FROM event WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$events = array();
			while($result = mysql_fetch_array($results)) {
				$event = new Event();
				$event->setId($result[0]);
				$event->setTitle($result[1]);
				$event->setDate($result[2]);
				$event->setStart_time($result[3]);
				$event->setEnd_time($result[4]);
				$event->setAddress_id($this->readAddress($result[5]));
				$event->setType($this->readInterest_type($result[6]));
				$event->setMax_num_guests($result[7]);
				$event->setCommittee($this->readCommittee($result[8]));
				$event->setSponsored_id($this->readCommittee($result[9]));
				$events[] = $event;
			}// end while
		} else {
			$event = false;
		}
		return $event;
	}// end function

	public function updateEvent($event) {
		global $con;
		$sql = 'UPDATE event SET ($array) WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		return $results;
	}// end function

	public function deleteEvent($id) {
		global $con;
		$sql = 'DELETE FROM event WHERE id = WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		return $results;
	}// end function

	public function listEvent() {
		global $con;
		$sql = 'SELECT * FROM event';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$events = array();
			while($result = mysql_fetch_array($results)) {
				$event = new Event();
				$event->setId($result[0]);
				$event->setTitle($result[1]);
				$event->setDate($result[2]);
				$event->setStart_time($result[3]);
				$event->setEnd_time($result[4]);
				$event->setAddress_id($this->readAddress($result[5]));
				$event->setType($this->readInterest_type($result[6]));
				$event->setMax_num_guests($result[7]);
				$event->setCommittee($this->readCommittee($result[8]));
				//$event->setSponsored_id($this->readSponsored($result[9]));
				$events[] = $event;
			}// end while
		} else {
			$event = false;
		}
		return $event;
	}// end function

	// event_expenses // --------------------

	public function createEvent_expenses($event_expenses, $array) {
		global $con;
		$sql = "INSERT INTO event_expenses (id, event_id, title, description, amount, when_entered, office_id, when_authorized, admin_id) VALUES ({$array})";
		$this->open();
		$results = mysql_query($sql, $con);
		$id = ($results) ? mysql_insert_id() : $results;
		$this->close();
		return $id;
	}// end function

	public function readEvent_expenses($id) {
		global $con;
		$sql = 'SELECT * FROM event_expenses WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$event_expensess = array();
			while($result = mysql_fetch_array($results)) {
				$event_expenses = new Event_expenses();
				$event_expenses->setId($result[0]);
				$event_expenses->setEvent(readEvent($result[1]));
				$event_expenses->setTitle($result[2]);
				$event_expenses->setDescription($result[3]);
				$event_expenses->setAmount($result[4]);
				$event_expenses->setWhen_entered($result[5]);
				$event_expenses->setOffice($this->readOffice($result[6]));
				$event_expenses->setWhen_authorized($result[7]);
				$event_expenses->setAdmin($this->readAdmin($result[8]));
				$event_expensess[] = $event_expenses;
			}// end while
		} else {
			$event_expenses = false;
		}
		return $event_expenses;
	}// end function

	public function updateEvent_expenses($event_expenses) {
		global $con;
		$sql = 'UPDATE event_expenses SET ($array) WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		return $results;
	}// end function

	public function deleteEvent_expenses($id) {
		global $con;
		$sql = 'DELETE FROM event_expenses WHERE id = WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		return $results;
	}// end function

	public function listEvent_expenses() {
		global $con;
		$sql = 'SELECT * FROM event_expenses';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$event_expensess = array();
			while($result = mysql_fetch_array($results)) {
				$event_expenses = new Event_expenses();
				$event_expenses->setId($result[0]);
				$event_expenses->setEvent($this->readEvent($result[1]));
				$event_expenses->setTitle($result[2]);
				$event_expenses->setDescription($result[3]);
				$event_expenses->setAmount($result[4]);
				$event_expenses->setWhen_entered($result[5]);
				$event_expenses->setOffice($this->readOffice($result[6]));
				$event_expenses->setWhen_authorized($result[7]);
				$event_expenses->setAdmin($this->readAdmin($result[8]));
				$event_expensess[] = $event_expenses;
			}// end while
		} else {
			$event_expenses = false;
		}
		return $event_expenses;
	}// end function

	// event_sponsor // --------------------

	public function createEvent_sponsor($event_sponsor, $array) {
		global $con;
		$sql = "INSERT INTO event_sponsor (id, event_id, person_id, organization_id) VALUES ({$array})";
		$this->open();
		$results = mysql_query($sql, $con);
		$id = ($results) ? mysql_insert_id() : $results;
		$this->close();
		return $id;
	}// end function

	public function readEvent_sponsor($id) {
		global $con;
		$sql = 'SELECT * FROM event_sponsor WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$event_sponsors = array();
			while($result = mysql_fetch_array($results)) {
				$event_sponsor = new Event_sponsor();
				$event_sponsor->setId($result[0]);
				$event_sponsor->setEvent($this->readEvent($result[1]));
				$event_sponsor->setPerson($this->readPerson($result[2]));
				$event_sponsor->setOrganization(readOrganization($result[3]));
				$event_sponsors[] = $event_sponsor;
			}// end while
		} else {
			$event_sponsor = false;
		}
		return $event_sponsor;
	}// end function

	public function updateEvent_sponsor($event_sponsor) {
		global $con;
		$sql = 'UPDATE event_sponsor SET ($array) WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		return $results;
	}// end function

	public function deleteEvent_sponsor($id) {
		global $con;
		$sql = 'DELETE FROM event_sponsor WHERE id = WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		return $results;
	}// end function

	public function listEvent_sponsor() {
		global $con;
		$sql = 'SELECT * FROM event_sponsor';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$event_sponsors = array();
			while($result = mysql_fetch_array($results)) {
				$event_sponsor = new Event_sponsor();
				$event_sponsor->setId($result[0]);
				$event_sponsor->setEvent($this->readEvent($result[1]));
				$event_sponsor->setPerson($this->readPerson($result[2]));
				$event_sponsor->setOrganization(readOrganization($result[3]));
				$event_sponsors[] = $event_sponsor;
			}// end while
		} else {
			$event_sponsor = false;
		}
		return $event_sponsor;
	}// end function

	// event_type // --------------------

	public function createEvent_type($event_type, $array) {
		global $con;
		$sql = "INSERT INTO event_type (id, title, description) VALUES ({$array})";
		$this->open();
		$results = mysql_query($sql, $con);
		$id = ($results) ? mysql_insert_id() : $results;
		$this->close();
		return $id;
	}// end function

	public function readEvent_type($id) {
		global $con;
		$sql = 'SELECT * FROM event_type WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$event_types = array();
			while($result = mysql_fetch_array($results)) {
				$event_type = new Event_type();
				$event_type->setId($result[0]);
				$event_type->setTitle($result[1]);
				$event_type->setDescription($result[2]);
				$event_types[] = $event_type;
			}// end while
		} else {
			$event_type = false;
		}
		return $event_type;
	}// end function

	public function updateEvent_type($event_type) {
		global $con;
		$sql = 'UPDATE event_type SET ($array) WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		return $results;
	}// end function

	public function deleteEvent_type($id) {
		global $con;
		$sql = 'DELETE FROM event_type WHERE id = WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		return $results;
	}// end function

	public function listEvent_type() {
		global $con;
		$sql = 'SELECT * FROM event_type';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$event_types = array();
			while($result = mysql_fetch_array($results)) {
				$event_type = new Event_type();
				$event_type->setId($result[0]);
				$event_type->setTitle($result[1]);
				$event_type->setDescription($result[2]);
				$event_types[] = $event_type;
			}// end while
		} else {
			$event_type = false;
		}
		return $event_type;
	}// end function

	// expense_type // --------------------

	public function createExpense_type($expense_type, $array) {
		global $con;
		$sql = "INSERT INTO expense_type (id, title, description) VALUES ({$array})";
		$this->open();
		$results = mysql_query($sql, $con);
		$id = ($results) ? mysql_insert_id() : $results;
		$this->close();
		return $id;
	}// end function

	public function readExpense_type($id) {
		global $con;
		$sql = 'SELECT * FROM expense_type WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$expense_types = array();
			while($result = mysql_fetch_array($results)) {
				$expense_type = new Expense_type();
				$expense_type->setId($result[0]);
				$expense_type->setTitle($result[1]);
				$expense_type->setDescription($result[2]);
				$expense_types[] = $expense_type;
			}// end while
		} else {
			$expense_type = false;
		}
		return $expense_type;
	}// end function

	public function updateExpense_type($expense_type) {
		global $con;
		$sql = 'UPDATE expense_type SET ($array) WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		return $results;
	}// end function

	public function deleteExpense_type($id) {
		global $con;
		$sql = 'DELETE FROM expense_type WHERE id = WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		return $results;
	}// end function

	public function listExpense_type() {
		global $con;
		$sql = 'SELECT * FROM expense_type';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$expense_types = array();
			while($result = mysql_fetch_array($results)) {
				$expense_type = new Expense_type();
				$expense_type->setId($result[0]);
				$expense_type->setTitle($result[1]);
				$expense_type->setDescription($result[2]);
				$expense_types[] = $expense_type;
			}// end while
		} else {
			$expense_type = false;
		}
		return $expense_type;
	}// end function

	// foh // --------------------

	public function createFoh($foh, $array) {
		global $con;
		$sql = "INSERT INTO foh (event_id, person_id) VALUES ({$array})";
		$this->open();
		$results = mysql_query($sql, $con);
		$id = ($results) ? mysql_insert_id() : $results;
		$this->close();
		return $id;
	}// end function

	public function readFoh($id) {
		global $con;
		$sql = 'SELECT * FROM foh WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$fohs = array();
			while($result = mysql_fetch_array($results)) {
				$foh = new Foh();
				$foh->setEvent($this->readEvent($result[0]));
				$foh->setPerson($this->readPerson($result[1]));
				$fohs[] = $foh;
			}// end while
		} else {
			$foh = false;
		}
		return $foh;
	}// end function

	public function updateFoh($foh) {
		global $con;
		$sql = 'UPDATE foh SET ($array) WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		return $results;
	}// end function

	public function deleteFoh($id) {
		global $con;
		$sql = 'DELETE FROM foh WHERE event_id = WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		return $results;
	}// end function

	public function listFoh() {
		global $con;
		$sql = 'SELECT * FROM foh';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$fohs = array();
			while($result = mysql_fetch_array($results)) {
				$foh = new Foh();
				$foh->setEvent($this->readEvent($result[0]));
				$foh->setPerson($this->readPerson($result[1]));
				$fohs[] = $foh;
			}// end while
		} else {
			$foh = false;
		}
		return $foh;
	}// end function

	// guest_list // --------------------

	public function createGuest_list($guest_list, $array) {
		global $con;
		$sql = "INSERT INTO guest_list (event_id, person_id, attended) VALUES ({$array})";
		$this->open();
		$results = mysql_query($sql, $con);
		$id = ($results) ? mysql_insert_id() : $results;
		$this->close();
		return $id;
	}// end function

	public function readGuest_list($id) {
		global $con;
		$sql = 'SELECT * FROM guest_list WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$guest_lists = array();
			while($result = mysql_fetch_array($results)) {
				$guest_list = new Guest_list();
				$guest_list->setEvent($this->readEvent($result[0]));
				$guest_list->setPerson($this->readPerson($result[1]));
				$guest_list->setAttended($result[2]);
				$guest_lists[] = $guest_list;
			}// end while
		} else {
			$guest_list = false;
		}
		return $guest_list;
	}// end function

	public function updateGuest_list($guest_list) {
		global $con;
		$sql = 'UPDATE guest_list SET ($array) WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		return $results;
	}// end function

	public function deleteGuest_list($id) {
		global $con;
		$sql = 'DELETE FROM guest_list WHERE event_id = WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		return $results;
	}// end function

	public function listGuest_list() {
		global $con;
		$sql = 'SELECT * FROM guest_list';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$guest_lists = array();
			while($result = mysql_fetch_array($results)) {
				$guest_list = new Guest_list();
				$guest_list->setEvent($this->readEvent($result[0]));
				$guest_list->setPerson($this->readPerson($result[1]));
				$guest_list->setAttended($result[2]);
				$guest_lists[] = $guest_list;
			}// end while
		} else {
			$guest_list = false;
		}
		return $guest_list;
	}// end function

	// habitat_employee // --------------------

	public function createHabitat_employee($habitat_employee, $array) {
		global $con;
		$sql = "INSERT INTO habitat_employee (id, person_id, start_date, end_date) VALUES ({$array})";
		$this->open();
		$results = mysql_query($sql, $con);
		$id = ($results) ? mysql_insert_id() : $results;
		$this->close();
		return $id;
	}// end function

	public function readHabitat_employee($id) {
		global $con;
		$sql = 'SELECT * FROM habitat_employee WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$habitat_employees = array();
			while($result = mysql_fetch_array($results)) {
				$habitat_employee = new Habitat_employee();
				$habitat_employee->setId($result[0]);
				$habitat_employee->setPerson($this->readPerson($result[1]));
				$habitat_employee->setStart_date($result[2]);
				$habitat_employee->setEnd_date($result[3]);
				$habitat_employees[] = $habitat_employee;
			}// end while
		} else {
			$habitat_employee = false;
		}
		return $habitat_employee;
	}// end function

	public function updateHabitat_employee($habitat_employee) {
		global $con;
		$sql = 'UPDATE habitat_employee SET ($array) WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		return $results;
	}// end function

	public function deleteHabitat_employee($id) {
		global $con;
		$sql = 'DELETE FROM habitat_employee WHERE id = WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		return $results;
	}// end function

	public function listHabitat_employee() {
		global $con;
		$sql = 'SELECT * FROM habitat_employee';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$habitat_employees = array();
			while($result = mysql_fetch_array($results)) {
				$habitat_employee = new Habitat_employee();
				$habitat_employee->setId($result[0]);
				$habitat_employee->setPerson($this->readPerson($result[1]));
				$habitat_employee->setStart_date($result[2]);
				$habitat_employee->setEnd_date($result[3]);
				$habitat_employees[] = $habitat_employee;
			}// end while
		} else {
			$habitat_employee = false;
		}
		return $habitat_employee;
	}// end function

	// ho_asset // --------------------

	public function createHo_asset($ho_asset, $array) {
		global $con;
		$sql = "INSERT INTO ho_asset (id, person_id, title, description, value) VALUES ({$array})";
		$this->open();
		$results = mysql_query($sql, $con);
		$id = ($results) ? mysql_insert_id() : $results;
		$this->close();
		return $id;
	}// end function

	public function readHo_asset($id) {
		global $con;
		$sql = 'SELECT * FROM ho_asset WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$ho_assets = array();
			while($result = mysql_fetch_array($results)) {
				$ho_asset = new Ho_asset();
				$ho_asset->setId($result[0]);
				$ho_asset->setPerson($this->readPerson($result[1]));
				$ho_asset->setTitle($result[2]);
				$ho_asset->setDescription($result[3]);
				$ho_asset->setValue($result[4]);
				$ho_assets[] = $ho_asset;
			}// end while
		} else {
			$ho_asset = false;
		}
		return $ho_asset;
	}// end function

	public function updateHo_asset($ho_asset) {
		global $con;
		$sql = 'UPDATE ho_asset SET ($array) WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		return $results;
	}// end function

	public function deleteHo_asset($id) {
		global $con;
		$sql = 'DELETE FROM ho_asset WHERE id = WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		return $results;
	}// end function

	public function listHo_asset() {
		global $con;
		$sql = 'SELECT * FROM ho_asset';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$ho_assets = array();
			while($result = mysql_fetch_array($results)) {
				$ho_asset = new Ho_asset();
				$ho_asset->setId($result[0]);
				$ho_asset->setPerson($this->readPerson($result[1]));
				$ho_asset->setTitle($result[2]);
				$ho_asset->setDescription($result[3]);
				$ho_asset->setValue($result[4]);
				$ho_assets[] = $ho_asset;
			}// end while
		} else {
			$ho_asset = false;
		}
		return $ho_asset;
	}// end function

	// ho_debt // --------------------

	public function createHo_debt($ho_debt, $array) {
		global $con;
		$sql = "INSERT INTO ho_debt (id, person_id, monthly_payment, balance) VALUES ({$array})";
		$this->open();
		$results = mysql_query($sql, $con);
		$id = ($results) ? mysql_insert_id() : $results;
		$this->close();
		return $id;
	}// end function

	public function readHo_debt($id) {
		global $con;
		$sql = 'SELECT * FROM ho_debt WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$ho_debts = array();
			while($result = mysql_fetch_array($results)) {
				$ho_debt = new Ho_debt();
				$ho_debt->setId($result[0]);
				$ho_debt->setPerson($this->readPerson($result[1]));
				$ho_debt->setMonthly_payment($result[2]);
				$ho_debt->setBalance($result[3]);
				$ho_debts[] = $ho_debt;
			}// end while
		} else {
			$ho_debt = false;
		}
		return $ho_debt;
	}// end function

	public function updateHo_debt($ho_debt) {
		global $con;
		$sql = 'UPDATE ho_debt SET ($array) WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		return $results;
	}// end function

	public function deleteHo_debt($id) {
		global $con;
		$sql = 'DELETE FROM ho_debt WHERE id = WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		return $results;
	}// end function

	public function listHo_debt() {
		global $con;
		$sql = 'SELECT * FROM ho_debt';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$ho_debts = array();
			while($result = mysql_fetch_array($results)) {
				$ho_debt = new Ho_debt();
				$ho_debt->setId($result[0]);
				$ho_debt->setPerson($this->readPerson($result[1]));
				$ho_debt->setMonthly_payment($result[2]);
				$ho_debt->setBalance($result[3]);
				$ho_debts[] = $ho_debt;
			}// end while
		} else {
			$ho_debt = false;
		}
		return $ho_debt;
	}// end function

	// ho_group // --------------------

	public function createHo_group($ho_group, $array) {
		global $con;
		$sql = "INSERT INTO ho_group (person_id, ho_id, demographic_id, primary_ho) VALUES ({$array})";
		$this->open();
		$results = mysql_query($sql, $con);
		$id = ($results) ? mysql_insert_id() : $results;
		$this->close();
		return $id;
	}// end function

	public function readHo_group($id) {
		global $con;
		$sql = 'SELECT * FROM ho_group WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$ho_groups = array();
			while($result = mysql_fetch_array($results)) {
				$ho_group = new Ho_group();
				$ho_group->setPerson($this->readPerson($result[0]));
				$ho_group->setHo(readHo($result[1]));
				$ho_group->setDemographic(readDemographic($result[2]));
				$ho_group->setPrimary_ho($result[3]);
				$ho_groups[] = $ho_group;
			}// end while
		} else {
			$ho_group = false;
		}
		return $ho_group;
	}// end function

	public function updateHo_group($ho_group) {
		global $con;
		$sql = 'UPDATE ho_group SET ($array) WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		return $results;
	}// end function

	public function deleteHo_group($id) {
		global $con;
		$sql = 'DELETE FROM ho_group WHERE person_id = WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		return $results;
	}// end function

	public function listHo_group() {
		global $con;
		$sql = 'SELECT * FROM ho_group';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$ho_groups = array();
			while($result = mysql_fetch_array($results)) {
				$ho_group = new Ho_group();
				$ho_group->setPerson($this->readPerson($result[0]));
				$ho_group->setHo(readHo($result[1]));
				$ho_group->setDemographic(readDemographic($result[2]));
				$ho_group->setPrimary_ho($result[3]);
				$ho_groups[] = $ho_group;
			}// end while
		} else {
			$ho_group = false;
		}
		return $ho_group;
	}// end function

	// ho_income // --------------------

	public function createHo_income($ho_income, $array) {
		global $con;
		$sql = "INSERT INTO ho_income (id, person_id, gross, child_support, disability, unemployment) VALUES ({$array})";
		$this->open();
		$results = mysql_query($sql, $con);
		$id = ($results) ? mysql_insert_id() : $results;
		$this->close();
		return $id;
	}// end function

	public function readHo_income($id) {
		global $con;
		$sql = 'SELECT * FROM ho_income WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$ho_incomes = array();
			while($result = mysql_fetch_array($results)) {
				$ho_income = new Ho_income();
				$ho_income->setId($result[0]);
				$ho_income->setPerson($this->readPerson($result[1]));
				$ho_income->setGross($result[2]);
				$ho_income->setChild_support($result[3]);
				$ho_income->setDisability($result[4]);
				$ho_income->setUnemployment($result[5]);
				$ho_incomes[] = $ho_income;
			}// end while
		} else {
			$ho_income = false;
		}
		return $ho_income;
	}// end function

	public function updateHo_income($ho_income) {
		global $con;
		$sql = 'UPDATE ho_income SET ($array) WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		return $results;
	}// end function

	public function deleteHo_income($id) {
		global $con;
		$sql = 'DELETE FROM ho_income WHERE id = WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		return $results;
	}// end function

	public function listHo_income() {
		global $con;
		$sql = 'SELECT * FROM ho_income';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$ho_incomes = array();
			while($result = mysql_fetch_array($results)) {
				$ho_income = new Ho_income();
				$ho_income->setId($result[0]);
				$ho_income->setPerson($this->readPerson($result[1]));
				$ho_income->setGross($result[2]);
				$ho_income->setChild_support($result[3]);
				$ho_income->setDisability($result[4]);
				$ho_income->setUnemployment($result[5]);
				$ho_incomes[] = $ho_income;
			}// end while
		} else {
			$ho_income = false;
		}
		return $ho_income;
	}// end function

	// ho_requirement // --------------------

	public function createHo_requirement($ho_requirement, $array) {
		global $con;
		$sql = "INSERT INTO ho_requirement (person_id, requirement_id, when_entered, when_completed, office_id, when_authorized, admin_id) VALUES ({$array})";
		$this->open();
		$results = mysql_query($sql, $con);
		$id = ($results) ? mysql_insert_id() : $results;
		$this->close();
		return $id;
	}// end function

	public function readHo_requirement($id) {
		global $con;
		$sql = 'SELECT * FROM ho_requirement WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$ho_requirements = array();
			while($result = mysql_fetch_array($results)) {
				$ho_requirement = new Ho_requirement();
				$ho_requirement->setPerson($this->readPerson($result[0]));
				$ho_requirement->setRequirement(readRequirement($result[1]));
				$ho_requirement->setWhen_entered($result[2]);
				$ho_requirement->setWhen_completed($result[3]);
				$ho_requirement->setOffice($this->readOffice($result[4]));
				$ho_requirement->setWhen_authorized($result[5]);
				$ho_requirement->setAdmin($this->readAdmin($result[6]));
				$ho_requirements[] = $ho_requirement;
			}// end while
		} else {
			$ho_requirement = false;
		}
		return $ho_requirement;
	}// end function

	public function updateHo_requirement($ho_requirement) {
		global $con;
		$sql = 'UPDATE ho_requirement SET ($array) WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		return $results;
	}// end function

	public function deleteHo_requirement($id) {
		global $con;
		$sql = 'DELETE FROM ho_requirement WHERE person_id = WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		return $results;
	}// end function

	public function listHo_requirement() {
		global $con;
		$sql = 'SELECT * FROM ho_requirement';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$ho_requirements = array();
			while($result = mysql_fetch_array($results)) {
				$ho_requirement = new Ho_requirement();
				$ho_requirement->setPerson($this->readPerson($result[0]));
				$ho_requirement->setRequirement(readRequirement($result[1]));
				$ho_requirement->setWhen_entered($result[2]);
				$ho_requirement->setWhen_completed($result[3]);
				$ho_requirement->setOffice($this->readOffice($result[4]));
				$ho_requirement->setWhen_authorized($result[5]);
				$ho_requirement->setAdmin($this->readAdmin($result[6]));
				$ho_requirements[] = $ho_requirement;
			}// end while
		} else {
			$ho_requirement = false;
		}
		return $ho_requirement;
	}// end function

	// ho_status // --------------------

	public function createHo_status($ho_status, $array) {
		global $con;
		$sql = "INSERT INTO ho_status (id, title, code, description) VALUES ({$array})";
		$this->open();
		$results = mysql_query($sql, $con);
		$id = ($results) ? mysql_insert_id() : $results;
		$this->close();
		return $id;
	}// end function

	public function readHo_status($id) {
		global $con;
		$sql = 'SELECT * FROM ho_status WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$ho_statuss = array();
			while($result = mysql_fetch_array($results)) {
				$ho_status = new Ho_status();
				$ho_status->setId($result[0]);
				$ho_status->setTitle($result[1]);
				$ho_status->setCode($result[2]);
				$ho_status->setDescription($result[3]);
				$ho_statuss[] = $ho_status;
			}// end while
		} else {
			$ho_status = false;
		}
		return $ho_status;
	}// end function

	public function updateHo_status($ho_status) {
		global $con;
		$sql = 'UPDATE ho_status SET ($array) WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		return $results;
	}// end function

	public function deleteHo_status($id) {
		global $con;
		$sql = 'DELETE FROM ho_status WHERE id = WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		return $results;
	}// end function

	public function listHo_status() {
		global $con;
		$sql = 'SELECT * FROM ho_status';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$ho_statuss = array();
			while($result = mysql_fetch_array($results)) {
				$ho_status = new Ho_status();
				$ho_status->setId($result[0]);
				$ho_status->setTitle($result[1]);
				$ho_status->setCode($result[2]);
				$ho_status->setDescription($result[3]);
				$ho_statuss[] = $ho_status;
			}// end while
		} else {
			$ho_status = false;
		}
		return $ho_status;
	}// end function

	// home_owner // --------------------

	public function createHome_owner($home_owner, $array) {
		global $con;
		$sql = "INSERT INTO home_owner (person_id, status_id, bank_id, social_security) VALUES ({$array})";
		$this->open();
		$results = mysql_query($sql, $con);
		$id = ($results) ? mysql_insert_id() : $results;
		$this->close();
		return $id;
	}// end function

	public function readHome_owner($id) {
		global $con;
		$sql = 'SELECT * FROM home_owner WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$home_owners = array();
			while($result = mysql_fetch_array($results)) {
				$home_owner = new Home_owner();
				$home_owner->setPerson($this->readPerson($result[0]));
				$home_owner->setStatus($this->readStatus_change($result[1]));
				$home_owner->setBank(readBank($result[2]));
				$home_owner->setSocial_security($result[3]);
				$home_owners[] = $home_owner;
			}// end while
		} else {
			$home_owner = false;
		}
		return $home_owner;
	}// end function

	public function updateHome_owner($home_owner) {
		global $con;
		$sql = 'UPDATE home_owner SET ($array) WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		return $results;
	}// end function

	public function deleteHome_owner($id) {
		global $con;
		$sql = 'DELETE FROM home_owner WHERE person_id = WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		return $results;
	}// end function

	public function listHome_owner() {
		global $con;
		$sql = 'SELECT * FROM home_owner';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$home_owners = array();
			while($result = mysql_fetch_array($results)) {
				$home_owner = new Home_owner();
				$home_owner->setPerson($this->readPerson($result[0]));
				$home_owner->setStatus($this->readStatus_change($result[1]));
				$home_owner->setBank(readBank($result[2]));
				$home_owner->setSocial_security($result[3]);
				$home_owners[] = $home_owner;
			}// end while
		} else {
			$home_owner = false;
		}
		return $home_owner;
	}// end function

	// interest // --------------------

	public function createInterest($interest, $array) {
		global $con;
		$sql = "INSERT INTO interest (id, type_id, title, description) VALUES ({$array})";
		$this->open();
		$results = mysql_query($sql, $con);
		$id = ($results) ? mysql_insert_id() : $results;
		$this->close();
		return $id;
	}// end function

	public function readInterest($id) {
		global $con;
		$sql = 'SELECT * FROM interest WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$interests = array();
			while($result = mysql_fetch_array($results)) {
				$interest = new Interest();
				$interest->setId($result[0]);
				$interest->setType($this->readInterest_type($result[1]));
				$interest->setTitle($result[2]);
				$interest->setDescription($result[3]);
				$interests[] = $interest;
			}// end while
		} else {
			$interests = false;
		}
		return $interests;
	}// end function

	public function updateInterest($interest) {
		global $con;
		$sql = 'UPDATE interest SET ($array) WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		return $results;
	}// end function

	public function deleteInterest($id) {
		global $con;
		$sql = 'DELETE FROM interest WHERE id = WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		return $results;
	}// end function

	public function listInterest() {
		global $con;
		$sql = 'SELECT * FROM interest';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$interests = array();
			while($result = mysql_fetch_array($results)) {
				$interest = new Interest();
				$interest->setId($result[0]);
				$interest->setType($this->readInterest_type($result[1]));
				$interest->setTitle($result[2]);
				$interest->setDescription($result[3]);
				$interests[] = $interest;
			}// end while
		} else {
			$interests = false;
		}
		return $interests;
	}// end function

	// interest_type // --------------------

	public function createInterest_type($interest_type, $array) {
		global $con;
		$sql = "INSERT INTO interest_type (id, title, description) VALUES ({$array})";
		$this->open();
		$results = mysql_query($sql, $con);
		$id = ($results) ? mysql_insert_id() : $results;
		$this->close();
		return $id;
	}// end function

	public function readInterest_type($id) {
		global $con;
		$sql = 'SELECT * FROM interest_type WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$interest_types = array();
			while($result = mysql_fetch_array($results)) {
				$interest_type = new Interest_type();
				$interest_type->setId($result[0]);
				$interest_type->setTitle($result[1]);
				$interest_type->setDescription($result[2]);
				$interest_types[] = $interest_type;
			}// end while
		} else {
			$interest_type = false;
		}
		return $interest_type;
	}// end function

	public function updateInterest_type($interest_type) {
		global $con;
		$sql = 'UPDATE interest_type SET ($array) WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		return $results;
	}// end function

	public function deleteInterest_type($id) {
		global $con;
		$sql = 'DELETE FROM interest_type WHERE id = WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		return $results;
	}// end function

	public function listInterest_type() {
		global $con;
		$sql = 'SELECT * FROM interest_type';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$interest_types = array();
			while($result = mysql_fetch_array($results)) {
				$interest_type = new Interest_type();
				$interest_type->setId($result[0]);
				$interest_type->setTitle($result[1]);
				$interest_type->setDescription($result[2]);
				$interest_types[] = $interest_type;
			}// end while
		} else {
			$interest_type = false;
		}
		return $interest_types;
	}// end function

	// interested_in // --------------------

	public function createInterested_in($interested_in, $array) {
		global $con;
		$sql = "INSERT INTO interested_in (volunteer_id, interest_id) VALUES ({$array})";
		$this->open();
		$results = mysql_query($sql, $con);
		$id = ($results) ? mysql_insert_id() : $results;
		$this->close();
		return $id;
	}// end function

	public function readInterested_in($id) {
		global $con;
		$sql = 'SELECT * FROM interested_in WHERE volunteer_id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$interested_ins = array();
			while($result = mysql_fetch_array($results)) {
				$interested_in = new Interested_in();
				$interested_in->setVolunteer($this->readVolunteer($result[0]));
				$interested_in->setInterest($this->readInterest($result[1]));
				$interested_ins[] = $interested_in;
			}// end while
		} else {
			$interested_ins = false;
		}
		return $interested_ins;
	}// end function

	public function updateInterested_in($interested_in) {
		global $con;
		$sql = 'UPDATE interested_in SET ($array) WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		return $results;
	}// end function

	public function deleteInterested_in($id) {
		global $con;
		$sql = 'DELETE FROM interested_in WHERE volunteer_id = WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		return $results;
	}// end function

	public function listInterested_in() {
		global $con;
		$sql = 'SELECT * FROM interested_in';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$interested_ins = array();
			while($result = mysql_fetch_array($results)) {
				$interested_in = new Interested_in();
				$interested_in->setVolunteer($this->readVolunteer($result[0]));
				$interested_in->setInterest($this->readInterest($result[1]));
				$interested_ins[] = $interested_in;
			}// end while
		} else {
			$interested_in = false;
		}
		return $interested_in;
	}// end function

	// labor // --------------------

	public function createLabor($labor, $array) {
		global $con;
		$sql = "INSERT INTO labor (donation_id, amount, method, project_id) VALUES ({$array})";
		$this->open();
		$results = mysql_query($sql, $con);
		$id = ($results) ? mysql_insert_id() : $results;
		$this->close();
		return $id;
	}// end function

	public function readLabor($id) {
		global $con;
		$sql = 'SELECT * FROM labor WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$labors = array();
			while($result = mysql_fetch_array($results)) {
				$labor = new Labor();
				$labor->setDonation(readDonation($result[0]));
				$labor->setAmount($result[1]);
				$labor->setMethod($result[2]);
				$labor->setProject(readProject($result[3]));
				$labors[] = $labor;
			}// end while
		} else {
			$labor = false;
		}
		return $labor;
	}// end function

	public function updateLabor($labor) {
		global $con;
		$sql = 'UPDATE labor SET ($array) WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		return $results;
	}// end function

	public function deleteLabor($id) {
		global $con;
		$sql = 'DELETE FROM labor WHERE donation_id = WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		return $results;
	}// end function

	public function listLabor() {
		global $con;
		$sql = 'SELECT * FROM labor';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$labors = array();
			while($result = mysql_fetch_array($results)) {
				$labor = new Labor();
				$labor->setDonation(readDonation($result[0]));
				$labor->setAmount($result[1]);
				$labor->setMethod($result[2]);
				$labor->setProject(readProject($result[3]));
				$labors[] = $labor;
			}// end while
		} else {
			$labor = false;
		}
		return $labor;
	}// end function

	// marital_status // --------------------

	public function createMarital_status($marital_status, $array) {
		global $con;
		$sql = "INSERT INTO marital_status (id, title, description) VALUES ({$array})";
		$this->open();
		$results = mysql_query($sql, $con);
		$id = ($results) ? mysql_insert_id() : $results;
		$this->close();
		return $id;
	}// end function

	public function readMarital_status($id) {
		global $con;
		$sql = 'SELECT * FROM marital_status WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$marital_statuss = array();
			while($result = mysql_fetch_array($results)) {
				$marital_status = new Marital_status();
				$marital_status->setId($result[0]);
				$marital_status->setTitle($result[1]);
				$marital_status->setDescription($result[2]);
				$marital_statuss[] = $marital_status;
			}// end while
		} else {
			$marital_status = false;
		}
		return $marital_status;
	}// end function

	public function updateMarital_status($marital_status) {
		global $con;
		$sql = 'UPDATE marital_status SET ($array) WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		return $results;
	}// end function

	public function deleteMarital_status($id) {
		global $con;
		$sql = 'DELETE FROM marital_status WHERE id = WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		return $results;
	}// end function

	public function listMarital_status() {
		global $con;
		$sql = 'SELECT * FROM marital_status';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$marital_statuss = array();
			while($result = mysql_fetch_array($results)) {
				$marital_status = new Marital_status();
				$marital_status->setId($result[0]);
				$marital_status->setTitle($result[1]);
				$marital_status->setDescription($result[2]);
				$marital_statuss[] = $marital_status;
			}// end while
		} else {
			$marital_status = false;
		}
		return $marital_status;
	}// end function

	// material // --------------------

	public function createMaterial($material, $array) {
		global $con;
		$sql = "INSERT INTO material (donation_id, value, description) VALUES ({$array})";
		$this->open();
		$results = mysql_query($sql, $con);
		$id = ($results) ? mysql_insert_id() : $results;
		$this->close();
		return $id;
	}// end function

	public function readMaterial($id) {
		global $con;
		$sql = 'SELECT * FROM material WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$materials = array();
			while($result = mysql_fetch_array($results)) {
				$material = new Material();
				$material->setDonation(readDonation($result[0]));
				$material->setValue($result[1]);
				$material->setDescription($result[2]);
				$materials[] = $material;
			}// end while
		} else {
			$material = false;
		}
		return $material;
	}// end function

	public function updateMaterial($material) {
		global $con;
		$sql = 'UPDATE material SET ($array) WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		return $results;
	}// end function

	public function deleteMaterial($id) {
		global $con;
		$sql = 'DELETE FROM material WHERE donation_id = WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		return $results;
	}// end function

	public function listMaterial() {
		global $con;
		$sql = 'SELECT * FROM material';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$materials = array();
			while($result = mysql_fetch_array($results)) {
				$material = new Material();
				$material->setDonation(readDonation($result[0]));
				$material->setValue($result[1]);
				$material->setDescription($result[2]);
				$materials[] = $material;
			}// end while
		} else {
			$material = false;
		}
		return $material;
	}// end function

	// money // --------------------

	public function createMoney($money, $array) {
		global $con;
		$sql = "INSERT INTO money (donation_id, amount, method) VALUES ({$array})";
		$this->open();
		$results = mysql_query($sql, $con);
		$id = ($results) ? mysql_insert_id() : $results;
		$this->close();
		return $id;
	}// end function

	public function readMoney($id) {
		global $con;
		$sql = 'SELECT * FROM money WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$moneys = array();
			while($result = mysql_fetch_array($results)) {
				$money = new Money();
				$money->setDonation(readDonation($result[0]));
				$money->setAmount($result[1]);
				$money->setMethod($result[2]);
				$moneys[] = $money;
			}// end while
		} else {
			$money = false;
		}
		return $money;
	}// end function

	public function updateMoney($money) {
		global $con;
		$sql = 'UPDATE money SET ($array) WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		return $results;
	}// end function

	public function deleteMoney($id) {
		global $con;
		$sql = 'DELETE FROM money WHERE donation_id = WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		return $results;
	}// end function

	public function listMoney() {
		global $con;
		$sql = 'SELECT * FROM money';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$moneys = array();
			while($result = mysql_fetch_array($results)) {
				$money = new Money();
				$money->setDonation(readDonation($result[0]));
				$money->setAmount($result[1]);
				$money->setMethod($result[2]);
				$moneys[] = $money;
			}// end while
		} else {
			$money = false;
		}
		return $money;
	}// end function

	// mortgage // --------------------

	public function createMortgage($mortgage, $array) {
		global $con;
		$sql = "INSERT INTO mortgage (id, person_id, amount, status, project_id, bank_id) VALUES ({$array})";
		$this->open();
		$results = mysql_query($sql, $con);
		$id = ($results) ? mysql_insert_id() : $results;
		$this->close();
		return $id;
	}// end function

	public function readMortgage($id) {
		global $con;
		$sql = 'SELECT * FROM mortgage WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$mortgages = array();
			while($result = mysql_fetch_array($results)) {
				$mortgage = new Mortgage();
				$mortgage->setId($result[0]);
				$mortgage->setPerson($this->readPerson($result[1]));
				$mortgage->setAmount($result[2]);
				$mortgage->setStatus($result[3]);
				$mortgage->setProject(readProject($result[4]));
				$mortgage->setBank(readBank($result[5]));
				$mortgages[] = $mortgage;
			}// end while
		} else {
			$mortgage = false;
		}
		return $mortgage;
	}// end function

	public function updateMortgage($mortgage) {
		global $con;
		$sql = 'UPDATE mortgage SET ($array) WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		return $results;
	}// end function

	public function deleteMortgage($id) {
		global $con;
		$sql = 'DELETE FROM mortgage WHERE id = WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		return $results;
	}// end function

	public function listMortgage() {
		global $con;
		$sql = 'SELECT * FROM mortgage';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$mortgages = array();
			while($result = mysql_fetch_array($results)) {
				$mortgage = new Mortgage();
				$mortgage->setId($result[0]);
				$mortgage->setPerson($this->readPerson($result[1]));
				$mortgage->setAmount($result[2]);
				$mortgage->setStatus($result[3]);
				$mortgage->setProject(readProject($result[4]));
				$mortgage->setBank(readBank($result[5]));
				$mortgages[] = $mortgage;
			}// end while
		} else {
			$mortgage = false;
		}
		return $mortgage;
	}// end function

	// municipality // --------------------

	public function createMunicipality($municipality, $array) {
		global $con;
		$sql = "INSERT INTO municipality (id, title) VALUES ({$array})";
		$this->open();
		$results = mysql_query($sql, $con);
		$id = ($results) ? mysql_insert_id() : $results;
		$this->close();
		return $id;
	}// end function

	public function readMunicipality($id) {
		global $con;
		$sql = 'SELECT * FROM municipality WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$municipalitys = array();
			while($result = mysql_fetch_array($results)) {
				$municipality = new Municipality();
				$municipality->setId($result[0]);
				$municipality->setTitle($result[1]);
				$municipalitys[] = $municipality;
			}// end while
		} else {
			$municipality = false;
		}
		return $municipality;
	}// end function

	public function updateMunicipality($municipality) {
		global $con;
		$sql = 'UPDATE municipality SET ($array) WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		return $results;
	}// end function

	public function deleteMunicipality($id) {
		global $con;
		$sql = 'DELETE FROM municipality WHERE id = WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		return $results;
	}// end function

	public function listMunicipality() {
		global $con;
		$sql = 'SELECT * FROM municipality';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$municipalitys = array();
			while($result = mysql_fetch_array($results)) {
				$municipality = new Municipality();
				$municipality->setId($result[0]);
				$municipality->setTitle($result[1]);
				$municipalitys[] = $municipality;
			}// end while
		} else {
			$municipality = false;
		}
		return $municipality;
	}// end function

	// office // --------------------

	public function createOffice($office, $array) {
		global $con;
		$sql = "INSERT INTO office (id, person_id) VALUES ({$array})";
		$this->open();
		$results = mysql_query($sql, $con);
		$id = ($results) ? mysql_insert_id() : $results;
		$this->close();
		return $id;
	}// end function

	public function readOffice($id) {
		global $con;
		$sql = 'SELECT * FROM office WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$offices = array();
			while($result = mysql_fetch_array($results)) {
				$office = new Office();
				$office->setId($result[0]);
				$office->setPerson($this->readPerson($result[1]));
				$offices[] = $office;
			}// end while
		} else {
			$office = false;
		}
		return $office;
	}// end function
        
        public function readOfficeByPid($pid) {
		global $con;
		$sql = 'SELECT * FROM admin WHERE person_id = ' . $pid . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
                    $result = mysql_fetch_array($results);
				$office = new Office();
				$office->setId($result[0]);
				$office->setPerson($this->readPerson($result[1]));
		} else {
			$office = false;
		}
		return $office;
	}// end function

	public function updateOffice($office) {
		global $con;
		$sql = 'UPDATE office SET ($array) WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		return $results;
	}// end function

	public function deleteOffice($id) {
		global $con;
		$sql = 'DELETE FROM office WHERE id = WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		return $results;
	}// end function

	public function listOffice() {
		global $con;
		$sql = 'SELECT * FROM office';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$offices = array();
			while($result = mysql_fetch_array($results)) {
				$office = new Office();
				$office->setId($result[0]);
				$office->setPerson($this->readPerson($result[1]));
				$offices[] = $office;
			}// end while
		} else {
			$office = false;
		}
		return $office;
	}// end function

	// organization // --------------------

	public function createOrganization($organization, $array) {
		global $con;
		$sql = "INSERT INTO organization (id, name, contact_id) VALUES ({$array})";
		$this->open();
		$results = mysql_query($sql, $con);
		$id = ($results) ? mysql_insert_id() : $results;
		$this->close();
		return $id;
	}// end function

	public function readOrganization($id) {
		global $con;
		$sql = 'SELECT * FROM organization WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$organizations = array();
			while($result = mysql_fetch_array($results)) {
				$organization = new Organization();
				$organization->setId($result[0]);
				$organization->setName($result[1]);
				$organization->setContact(readContact($result[2]));
				$organizations[] = $organization;
			}// end while
		} else {
			$organization = false;
		}
		return $organization;
	}// end function

	public function updateOrganization($organization) {
		global $con;
		$sql = 'UPDATE organization SET ($array) WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		return $results;
	}// end function

	public function deleteOrganization($id) {
		global $con;
		$sql = 'DELETE FROM organization WHERE id = WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		return $results;
	}// end function

	public function listOrganization() {
		global $con;
		$sql = 'SELECT * FROM organization';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$organizations = array();
			while($result = mysql_fetch_array($results)) {
				$organization = new Organization();
				$organization->setId($result[0]);
				$organization->setName($result[1]);
				$organization->setContact($this->readContact($result[2]));
				$organizations[] = $organization;
			}// end while
		} else {
			$organizations = false;
		}
		return $organizations;
	}// end function

	// organization_contact // --------------------

	public function createOrganization_contact($organization_contact, $array) {
		global $con;
		$sql = "INSERT INTO organization_contact (organization_id, person_id, phone, ext, fax) VALUES ({$array})";
		$this->open();
		$results = mysql_query($sql, $con);
		$id = ($results) ? mysql_insert_id() : $results;
		$this->close();
		return $id;
	}// end function

	public function readOrganization_contact($id) {
		global $con;
		$sql = 'SELECT * FROM organization_contact WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$organization_contacts = array();
			while($result = mysql_fetch_array($results)) {
				$organization_contact = new Organization_contact();
				$organization_contact->setOrganization(readOrganization($result[0]));
				$organization_contact->setPerson($this->readPerson($result[1]));
				$organization_contact->setPhone($result[2]);
				$organization_contact->setExt($result[3]);
				$organization_contact->setFax($result[4]);
				$organization_contacts[] = $organization_contact;
			}// end while
		} else {
			$organization_contact = false;
		}
		return $organization_contact;
	}// end function

	public function updateOrganization_contact($organization_contact) {
		global $con;
		$sql = 'UPDATE organization_contact SET ($array) WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		return $results;
	}// end function

	public function deleteOrganization_contact($id) {
		global $con;
		$sql = 'DELETE FROM organization_contact WHERE organization_id = WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		return $results;
	}// end function

	public function listOrganization_contact() {
		global $con;
		$sql = 'SELECT * FROM organization_contact';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$organization_contacts = array();
			while($result = mysql_fetch_array($results)) {
				$organization_contact = new Organization_contact();
				$organization_contact->setOrganization(readOrganization($result[0]));
				$organization_contact->setPerson($this->readPerson($result[1]));
				$organization_contact->setPhone($result[2]);
				$organization_contact->setExt($result[3]);
				$organization_contact->setFax($result[4]);
				$organization_contacts[] = $organization_contact;
			}// end while
		} else {
			$organization_contact = false;
		}
		return $organization_contact;
	}// end function

	// organization_donation // --------------------

	public function createOrganization_donation($organization_donation, $array) {
		global $con;
		$sql = "INSERT INTO organization_donation (id, donation_id, organization_id) VALUES ({$array})";
		$this->open();
		$results = mysql_query($sql, $con);
		$id = ($results) ? mysql_insert_id() : $results;
		$this->close();
		return $id;
	}// end function

	public function readOrganization_donation($id) {
		global $con;
		$sql = 'SELECT * FROM organization_donation WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$organization_donations = array();
			while($result = mysql_fetch_array($results)) {
				$organization_donation = new Organization_donation();
				$organization_donation->setId($result[0]);
				$organization_donation->setDonation(readDonation($result[1]));
				$organization_donation->setOrganization(readOrganization($result[2]));
				$organization_donations[] = $organization_donation;
			}// end while
		} else {
			$organization_donation = false;
		}
		return $organization_donation;
	}// end function

	public function updateOrganization_donation($organization_donation) {
		global $con;
		$sql = 'UPDATE organization_donation SET ($array) WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		return $results;
	}// end function

	public function deleteOrganization_donation($id) {
		global $con;
		$sql = 'DELETE FROM organization_donation WHERE id = WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		return $results;
	}// end function

	public function listOrganization_donation() {
		global $con;
		$sql = 'SELECT * FROM organization_donation';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$organization_donations = array();
			while($result = mysql_fetch_array($results)) {
				$organization_donation = new Organization_donation();
				$organization_donation->setId($result[0]);
				$organization_donation->setDonation(readDonation($result[1]));
				$organization_donation->setOrganization(readOrganization($result[2]));
				$organization_donations[] = $organization_donation;
			}// end while
		} else {
			$organization_donation = false;
		}
		return $organization_donation;
	}// end function

	// payment // --------------------

	public function createPayment($payment, $array) {
		global $con;
		$sql = "INSERT INTO payment (id, person_id, mortgage_id, amount, date, time, office_id, when_authorized, admin_id) VALUES ({$array})";
		$this->open();
		$results = mysql_query($sql, $con);
		$id = ($results) ? mysql_insert_id() : $results;
		$this->close();
		return $id;
	}// end function

	public function readPayment($id) {
		global $con;
		$sql = 'SELECT * FROM payment WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$payments = array();
			while($result = mysql_fetch_array($results)) {
				$payment = new Payment();
				$payment->setId($result[0]);
				$payment->setPerson($this->readPerson($result[1]));
				$payment->setMortgage(readMortgage($result[2]));
				$payment->setAmount($result[3]);
				$payment->setDate($result[4]);
				$payment->setTime($result[5]);
				$payment->setOffice(readOffice($result[6]));
				$payment->setWhen_authorized($result[7]);
				$payment->setAdmin($this->readAdmin($result[8]));
				$payments[] = $payment;
			}// end while
		} else {
			$payment = false;
		}
		return $payment;
	}// end function

	public function updatePayment($payment) {
		global $con;
		$sql = 'UPDATE payment SET ($array) WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		return $results;
	}// end function

	public function deletePayment($id) {
		global $con;
		$sql = 'DELETE FROM payment WHERE id = WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		return $results;
	}// end function

	public function listPayment() {
		global $con;
		$sql = 'SELECT * FROM payment';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$payments = array();
			while($result = mysql_fetch_array($results)) {
				$payment = new Payment();
				$payment->setId($result[0]);
				$payment->setPerson($this->readPerson($result[1]));
				$payment->setMortgage(readMortgage($result[2]));
				$payment->setAmount($result[3]);
				$payment->setDate($result[4]);
				$payment->setTime($result[5]);
				$payment->setOffice(readOffice($result[6]));
				$payment->setWhen_authorized($result[7]);
				$payment->setAdmin($this->readAdmin($result[8]));
				$payments[] = $payment;
			}// end while
		} else {
			$payment = false;
		}
		return $payment;
	}// end function

	// person // --------------------

	public function createPerson($person, $array) {
		global $con;
		$sql = "INSERT INTO person (id, title, first_name, last_name, gender, dob, marital_status_id, contact_id) VALUES ({$array})";
		$this->open();
		$results = mysql_query($sql, $con);
		$id = ($results) ? mysql_insert_id() : $results;
		$this->close();
		return $id;
	}// end function

	public function readPerson($id) {
		global $con;
		$sql = "SELECT * FROM person WHERE id = '" . $id . "';";
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
                    $result = mysql_fetch_array($results);
				$person = new Person();
				$person->setId($result[0]);
				$person->setTitle($result[1]);
				$person->setFirst_name($result[2]);
				$person->setLast_name($result[3]);
				$person->setGender($result[4]);
				$person->setDob($result[5]);
				$person->setMarital_status($this->readMarital_status($result[6]));
				$person->setContact($this->readContact($result[7]));
		} else {
			$person = false;
		}
		return $person;
	}// end function
        
        public function readPersonByName($fName, $lName) {
		global $con;
                $sql = "SELECT * FROM person WHERE first_name LIKE '%{$fName}%' AND last_name LIKE '%{$lName}%';";
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
                    while($result = mysql_fetch_array($results)) {
                        $person = new Person();
                        $person->setId($result[0]);
                        $person->setTitle($result[1]);
                        $person->setFirst_name($result[2]);
                        $person->setLast_name($result[3]);
                        $person->setGender($result[4]);
                        $person->setDob($result[5]);
                        $person->setMarital_status($this->readMarital_status($result[6]));
                        $person->setContact($this->readContact($result[7]));
                        $persons[] = $person;
                    }
		} else {
			$persons = false;
		}
		return $persons;
	}// end function

	public function updatePerson($pid, $person) {
		global $con;
		//$array = implode(",",$person);
		$title = $person->getTitle();
		$fName = $person->getFirst_name();
		$lName = $person->getLast_name();
		$sql = "UPDATE person SET title='{$title}', first_name='{$fName}', last_name='{$lName}' WHERE id = '" . $pid . "'";
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		return $results;
	}// end function

	public function deletePerson($id) {
		global $con;
		$sql = 'DELETE FROM person WHERE id = WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		return $results;
	}// end function

	public function listPerson() {
		global $con;
		$sql = 'SELECT * FROM person';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$persons = array();
			while($result = mysql_fetch_array($results)) {
				$person = new Person();
				$person->setId($result[0]);
				$person->setTitle($result[1]);
				$person->setFirst_name($result[2]);
				$person->setLast_name($result[3]);
				$person->setGender($result[4]);
				$person->setDob($result[5]);
				$person->setMarital_status($this->readMarital_status($result[6]));
				$person->setContact($this->readContact($result[7]));
				$persons[] = $person;
			}// end while
		} else {
			$persons = false;
		}
		return $persons;
	}// end function

	// personal_donation // --------------------

	public function createPersonal_donation($personal_donation, $array) {
		global $con;
		$sql = "INSERT INTO personal_donation (id, donation_id, person_id) VALUES ({$array})";
		$this->open();
		$results = mysql_query($sql, $con);
		$id = ($results) ? mysql_insert_id() : $results;
		$this->close();
		return $id;
	}// end function

	public function readPersonal_donation($id) {
		global $con;
		$sql = 'SELECT * FROM personal_donation WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$personal_donations = array();
			while($result = mysql_fetch_array($results)) {
				$personal_donation = new Personal_donation();
				$personal_donation->setId($result[0]);
				$personal_donation->setDonation(readDonation($result[1]));
				$personal_donation->setPerson(readPerson($result[2]));
				$personal_donations[] = $personal_donation;
			}// end while
		} else {
			$personal_donation = false;
		}
		return $personal_donation;
	}// end function

	public function updatePersonal_donation($personal_donation) {
		global $con;
		$sql = 'UPDATE personal_donation SET ($array) WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		return $results;
	}// end function

	public function deletePersonal_donation($id) {
		global $con;
		$sql = 'DELETE FROM personal_donation WHERE id = WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		return $results;
	}// end function

	public function listPersonal_donation() {
		global $con;
		$sql = 'SELECT * FROM personal_donation';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$personal_donations = array();
			while($result = mysql_fetch_array($results)) {
				$personal_donation = new Personal_donation();
				$personal_donation->setId($result[0]);
				$personal_donation->setDonation($this->readDonation($result[1]));
				$personal_donation->setPerson($this->readPerson($result[2]));
				$personal_donations[] = $personal_donation;
			}// end while
		} else {
			$personal_donation = false;
		}
		return $personal_donations;
	}// end function

	// photo_id // --------------------

	public function createPhoto_id($photo_id, $array) {
		global $con;
		$sql = "INSERT INTO photo_id (person_id, photo_id) VALUES ({$array})";
		$this->open();
		$results = mysql_query($sql, $con);
		$id = ($results) ? mysql_insert_id() : $results;
		$this->close();
		return $id;
	}// end function

	public function readPhoto_id($id) {
		global $con;
		$sql = 'SELECT * FROM photo_id WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$photo_ids = array();
			while($result = mysql_fetch_array($results)) {
				$photo_id = new Photo_id();
				$photo_id->setPerson($this->readPerson($result[0]));
				$photo_id->setPhoto(readPhoto($result[1]));
				$photo_ids[] = $photo_id;
			}// end while
		} else {
			$photo_id = false;
		}
		return $photo_id;
	}// end function

	public function updatePhoto_id($photo_id) {
		global $con;
		$sql = 'UPDATE photo_id SET ($array) WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		return $results;
	}// end function

	public function deletePhoto_id($id) {
		global $con;
		$sql = 'DELETE FROM photo_id WHERE person_id = WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		return $results;
	}// end function

	public function listPhoto_id() {
		global $con;
		$sql = 'SELECT * FROM photo_id';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$photo_ids = array();
			while($result = mysql_fetch_array($results)) {
				$photo_id = new Photo_id();
				$photo_id->setPerson($this->readPerson($result[0]));
				$photo_id->setPhoto(readPhoto($result[1]));
				$photo_ids[] = $photo_id;
			}// end while
		} else {
			$photo_id = false;
		}
		return $photo_id;
	}// end function

	// project // --------------------

	public function createProject($project, $array) {
		global $con;
		$sql = "INSERT INTO project (id, is_active, municipality_id, sponsor_id, date_of_origin, start_date, estimated_completion_date, actual_completion_date, description, extimated_valutation, estimated_purchase, estimated_rehab, estimated_Pre-Acq, actual_pre_acq, estimated_sponser_value, estimated_donation_value, estimated_sell_price, estimated_volunteer_hours, estimated_purchase_cost, actual_purchase_cost, materials_budger, labor_budget, subContract_budget, indirectAllocation_budget, buyer_hours_required, estimated_selling_price, actual_appraisal_value, actual_sell_price) VALUES ({$array})";
		$this->open();
		$results = mysql_query($sql, $con);
		$id = ($results) ? mysql_insert_id() : $results;
		$this->close();
		return $id;
	}// end function

	public function readProject($id) {
		global $con;
		$sql = 'SELECT * FROM project WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$projects = array();
			while($result = mysql_fetch_array($results)) {
				$project = new Project();
				$project->setId($result[0]);
				$project->setIs_active($result[1]);
				$project->setMunicipality(readMunicipality($result[2]));
				$project->setSponsor(readSponsor($result[3]));
				$project->setDate_of_origin($result[4]);
				$project->setStart_date($result[5]);
				$project->setEstimated_completion_date($result[6]);
				$project->setActual_completion_date($result[7]);
				$project->setDescription($result[8]);
				$project->setExtimated_valutation($result[9]);
				$project->setEstimated_purchase($result[10]);
				$project->setEstimated_rehab($result[11]);
				$project->setEstimated_Pre-Acq($result[12]);
				$project->setActual_pre_acq($result[13]);
				$project->setEstimated_sponser_value($result[14]);
				$project->setEstimated_donation_value($result[15]);
				$project->setEstimated_sell_price($result[16]);
				$project->setEstimated_volunteer_hours($result[17]);
				$project->setEstimated_purchase_cost($result[18]);
				$project->setActual_purchase_cost($result[19]);
				$project->setMaterials_budger($result[20]);
				$project->setLabor_budget($result[21]);
				$project->setSubContract_budget($result[22]);
				$project->setIndirectAllocation_budget($result[23]);
				$project->setBuyer_hours_required($result[24]);
				$project->setEstimated_selling_price($result[25]);
				$project->setActual_appraisal_value($result[26]);
				$project->setActual_sell_price($result[27]);
				$projects[] = $project;
			}// end while
		} else {
			$project = false;
		}
		return $project;
	}// end function

	public function updateProject($project) {
		global $con;
		$sql = 'UPDATE project SET ($array) WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		return $results;
	}// end function

	public function deleteProject($id) {
		global $con;
		$sql = 'DELETE FROM project WHERE id = WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		return $results;
	}// end function

	public function listProject() {
		global $con;
		$sql = 'SELECT * FROM project';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$projects = array();
			while($result = mysql_fetch_array($results)) {
				$project = new Project();
				$project->setId($result[0]);
				$project->setIs_active($result[1]);
				$project->setMunicipality(readMunicipality($result[2]));
				$project->setSponsor(readSponsor($result[3]));
				$project->setDate_of_origin($result[4]);
				$project->setStart_date($result[5]);
				$project->setEstimated_completion_date($result[6]);
				$project->setActual_completion_date($result[7]);
				$project->setDescription($result[8]);
				$project->setExtimated_valutation($result[9]);
				$project->setEstimated_purchase($result[10]);
				$project->setEstimated_rehab($result[11]);
				$project->setEstimated_Pre-Acq($result[12]);
				$project->setActual_pre_acq($result[13]);
				$project->setEstimated_sponser_value($result[14]);
				$project->setEstimated_donation_value($result[15]);
				$project->setEstimated_sell_price($result[16]);
				$project->setEstimated_volunteer_hours($result[17]);
				$project->setEstimated_purchase_cost($result[18]);
				$project->setActual_purchase_cost($result[19]);
				$project->setMaterials_budger($result[20]);
				$project->setLabor_budget($result[21]);
				$project->setSubContract_budget($result[22]);
				$project->setIndirectAllocation_budget($result[23]);
				$project->setBuyer_hours_required($result[24]);
				$project->setEstimated_selling_price($result[25]);
				$project->setActual_appraisal_value($result[26]);
				$project->setActual_sell_price($result[27]);
				$projects[] = $project;
			}// end while
		} else {
			$project = false;
		}
		return $project;
	}// end function

	// project_donation // --------------------

	public function createProject_donation($project_donation, $array) {
		global $con;
		$sql = "INSERT INTO project_donation (id, project_id, donation_id) VALUES ({$array})";
		$this->open();
		$results = mysql_query($sql, $con);
		$id = ($results) ? mysql_insert_id() : $results;
		$this->close();
		return $id;
	}// end function

	public function readProject_donation($id) {
		global $con;
		$sql = 'SELECT * FROM project_donation WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$project_donations = array();
			while($result = mysql_fetch_array($results)) {
				$project_donation = new Project_donation();
				$project_donation->setId($result[0]);
				$project_donation->setProject(readProject($result[1]));
				$project_donation->setDonation(readDonation($result[2]));
				$project_donations[] = $project_donation;
			}// end while
		} else {
			$project_donation = false;
		}
		return $project_donation;
	}// end function

	public function updateProject_donation($project_donation) {
		global $con;
		$sql = 'UPDATE project_donation SET ($array) WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		return $results;
	}// end function

	public function deleteProject_donation($id) {
		global $con;
		$sql = 'DELETE FROM project_donation WHERE id = WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		return $results;
	}// end function

	public function listProject_donation() {
		global $con;
		$sql = 'SELECT * FROM project_donation';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$project_donations = array();
			while($result = mysql_fetch_array($results)) {
				$project_donation = new Project_donation();
				$project_donation->setId($result[0]);
				$project_donation->setProject(readProject($result[1]));
				$project_donation->setDonation(readDonation($result[2]));
				$project_donations[] = $project_donation;
			}// end while
		} else {
			$project_donation = false;
		}
		return $project_donation;
	}// end function

	// project_event // --------------------

	public function createProject_event($project_event, $array) {
		global $con;
		$sql = "INSERT INTO project_event (event_id, project_id) VALUES ({$array})";
		$this->open();
		$results = mysql_query($sql, $con);
		$id = ($results) ? mysql_insert_id() : $results;
		$this->close();
		return $id;
	}// end function

	public function readProject_event($id) {
		global $con;
		$sql = 'SELECT * FROM project_event WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$project_events = array();
			while($result = mysql_fetch_array($results)) {
				$project_event = new Project_event();
				$project_event->setEvent($this->readEvent($result[0]));
				$project_event->setProject(readProject($result[1]));
				$project_events[] = $project_event;
			}// end while
		} else {
			$project_event = false;
		}
		return $project_event;
	}// end function

	public function updateProject_event($project_event) {
		global $con;
		$sql = 'UPDATE project_event SET ($array) WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		return $results;
	}// end function

	public function deleteProject_event($id) {
		global $con;
		$sql = 'DELETE FROM project_event WHERE event_id = WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		return $results;
	}// end function

	public function listProject_event() {
		global $con;
		$sql = 'SELECT * FROM project_event';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$project_events = array();
			while($result = mysql_fetch_array($results)) {
				$project_event = new Project_event();
				$project_event->setEvent($this->readEvent($result[0]));
				$project_event->setProject(readProject($result[1]));
				$project_events[] = $project_event;
			}// end while
		} else {
			$project_event = false;
		}
		return $project_event;
	}// end function

	// project_expenses // --------------------

	public function createProject_expenses($project_expenses, $array) {
		global $con;
		$sql = "INSERT INTO project_expenses (id, title, description, project_id, type_id, amount, when_entered, office_id, when_authorized, admin_id) VALUES ({$array})";
		$this->open();
		$results = mysql_query($sql, $con);
		$id = ($results) ? mysql_insert_id() : $results;
		$this->close();
		return $id;
	}// end function

	public function readProject_expenses($id) {
		global $con;
		$sql = 'SELECT * FROM project_expenses WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$project_expensess = array();
			while($result = mysql_fetch_array($results)) {
				$project_expenses = new Project_expenses();
				$project_expenses->setId($result[0]);
				$project_expenses->setTitle($result[1]);
				$project_expenses->setDescription($result[2]);
				$project_expenses->setProject(readProject($result[3]));
				$project_expenses->setType($this->readInterest_type($result[4]));
				$project_expenses->setAmount($result[5]);
				$project_expenses->setWhen_entered($result[6]);
				$project_expenses->setOffice(readOffice($result[7]));
				$project_expenses->setWhen_authorized($result[8]);
				$project_expenses->setAdmin($this->readAdmin($result[9]));
				$project_expensess[] = $project_expenses;
			}// end while
		} else {
			$project_expenses = false;
		}
		return $project_expenses;
	}// end function

	public function updateProject_expenses($project_expenses) {
		global $con;
		$sql = 'UPDATE project_expenses SET ($array) WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		return $results;
	}// end function

	public function deleteProject_expenses($id) {
		global $con;
		$sql = 'DELETE FROM project_expenses WHERE id = WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		return $results;
	}// end function

	public function listProject_expenses() {
		global $con;
		$sql = 'SELECT * FROM project_expenses';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$project_expensess = array();
			while($result = mysql_fetch_array($results)) {
				$project_expenses = new Project_expenses();
				$project_expenses->setId($result[0]);
				$project_expenses->setTitle($result[1]);
				$project_expenses->setDescription($result[2]);
				$project_expenses->setProject(readProject($result[3]));
				$project_expenses->setType($this->readInterest_type($result[4]));
				$project_expenses->setAmount($result[5]);
				$project_expenses->setWhen_entered($result[6]);
				$project_expenses->setOffice(readOffice($result[7]));
				$project_expenses->setWhen_authorized($result[8]);
				$project_expenses->setAdmin($this->readAdmin($result[9]));
				$project_expensess[] = $project_expenses;
			}// end while
		} else {
			$project_expenses = false;
		}
		return $project_expenses;
	}// end function

	// project_status // --------------------

	public function createProject_status($project_status, $array) {
		global $con;
		$sql = "INSERT INTO project_status (id, title, description, abbreviation) VALUES ({$array})";
		$this->open();
		$results = mysql_query($sql, $con);
		$id = ($results) ? mysql_insert_id() : $results;
		$this->close();
		return $id;
	}// end function

	public function readProject_status($id) {
		global $con;
		$sql = 'SELECT * FROM project_status WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$project_statuss = array();
			while($result = mysql_fetch_array($results)) {
				$project_status = new Project_status();
				$project_status->setId($result[0]);
				$project_status->setTitle($result[1]);
				$project_status->setDescription($result[2]);
				$project_status->setAbbreviation($result[3]);
				$project_statuss[] = $project_status;
			}// end while
		} else {
			$project_status = false;
		}
		return $project_status;
	}// end function

	public function updateProject_status($project_status) {
		global $con;
		$sql = 'UPDATE project_status SET ($array) WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		return $results;
	}// end function

	public function deleteProject_status($id) {
		global $con;
		$sql = 'DELETE FROM project_status WHERE id = WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		return $results;
	}// end function

	public function listProject_status() {
		global $con;
		$sql = 'SELECT * FROM project_status';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$project_statuss = array();
			while($result = mysql_fetch_array($results)) {
				$project_status = new Project_status();
				$project_status->setId($result[0]);
				$project_status->setTitle($result[1]);
				$project_status->setDescription($result[2]);
				$project_status->setAbbreviation($result[3]);
				$project_statuss[] = $project_status;
			}// end while
		} else {
			$project_status = false;
		}
		return $project_status;
	}// end function

	// recovery_log // --------------------

	public function createRecovery_log($recovery_log, $array) {
		global $con;
		$sql = "INSERT INTO recovery_log (account_id, date, time) VALUES ({$array})";
		$this->open();
		$results = mysql_query($sql, $con);
		$id = ($results) ? mysql_insert_id() : $results;
		$this->close();
		return $id;
	}// end function

	public function readRecovery_log($id) {
		global $con;
		$sql = 'SELECT * FROM recovery_log WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$recovery_logs = array();
			while($result = mysql_fetch_array($results)) {
				$recovery_log = new Recovery_log();
				$recovery_log->setAccount($this->readAccount($result[0]));
				$recovery_log->setDate($result[1]);
				$recovery_log->setTime($result[2]);
				$recovery_logs[] = $recovery_log;
			}// end while
		} else {
			$recovery_log = false;
		}
		return $recovery_log;
	}// end function

	public function updateRecovery_log($recovery_log) {
		global $con;
		$sql = 'UPDATE recovery_log SET ($array) WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		return $results;
	}// end function

	public function deleteRecovery_log($id) {
		global $con;
		$sql = 'DELETE FROM recovery_log WHERE account_id = WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		return $results;
	}// end function

	public function listRecovery_log() {
		global $con;
		$sql = 'SELECT * FROM recovery_log';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$recovery_logs = array();
			while($result = mysql_fetch_array($results)) {
				$recovery_log = new Recovery_log();
				$recovery_log->setAccount($this->readAccount($result[0]));
				$recovery_log->setDate($result[1]);
				$recovery_log->setTime($result[2]);
				$recovery_logs[] = $recovery_log;
			}// end while
		} else {
			$recovery_log = false;
		}
		return $recovery_log;
	}// end function

	// requirement // --------------------

	public function createRequirement($requirement, $array) {
		global $con;
		$sql = "INSERT INTO requirement (id, title, description) VALUES ({$array})";
		$this->open();
		$results = mysql_query($sql, $con);
		$id = ($results) ? mysql_insert_id() : $results;
		$this->close();
		return $id;
	}// end function

	public function readRequirement($id) {
		global $con;
		$sql = 'SELECT * FROM requirement WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$requirements = array();
			while($result = mysql_fetch_array($results)) {
				$requirement = new Requirement();
				$requirement->setId($result[0]);
				$requirement->setTitle($result[1]);
				$requirement->setDescription($result[2]);
				$requirements[] = $requirement;
			}// end while
		} else {
			$requirement = false;
		}
		return $requirement;
	}// end function

	public function updateRequirement($requirement) {
		global $con;
		$sql = 'UPDATE requirement SET ($array) WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		return $results;
	}// end function

	public function deleteRequirement($id) {
		global $con;
		$sql = 'DELETE FROM requirement WHERE id = WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		return $results;
	}// end function

	public function listRequirement() {
		global $con;
		$sql = 'SELECT * FROM requirement';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$requirements = array();
			while($result = mysql_fetch_array($results)) {
				$requirement = new Requirement();
				$requirement->setId($result[0]);
				$requirement->setTitle($result[1]);
				$requirement->setDescription($result[2]);
				$requirements[] = $requirement;
			}// end while
		} else {
			$requirement = false;
		}
		return $requirement;
	}// end function

	// schedule // --------------------

	public function createSchedule($schedule, $array) {
		global $con;
		$sql = "INSERT INTO schedule (id, schedule_id, start_time, end_time, description, interest_id, max_num_people) VALUES ({$array})";
		$this->open();
		$results = mysql_query($sql, $con);
		$id = ($results) ? mysql_insert_id() : $results;
		$this->close();
		return $id;
	}// end function

	public function readSchedule($id) {
		global $con;
		$sql = 'SELECT * FROM schedule WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$schedules = array();
			while($result = mysql_fetch_array($results)) {
				$schedule = new Schedule();
				$schedule->setId($result[0]);
				$schedule->setSchedule(readSchedule($result[1]));
				$schedule->setStart_time($result[2]);
				$schedule->setEnd_time($result[3]);
				$schedule->setDescription($result[4]);
				$schedule->setInterest(readInterest($result[5]));
				$schedule->setMax_num_people($result[6]);
				$schedules[] = $schedule;
			}// end while
		} else {
			$schedule = false;
		}
		return $schedule;
	}// end function

	public function updateSchedule($schedule) {
		global $con;
		$sql = 'UPDATE schedule SET ($array) WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		return $results;
	}// end function

	public function deleteSchedule($id) {
		global $con;
		$sql = 'DELETE FROM schedule WHERE id = WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		return $results;
	}// end function

	public function listSchedule() {
		global $con;
		$sql = 'SELECT * FROM schedule';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$schedules = array();
			while($result = mysql_fetch_array($results)) {
				$schedule = new Schedule();
				$schedule->setId($result[0]);
				$schedule->setSchedule(readSchedule($result[1]));
				$schedule->setStart_time($result[2]);
				$schedule->setEnd_time($result[3]);
				$schedule->setDescription($result[4]);
				$schedule->setInterest(readInterest($result[5]));
				$schedule->setMax_num_people($result[6]);
				$schedules[] = $schedule;
			}// end while
		} else {
			$schedule = false;
		}
		return $schedule;
	}// end function

	// serves_on // --------------------

	public function createServes_on($serves_on, $array) {
		global $con;
		$sql = "INSERT INTO serves_on (volunteer_id, committee_id, is_officer) VALUES ({$array})";
		$this->open();
		$results = mysql_query($sql, $con);
		$id = ($results) ? mysql_insert_id() : $results;
		$this->close();
		return $id;
	}// end function

	public function readServes_on($id) {
		global $con;
		$sql = 'SELECT * FROM serves_on WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$serves_ons = array();
			while($result = mysql_fetch_array($results)) {
				$serves_on = new Serves_on();
				$serves_on->setVolunteer($this->readVolunteer($result[0]));
				$serves_on->setCommittee($this->readCommittee($result[1]));
				$serves_on->setIs_officer($result[2]);
				$serves_ons[] = $serves_on;
			}// end while
		} else {
			$serves_on = false;
		}
		return $serves_on;
	}// end function

	public function updateServes_on($serves_on) {
		global $con;
		$sql = 'UPDATE serves_on SET ($array) WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		return $results;
	}// end function

	public function deleteServes_on($id) {
		global $con;
		$sql = 'DELETE FROM serves_on WHERE volunteer_id = WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		return $results;
	}// end function

	public function listServes_on() {
		global $con;
		$sql = 'SELECT * FROM serves_on';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$serves_ons = array();
			while($result = mysql_fetch_array($results)) {
				$serves_on = new Serves_on();
				$serves_on->setVolunteer($this->readVolunteer($result[0]));
				$serves_on->setCommittee($this->readCommittee($result[1]));
				$serves_on->setIs_officer($result[2]);
				$serves_ons[] = $serves_on;
			}// end while
		} else {
			$serves_on = false;
		}
		return $serves_on;
	}// end function

	// state // --------------------

	public function createState($state, $array) {
		global $con;
		$sql = "INSERT INTO state (id, abbreviation, title) VALUES ({$array})";
		$this->open();
		$results = mysql_query($sql, $con);
		$id = ($results) ? mysql_insert_id() : $results;
		$this->close();
		return $id;
	}// end function

	public function readState($id) {
		global $con;
		$sql = 'SELECT * FROM state WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$states = array();
			while($result = mysql_fetch_array($results)) {
				$state = new State();
				$state->setId($result[0]);
				$state->setAbbreviation($result[1]);
				$state->setTitle($result[2]);
				$states[] = $state;
			}// end while
		} else {
			$state = false;
		}
		return $state;
	}// end function
        
        public function readStateByTitle($title) {
		global $con;
		$sql = 'SELECT * FROM state WHERE title = ' . $title . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$result = mysql_fetch_array($results); 
				$state = new State();
				$state->setId($result[0]);
				$state->setAbbreviation($result[1]);
				$state->setTitle($result[2]);
		} else {
			$state = false;
		}
		return $state;
	}// end function

	public function updateState($state) {
		global $con;
		$sql = 'UPDATE state SET ($array) WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		return $results;
	}// end function

	public function deleteState($id) {
		global $con;
		$sql = 'DELETE FROM state WHERE id = WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		return $results;
	}// end function

	public function listState() {
		global $con;
		$sql = 'SELECT * FROM state';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$states = array();
			while($result = mysql_fetch_array($results)) {
				$state = new State();
				$state->setId($result[0]);
				$state->setAbbreviation($result[1]);
				$state->setTitle($result[2]);
				$states[] = $state;
			}// end while
		} else {
			$state = false;
		}
		return $state;
	}// end function

	// status_change // --------------------

	public function createStatus_change($status_change, $array) {
		global $con;
		$sql = "INSERT INTO status_change (project_id, status_id, when_changed) VALUES ({$array})";
		$this->open();
		$results = mysql_query($sql, $con);
		$id = ($results) ? mysql_insert_id() : $results;
		$this->close();
		return $id;
	}// end function

	public function readStatus_change($id) {
		global $con;
		$sql = 'SELECT * FROM status_change WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$status_changes = array();
			while($result = mysql_fetch_array($results)) {
				$status_change = new Status_change();
				$status_change->setProject(readProject($result[0]));
				$status_change->setStatus($this->readStatus_change($result[1]));
				$status_change->setWhen_changed($result[2]);
				$status_changes[] = $status_change;
			}// end while
		} else {
			$status_change = false;
		}
		return $status_change;
	}// end function

	public function updateStatus_change($status_change) {
		global $con;
		$sql = 'UPDATE status_change SET ($array) WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		return $results;
	}// end function

	public function deleteStatus_change($id) {
		global $con;
		$sql = 'DELETE FROM status_change WHERE project_id = WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		return $results;
	}// end function

	public function listStatus_change() {
		global $con;
		$sql = 'SELECT * FROM status_change';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$status_changes = array();
			while($result = mysql_fetch_array($results)) {
				$status_change = new Status_change();
				$status_change->setProject(readProject($result[0]));
				$status_change->setStatus($this->readStatus_change($result[1]));
				$status_change->setWhen_changed($result[2]);
				$status_changes[] = $status_change;
			}// end while
		} else {
			$status_change = false;
		}
		return $status_change;
	}// end function

	// tickets // --------------------

	public function createTickets($tickets, $array) {
		global $con;
		$sql = "INSERT INTO tickets (event_id, id, ticket_price, max_num, current_num) VALUES ({$array})";
		$this->open();
		$results = mysql_query($sql, $con);
		$id = ($results) ? mysql_insert_id() : $results;
		$this->close();
		return $id;
	}// end function

	public function readTickets($id) {
		global $con;
		$sql = 'SELECT * FROM tickets WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$ticketss = array();
			while($result = mysql_fetch_array($results)) {
				$tickets = new Tickets();
				$tickets->setEvent($this->readEvent($result[0]));
				$tickets->setId($result[1]);
				$tickets->setTicket_price($result[2]);
				$tickets->setMax_num($result[3]);
				$tickets->setCurrent_num($result[4]);
				$ticketss[] = $tickets;
			}// end while
		} else {
			$tickets = false;
		}
		return $tickets;
	}// end function

	public function updateTickets($tickets) {
		global $con;
		$sql = 'UPDATE tickets SET ($array) WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		return $results;
	}// end function

	public function deleteTickets($id) {
		global $con;
		$sql = 'DELETE FROM tickets WHERE event_id = WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		return $results;
	}// end function

	public function listTickets() {
		global $con;
		$sql = 'SELECT * FROM tickets';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$ticketss = array();
			while($result = mysql_fetch_array($results)) {
				$tickets = new Tickets();
				$tickets->setEvent($this->readEvent($result[0]));
				$tickets->setId($result[1]);
				$tickets->setTicket_price($result[2]);
				$tickets->setMax_num($result[3]);
				$tickets->setCurrent_num($result[4]);
				$ticketss[] = $tickets;
			}// end while
		} else {
			$tickets = false;
		}
		return $tickets;
	}// end function

	// volunteer // --------------------

	public function createVolunteer($volunteer, $array) {
		global $con;
		$sql = "INSERT INTO volunteer (id, person_id, consent_age, consent_video, consent_waiver, consent_photo, consent_minor, consent_safety, avail_day, avail_eve, avail_wkend, emergency_name, emergency_phone) VALUES ({$array})";
		$this->open();
		$results = mysql_query($sql, $con);
		$id = ($results) ? mysql_insert_id() : $results;
		$this->close();
		return $id;
	}// end function

	public function readVolunteer($id) {
		global $con;
		$sql = 'SELECT * FROM volunteer WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$volunteers = array();
			while($result = mysql_fetch_array($results)) {
				$volunteer = new Volunteer();
				$volunteer->setId($result[0]);
				$volunteer->setPerson($this->readPerson($result[1]));
				$volunteer->setConsent_age($result[2]);
				$volunteer->setConsent_video($result[3]);
				$volunteer->setConsent_waiver($result[4]);
				$volunteer->setConsent_photo($result[5]);
				$volunteer->setConsent_minor($result[6]);
				$volunteer->setConsent_safety($result[7]);
				$volunteer->setAvail_day($result[8]);
				$volunteer->setAvail_eve($result[9]);
				$volunteer->setAvail_wkend($result[10]);
				$volunteer->setEmergency_name($result[11]);
				$volunteer->setEmergency_phone($result[12]);
				$volunteers[] = $volunteer;
			}// end while
		} else {
			$volunteer = false;
		}
		return $volunteer;
	}// end function
        
        public function readVolunteerByPid($pid) {
		global $con;
		$sql = 'SELECT * FROM volunteer WHERE person_id= ' . $pid . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$result = mysql_fetch_array($results);
				$volunteer = new Volunteer();
				$volunteer->setId($result[0]);
				$volunteer->setPerson($this->readPerson($result[1]));
				$volunteer->setConsent_age($result[2]);
				$volunteer->setConsent_video($result[3]);
				$volunteer->setConsent_waiver($result[4]);
				$volunteer->setConsent_photo($result[5]);
				$volunteer->setConsent_minor($result[6]);
				$volunteer->setConsent_safety($result[7]);
				$volunteer->setAvail_day($result[8]);
				$volunteer->setAvail_eve($result[9]);
				$volunteer->setAvail_wkend($result[10]);
				$volunteer->setEmergency_name($result[11]);
				$volunteer->setEmergency_phone($result[12]);
		} else {
			$volunteer = false;
		}
		return $volunteer;
	}// end function

	public function updateVolunteerAvailability($personId, $avail_day, $avail_eve, $avail_wkend) {
		global $con;
                $sql = "UPDATE volunteer SET avail_day = '{$avail_day}', avail_eve = '{$avail_eve}', avail_wkend = '{$avail_wkend}' WHERE person_id = '{$personId}';";
		$this->open();
		mysql_query($sql, $con);
		$this->close();
		return true;
	}// end function
        
        public function updateVolunteerConsent($personId, $emergencyName, $emergencyPhone) {
		global $con;
                $sql = "UPDATE volunteer SET emergency_name = '{$emergencyName}', emergency_phone = '{$emergencyPhone}' WHERE person_id = '{$personId}';";
		$this->open();
		mysql_query($sql, $con);
		$this->close();
		return true;
	}// end function

	public function deleteVolunteer($id) {
		global $con;
		$sql = 'DELETE FROM volunteer WHERE id = WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		return $results;
	}// end function

	public function listVolunteer() {
		global $con;
		$sql = 'SELECT * FROM volunteer';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$volunteers = array();
			while($result = mysql_fetch_array($results)) {
				$volunteer = new Volunteer();
				$volunteer->setId($result[0]);
				$volunteer->setPerson($this->readPerson($result[1]));
				$volunteer->setConsent_age($result[2]);
				$volunteer->setConsent_video($result[3]);
				$volunteer->setConsent_waiver($result[4]);
				$volunteer->setConsent_photo($result[5]);
				$volunteer->setConsent_minor($result[6]);
				$volunteer->setConsent_safety($result[7]);
				$volunteer->setAvail_day($result[8]);
				$volunteer->setAvail_eve($result[9]);
				$volunteer->setAvail_wkend($result[10]);
				$volunteer->setEmergency_name($result[11]);
				$volunteer->setEmergency_phone($result[12]);
				$volunteers[] = $volunteer;
			}// end while
		} else {
			$volunteers = false;
		}
		return $volunteers;
	}// end function

	// work // --------------------

	public function createWork($work, $array) {
		global $con;
		$sql = "INSERT INTO work (id, volunteer_id, date, event_id, when_entered, office_id, when_authorized, admin_id, hours_worked) VALUES ({$array})";
		$this->open();
		$results = mysql_query($sql, $con);
		$id = ($results) ? mysql_insert_id() : $results;
		$this->close();
		return $id;
	}// end function

	public function readWork($id) {
		global $con;
		$sql = 'SELECT * FROM work WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$works = array();
			while($result = mysql_fetch_array($results)) {
				$work = new Work();
				$work->setId($result[0]);
				$work->setVolunteer($this->readVolunteer($result[1]));
				$work->setDate($result[2]);
				$work->setEvent($this->readEvent($result[3]));
				$work->setWhen_entered($result[4]);
				$work->setOffice(readOffice($result[5]));
				$work->setWhen_authorized($result[6]);
				$work->setAdmin($this->readAdmin($result[7]));
				$work->setHours_worked($result[8]);
				$works[] = $work;
			}// end while
		} else {
			$work = false;
		}
		return $work;
	}// end function
        
        public function readWorkByVid($vid) {
		global $con;
		$sql = 'SELECT * FROM work WHERE volunteer_id = ' . $vid . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$works = array();
			while($result = mysql_fetch_array($results)) {
				$work = new Work();
				$work->setId($result[0]);
				$work->setVolunteer($this->readVolunteer($result[1]));
				$work->setDate($result[2]);
				$work->setEvent($this->readEvent($result[3]));
				$work->setWhen_entered($result[4]);
				$work->setOffice($this->readOffice($result[5]));
				$work->setWhen_authorized($result[6]);
				$work->setAdmin($this->readAdmin($result[7]));
				$work->setHours_worked($result[8]);
				$works[] = $work;
			}// end while
		} else {
			$works = false;
		}
		return $works;
	}// end function

	public function updateWork($work) {
		global $con;
		$sql = 'UPDATE work SET ($array) WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		return $results;
	}// end function

	public function deleteWork($id) {
		global $con;
		$sql = 'DELETE FROM work WHERE id = WHERE id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		return $results;
	}// end function

	public function listWork() {
		global $con;
		$sql = 'SELECT * FROM work';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$works = array();
			while($result = mysql_fetch_array($results)) {
				$work = new Work();
				$work->setId($result[0]);
				$work->setVolunteer($this->readVolunteer($result[1]));
				$work->setDate($result[2]);
				$work->setEvent(readEvent($result[3]));
				$work->setWhen_entered($result[4]);
				$work->setOffice(readOffice($result[5]));
				$work->setWhen_authorized($result[6]);
				$work->setAdmin($this->readAdmin($result[7]));
				$work->setHours_worked($result[8]);
				$works[] = $work;
			}// end while
		} else {
			$work = false;
		}
		return $work;
	}// end function

    }
?>