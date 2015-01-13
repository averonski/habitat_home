<?php

	// TITLE: Database Model
	// FILE: model/dbio.php
	// AUTHOR: AUTOGEN



	class dbio {

		// ATTRIBUTES /////////////////////////////////////////////////////////////////////////////

		protected $con;
                protected $link;

		// CONSTRUCTOR ////////////////////////////////////////////////////////////////////////////

		public function __construct() {}


		// METHODS ////////////////////////////////////////////////////////////////////////////////

		private function open() {
			global $con;
			$hostname = 'mysql3.000webhost.com';
			$username = 'a6127773_root';
			$password = '440wistpsuyk';
			$database = 'a612773_habitat';
			$con = mysql_connect($hostname, $username, $password) or die ('no worky');
			mysql_select_db($database);
		}// END
                
                private function openi() {
			global $link;
			$hostname = 'mysql3.000webhost.com';
			$username = 'a6127773_root';
			$password = '440wistpsuyk';
			$database = 'a612773_habitat';
			$link = mysqli_connect($hostname, $username, $password, $database);
                            if (mysqli_connect_errno()) {
                                printf("Connect failed: %s\n", mysqli_connect_error());
                                exit();
                            }
		}// END

		private function close() {
			global $con;
			mysql_close($con);
		}// END
                
                private function closei() {
			global $link;
			mysqli_close($link);
		}// END


		// BUSINESS LOGIC METHODS //////////////////////////////////////////////
                
                //modified queries // ---------------------
                
                public function readAccount_by_account($id) {
		global $con;
                $sql = "SELECT * FROM account WHERE id = '{$id}';";
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
                     $result = mysql_fetch_array($results);
				$account = new Account();
				$account->setId($result[0]);
				$account->setEmail($this->readEmail($result[1]));
				$account->setPassword($result[2]);
				$account->setCreated($result[3]);
				$account->setStatus($this->readStatus_change($result[4]));
				$account->setPerson($this->readPerson($result[5]));
		} else {
			$account = false;;
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
                    $accounts = false;;
		}
		return $accounts;
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
			$admin = false;;
		}
		return $admin;
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
			$email = false;;
		}
		return $email;
                }// end function
                
                public function readFoh_by_person($id) {
		global $con;
                $sql = "SELECT * FROM foh WHERE person_id = '{$id}'";
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$result = mysql_fetch_array($results);
                                $foh = new Foh;
				$foh->setEvent($this->readEvent($result[0]));
				$foh->setPerson($this->readPerson($result[1]));
		} else {
			$foh = false;;
		}
		return $foh;
                }// end function
                
                public function readGuest_list_by_event($id) {
		global $con;
		$sql = 'SELECT * FROM guest_list WHERE event_id = ' . $id . '';
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
			$guest_lists = false;;
		}
		return $guest_lists;
                }// end function
                
                public function readInterestbyType($id) {
		global $con;
		$sql = 'SELECT * FROM interest WHERE type_id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			while($result = mysql_fetch_array($results)) {
				$interest = new Interest();
				$interest->setId($this->readInterested_in($result[0]));
				$interest->setType($this->readInterest_type($result[1]));
				$interest->setTitle($result[2]);
				$interest->setDescription($result[3]);
                                $interests[] = $interest;
                        }
		} else {
			$interests = false;;
		}
		return $interests;
                }// end function
                
                public function readInterested_in_by_volunteer($id) {
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
			$interested_ins = false;;
		}
		return $interested_ins;
                }// end function
                
                public function readNot_Interested_in_by_volunteer($id) {
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
			$interested_ins = false;;
		}
		return $interested_ins;
                }// end function
                
                public function readInterested_in_NA($id) {
		global $con;
		$sql = 'SELECT * FROM interested_in WHERE interest_id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$result = mysql_fetch_array($results);
				$interested_in = new Interested_in();
				$interested_in->setVolunteer($this->readVolunteer($result[0]));
				$interested_in->setInterest($this->readInterest($result[1]));
		} else {
			$interested_in = false;;
		}
		return $interested_in;
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
			$office = false;;
		}
		return $office;
                }// end function
                
                public function readOrganizationByName($orgName) {
		global $con;
                $sql = "SELECT * FROM organization WHERE name LIKE '%{$orgName}%';";
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
                    $organizations = array();
                    while($result = mysql_fetch_array($results)) {
                        $organization = new Organization();
                        $organization->setId($result[0]);
                        $organization->setName($result[1]);
                        $organization->setAddress($this->readAddress($result[2]));
                        $organizations[] = $organization;
                    } //end while
		} else {
			$organizations = false;;
		}
		return $organizations;
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
			$persons = false;;
		}
		return $persons;
                }// end function
                
                public function readPersonByOrg($org) {
		global $con;
                $sql = "SELECT id FROM organization WHERE name LIKE '%{$org}%';";
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$organizations = array();
			while($result = mysql_fetch_array($results)) {
				$organization = new Organization();
				$organization->setId($this->readOrganization_contact($result[0]));
				$organizations[] = $organization;
			}// end while
		} else {
			$organizations = false;;
		}
		return $organizations;
                }// end function
                
                public function readSchedule_by_event($id) {
		global $con;
		$sql = 'SELECT * FROM schedule WHERE event_id = ' . $id . '';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
                        $schedules = array();
			while($result = mysql_fetch_array($results)) {
				$schedule = new Schedule();
				$schedule->setId($result[0]);
				$schedule->setSchedule($this->readSchedule($result[1]));
				$schedule->setStart_time($result[2]);
				$schedule->setEnd_time($result[3]);
				$schedule->setDescription($result[4]);
				$schedule->setInterest_id($this->readInterest($result[5]));
				$schedule->setMax_num_people($result[6]);
                                $schedules[] = $schedule;
                        } //end while
		} else {
			$schedules = false;;
		}
		return $schedules;
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
			$state = false;;
		}
		return $state;
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
			$volunteer = false;;
		}
		return $volunteer;
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
			$works = false;;
		}
		return $works;
                }// end function
                
                // old functions (need fixed, but still in use) // --------------------
                
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
                    $this->openi();
                    global $link;
                    //$hold = array();
                    $sql='SELECT id, email FROM email where email =?';
                    //$result=mysql_query($sql,$con);
                    $stmt = mysqli_stmt_init($link);
                        if (mysqli_stmt_prepare($stmt, $sql)) {
                            mysqli_stmt_bind_param($stmt, "s", $user);
                            mysqli_stmt_execute($stmt);
                            mysqli_stmt_bind_result($stmt, $id, $email);
                            while (mysqli_stmt_fetch($stmt)) {
                                $hold[0] = $id;
                                $hold[1] = $email;
                            }
                            mysqli_stmt_close($stmt);
                        }
                    //$id=$hold[0];
                    //$email=$hold[1];

                    $sql2='SELECT email,password FROM account WHERE email=? AND password=?';
                    $stmt2 = mysqli_stmt_init($link);
                        if (mysqli_stmt_prepare($stmt2, $sql2)) {
                            mysqli_stmt_bind_param($stmt2, "is", $hold[0], $hold[1]);
                            mysqli_stmt_execute($stmt2);
                            mysqli_stmt_bind_result($stmt2, $email, $password);
                            $status = $email;
                        }
                    //$results=mysql_query($sql2,$con);
                    //$final=mysql_fetch_row($results);
                    //$status=$final;
                    $this->closei();
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
                // OLD FUNCTIONS //---------------

                    public function createNewPerson($street1,$street2,$city,$state,$zip,$phone,$email,$phone2,$extension,$title,$fName,$lName,$gender,$dob,$maritialStatusId,$prefEmail,$prefMail,$prefPhone){
                        global $con;
                        $this->open();

                        //insert data into address

                        //finds state id from name
                        $sql = "SELECT id
                                FROM STATE
                                WHERE title = '" .$state. "';";
                                $result = mysql_query($sql, $con);
                                while($row = mysql_fetch_array($result)) {
                                    $state_id = $row[0];
                                }

                        //inserts data into address
                        $sql =	"INSERT INTO Address
                            (street1,street2,city,state_id,zip)
                            VALUES
                            ('" .$street1. "','" .$street2. "','" .$city. "','" .$state_id. "','" .$zip. "');";
                        mysql_query($sql, $con);
                            //echo mysql_errno($con) . ": " . mysql_error($con). "\n";


                        //insert data into person

                        //finds the last address created
                        $sql = "SELECT MAX(id)
                                FROM address;";
                                $result = mysql_query($sql, $con);
                                while($row = mysql_fetch_array($result)) {
                                    $address_id = $row[0];
                                }

                        //finds the last contact id in the contact table and ioncrements by one. This will need fixed when database changes are made
                        $sql= "SELECT max(id) FROM contact;";
                            $result = mysql_query($sql, $con);
                            while($row = mysql_fetch_array($result)) {
                                $contact_id = $row[0];
                            }
                            $contact_id = (int)$contact_id + 1;

                        //inserts data into person                
                        $sql=	"INSERT INTO person
                            (title,first_name,last_name,gender,dob,marital_status_id,contact_id)
                            VALUES ('" .$title. "','" .$fName. "','" .$lName. "','" .$gender. "','" .$dob. "','" .$maritialStatusId. "','" .$contact_id. "');";
                        mysql_query($sql, $con); 


                        //insert data into email

                        //finds the last person created
                        $sql = "SELECT max(id) FROM person;";
                            $result = mysql_query($sql, $con);
                            while($row = mysql_fetch_array($result)) {
                                $person_id = $row[0];
                            }

                        //inserts data into email    
                        $sql = "INSERT INTO email (email,person_id)
                                VALUES ('" .$email. "','" .$person_id. "');";
                        mysql_query($sql, $con);


                        //insert data into contact

                        //finds the last email created
                        $sql = "SELECT max(id) FROM email";
                            $result = mysql_query($sql, $con);
                            while($row = mysql_fetch_array($result)) {
                                $email_id = $row[0];
                            }

                        // finds the last address created
                        $sql= "SELECT max(id) FROM ADDRESS;";
                            $result = mysql_query($sql, $con);
                            while($row = mysql_fetch_array($result)) {
                                $address_id = $row[0];
                            }

                        //inserts data into contact
                        $sql=	"INSERT INTO Contact
                                        (address_id,phone,phone2,email_id)
                                        VALUES
                                        ('" .$address_id. "','" .$phone. "','" .$phone2. "','" .$email_id. "');";
                        mysql_query($sql, $con);

                        $this->close();

                        return True;
                    }//end function
                
		// account // --------------------

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
				$account->setEmail($result[1]);
				$account->setPassword($result[2]);
				$account->setCreated($result[3]);
				$account->setStatus($this->readAccount_status($result[4]));
				$account->setPerson($this->readPerson($result[5]));
				$accounts[] = $account;
			}// end while
		} else {
			$accounts = false;
		}
		return $account;
	}// end function

		// account // --------------------

	public function readAccount($id) {
		global $con;
		$sql = 'SELECT * FROM account WHERE id = ' . $id . ';';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$result = mysql_fetch_array($results);
			$account = new Account();
			$account->setId($result[0]);
			$account->setEmail($result[1]);
			$account->setPassword($result[2]);
			$account->setCreated($result[3]);
			$account->setStatus($this->readAccount_status($result[4]));
			$account->setPerson($this->readPerson($result[5]));
		} else {
			$account = false;
		}
		return $account;
	}// end function

		public function deleteAccount($id) {
			global $con;
			$sql = 'DELETE FROM account WHERE id = ' . $id . ';';
			$this->open();
			$result = mysql_query($sql, $con);
			$this->close();
			return $result;
		}// end function

		// account_recovery // --------------------

	public function readAccount_recovery($id) {
		global $con;
		$sql = 'SELECT * FROM account_recovery WHERE id = ' . $id . ';';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$result = mysql_fetch_array($results);
			$account_recovery = new Account_recovery();
			$account_recovery->setAccount($this->readAccount($result[0]));
			$account_recovery->setCode($result[1]);
			$account_recovery->setDate($result[2]);
			$account_recovery->setTime($result[3]);
		} else {
			$account_recovery = false;
		}
		return $account_recovery;
	}// end function

		public function deleteAccount_recovery($id) {
			global $con;
			$sql = 'DELETE FROM account_recovery WHERE account_id = ' . $id . ';';
			$this->open();
			$result = mysql_query($sql, $con);
			$this->close();
			return $result;
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
				$account_recovery->setAccount($this->readAccount($result[0]));
				$account_recovery->setCode($result[1]);
				$account_recovery->setDate($result[2]);
				$account_recovery->setTime($result[3]);
				$account_recoverys[] = $account_recovery;
			}// end while
		} else {
			$account_recoverys = false;
		}
		return $account_recovery;
	}// end function

		// account_status // --------------------

	public function readAccount_status($id) {
		global $con;
		$sql = 'SELECT * FROM account_status WHERE id = ' . $id . ';';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$result = mysql_fetch_array($results);
			$account_status = new Account_status();
			$account_status->setId($result[0]);
			$account_status->setTitle($result[1]);
			$account_status->setDescription($result[2]);
		} else {
			$account_status = false;
		}
		return $account_status;
	}// end function

		public function deleteAccount_status($id) {
			global $con;
			$sql = 'DELETE FROM account_status WHERE id = ' . $id . ';';
			$this->open();
			$result = mysql_query($sql, $con);
			$this->close();
			return $result;
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
			$account_statuss = false;
		}
		return $account_status;
	}// end function

		// address // --------------------

	public function readAddress($id) {
		global $con;
		$sql = 'SELECT * FROM address WHERE id = ' . $id . ';';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$result = mysql_fetch_array($results);
			$address = new Address();
			$address->setId($result[0]);
			$address->setStreet1($result[1]);
			$address->setStreet2($result[2]);
			$address->setCity($result[3]);
			$address->setState($this->readState($result[4]));
			$address->setZip($result[5]);
		} else {
			$address = false;
		}
		return $address;
	}// end function

		public function deleteAddress($id) {
			global $con;
			$sql = 'DELETE FROM address WHERE id = ' . $id . ';';
			$this->open();
			$result = mysql_query($sql, $con);
			$this->close();
			return $result;
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
			$addresss = false;
		}
		return $address;
	}// end function

		// admin // --------------------

	public function readAdmin($id) {
		global $con;
		$sql = 'SELECT * FROM admin WHERE id = ' . $id . ';';
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

		public function deleteAdmin($id) {
			global $con;
			$sql = 'DELETE FROM admin WHERE id = ' . $id . ';';
			$this->open();
			$result = mysql_query($sql, $con);
			$this->close();
			return $result;
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
			$admins = false;
		}
		return $admin;
	}// end function

		// ambassador // --------------------

	public function readAmbassador($id) {
		global $con;
		$sql = 'SELECT * FROM ambassador WHERE id = ' . $id . ';';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$result = mysql_fetch_array($results);
			$ambassador = new Ambassador();
			$ambassador->setVolunteer($this->readVolunteer($result[0]));
			$ambassador->setOrganization($this->readOrganization($result[1]));
			$ambassador->setChurch_ambassador($result[2]);
			$ambassador->setAffiliation($result[3]);
		} else {
			$ambassador = false;
		}
		return $ambassador;
	}// end function

		public function deleteAmbassador($id) {
			global $con;
			$sql = 'DELETE FROM ambassador WHERE volunteer_id = ' . $id . ';';
			$this->open();
			$result = mysql_query($sql, $con);
			$this->close();
			return $result;
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
				$ambassador->setOrganization($this->readOrganization($result[1]));
				$ambassador->setChurch_ambassador($result[2]);
				$ambassador->setAffiliation($result[3]);
				$ambassadors[] = $ambassador;
			}// end while
		} else {
			$ambassadors = false;
		}
		return $ambassador;
	}// end function

		// auction // --------------------

	public function readAuction($id) {
		global $con;
		$sql = 'SELECT * FROM auction WHERE id = ' . $id . ';';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$result = mysql_fetch_array($results);
			$auction = new Auction();
			$auction->setId($result[0]);
			$auction->setEvent($this->readEvent($result[1]));
		} else {
			$auction = false;
		}
		return $auction;
	}// end function

		public function deleteAuction($id) {
			global $con;
			$sql = 'DELETE FROM auction WHERE id = ' . $id . ';';
			$this->open();
			$result = mysql_query($sql, $con);
			$this->close();
			return $result;
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
			$auctions = false;
		}
		return $auction;
	}// end function

		// auction_item // --------------------

	public function readAuction_item($id) {
		global $con;
		$sql = 'SELECT * FROM auction_item WHERE id = ' . $id . ';';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$result = mysql_fetch_array($results);
			$auction_item = new Auction_item();
			$auction_item->setId($result[0]);
			$auction_item->setAuction($this->readAuction($result[1]));
			$auction_item->setItem_num($result[2]);
			$auction_item->setTitle($result[3]);
			$auction_item->setDescription($result[4]);
			$auction_item->setValue($result[5]);
			$auction_item->setPrice($result[6]);
			$auction_item->setPerson($this->readPerson($result[7]));
			$auction_item->setDonation($this->readDonation($result[8]));
		} else {
			$auction_item = false;
		}
		return $auction_item;
	}// end function

		public function deleteAuction_item($id) {
			global $con;
			$sql = 'DELETE FROM auction_item WHERE id = ' . $id . ';';
			$this->open();
			$result = mysql_query($sql, $con);
			$this->close();
			return $result;
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
				$auction_item->setAuction($this->readAuction($result[1]));
				$auction_item->setItem_num($result[2]);
				$auction_item->setTitle($result[3]);
				$auction_item->setDescription($result[4]);
				$auction_item->setValue($result[5]);
				$auction_item->setPrice($result[6]);
				$auction_item->setPerson($this->readPerson($result[7]));
				$auction_item->setDonation($this->readDonation($result[8]));
				$auction_items[] = $auction_item;
			}// end while
		} else {
			$auction_items = false;
		}
		return $auction_item;
	}// end function

		// board_member // --------------------

	public function readBoard_member($id) {
		global $con;
		$sql = 'SELECT * FROM board_member WHERE id = ' . $id . ';';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$result = mysql_fetch_array($results);
			$board_member = new Board_member();
			$board_member->setVolunteer($this->readVolunteer($result[0]));
			$board_member->setIs_board_member($result[1]);
		} else {
			$board_member = false;
		}
		return $board_member;
	}// end function

		public function deleteBoard_member($id) {
			global $con;
			$sql = 'DELETE FROM board_member WHERE volunteer_id = ' . $id . ';';
			$this->open();
			$result = mysql_query($sql, $con);
			$this->close();
			return $result;
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
			$board_members = false;
		}
		return $board_member;
	}// end function

		// city // --------------------

	public function readCity($id) {
		global $con;
		$sql = 'SELECT * FROM city WHERE id = ' . $id . ';';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$result = mysql_fetch_array($results);
			$city = new City();
			$city->setId($result[0]);
			$city->setTitle($result[1]);
			$city->setState($this->readState($result[2]));
		} else {
			$city = false;
		}
		return $city;
	}// end function

		public function deleteCity($id) {
			global $con;
			$sql = 'DELETE FROM city WHERE id = ' . $id . ';';
			$this->open();
			$result = mysql_query($sql, $con);
			$this->close();
			return $result;
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
			$citys = false;
		}
		return $city;
	}// end function

		// committee // --------------------

	public function readCommittee($id) {
		global $con;
		$sql = 'SELECT * FROM committee WHERE id = ' . $id . ';';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$result = mysql_fetch_array($results);
			$committee = new Committee();
			$committee->setId($result[0]);
			$committee->setTitle($result[1]);
		} else {
			$committee = false;
		}
		return $committee;
	}// end function

		public function deleteCommittee($id) {
			global $con;
			$sql = 'DELETE FROM committee WHERE id = ' . $id . ';';
			$this->open();
			$result = mysql_query($sql, $con);
			$this->close();
			return $result;
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
			$committees = false;
		}
		return $committee;
	}// end function

		// committee_attendance // --------------------

	public function readCommittee_attendance($id) {
		global $con;
		$sql = 'SELECT * FROM committee_attendance WHERE id = ' . $id . ';';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$result = mysql_fetch_array($results);
			$committee_attendance = new Committee_attendance();
			$committee_attendance->setAttendance($this->readAttendance($result[0]));
			$committee_attendance->setCommittee($this->readCommittee($result[1]));
			$committee_attendance->setVolunteer($this->readVolunteer($result[2]));
			$committee_attendance->setStatus($result[3]);
		} else {
			$committee_attendance = false;
		}
		return $committee_attendance;
	}// end function

		public function deleteCommittee_attendance($id) {
			global $con;
			$sql = 'DELETE FROM committee_attendance WHERE attendance_id = ' . $id . ';';
			$this->open();
			$result = mysql_query($sql, $con);
			$this->close();
			return $result;
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
			$committee_attendances = false;
		}
		return $committee_attendance;
	}// end function

		// contact // --------------------

	public function readContact($id) {
		global $con;
		$sql = 'SELECT * FROM contact WHERE id = ' . $id . ';';
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
			$contact->setEmail($result[4]);
		} else {
			$contact = false;
		}
		return $contact;
	}// end function

		public function deleteContact($id) {
			global $con;
			$sql = 'DELETE FROM contact WHERE id = ' . $id . ';';
			$this->open();
			$result = mysql_query($sql, $con);
			$this->close();
			return $result;
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
			$contacts = false;
		}
		return $contact;
	}// end function

		// demographic_type // --------------------

	public function readDemographic_type($id) {
		global $con;
		$sql = 'SELECT * FROM demographic_type WHERE id = ' . $id . ';';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$result = mysql_fetch_array($results);
			$demographic_type = new Demographic_type();
			$demographic_type->setId($result[0]);
			$demographic_type->setTitle($result[1]);
			$demographic_type->setDescription($result[2]);
		} else {
			$demographic_type = false;
		}
		return $demographic_type;
	}// end function

		public function deleteDemographic_type($id) {
			global $con;
			$sql = 'DELETE FROM demographic_type WHERE id = ' . $id . ';';
			$this->open();
			$result = mysql_query($sql, $con);
			$this->close();
			return $result;
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
			$demographic_types = false;
		}
		return $demographic_type;
	}// end function

		// donation // --------------------

	public function readDonation($id) {
		global $con;
		$sql = 'SELECT * FROM donation WHERE id = ' . $id . ';';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$result = mysql_fetch_array($results);
			$donation = new Donation();
			$donation->setId($result[0]);
			$donation->setDate($result[1]);
			$donation->setTime($result[2]);
			$donation->setDetails($result[3]);
			$donation->setWhen_entered($result[4]);
			$donation->setDonor($this->readDonor($result[5]));
			$donation->setOffice($this->readOffice($result[6]));
			$donation->setDonation_type($this->readDonation_type($result[7]));
			$donation->setPledge($result[8]);
			$donation->setAdmin($this->readAdmin($result[9]));
		} else {
			$donation = false;
		}
		return $donation;
	}// end function

		public function deleteDonation($id) {
			global $con;
			$sql = 'DELETE FROM donation WHERE id = ' . $id . ';';
			$this->open();
			$result = mysql_query($sql, $con);
			$this->close();
			return $result;
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
				$donation->setDonor($this->readDonor($result[5]));
				$donation->setOffice($this->readOffice($result[6]));
				$donation->setDonation_type($this->readDonation_type($result[7]));
				$donation->setPledge($result[8]);
				$donation->setAdmin($this->readAdmin($result[9]));
				$donations[] = $donation;
			}// end while
		} else {
			$donations = false;
		}
		return $donation;
	}// end function

		// donation_type // --------------------

	public function readDonation_type($id) {
		global $con;
		$sql = 'SELECT * FROM donation_type WHERE id = ' . $id . ';';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$result = mysql_fetch_array($results);
			$donation_type = new Donation_type();
			$donation_type->setId($result[0]);
			$donation_type->setTitle($result[1]);
			$donation_type->setDescription($result[2]);
		} else {
			$donation_type = false;
		}
		return $donation_type;
	}// end function

		public function deleteDonation_type($id) {
			global $con;
			$sql = 'DELETE FROM donation_type WHERE id = ' . $id . ';';
			$this->open();
			$result = mysql_query($sql, $con);
			$this->close();
			return $result;
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
			$donation_types = false;
		}
		return $donation_type;
	}// end function

		// email // --------------------

	public function readEmail($id) {
		global $con;
		$sql = 'SELECT * FROM email WHERE id = ' . $id . ';';
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

		public function deleteEmail($id) {
			global $con;
			$sql = 'DELETE FROM email WHERE id = ' . $id . ';';
			$this->open();
			$result = mysql_query($sql, $con);
			$this->close();
			return $result;
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
				$emails[] = $email;
			}// end while
		} else {
			$emails = false;
		}
		return $email;
	}// end function

		// event // --------------------

	public function readEvent($id) {
		global $con;
		$sql = 'SELECT * FROM event WHERE id = ' . $id . ';';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$result = mysql_fetch_array($results);
			$event = new Event();
			$event->setId($result[0]);
			$event->setTitle($result[1]);
			$event->setDate($result[2]);
			$event->setStart_time($result[3]);
			$event->setEnd_time($result[4]);
			$event->setAddress($this->readAddress($result[5]));
			$event->setType($this->readEvent_type($result[6]));
			$event->setMax_num_guests($result[7]);
			$event->setCommittee($this->readCommittee($result[8]));
			$event->setSponsored($this->readPerson($result[9]));
		} else {
			$event = false;
		}
		return $event;
	}// end function

		public function deleteEvent($id) {
			global $con;
			$sql = 'DELETE FROM event WHERE id = ' . $id . ';';
			$this->open();
			$result = mysql_query($sql, $con);
			$this->close();
			return $result;
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
				$event->setAddress($this->readAddress($result[5]));
				$event->setType($this->readEvent_type($result[6]));
				$event->setMax_num_guests($result[7]);
				$event->setCommittee($this->readCommittee($result[8]));
				$event->setSponsored($this->readPerson($result[9]));
				$events[] = $event;
			}// end while
		} else {
			$events = false;
		}
		return $event;
	}// end function

		// event_expenses // --------------------

	public function readEvent_expenses($id) {
		global $con;
		$sql = 'SELECT * FROM event_expenses WHERE id = ' . $id . ';';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$result = mysql_fetch_array($results);
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
		} else {
			$event_expenses = false;
		}
		return $event_expenses;
	}// end function

		public function deleteEvent_expenses($id) {
			global $con;
			$sql = 'DELETE FROM event_expenses WHERE id = ' . $id . ';';
			$this->open();
			$result = mysql_query($sql, $con);
			$this->close();
			return $result;
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
			$event_expensess = false;
		}
		return $event_expenses;
	}// end function

		// event_sponsor // --------------------

	public function readEvent_sponsor($id) {
		global $con;
		$sql = 'SELECT * FROM event_sponsor WHERE id = ' . $id . ';';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$result = mysql_fetch_array($results);
			$event_sponsor = new Event_sponsor();
			$event_sponsor->setId($result[0]);
			$event_sponsor->setEvent($this->readEvent($result[1]));
			$event_sponsor->setPerson($this->readPerson($result[2]));
			$event_sponsor->setOrganization($this->readOrganization($result[3]));
		} else {
			$event_sponsor = false;
		}
		return $event_sponsor;
	}// end function

		public function deleteEvent_sponsor($id) {
			global $con;
			$sql = 'DELETE FROM event_sponsor WHERE id = ' . $id . ';';
			$this->open();
			$result = mysql_query($sql, $con);
			$this->close();
			return $result;
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
				$event_sponsor->setOrganization($this->readOrganization($result[3]));
				$event_sponsors[] = $event_sponsor;
			}// end while
		} else {
			$event_sponsors = false;
		}
		return $event_sponsor;
	}// end function

		// event_type // --------------------

	public function readEvent_type($id) {
		global $con;
		$sql = 'SELECT * FROM event_type WHERE id = ' . $id . ';';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$result = mysql_fetch_array($results);
			$event_type = new Event_type();
			$event_type->setId($result[0]);
			$event_type->setTitle($result[1]);
			$event_type->setDescription($result[2]);
		} else {
			$event_type = false;
		}
		return $event_type;
	}// end function

		public function deleteEvent_type($id) {
			global $con;
			$sql = 'DELETE FROM event_type WHERE id = ' . $id . ';';
			$this->open();
			$result = mysql_query($sql, $con);
			$this->close();
			return $result;
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
			$event_types = false;
		}
		return $event_type;
	}// end function

		// expense_type // --------------------

	public function readExpense_type($id) {
		global $con;
		$sql = 'SELECT * FROM expense_type WHERE id = ' . $id . ';';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$result = mysql_fetch_array($results);
			$expense_type = new Expense_type();
			$expense_type->setId($result[0]);
			$expense_type->setTitle($result[1]);
			$expense_type->setDescription($result[2]);
		} else {
			$expense_type = false;
		}
		return $expense_type;
	}// end function

		public function deleteExpense_type($id) {
			global $con;
			$sql = 'DELETE FROM expense_type WHERE id = ' . $id . ';';
			$this->open();
			$result = mysql_query($sql, $con);
			$this->close();
			return $result;
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
			$expense_types = false;
		}
		return $expense_type;
	}// end function

		// foh // --------------------

	public function readFoh($id) {
		global $con;
		$sql = 'SELECT * FROM foh WHERE id = ' . $id . ';';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$result = mysql_fetch_array($results);
			$foh = new Foh();
			$foh->setEvent($this->readEvent($result[0]));
			$foh->setPerson($this->readPerson($result[1]));
		} else {
			$foh = false;
		}
		return $foh;
	}// end function

		public function deleteFoh($id) {
			global $con;
			$sql = 'DELETE FROM foh WHERE event_id = ' . $id . ';';
			$this->open();
			$result = mysql_query($sql, $con);
			$this->close();
			return $result;
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
			$fohs = false;
		}
		return $foh;
	}// end function

		// guest_list // --------------------

	public function readGuest_list($id) {
		global $con;
		$sql = 'SELECT * FROM guest_list WHERE id = ' . $id . ';';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
                    while ($result =  mysql_fetch_array($results)) {
			$result = mysql_fetch_array($results);
			$guest_list = new Guest_list();
			$guest_list->setEvent($this->readEvent($result[0]));
			$guest_list->setPerson($this->readPerson($result[1]));
			$guest_list->setAttended($result[2]);
                    }
		} else {
			$guest_list = false;
		}
		return $guest_list;
	}// end function

		public function deleteGuest_list($id) {
			global $con;
			$sql = 'DELETE FROM guest_list WHERE event_id = ' . $id . ';';
			$this->open();
			$result = mysql_query($sql, $con);
			$this->close();
			return $result;
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
			$guest_lists = false;
		}
		return $guest_list;
	}// end function

		// habitat_employee // --------------------

	public function readHabitat_employee($id) {
		global $con;
		$sql = 'SELECT * FROM habitat_employee WHERE id = ' . $id . ';';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$result = mysql_fetch_array($results);
			$habitat_employee = new Habitat_employee();
			$habitat_employee->setId($result[0]);
			$habitat_employee->setPerson($this->readPerson($result[1]));
			$habitat_employee->setStart_date($result[2]);
			$habitat_employee->setEnd_date($result[3]);
		} else {
			$habitat_employee = false;
		}
		return $habitat_employee;
	}// end function

		public function deleteHabitat_employee($id) {
			global $con;
			$sql = 'DELETE FROM habitat_employee WHERE id = ' . $id . ';';
			$this->open();
			$result = mysql_query($sql, $con);
			$this->close();
			return $result;
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
			$habitat_employees = false;
		}
		return $habitat_employee;
	}// end function

		// ho_asset // --------------------

	public function readHo_asset($id) {
		global $con;
		$sql = 'SELECT * FROM ho_asset WHERE id = ' . $id . ';';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$result = mysql_fetch_array($results);
			$ho_asset = new Ho_asset();
			$ho_asset->setId($result[0]);
			$ho_asset->setPerson($this->readPerson($result[1]));
			$ho_asset->setTitle($result[2]);
			$ho_asset->setDescription($result[3]);
			$ho_asset->setValue($result[4]);
		} else {
			$ho_asset = false;
		}
		return $ho_asset;
	}// end function

		public function deleteHo_asset($id) {
			global $con;
			$sql = 'DELETE FROM ho_asset WHERE id = ' . $id . ';';
			$this->open();
			$result = mysql_query($sql, $con);
			$this->close();
			return $result;
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
			$ho_assets = false;
		}
		return $ho_asset;
	}// end function

		// ho_debt // --------------------

	public function readHo_debt($id) {
		global $con;
		$sql = 'SELECT * FROM ho_debt WHERE id = ' . $id . ';';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$result = mysql_fetch_array($results);
			$ho_debt = new Ho_debt();
			$ho_debt->setId($result[0]);
			$ho_debt->setPerson($this->readPerson($result[1]));
			$ho_debt->setMonthly_payment($result[2]);
			$ho_debt->setBalance($result[3]);
		} else {
			$ho_debt = false;
		}
		return $ho_debt;
	}// end function

		public function deleteHo_debt($id) {
			global $con;
			$sql = 'DELETE FROM ho_debt WHERE id = ' . $id . ';';
			$this->open();
			$result = mysql_query($sql, $con);
			$this->close();
			return $result;
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
			$ho_debts = false;
		}
		return $ho_debt;
	}// end function

		// ho_group // --------------------

	public function readHo_group($id) {
		global $con;
		$sql = 'SELECT * FROM ho_group WHERE id = ' . $id . ';';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$result = mysql_fetch_array($results);
			$ho_group = new Ho_group();
			$ho_group->setPerson($this->readPerson($result[0]));
			$ho_group->setHo($this->readHo($result[1]));
			$ho_group->setDemographic($this->readDemographic($result[2]));
			$ho_group->setPrimary_ho($result[3]);
		} else {
			$ho_group = false;
		}
		return $ho_group;
	}// end function

		public function deleteHo_group($id) {
			global $con;
			$sql = 'DELETE FROM ho_group WHERE person_id = ' . $id . ';';
			$this->open();
			$result = mysql_query($sql, $con);
			$this->close();
			return $result;
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
				$ho_group->setHo($this->readHo($result[1]));
				$ho_group->setDemographic($this->readDemographic($result[2]));
				$ho_group->setPrimary_ho($result[3]);
				$ho_groups[] = $ho_group;
			}// end while
		} else {
			$ho_groups = false;
		}
		return $ho_group;
	}// end function

		// ho_income // --------------------

	public function readHo_income($id) {
		global $con;
		$sql = 'SELECT * FROM ho_income WHERE id = ' . $id . ';';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$result = mysql_fetch_array($results);
			$ho_income = new Ho_income();
			$ho_income->setId($result[0]);
			$ho_income->setPerson($this->readPerson($result[1]));
			$ho_income->setGross($result[2]);
			$ho_income->setChild_support($result[3]);
			$ho_income->setDisability($result[4]);
			$ho_income->setUnemployment($result[5]);
		} else {
			$ho_income = false;
		}
		return $ho_income;
	}// end function

		public function deleteHo_income($id) {
			global $con;
			$sql = 'DELETE FROM ho_income WHERE id = ' . $id . ';';
			$this->open();
			$result = mysql_query($sql, $con);
			$this->close();
			return $result;
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
			$ho_incomes = false;
		}
		return $ho_income;
	}// end function

		// ho_requirement // --------------------

	public function readHo_requirement($id) {
		global $con;
		$sql = 'SELECT * FROM ho_requirement WHERE id = ' . $id . ';';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$result = mysql_fetch_array($results);
			$ho_requirement = new Ho_requirement();
			$ho_requirement->setPerson($this->readPerson($result[0]));
			$ho_requirement->setRequirement($this->readRequirement($result[1]));
			$ho_requirement->setWhen_entered($result[2]);
			$ho_requirement->setWhen_completed($result[3]);
			$ho_requirement->setOffice($this->readOffice($result[4]));
			$ho_requirement->setWhen_authorized($result[5]);
			$ho_requirement->setAdmin($this->readAdmin($result[6]));
		} else {
			$ho_requirement = false;
		}
		return $ho_requirement;
	}// end function

		public function deleteHo_requirement($id) {
			global $con;
			$sql = 'DELETE FROM ho_requirement WHERE person_id = ' . $id . ';';
			$this->open();
			$result = mysql_query($sql, $con);
			$this->close();
			return $result;
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
				$ho_requirement->setRequirement($this->readRequirement($result[1]));
				$ho_requirement->setWhen_entered($result[2]);
				$ho_requirement->setWhen_completed($result[3]);
				$ho_requirement->setOffice($this->readOffice($result[4]));
				$ho_requirement->setWhen_authorized($result[5]);
				$ho_requirement->setAdmin($this->readAdmin($result[6]));
				$ho_requirements[] = $ho_requirement;
			}// end while
		} else {
			$ho_requirements = false;
		}
		return $ho_requirement;
	}// end function

		// ho_status // --------------------

	public function readHo_status($id) {
		global $con;
		$sql = 'SELECT * FROM ho_status WHERE id = ' . $id . ';';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$result = mysql_fetch_array($results);
			$ho_status = new Ho_status();
			$ho_status->setId($result[0]);
			$ho_status->setTitle($result[1]);
			$ho_status->setCode($result[2]);
			$ho_status->setDescription($result[3]);
		} else {
			$ho_status = false;
		}
		return $ho_status;
	}// end function

		public function deleteHo_status($id) {
			global $con;
			$sql = 'DELETE FROM ho_status WHERE id = ' . $id . ';';
			$this->open();
			$result = mysql_query($sql, $con);
			$this->close();
			return $result;
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
			$ho_statuss = false;
		}
		return $ho_status;
	}// end function

		// home_owner // --------------------

	public function readHome_owner($id) {
		global $con;
		$sql = 'SELECT * FROM home_owner WHERE id = ' . $id . ';';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$result = mysql_fetch_array($results);
			$home_owner = new Home_owner();
			$home_owner->setPerson($this->readPerson($result[0]));
			$home_owner->setStatus($this->readHo_status($result[1]));
			$home_owner->setBank($this->readBank($result[2]));
			$home_owner->setSocial_security($result[3]);
		} else {
			$home_owner = false;
		}
		return $home_owner;
	}// end function

		public function deleteHome_owner($id) {
			global $con;
			$sql = 'DELETE FROM home_owner WHERE person_id = ' . $id . ';';
			$this->open();
			$result = mysql_query($sql, $con);
			$this->close();
			return $result;
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
				$home_owner->setStatus($this->readHo_status($result[1]));
				$home_owner->setBank($this->readBank($result[2]));
				$home_owner->setSocial_security($result[3]);
				$home_owners[] = $home_owner;
			}// end while
		} else {
			$home_owners = false;
		}
		return $home_owner;
	}// end function

		// interest // --------------------

	public function readInterest($id) {
		global $con;
		$sql = 'SELECT * FROM interest WHERE id = ' . $id . ';';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$result = mysql_fetch_array($results);
			$interest = new Interest();
			$interest->setId($result[0]);
			$interest->setType($this->readType($result[1]));
			$interest->setTitle($result[2]);
			$interest->setDescription($result[3]);
		} else {
			$interest = false;
		}
		return $interest;
	}// end function

		public function deleteInterest($id) {
			global $con;
			$sql = 'DELETE FROM interest WHERE id = ' . $id . ';';
			$this->open();
			$result = mysql_query($sql, $con);
			$this->close();
			return $result;
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
				$interest->setType($this->readType($result[1]));
				$interest->setTitle($result[2]);
				$interest->setDescription($result[3]);
				$interests[] = $interest;
			}// end while
		} else {
			$interests = false;
		}
		return $interest;
	}// end function

		// interest_type // --------------------

	public function readInterest_type($id) {
		global $con;
		$sql = 'SELECT * FROM interest_type WHERE id = ' . $id . ';';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$result = mysql_fetch_array($results);
			$interest_type = new Interest_type();
			$interest_type->setId($result[0]);
			$interest_type->setTitle($result[1]);
			$interest_type->setDescription($result[2]);
		} else {
			$interest_type = false;
		}
		return $interest_type;
	}// end function

		public function deleteInterest_type($id) {
			global $con;
			$sql = 'DELETE FROM interest_type WHERE id = ' . $id . ';';
			$this->open();
			$result = mysql_query($sql, $con);
			$this->close();
			return $result;
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
			$interest_types = false;
		}
		return $interest_type;
	}// end function

		// interested_in // --------------------

	public function readInterested_in($id) {
		global $con;
		$sql = 'SELECT * FROM interested_in WHERE id = ' . $id . ';';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$result = mysql_fetch_array($results);
			$interested_in = new Interested_in();
			$interested_in->setVolunteer($this->readVolunteer($result[0]));
			$interested_in->setInterest($this->readInterest($result[1]));
		} else {
			$interested_in = false;
		}
		return $interested_in;
	}// end function

		public function deleteInterested_in($id) {
			global $con;
			$sql = 'DELETE FROM interested_in WHERE volunteer_id = ' . $id . ';';
			$this->open();
			$result = mysql_query($sql, $con);
			$this->close();
			return $result;
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
			$interested_ins = false;
		}
		return $interested_in;
	}// end function

		// labor // --------------------

	public function readLabor($id) {
		global $con;
		$sql = 'SELECT * FROM labor WHERE id = ' . $id . ';';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$result = mysql_fetch_array($results);
			$labor = new Labor();
			$labor->setDonation($this->readDonation($result[0]));
			$labor->setAmount($result[1]);
			$labor->setMethod($result[2]);
			$labor->setProject($this->readProject($result[3]));
		} else {
			$labor = false;
		}
		return $labor;
	}// end function

		public function deleteLabor($id) {
			global $con;
			$sql = 'DELETE FROM labor WHERE donation_id = ' . $id . ';';
			$this->open();
			$result = mysql_query($sql, $con);
			$this->close();
			return $result;
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
				$labor->setDonation($this->readDonation($result[0]));
				$labor->setAmount($result[1]);
				$labor->setMethod($result[2]);
				$labor->setProject($this->readProject($result[3]));
				$labors[] = $labor;
			}// end while
		} else {
			$labors = false;
		}
		return $labor;
	}// end function

		// marital_status // --------------------

	public function readMarital_status($id) {
		global $con;
		$sql = 'SELECT * FROM marital_status WHERE id = ' . $id . ';';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$result = mysql_fetch_array($results);
			$marital_status = new Marital_status();
			$marital_status->setId($result[0]);
			$marital_status->setTitle($result[1]);
			$marital_status->setDescription($result[2]);
		} else {
			$marital_status = false;
		}
		return $marital_status;
	}// end function

		public function deleteMarital_status($id) {
			global $con;
			$sql = 'DELETE FROM marital_status WHERE id = ' . $id . ';';
			$this->open();
			$result = mysql_query($sql, $con);
			$this->close();
			return $result;
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
			$marital_statuss = false;
		}
		return $marital_status;
	}// end function

		// material // --------------------

	public function readMaterial($id) {
		global $con;
		$sql = 'SELECT * FROM material WHERE id = ' . $id . ';';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$result = mysql_fetch_array($results);
			$material = new Material();
			$material->setDonation($this->readDonation($result[0]));
			$material->setValue($result[1]);
			$material->setDescription($result[2]);
		} else {
			$material = false;
		}
		return $material;
	}// end function

		public function deleteMaterial($id) {
			global $con;
			$sql = 'DELETE FROM material WHERE donation_id = ' . $id . ';';
			$this->open();
			$result = mysql_query($sql, $con);
			$this->close();
			return $result;
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
				$material->setDonation($this->readDonation($result[0]));
				$material->setValue($result[1]);
				$material->setDescription($result[2]);
				$materials[] = $material;
			}// end while
		} else {
			$materials = false;
		}
		return $material;
	}// end function

		// money // --------------------

	public function readMoney($id) {
		global $con;
		$sql = 'SELECT * FROM money WHERE id = ' . $id . ';';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$result = mysql_fetch_array($results);
			$money = new Money();
			$money->setDonation($this->readDonation($result[0]));
			$money->setAmount($result[1]);
			$money->setMethod($result[2]);
		} else {
			$money = false;
		}
		return $money;
	}// end function

		public function deleteMoney($id) {
			global $con;
			$sql = 'DELETE FROM money WHERE donation_id = ' . $id . ';';
			$this->open();
			$result = mysql_query($sql, $con);
			$this->close();
			return $result;
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
				$money->setDonation($this->readDonation($result[0]));
				$money->setAmount($result[1]);
				$money->setMethod($result[2]);
				$moneys[] = $money;
			}// end while
		} else {
			$moneys = false;
		}
		return $money;
	}// end function

		// mortgage // --------------------

	public function readMortgage($id) {
		global $con;
		$sql = 'SELECT * FROM mortgage WHERE id = ' . $id . ';';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$result = mysql_fetch_array($results);
			$mortgage = new Mortgage();
			$mortgage->setId($result[0]);
			$mortgage->setPerson($this->readPerson($result[1]));
			$mortgage->setAmount($result[2]);
			$mortgage->setStatus($result[3]);
			$mortgage->setProject($this->readProject($result[4]));
			$mortgage->setBank($this->readBank($result[5]));
		} else {
			$mortgage = false;
		}
		return $mortgage;
	}// end function

		public function deleteMortgage($id) {
			global $con;
			$sql = 'DELETE FROM mortgage WHERE id = ' . $id . ';';
			$this->open();
			$result = mysql_query($sql, $con);
			$this->close();
			return $result;
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
				$mortgage->setProject($this->readProject($result[4]));
				$mortgage->setBank($this->readBank($result[5]));
				$mortgages[] = $mortgage;
			}// end while
		} else {
			$mortgages = false;
		}
		return $mortgage;
	}// end function

		// municipality // --------------------

	public function readMunicipality($id) {
		global $con;
		$sql = 'SELECT * FROM municipality WHERE id = ' . $id . ';';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$result = mysql_fetch_array($results);
			$municipality = new Municipality();
			$municipality->setId($result[0]);
			$municipality->setTitle($result[1]);
		} else {
			$municipality = false;
		}
		return $municipality;
	}// end function

		public function deleteMunicipality($id) {
			global $con;
			$sql = 'DELETE FROM municipality WHERE id = ' . $id . ';';
			$this->open();
			$result = mysql_query($sql, $con);
			$this->close();
			return $result;
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
			$municipalitys = false;
		}
		return $municipality;
	}// end function

		// office // --------------------

	public function readOffice($id) {
		global $con;
		$sql = 'SELECT * FROM office WHERE id = ' . $id . ';';
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

		public function deleteOffice($id) {
			global $con;
			$sql = 'DELETE FROM office WHERE id = ' . $id . ';';
			$this->open();
			$result = mysql_query($sql, $con);
			$this->close();
			return $result;
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
			$offices = false;
		}
		return $office;
	}// end function

		// organization // --------------------

	public function readOrganization($id) {
		global $con;
		$sql = 'SELECT * FROM organization WHERE id = ' . $id . ';';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$result = mysql_fetch_array($results);
			$organization = new Organization();
			$organization->setId($result[0]);
			$organization->setName($result[1]);
			$organization->setContact($this->readContact($result[2]));
		} else {
			$organization = false;
		}
		return $organization;
	}// end function

		public function deleteOrganization($id) {
			global $con;
			$sql = 'DELETE FROM organization WHERE id = ' . $id . ';';
			$this->open();
			$result = mysql_query($sql, $con);
			$this->close();
			return $result;
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
		return $organization;
	}// end function

		// organization_contact // --------------------

	public function readOrganization_contact($id) {
		global $con;
		$sql = 'SELECT * FROM organization_contact WHERE id = ' . $id . ';';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$result = mysql_fetch_array($results);
			$organization_contact = new Organization_contact();
			$organization_contact->setOrganization($this->readOrganization($result[0]));
			$organization_contact->setPerson($this->readPerson($result[1]));
			$organization_contact->setPhone($result[2]);
			$organization_contact->setExt($result[3]);
			$organization_contact->setFax($result[4]);
		} else {
			$organization_contact = false;
		}
		return $organization_contact;
	}// end function

		public function deleteOrganization_contact($id) {
			global $con;
			$sql = 'DELETE FROM organization_contact WHERE organization_id = ' . $id . ';';
			$this->open();
			$result = mysql_query($sql, $con);
			$this->close();
			return $result;
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
				$organization_contact->setOrganization($this->readOrganization($result[0]));
				$organization_contact->setPerson($this->readPerson($result[1]));
				$organization_contact->setPhone($result[2]);
				$organization_contact->setExt($result[3]);
				$organization_contact->setFax($result[4]);
				$organization_contacts[] = $organization_contact;
			}// end while
		} else {
			$organization_contacts = false;
		}
		return $organization_contact;
	}// end function

		// organization_donation // --------------------

	public function readOrganization_donation($id) {
		global $con;
		$sql = 'SELECT * FROM organization_donation WHERE id = ' . $id . ';';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$result = mysql_fetch_array($results);
			$organization_donation = new Organization_donation();
			$organization_donation->setId($result[0]);
			$organization_donation->setDonation($this->readDonation($result[1]));
			$organization_donation->setOrganization($this->readOrganization($result[2]));
		} else {
			$organization_donation = false;
		}
		return $organization_donation;
	}// end function

		public function deleteOrganization_donation($id) {
			global $con;
			$sql = 'DELETE FROM organization_donation WHERE id = ' . $id . ';';
			$this->open();
			$result = mysql_query($sql, $con);
			$this->close();
			return $result;
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
				$organization_donation->setDonation($this->readDonation($result[1]));
				$organization_donation->setOrganization($this->readOrganization($result[2]));
				$organization_donations[] = $organization_donation;
			}// end while
		} else {
			$organization_donations = false;
		}
		return $organization_donation;
	}// end function

		// payment // --------------------

	public function readPayment($id) {
		global $con;
		$sql = 'SELECT * FROM payment WHERE id = ' . $id . ';';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$result = mysql_fetch_array($results);
			$payment = new Payment();
			$payment->setId($result[0]);
			$payment->setPerson($this->readPerson($result[1]));
			$payment->setMortgage($this->readMortgage($result[2]));
			$payment->setAmount($result[3]);
			$payment->setDate($result[4]);
			$payment->setTime($result[5]);
			$payment->setOffice($this->readOffice($result[6]));
			$payment->setWhen_authorized($result[7]);
			$payment->setAdmin($this->readAdmin($result[8]));
		} else {
			$payment = false;
		}
		return $payment;
	}// end function

		public function deletePayment($id) {
			global $con;
			$sql = 'DELETE FROM payment WHERE id = ' . $id . ';';
			$this->open();
			$result = mysql_query($sql, $con);
			$this->close();
			return $result;
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
				$payment->setMortgage($this->readMortgage($result[2]));
				$payment->setAmount($result[3]);
				$payment->setDate($result[4]);
				$payment->setTime($result[5]);
				$payment->setOffice($this->readOffice($result[6]));
				$payment->setWhen_authorized($result[7]);
				$payment->setAdmin($this->readAdmin($result[8]));
				$payments[] = $payment;
			}// end while
		} else {
			$payments = false;
		}
		return $payment;
	}// end function

		// person // --------------------

	public function readPerson($id) {
		global $con;
		$sql = 'SELECT * FROM person WHERE id = ' . $id . ';';
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

		public function deletePerson($id) {
			global $con;
			$sql = 'DELETE FROM person WHERE id = ' . $id . ';';
			$this->open();
			$result = mysql_query($sql, $con);
			$this->close();
			return $result;
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
		return $person;
	}// end function

		// personal_donation // --------------------

	public function readPersonal_donation($id) {
		global $con;
		$sql = 'SELECT * FROM personal_donation WHERE id = ' . $id . ';';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$result = mysql_fetch_array($results);
			$personal_donation = new Personal_donation();
			$personal_donation->setId($result[0]);
			$personal_donation->setDonation($this->readDonation($result[1]));
			$personal_donation->setPerson($this->readPerson($result[2]));
		} else {
			$personal_donation = false;
		}
		return $personal_donation;
	}// end function

		public function deletePersonal_donation($id) {
			global $con;
			$sql = 'DELETE FROM personal_donation WHERE id = ' . $id . ';';
			$this->open();
			$result = mysql_query($sql, $con);
			$this->close();
			return $result;
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
			$personal_donations = false;
		}
		return $personal_donation;
	}// end function

		// photo_id // --------------------

	public function readPhoto_id($id) {
		global $con;
		$sql = 'SELECT * FROM photo_id WHERE id = ' . $id . ';';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$result = mysql_fetch_array($results);
			$photo_id = new Photo_id();
			$photo_id->setPerson($this->readPerson($result[0]));
			$photo_id->setPhoto($this->readPhoto($result[1]));
		} else {
			$photo_id = false;
		}
		return $photo_id;
	}// end function

		public function deletePhoto_id($id) {
			global $con;
			$sql = 'DELETE FROM photo_id WHERE person_id = ' . $id . ';';
			$this->open();
			$result = mysql_query($sql, $con);
			$this->close();
			return $result;
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
				$photo_id->setPhoto($this->readPhoto($result[1]));
				$photo_ids[] = $photo_id;
			}// end while
		} else {
			$photo_ids = false;
		}
		return $photo_id;
	}// end function

		// project // --------------------

	public function readProject($id) {
		global $con;
		$sql = 'SELECT * FROM project WHERE id = ' . $id . ';';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$result = mysql_fetch_array($results);
			$project = new Project();
			$project->setId($result[0]);
			$project->setIs_active($result[1]);
			$project->setMunicipality($this->readMunicipality($result[2]));
			$project->setSponsor($this->readSponsor($result[3]));
			$project->setDate_of_origin($result[4]);
			$project->setStart_date($result[5]);
			$project->setEstimated_completion_date($result[6]);
			$project->setActual_completion_date($result[7]);
			$project->setDescription($result[8]);
			$project->setExtimated_valutation($result[9]);
			$project->setEstimated_purchase($result[10]);
			$project->setEstimated_rehab($result[11]);
			$project->setEstimated_pre_acq($result[12]);
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
		} else {
			$project = false;
		}
		return $project;
	}// end function

		public function deleteProject($id) {
			global $con;
			$sql = 'DELETE FROM project WHERE id = ' . $id . ';';
			$this->open();
			$result = mysql_query($sql, $con);
			$this->close();
			return $result;
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
				$project->setMunicipality($this->readMunicipality($result[2]));
				$project->setSponsor($this->readSponsor($result[3]));
				$project->setDate_of_origin($result[4]);
				$project->setStart_date($result[5]);
				$project->setEstimated_completion_date($result[6]);
				$project->setActual_completion_date($result[7]);
				$project->setDescription($result[8]);
				$project->setExtimated_valutation($result[9]);
				$project->setEstimated_purchase($result[10]);
				$project->setEstimated_rehab($result[11]);
				$project->setEstimated_pre_acq($result[12]);
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
			$projects = false;
		}
		return $project;
	}// end function

		// project_donation // --------------------

	public function readProject_donation($id) {
		global $con;
		$sql = 'SELECT * FROM project_donation WHERE id = ' . $id . ';';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$result = mysql_fetch_array($results);
			$project_donation = new Project_donation();
			$project_donation->setId($result[0]);
			$project_donation->setProject($this->readProject($result[1]));
			$project_donation->setDonation($this->readDonation($result[2]));
		} else {
			$project_donation = false;
		}
		return $project_donation;
	}// end function

		public function deleteProject_donation($id) {
			global $con;
			$sql = 'DELETE FROM project_donation WHERE id = ' . $id . ';';
			$this->open();
			$result = mysql_query($sql, $con);
			$this->close();
			return $result;
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
				$project_donation->setProject($this->readProject($result[1]));
				$project_donation->setDonation($this->readDonation($result[2]));
				$project_donations[] = $project_donation;
			}// end while
		} else {
			$project_donations = false;
		}
		return $project_donation;
	}// end function

		// project_event // --------------------

	public function readProject_event($id) {
		global $con;
		$sql = 'SELECT * FROM project_event WHERE id = ' . $id . ';';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$result = mysql_fetch_array($results);
			$project_event = new Project_event();
			$project_event->setEvent($this->readEvent($result[0]));
			$project_event->setProject($this->readProject($result[1]));
		} else {
			$project_event = false;
		}
		return $project_event;
	}// end function

		public function deleteProject_event($id) {
			global $con;
			$sql = 'DELETE FROM project_event WHERE event_id = ' . $id . ';';
			$this->open();
			$result = mysql_query($sql, $con);
			$this->close();
			return $result;
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
				$project_event->setProject($this->readProject($result[1]));
				$project_events[] = $project_event;
			}// end while
		} else {
			$project_events = false;
		}
		return $project_event;
	}// end function

		// project_expenses // --------------------

	public function readProject_expenses($id) {
		global $con;
		$sql = 'SELECT * FROM project_expenses WHERE id = ' . $id . ';';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$result = mysql_fetch_array($results);
			$project_expenses = new Project_expenses();
			$project_expenses->setId($result[0]);
			$project_expenses->setTitle($result[1]);
			$project_expenses->setDescription($result[2]);
			$project_expenses->setProject($this->readProject($result[3]));
			$project_expenses->setType($this->readType($result[4]));
			$project_expenses->setAmount($result[5]);
			$project_expenses->setWhen_entered($result[6]);
			$project_expenses->setOffice($this->readOffice($result[7]));
			$project_expenses->setWhen_authorized($result[8]);
			$project_expenses->setAdmin($this->readAdmin($result[9]));
		} else {
			$project_expenses = false;
		}
		return $project_expenses;
	}// end function

		public function deleteProject_expenses($id) {
			global $con;
			$sql = 'DELETE FROM project_expenses WHERE id = ' . $id . ';';
			$this->open();
			$result = mysql_query($sql, $con);
			$this->close();
			return $result;
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
				$project_expenses->setProject($this->readProject($result[3]));
				$project_expenses->setType($this->readType($result[4]));
				$project_expenses->setAmount($result[5]);
				$project_expenses->setWhen_entered($result[6]);
				$project_expenses->setOffice($this->readOffice($result[7]));
				$project_expenses->setWhen_authorized($result[8]);
				$project_expenses->setAdmin($this->readAdmin($result[9]));
				$project_expensess[] = $project_expenses;
			}// end while
		} else {
			$project_expensess = false;
		}
		return $project_expenses;
	}// end function

		// project_status // --------------------

	public function readProject_status($id) {
		global $con;
		$sql = 'SELECT * FROM project_status WHERE id = ' . $id . ';';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$result = mysql_fetch_array($results);
			$project_status = new Project_status();
			$project_status->setId($result[0]);
			$project_status->setTitle($result[1]);
			$project_status->setDescription($result[2]);
			$project_status->setAbbreviation($result[3]);
		} else {
			$project_status = false;
		}
		return $project_status;
	}// end function

		public function deleteProject_status($id) {
			global $con;
			$sql = 'DELETE FROM project_status WHERE id = ' . $id . ';';
			$this->open();
			$result = mysql_query($sql, $con);
			$this->close();
			return $result;
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
			$project_statuss = false;
		}
		return $project_status;
	}// end function

		// recovery_log // --------------------

	public function readRecovery_log($id) {
		global $con;
		$sql = 'SELECT * FROM recovery_log WHERE id = ' . $id . ';';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$result = mysql_fetch_array($results);
			$recovery_log = new Recovery_log();
			$recovery_log->setAccount($this->readAccount($result[0]));
			$recovery_log->setDate($result[1]);
			$recovery_log->setTime($result[2]);
		} else {
			$recovery_log = false;
		}
		return $recovery_log;
	}// end function

		public function deleteRecovery_log($id) {
			global $con;
			$sql = 'DELETE FROM recovery_log WHERE account_id = ' . $id . ';';
			$this->open();
			$result = mysql_query($sql, $con);
			$this->close();
			return $result;
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
			$recovery_logs = false;
		}
		return $recovery_log;
	}// end function

		// requirement // --------------------

	public function readRequirement($id) {
		global $con;
		$sql = 'SELECT * FROM requirement WHERE id = ' . $id . ';';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$result = mysql_fetch_array($results);
			$requirement = new Requirement();
			$requirement->setId($result[0]);
			$requirement->setTitle($result[1]);
			$requirement->setDescription($result[2]);
		} else {
			$requirement = false;
		}
		return $requirement;
	}// end function

		public function deleteRequirement($id) {
			global $con;
			$sql = 'DELETE FROM requirement WHERE id = ' . $id . ';';
			$this->open();
			$result = mysql_query($sql, $con);
			$this->close();
			return $result;
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
			$requirements = false;
		}
		return $requirement;
	}// end function

		// schedule // --------------------

	public function readSchedule($id) {
		global $con;
		$sql = 'SELECT * FROM schedule WHERE id = ' . $id . ';';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$result = mysql_fetch_array($results);
			$schedule = new Schedule();
			$schedule->setId($result[0]);
			$schedule->setSchedule($this->readSchedule($result[1]));
			$schedule->setStart_time($result[2]);
			$schedule->setEnd_time($result[3]);
			$schedule->setDescription($result[4]);
			$schedule->setInterest($this->readInterest($result[5]));
			$schedule->setMax_num_people($result[6]);
		} else {
			$schedule = false;
		}
		return $schedule;
	}// end function

		public function deleteSchedule($id) {
			global $con;
			$sql = 'DELETE FROM schedule WHERE id = ' . $id . ';';
			$this->open();
			$result = mysql_query($sql, $con);
			$this->close();
			return $result;
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
				$schedule->setSchedule($this->readSchedule($result[1]));
				$schedule->setStart_time($result[2]);
				$schedule->setEnd_time($result[3]);
				$schedule->setDescription($result[4]);
				$schedule->setInterest($this->readInterest($result[5]));
				$schedule->setMax_num_people($result[6]);
				$schedules[] = $schedule;
			}// end while
		} else {
			$schedules = false;
		}
		return $schedule;
	}// end function

		// serves_on // --------------------

	public function readServes_on($id) {
		global $con;
		$sql = 'SELECT * FROM serves_on WHERE id = ' . $id . ';';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$result = mysql_fetch_array($results);
			$serves_on = new Serves_on();
			$serves_on->setVolunteer($this->readVolunteer($result[0]));
			$serves_on->setCommittee($this->readCommittee($result[1]));
			$serves_on->setIs_officer($result[2]);
		} else {
			$serves_on = false;
		}
		return $serves_on;
	}// end function

		public function deleteServes_on($id) {
			global $con;
			$sql = 'DELETE FROM serves_on WHERE volunteer_id = ' . $id . ';';
			$this->open();
			$result = mysql_query($sql, $con);
			$this->close();
			return $result;
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
			$serves_ons = false;
		}
		return $serves_on;
	}// end function

		// state // --------------------

	public function readState($id) {
		global $con;
		$sql = 'SELECT * FROM state WHERE id = ' . $id . ';';
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

		public function deleteState($id) {
			global $con;
			$sql = 'DELETE FROM state WHERE id = ' . $id . ';';
			$this->open();
			$result = mysql_query($sql, $con);
			$this->close();
			return $result;
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
			$states = false;
		}
		return $state;
	}// end function

		// status_change // --------------------

	public function readStatus_change($id) {
		global $con;
		$sql = 'SELECT * FROM status_change WHERE id = ' . $id . ';';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$result = mysql_fetch_array($results);
			$status_change = new Status_change();
			$status_change->setProject($this->readProject($result[0]));
			$status_change->setStatus($this->readProject_status($result[1]));
			$status_change->setWhen_changed($result[2]);
		} else {
			$status_change = false;
		}
		return $status_change;
	}// end function

		public function deleteStatus_change($id) {
			global $con;
			$sql = 'DELETE FROM status_change WHERE project_id = ' . $id . ';';
			$this->open();
			$result = mysql_query($sql, $con);
			$this->close();
			return $result;
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
				$status_change->setProject($this->readProject($result[0]));
				$status_change->setStatus($this->readProject_status($result[1]));
				$status_change->setWhen_changed($result[2]);
				$status_changes[] = $status_change;
			}// end while
		} else {
			$status_changes = false;
		}
		return $status_change;
	}// end function

		// tickets // --------------------

	public function readTickets($id) {
		global $con;
		$sql = 'SELECT * FROM tickets WHERE id = ' . $id . ';';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$result = mysql_fetch_array($results);
			$tickets = new Tickets();
			$tickets->setId($result[0]);
			$tickets->setEvent($this->readEvent($result[1]));
			$tickets->setTicket_price($result[2]);
			$tickets->setMax_num($result[3]);
			$tickets->setCurrent_num($result[4]);
		} else {
			$tickets = false;
		}
		return $tickets;
	}// end function

		public function deleteTickets($id) {
			global $con;
			$sql = 'DELETE FROM tickets WHERE id = ' . $id . ';';
			$this->open();
			$result = mysql_query($sql, $con);
			$this->close();
			return $result;
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
				$tickets->setId($result[0]);
				$tickets->setEvent($this->readEvent($result[1]));
				$tickets->setTicket_price($result[2]);
				$tickets->setMax_num($result[3]);
				$tickets->setCurrent_num($result[4]);
				$ticketss[] = $tickets;
			}// end while
		} else {
			$ticketss = false;
		}
		return $tickets;
	}// end function

		// volunteer // --------------------

	public function readVolunteer($id) {
		global $con;
		$sql = 'SELECT * FROM volunteer WHERE id = ' . $id . ';';
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

		public function deleteVolunteer($id) {
			global $con;
			$sql = 'DELETE FROM volunteer WHERE id = ' . $id . ';';
			$this->open();
			$result = mysql_query($sql, $con);
			$this->close();
			return $result;
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
		return $volunteer;
	}// end function

		// work // --------------------

	public function readWork($id) {
		global $con;
		$sql = 'SELECT * FROM work WHERE id = ' . $id . ';';
		$this->open();
		$results = mysql_query($sql, $con);
		$this->close();
		if ($results) {
			$result = mysql_fetch_array($results);
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
		} else {
			$work = false;
		}
		return $work;
	}// end function

		public function deleteWork($id) {
			global $con;
			$sql = 'DELETE FROM work WHERE id = ' . $id . ';';
			$this->open();
			$result = mysql_query($sql, $con);
			$this->close();
			return $result;
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
		return $work;
	}// end function

// account // --------------------

	public function createAccount($account) {
		global $con;
			$id = $account->getId();
			$email = $account->getEmail();
			$password = $account->getPassword();
			$created = $account->getCreated();
			$status_id = $account->getStatus();
			$person_id = $account->getPerson();
		$sql = 'INSERT INTO account (id, email, password, created, status_id, person_id) VALUES (' . $id . ', ' . $email . ', ' . $password . ', ' . $created . ', ' . $status_id . ', ' . $person_id . ');';
		$this->open();
		$result = mysql_query($sql, $con);
		$id = ($result) ? mysql_insert_id() : $result;
		$this->close();
		return $id;
	}// end function

		public function updateAccount($account) {
			global $con;
			$id = $account->getId();
			$email = $account->getEmail();
			$password = $account->getPassword();
			$created = $account->getCreated();
			$status = $account->getStatus();
			$person = $account->getPerson();
			$sql = 'UPDATE account SET email = ' . $email . ', password = ' . $password . ', created = ' . $created . ', status = ' . $status . ', person = ' . $person . ' WHERE id = ' . $id . ';';
			$this->open();
			$result = mysql_query($sql, $con);
			$this->close();
			return $result;
		}// end function

	// account_recovery // --------------------

	public function createAccount_recovery($account_recovery) {
		global $con;
			$account_id = $account_recovery->getAccount();
			$code = $account_recovery->getCode();
			$date = $account_recovery->getDate();
			$time = $account_recovery->getTime();
		$sql = 'INSERT INTO account_recovery (account_id, code, date, time) VALUES (' . $account_id . ', ' . $code . ', ' . $date . ', ' . $time . ');';
		$this->open();
		$result = mysql_query($sql, $con);
		$id = ($result) ? mysql_insert_id() : $result;
		$this->close();
		return $id;
	}// end function

		public function updateAccount_recovery($account_recovery) {
			global $con;
			$account = $account_recovery->getAccount();
			$code = $account_recovery->getCode();
			$date = $account_recovery->getDate();
			$time = $account_recovery->getTime();
			$sql = 'UPDATE account_recovery SET account = ' . $account . ', code = ' . $code . ', date = ' . $date . ', time = ' . $time . ' WHERE id = ' . $id . ';';
			$this->open();
			$result = mysql_query($sql, $con);
			$this->close();
			return $result;
		}// end function

	// account_status // --------------------

	public function createAccount_status($account_status) {
		global $con;
			$id = $account_status->getId();
			$title = $account_status->getTitle();
			$description = $account_status->getDescription();
		$sql = 'INSERT INTO account_status (id, title, description) VALUES (' . $id . ', ' . $title . ', ' . $description . ');';
		$this->open();
		$result = mysql_query($sql, $con);
		$id = ($result) ? mysql_insert_id() : $result;
		$this->close();
		return $id;
	}// end function

		public function updateAccount_status($account_status) {
			global $con;
			$id = $account_status->getId();
			$title = $account_status->getTitle();
			$description = $account_status->getDescription();
			$sql = 'UPDATE account_status SET title = ' . $title . ', description = ' . $description . ' WHERE id = ' . $id . ';';
			$this->open();
			$result = mysql_query($sql, $con);
			$this->close();
			return $result;
		}// end function

	// address // --------------------

	public function createAddress($address) {
		global $con;
			$id = $address->getId();
			$street1 = $address->getStreet1();
			$street2 = $address->getStreet2();
			$city = $address->getCity();
			$state_id = $address->getState();
			$zip = $address->getZip();
		$sql = 'INSERT INTO address (id, street1, street2, city, state_id, zip) VALUES (' . $id . ', ' . $street1 . ', ' . $street2 . ', ' . $city . ', ' . $state_id . ', ' . $zip . ');';
		$this->open();
		$result = mysql_query($sql, $con);
		$id = ($result) ? mysql_insert_id() : $result;
		$this->close();
		return $id;
	}// end function

		public function updateAddress($address) {
			global $con;
			$id = $address->getId();
			$street1 = $address->getStreet1();
			$street2 = $address->getStreet2();
			$city = $address->getCity();
			$state = $address->getState();
			$zip = $address->getZip();
			$sql = 'UPDATE address SET street1 = ' . $street1 . ', street2 = ' . $street2 . ', city = ' . $city . ', state = ' . $state . ', zip = ' . $zip . ' WHERE id = ' . $id . ';';
			$this->open();
			$result = mysql_query($sql, $con);
			$this->close();
			return $result;
		}// end function

	// admin // --------------------

	public function createAdmin($admin) {
		global $con;
			$id = $admin->getId();
			$person_id = $admin->getPerson();
		$sql = 'INSERT INTO admin (id, person_id) VALUES (' . $id . ', ' . $person_id . ');';
		$this->open();
		$result = mysql_query($sql, $con);
		$id = ($result) ? mysql_insert_id() : $result;
		$this->close();
		return $id;
	}// end function

		public function updateAdmin($admin) {
			global $con;
			$id = $admin->getId();
			$person = $admin->getPerson();
			$sql = 'UPDATE admin SET person = ' . $person . ' WHERE id = ' . $id . ';';
			$this->open();
			$result = mysql_query($sql, $con);
			$this->close();
			return $result;
		}// end function

	// ambassador // --------------------

	public function createAmbassador($ambassador) {
		global $con;
			$volunteer_id = $ambassador->getVolunteer();
			$organization_id = $ambassador->getOrganization();
			$church_ambassador = $ambassador->getChurch_ambassador();
			$affiliation = $ambassador->getAffiliation();
		$sql = 'INSERT INTO ambassador (volunteer_id, organization_id, church_ambassador, affiliation) VALUES (' . $volunteer_id . ', ' . $organization_id . ', ' . $church_ambassador . ', ' . $affiliation . ');';
		$this->open();
		$result = mysql_query($sql, $con);
		$id = ($result) ? mysql_insert_id() : $result;
		$this->close();
		return $id;
	}// end function

		public function updateAmbassador($ambassador) {
			global $con;
			$volunteer = $ambassador->getVolunteer();
			$organization = $ambassador->getOrganization();
			$church_ambassador = $ambassador->getChurch_ambassador();
			$affiliation = $ambassador->getAffiliation();
			$sql = 'UPDATE ambassador SET volunteer = ' . $volunteer . ', organization = ' . $organization . ', church_ambassador = ' . $church_ambassador . ', affiliation = ' . $affiliation . ' WHERE id = ' . $id . ';';
			$this->open();
			$result = mysql_query($sql, $con);
			$this->close();
			return $result;
		}// end function

	// auction // --------------------

	public function createAuction($auction) {
		global $con;
			$id = $auction->getId();
			$event_id = $auction->getEvent();
		$sql = 'INSERT INTO auction (id, event_id) VALUES (' . $id . ', ' . $event_id . ');';
		$this->open();
		$result = mysql_query($sql, $con);
		$id = ($result) ? mysql_insert_id() : $result;
		$this->close();
		return $id;
	}// end function

		public function updateAuction($auction) {
			global $con;
			$id = $auction->getId();
			$event = $auction->getEvent();
			$sql = 'UPDATE auction SET event = ' . $event . ' WHERE id = ' . $id . ';';
			$this->open();
			$result = mysql_query($sql, $con);
			$this->close();
			return $result;
		}// end function

	// auction_item // --------------------

	public function createAuction_item($auction_item) {
		global $con;
			$id = $auction_item->getId();
			$auction_id = $auction_item->getAuction();
			$item_num = $auction_item->getItem_num();
			$title = $auction_item->getTitle();
			$description = $auction_item->getDescription();
			$value = $auction_item->getValue();
			$price = $auction_item->getPrice();
			$person_id = $auction_item->getPerson();
			$donation_id = $auction_item->getDonation();
		$sql = 'INSERT INTO auction_item (id, auction_id, item_num, title, description, value, price, person_id, donation_id) VALUES (' . $id . ', ' . $auction_id . ', ' . $item_num . ', ' . $title . ', ' . $description . ', ' . $value . ', ' . $price . ', ' . $person_id . ', ' . $donation_id . ');';
		$this->open();
		$result = mysql_query($sql, $con);
		$id = ($result) ? mysql_insert_id() : $result;
		$this->close();
		return $id;
	}// end function

		public function updateAuction_item($auction_item) {
			global $con;
			$id = $auction_item->getId();
			$auction = $auction_item->getAuction();
			$item_num = $auction_item->getItem_num();
			$title = $auction_item->getTitle();
			$description = $auction_item->getDescription();
			$value = $auction_item->getValue();
			$price = $auction_item->getPrice();
			$person = $auction_item->getPerson();
			$donation = $auction_item->getDonation();
			$sql = 'UPDATE auction_item SET auction = ' . $auction . ', item_num = ' . $item_num . ', title = ' . $title . ', description = ' . $description . ', value = ' . $value . ', price = ' . $price . ', person = ' . $person . ', donation = ' . $donation . ' WHERE id = ' . $id . ';';
			$this->open();
			$result = mysql_query($sql, $con);
			$this->close();
			return $result;
		}// end function

	// board_member // --------------------

	public function createBoard_member($board_member) {
		global $con;
			$volunteer_id = $board_member->getVolunteer();
			$is_board_member = $board_member->getIs_board_member();
		$sql = 'INSERT INTO board_member (volunteer_id, is_board_member) VALUES (' . $volunteer_id . ', ' . $is_board_member . ');';
		$this->open();
		$result = mysql_query($sql, $con);
		$id = ($result) ? mysql_insert_id() : $result;
		$this->close();
		return $id;
	}// end function

		public function updateBoard_member($board_member) {
			global $con;
			$volunteer = $board_member->getVolunteer();
			$is_board_member = $board_member->getIs_board_member();
			$sql = 'UPDATE board_member SET volunteer = ' . $volunteer . ', is_board_member = ' . $is_board_member . ' WHERE id = ' . $id . ';';
			$this->open();
			$result = mysql_query($sql, $con);
			$this->close();
			return $result;
		}// end function

	// city // --------------------

	public function createCity($city) {
		global $con;
			$id = $city->getId();
			$title = $city->getTitle();
			$state_id = $city->getState();
		$sql = 'INSERT INTO city (id, title, state_id) VALUES (' . $id . ', ' . $title . ', ' . $state_id . ');';
		$this->open();
		$result = mysql_query($sql, $con);
		$id = ($result) ? mysql_insert_id() : $result;
		$this->close();
		return $id;
	}// end function

		public function updateCity($city) {
			global $con;
			$id = $city->getId();
			$title = $city->getTitle();
			$state = $city->getState();
			$sql = 'UPDATE city SET title = ' . $title . ', state = ' . $state . ' WHERE id = ' . $id . ';';
			$this->open();
			$result = mysql_query($sql, $con);
			$this->close();
			return $result;
		}// end function

	// committee // --------------------

	public function createCommittee($committee) {
		global $con;
			$id = $committee->getId();
			$title = $committee->getTitle();
		$sql = 'INSERT INTO committee (id, title) VALUES (' . $id . ', ' . $title . ');';
		$this->open();
		$result = mysql_query($sql, $con);
		$id = ($result) ? mysql_insert_id() : $result;
		$this->close();
		return $id;
	}// end function

		public function updateCommittee($committee) {
			global $con;
			$id = $committee->getId();
			$title = $committee->getTitle();
			$sql = 'UPDATE committee SET title = ' . $title . ' WHERE id = ' . $id . ';';
			$this->open();
			$result = mysql_query($sql, $con);
			$this->close();
			return $result;
		}// end function

	// committee_attendance // --------------------

	public function createCommittee_attendance($committee_attendance) {
		global $con;
			$attendance_id = $committee_attendance->getAttendance();
			$committee_id = $committee_attendance->getCommittee();
			$volunteer_id = $committee_attendance->getVolunteer();
			$status = $committee_attendance->getStatus();
		$sql = 'INSERT INTO committee_attendance (attendance_id, committee_id, volunteer_id, status) VALUES (' . $attendance_id . ', ' . $committee_id . ', ' . $volunteer_id . ', ' . $status . ');';
		$this->open();
		$result = mysql_query($sql, $con);
		$id = ($result) ? mysql_insert_id() : $result;
		$this->close();
		return $id;
	}// end function

		public function updateCommittee_attendance($committee_attendance) {
			global $con;
			$attendance = $committee_attendance->getAttendance();
			$committee = $committee_attendance->getCommittee();
			$volunteer = $committee_attendance->getVolunteer();
			$status = $committee_attendance->getStatus();
			$sql = 'UPDATE committee_attendance SET attendance = ' . $attendance . ', committee = ' . $committee . ', volunteer = ' . $volunteer . ', status = ' . $status . ' WHERE id = ' . $id . ';';
			$this->open();
			$result = mysql_query($sql, $con);
			$this->close();
			return $result;
		}// end function

	// contact // --------------------

	public function createContact($contact) {
		global $con;
			$id = $contact->getId();
			$address_id = $contact->getAddress();
			$phone = $contact->getPhone();
			$phone2 = $contact->getPhone2();
			$email_id = $contact->getEmail();
		$sql = 'INSERT INTO contact (id, address_id, phone, phone2, email_id) VALUES (' . $id . ', ' . $address_id . ', ' . $phone . ', ' . $phone2 . ', ' . $email_id . ');';
		$this->open();
		$result = mysql_query($sql, $con);
		$id = ($result) ? mysql_insert_id() : $result;
		$this->close();
		return $id;
	}// end function

		public function updateContact($contact) {
			global $con;
			$id = $contact->getId();
			$address = $contact->getAddress();
			$phone = $contact->getPhone();
			$phone2 = $contact->getPhone2();
			$email = $contact->getEmail();
			$sql = 'UPDATE contact SET address = ' . $address . ', phone = ' . $phone . ', phone2 = ' . $phone2 . ', email = ' . $email . ' WHERE id = ' . $id . ';';
			$this->open();
			$result = mysql_query($sql, $con);
			$this->close();
			return $result;
		}// end function

	// demographic_type // --------------------

	public function createDemographic_type($demographic_type) {
		global $con;
			$id = $demographic_type->getId();
			$title = $demographic_type->getTitle();
			$description = $demographic_type->getDescription();
		$sql = 'INSERT INTO demographic_type (id, title, description) VALUES (' . $id . ', ' . $title . ', ' . $description . ');';
		$this->open();
		$result = mysql_query($sql, $con);
		$id = ($result) ? mysql_insert_id() : $result;
		$this->close();
		return $id;
	}// end function

		public function updateDemographic_type($demographic_type) {
			global $con;
			$id = $demographic_type->getId();
			$title = $demographic_type->getTitle();
			$description = $demographic_type->getDescription();
			$sql = 'UPDATE demographic_type SET title = ' . $title . ', description = ' . $description . ' WHERE id = ' . $id . ';';
			$this->open();
			$result = mysql_query($sql, $con);
			$this->close();
			return $result;
		}// end function

	// donation // --------------------

	public function createDonation($donation) {
		global $con;
			$id = $donation->getId();
			$date = $donation->getDate();
			$time = $donation->getTime();
			$details = $donation->getDetails();
			$value = $donation->getValue();
			$when_entered = $donation->getWhen_entered();
			$donor_id = $donation->getDonor();
			$office_id = $donation->getOffice();
			$donation_type_id = $donation->getDonation_type();
			$pledge = $donation->getPledge();
			$admin_id = $donation->getAdmin();
		$sql = 'INSERT INTO donation (id, date, time, details, value, when_entered, donor_id, office_id, donation_type_id, pledge, admin_id) VALUES (' . $id . ', ' . $date . ', ' . $time . ', ' . $details . ', ' . $value . ', ' . $when_entered . ', ' . $donor_id . ', ' . $office_id . ', ' . $donation_type_id . ', ' . $pledge . ', ' . $admin_id . ');';
		$this->open();
		$result = mysql_query($sql, $con);
		$id = ($result) ? mysql_insert_id() : $result;
		$this->close();
		return $id;
	}// end function

		public function updateDonation($donation) {
			global $con;
			$id = $donation->getId();
			$date = $donation->getDate();
			$time = $donation->getTime();
			$details = $donation->getDetails();
			$value = $donation->getValue();
			$when_entered = $donation->getWhen_entered();
			$donor = $donation->getDonor();
			$office = $donation->getOffice();
			$donation_type = $donation->getDonation_type();
			$pledge = $donation->getPledge();
			$admin = $donation->getAdmin();
			$sql = 'UPDATE donation SET date = ' . $date . ', time = ' . $time . ', details = ' . $details . ', value = ' . $value . ', when_entered = ' . $when_entered . ', donor = ' . $donor . ', office = ' . $office . ', donation_type = ' . $donation_type . ', pledge = ' . $pledge . ', admin = ' . $admin . ' WHERE id = ' . $id . ';';
			$this->open();
			$result = mysql_query($sql, $con);
			$this->close();
			return $result;
		}// end function

	// donation_type // --------------------

	public function createDonation_type($donation_type) {
		global $con;
			$id = $donation_type->getId();
			$title = $donation_type->getTitle();
			$description = $donation_type->getDescription();
		$sql = 'INSERT INTO donation_type (id, title, description) VALUES (' . $id . ', ' . $title . ', ' . $description . ');';
		$this->open();
		$result = mysql_query($sql, $con);
		$id = ($result) ? mysql_insert_id() : $result;
		$this->close();
		return $id;
	}// end function

		public function updateDonation_type($donation_type) {
			global $con;
			$id = $donation_type->getId();
			$title = $donation_type->getTitle();
			$description = $donation_type->getDescription();
			$sql = 'UPDATE donation_type SET title = ' . $title . ', description = ' . $description . ' WHERE id = ' . $id . ';';
			$this->open();
			$result = mysql_query($sql, $con);
			$this->close();
			return $result;
		}// end function

	// email // --------------------

	public function createEmail($email) {
		global $con;
			$id = $email->getId();
			$email = $email->getEmail();
			$person_id = $email->getPerson();
		$sql = 'INSERT INTO email (id, email, person_id) VALUES (' . $id . ', ' . $email . ', ' . $person_id . ');';
		$this->open();
		$result = mysql_query($sql, $con);
		$id = ($result) ? mysql_insert_id() : $result;
		$this->close();
		return $id;
	}// end function

		public function updateEmail($email) {
			global $con;
			$id = $email->getId();
			$email = $email->getEmail();
			$person = $email->getPerson();
			$sql = 'UPDATE email SET email = ' . $email . ', person = ' . $person . ' WHERE id = ' . $id . ';';
			$this->open();
			$result = mysql_query($sql, $con);
			$this->close();
			return $result;
		}// end function

	// event // --------------------

	public function createEvent($event) {
		global $con;
			$id = $event->getId();
			$title = $event->getTitle();
			$date = $event->getDate();
			$start_time = $event->getStart_time();
			$end_time = $event->getEnd_time();
			$address_id = $event->getAddress();
			$type_id = $event->getType();
			$max_num_guests = $event->getMax_num_guests();
			$committee_id = $event->getCommittee();
			$sponsored_id = $event->getSponsored();
		$sql = 'INSERT INTO event (id, title, date, start_time, end_time, address_id, type_id, max_num_guests, committee_id, sponsored_id) VALUES (' . $id . ', ' . $title . ', ' . $date . ', ' . $start_time . ', ' . $end_time . ', ' . $address_id . ', ' . $type_id . ', ' . $max_num_guests . ', ' . $committee_id . ', ' . $sponsored_id . ');';
		$this->open();
		$result = mysql_query($sql, $con);
		$id = ($result) ? mysql_insert_id() : $result;
		$this->close();
		return $id;
	}// end function

		public function updateEvent($event) {
			global $con;
			$id = $event->getId();
			$title = $event->getTitle();
			$date = $event->getDate();
			$start_time = $event->getStart_time();
			$end_time = $event->getEnd_time();
			$address = $event->getAddress();
			$type = $event->getType();
			$max_num_guests = $event->getMax_num_guests();
			$committee = $event->getCommittee();
			$sponsored = $event->getSponsored();
			$sql = 'UPDATE event SET title = ' . $title . ', date = ' . $date . ', start_time = ' . $start_time . ', end_time = ' . $end_time . ', address = ' . $address . ', type = ' . $type . ', max_num_guests = ' . $max_num_guests . ', committee = ' . $committee . ', sponsored = ' . $sponsored . ' WHERE id = ' . $id . ';';
			$this->open();
			$result = mysql_query($sql, $con);
			$this->close();
			return $result;
		}// end function

	// event_expenses // --------------------

	public function createEvent_expenses($event_expenses) {
		global $con;
			$id = $event_expenses->getId();
			$event_id = $event_expenses->getEvent();
			$title = $event_expenses->getTitle();
			$description = $event_expenses->getDescription();
			$amount = $event_expenses->getAmount();
			$when_entered = $event_expenses->getWhen_entered();
			$office_id = $event_expenses->getOffice();
			$when_authorized = $event_expenses->getWhen_authorized();
			$admin_id = $event_expenses->getAdmin();
		$sql = 'INSERT INTO event_expenses (id, event_id, title, description, amount, when_entered, office_id, when_authorized, admin_id) VALUES (' . $id . ', ' . $event_id . ', ' . $title . ', ' . $description . ', ' . $amount . ', ' . $when_entered . ', ' . $office_id . ', ' . $when_authorized . ', ' . $admin_id . ');';
		$this->open();
		$result = mysql_query($sql, $con);
		$id = ($result) ? mysql_insert_id() : $result;
		$this->close();
		return $id;
	}// end function

		public function updateEvent_expenses($event_expenses) {
			global $con;
			$id = $event_expenses->getId();
			$event = $event_expenses->getEvent();
			$title = $event_expenses->getTitle();
			$description = $event_expenses->getDescription();
			$amount = $event_expenses->getAmount();
			$when_entered = $event_expenses->getWhen_entered();
			$office = $event_expenses->getOffice();
			$when_authorized = $event_expenses->getWhen_authorized();
			$admin = $event_expenses->getAdmin();
			$sql = 'UPDATE event_expenses SET event = ' . $event . ', title = ' . $title . ', description = ' . $description . ', amount = ' . $amount . ', when_entered = ' . $when_entered . ', office = ' . $office . ', when_authorized = ' . $when_authorized . ', admin = ' . $admin . ' WHERE id = ' . $id . ';';
			$this->open();
			$result = mysql_query($sql, $con);
			$this->close();
			return $result;
		}// end function

	// event_sponsor // --------------------

	public function createEvent_sponsor($event_sponsor) {
		global $con;
			$id = $event_sponsor->getId();
			$event_id = $event_sponsor->getEvent();
			$person_id = $event_sponsor->getPerson();
			$organization_id = $event_sponsor->getOrganization();
		$sql = 'INSERT INTO event_sponsor (id, event_id, person_id, organization_id) VALUES (' . $id . ', ' . $event_id . ', ' . $person_id . ', ' . $organization_id . ');';
		$this->open();
		$result = mysql_query($sql, $con);
		$id = ($result) ? mysql_insert_id() : $result;
		$this->close();
		return $id;
	}// end function

		public function updateEvent_sponsor($event_sponsor) {
			global $con;
			$id = $event_sponsor->getId();
			$event = $event_sponsor->getEvent();
			$person = $event_sponsor->getPerson();
			$organization = $event_sponsor->getOrganization();
			$sql = 'UPDATE event_sponsor SET event = ' . $event . ', person = ' . $person . ', organization = ' . $organization . ' WHERE id = ' . $id . ';';
			$this->open();
			$result = mysql_query($sql, $con);
			$this->close();
			return $result;
		}// end function

	// event_type // --------------------

	public function createEvent_type($event_type) {
		global $con;
			$id = $event_type->getId();
			$title = $event_type->getTitle();
			$description = $event_type->getDescription();
		$sql = 'INSERT INTO event_type (id, title, description) VALUES (' . $id . ', ' . $title . ', ' . $description . ');';
		$this->open();
		$result = mysql_query($sql, $con);
		$id = ($result) ? mysql_insert_id() : $result;
		$this->close();
		return $id;
	}// end function

		public function updateEvent_type($event_type) {
			global $con;
			$id = $event_type->getId();
			$title = $event_type->getTitle();
			$description = $event_type->getDescription();
			$sql = 'UPDATE event_type SET title = ' . $title . ', description = ' . $description . ' WHERE id = ' . $id . ';';
			$this->open();
			$result = mysql_query($sql, $con);
			$this->close();
			return $result;
		}// end function

	// expense_type // --------------------

	public function createExpense_type($expense_type) {
		global $con;
			$id = $expense_type->getId();
			$title = $expense_type->getTitle();
			$description = $expense_type->getDescription();
		$sql = 'INSERT INTO expense_type (id, title, description) VALUES (' . $id . ', ' . $title . ', ' . $description . ');';
		$this->open();
		$result = mysql_query($sql, $con);
		$id = ($result) ? mysql_insert_id() : $result;
		$this->close();
		return $id;
	}// end function

		public function updateExpense_type($expense_type) {
			global $con;
			$id = $expense_type->getId();
			$title = $expense_type->getTitle();
			$description = $expense_type->getDescription();
			$sql = 'UPDATE expense_type SET title = ' . $title . ', description = ' . $description . ' WHERE id = ' . $id . ';';
			$this->open();
			$result = mysql_query($sql, $con);
			$this->close();
			return $result;
		}// end function

	// foh // --------------------

	public function createFoh($foh) {
		global $con;
			$event_id = $foh->getEvent();
			$person_id = $foh->getPerson();
		$sql = 'INSERT INTO foh (event_id, person_id) VALUES (' . $event_id . ', ' . $person_id . ');';
		$this->open();
		$result = mysql_query($sql, $con);
		$id = ($result) ? mysql_insert_id() : $result;
		$this->close();
		return $id;
	}// end function

		public function updateFoh($foh) {
			global $con;
			$event = $foh->getEvent();
			$person = $foh->getPerson();
			$sql = 'UPDATE foh SET event = ' . $event . ', person = ' . $person . ' WHERE id = ' . $id . ';';
			$this->open();
			$result = mysql_query($sql, $con);
			$this->close();
			return $result;
		}// end function

	// guest_list // --------------------

	public function createGuest_list($guest_list) {
		global $con;
			$event_id = $guest_list->getEvent();
			$person_id = $guest_list->getPerson();
			$attended = $guest_list->getAttended();
		$sql = 'INSERT INTO guest_list (event_id, person_id, attended) VALUES (' . $event_id . ', ' . $person_id . ', ' . $attended . ');';
		$this->open();
		$result = mysql_query($sql, $con);
		$id = ($result) ? mysql_insert_id() : $result;
		$this->close();
		return $id;
	}// end function

		public function updateGuest_list($guest_list) {
			global $con;
			$event = $guest_list->getEvent();
			$person = $guest_list->getPerson();
			$attended = $guest_list->getAttended();
			$sql = 'UPDATE guest_list SET event = ' . $event . ', person = ' . $person . ', attended = ' . $attended . ' WHERE id = ' . $id . ';';
			$this->open();
			$result = mysql_query($sql, $con);
			$this->close();
			return $result;
		}// end function

	// habitat_employee // --------------------

	public function createHabitat_employee($habitat_employee) {
		global $con;
			$id = $habitat_employee->getId();
			$person_id = $habitat_employee->getPerson();
			$start_date = $habitat_employee->getStart_date();
			$end_date = $habitat_employee->getEnd_date();
		$sql = 'INSERT INTO habitat_employee (id, person_id, start_date, end_date) VALUES (' . $id . ', ' . $person_id . ', ' . $start_date . ', ' . $end_date . ');';
		$this->open();
		$result = mysql_query($sql, $con);
		$id = ($result) ? mysql_insert_id() : $result;
		$this->close();
		return $id;
	}// end function

		public function updateHabitat_employee($habitat_employee) {
			global $con;
			$id = $habitat_employee->getId();
			$person = $habitat_employee->getPerson();
			$start_date = $habitat_employee->getStart_date();
			$end_date = $habitat_employee->getEnd_date();
			$sql = 'UPDATE habitat_employee SET person = ' . $person . ', start_date = ' . $start_date . ', end_date = ' . $end_date . ' WHERE id = ' . $id . ';';
			$this->open();
			$result = mysql_query($sql, $con);
			$this->close();
			return $result;
		}// end function

	// ho_asset // --------------------

	public function createHo_asset($ho_asset) {
		global $con;
			$id = $ho_asset->getId();
			$person_id = $ho_asset->getPerson();
			$title = $ho_asset->getTitle();
			$description = $ho_asset->getDescription();
			$value = $ho_asset->getValue();
		$sql = 'INSERT INTO ho_asset (id, person_id, title, description, value) VALUES (' . $id . ', ' . $person_id . ', ' . $title . ', ' . $description . ', ' . $value . ');';
		$this->open();
		$result = mysql_query($sql, $con);
		$id = ($result) ? mysql_insert_id() : $result;
		$this->close();
		return $id;
	}// end function

		public function updateHo_asset($ho_asset) {
			global $con;
			$id = $ho_asset->getId();
			$person = $ho_asset->getPerson();
			$title = $ho_asset->getTitle();
			$description = $ho_asset->getDescription();
			$value = $ho_asset->getValue();
			$sql = 'UPDATE ho_asset SET person = ' . $person . ', title = ' . $title . ', description = ' . $description . ', value = ' . $value . ' WHERE id = ' . $id . ';';
			$this->open();
			$result = mysql_query($sql, $con);
			$this->close();
			return $result;
		}// end function

	// ho_debt // --------------------

	public function createHo_debt($ho_debt) {
		global $con;
			$id = $ho_debt->getId();
			$person_id = $ho_debt->getPerson();
			$monthly_payment = $ho_debt->getMonthly_payment();
			$balance = $ho_debt->getBalance();
		$sql = 'INSERT INTO ho_debt (id, person_id, monthly_payment, balance) VALUES (' . $id . ', ' . $person_id . ', ' . $monthly_payment . ', ' . $balance . ');';
		$this->open();
		$result = mysql_query($sql, $con);
		$id = ($result) ? mysql_insert_id() : $result;
		$this->close();
		return $id;
	}// end function

		public function updateHo_debt($ho_debt) {
			global $con;
			$id = $ho_debt->getId();
			$person = $ho_debt->getPerson();
			$monthly_payment = $ho_debt->getMonthly_payment();
			$balance = $ho_debt->getBalance();
			$sql = 'UPDATE ho_debt SET person = ' . $person . ', monthly_payment = ' . $monthly_payment . ', balance = ' . $balance . ' WHERE id = ' . $id . ';';
			$this->open();
			$result = mysql_query($sql, $con);
			$this->close();
			return $result;
		}// end function

	// ho_group // --------------------

	public function createHo_group($ho_group) {
		global $con;
			$person_id = $ho_group->getPerson();
			$ho_id = $ho_group->getHo();
			$demographic_id = $ho_group->getDemographic();
			$primary_ho = $ho_group->getPrimary_ho();
		$sql = 'INSERT INTO ho_group (person_id, ho_id, demographic_id, primary_ho) VALUES (' . $person_id . ', ' . $ho_id . ', ' . $demographic_id . ', ' . $primary_ho . ');';
		$this->open();
		$result = mysql_query($sql, $con);
		$id = ($result) ? mysql_insert_id() : $result;
		$this->close();
		return $id;
	}// end function

		public function updateHo_group($ho_group) {
			global $con;
			$person = $ho_group->getPerson();
			$ho = $ho_group->getHo();
			$demographic = $ho_group->getDemographic();
			$primary_ho = $ho_group->getPrimary_ho();
			$sql = 'UPDATE ho_group SET person = ' . $person . ', ho = ' . $ho . ', demographic = ' . $demographic . ', primary_ho = ' . $primary_ho . ' WHERE id = ' . $id . ';';
			$this->open();
			$result = mysql_query($sql, $con);
			$this->close();
			return $result;
		}// end function

	// ho_income // --------------------

	public function createHo_income($ho_income) {
		global $con;
			$id = $ho_income->getId();
			$person_id = $ho_income->getPerson();
			$gross = $ho_income->getGross();
			$child_support = $ho_income->getChild_support();
			$disability = $ho_income->getDisability();
			$unemployment = $ho_income->getUnemployment();
		$sql = 'INSERT INTO ho_income (id, person_id, gross, child_support, disability, unemployment) VALUES (' . $id . ', ' . $person_id . ', ' . $gross . ', ' . $child_support . ', ' . $disability . ', ' . $unemployment . ');';
		$this->open();
		$result = mysql_query($sql, $con);
		$id = ($result) ? mysql_insert_id() : $result;
		$this->close();
		return $id;
	}// end function

		public function updateHo_income($ho_income) {
			global $con;
			$id = $ho_income->getId();
			$person = $ho_income->getPerson();
			$gross = $ho_income->getGross();
			$child_support = $ho_income->getChild_support();
			$disability = $ho_income->getDisability();
			$unemployment = $ho_income->getUnemployment();
			$sql = 'UPDATE ho_income SET person = ' . $person . ', gross = ' . $gross . ', child_support = ' . $child_support . ', disability = ' . $disability . ', unemployment = ' . $unemployment . ' WHERE id = ' . $id . ';';
			$this->open();
			$result = mysql_query($sql, $con);
			$this->close();
			return $result;
		}// end function

	// ho_requirement // --------------------

	public function createHo_requirement($ho_requirement) {
		global $con;
			$person_id = $ho_requirement->getPerson();
			$requirement_id = $ho_requirement->getRequirement();
			$when_entered = $ho_requirement->getWhen_entered();
			$when_completed = $ho_requirement->getWhen_completed();
			$office_id = $ho_requirement->getOffice();
			$when_authorized = $ho_requirement->getWhen_authorized();
			$admin_id = $ho_requirement->getAdmin();
		$sql = 'INSERT INTO ho_requirement (person_id, requirement_id, when_entered, when_completed, office_id, when_authorized, admin_id) VALUES (' . $person_id . ', ' . $requirement_id . ', ' . $when_entered . ', ' . $when_completed . ', ' . $office_id . ', ' . $when_authorized . ', ' . $admin_id . ');';
		$this->open();
		$result = mysql_query($sql, $con);
		$id = ($result) ? mysql_insert_id() : $result;
		$this->close();
		return $id;
	}// end function

		public function updateHo_requirement($ho_requirement) {
			global $con;
			$person = $ho_requirement->getPerson();
			$requirement = $ho_requirement->getRequirement();
			$when_entered = $ho_requirement->getWhen_entered();
			$when_completed = $ho_requirement->getWhen_completed();
			$office = $ho_requirement->getOffice();
			$when_authorized = $ho_requirement->getWhen_authorized();
			$admin = $ho_requirement->getAdmin();
			$sql = 'UPDATE ho_requirement SET person = ' . $person . ', requirement = ' . $requirement . ', when_entered = ' . $when_entered . ', when_completed = ' . $when_completed . ', office = ' . $office . ', when_authorized = ' . $when_authorized . ', admin = ' . $admin . ' WHERE id = ' . $id . ';';
			$this->open();
			$result = mysql_query($sql, $con);
			$this->close();
			return $result;
		}// end function

	// ho_status // --------------------

	public function createHo_status($ho_status) {
		global $con;
			$id = $ho_status->getId();
			$title = $ho_status->getTitle();
			$code = $ho_status->getCode();
			$description = $ho_status->getDescription();
		$sql = 'INSERT INTO ho_status (id, title, code, description) VALUES (' . $id . ', ' . $title . ', ' . $code . ', ' . $description . ');';
		$this->open();
		$result = mysql_query($sql, $con);
		$id = ($result) ? mysql_insert_id() : $result;
		$this->close();
		return $id;
	}// end function

		public function updateHo_status($ho_status) {
			global $con;
			$id = $ho_status->getId();
			$title = $ho_status->getTitle();
			$code = $ho_status->getCode();
			$description = $ho_status->getDescription();
			$sql = 'UPDATE ho_status SET title = ' . $title . ', code = ' . $code . ', description = ' . $description . ' WHERE id = ' . $id . ';';
			$this->open();
			$result = mysql_query($sql, $con);
			$this->close();
			return $result;
		}// end function

	// home_owner // --------------------

	public function createHome_owner($home_owner) {
		global $con;
			$person_id = $home_owner->getPerson();
			$status_id = $home_owner->getStatus();
			$bank_id = $home_owner->getBank();
			$social_security = $home_owner->getSocial_security();
		$sql = 'INSERT INTO home_owner (person_id, status_id, bank_id, social_security) VALUES (' . $person_id . ', ' . $status_id . ', ' . $bank_id . ', ' . $social_security . ');';
		$this->open();
		$result = mysql_query($sql, $con);
		$id = ($result) ? mysql_insert_id() : $result;
		$this->close();
		return $id;
	}// end function

		public function updateHome_owner($home_owner) {
			global $con;
			$person = $home_owner->getPerson();
			$status = $home_owner->getStatus();
			$bank = $home_owner->getBank();
			$social_security = $home_owner->getSocial_security();
			$sql = 'UPDATE home_owner SET person = ' . $person . ', status = ' . $status . ', bank = ' . $bank . ', social_security = ' . $social_security . ' WHERE id = ' . $id . ';';
			$this->open();
			$result = mysql_query($sql, $con);
			$this->close();
			return $result;
		}// end function

	// interest // --------------------

	public function createInterest($interest) {
		global $con;
			$id = $interest->getId();
			$type_id = $interest->getType();
			$title = $interest->getTitle();
			$description = $interest->getDescription();
		$sql = 'INSERT INTO interest (id, type_id, title, description) VALUES (' . $id . ', ' . $type_id . ', ' . $title . ', ' . $description . ');';
		$this->open();
		$result = mysql_query($sql, $con);
		$id = ($result) ? mysql_insert_id() : $result;
		$this->close();
		return $id;
	}// end function

		public function updateInterest($interest) {
			global $con;
			$id = $interest->getId();
			$type = $interest->getType();
			$title = $interest->getTitle();
			$description = $interest->getDescription();
			$sql = 'UPDATE interest SET type = ' . $type . ', title = ' . $title . ', description = ' . $description . ' WHERE id = ' . $id . ';';
			$this->open();
			$result = mysql_query($sql, $con);
			$this->close();
			return $result;
		}// end function

	// interest_type // --------------------

	public function createInterest_type($interest_type) {
		global $con;
			$id = $interest_type->getId();
			$title = $interest_type->getTitle();
			$description = $interest_type->getDescription();
		$sql = 'INSERT INTO interest_type (id, title, description) VALUES (' . $id . ', ' . $title . ', ' . $description . ');';
		$this->open();
		$result = mysql_query($sql, $con);
		$id = ($result) ? mysql_insert_id() : $result;
		$this->close();
		return $id;
	}// end function

		public function updateInterest_type($interest_type) {
			global $con;
			$id = $interest_type->getId();
			$title = $interest_type->getTitle();
			$description = $interest_type->getDescription();
			$sql = 'UPDATE interest_type SET title = ' . $title . ', description = ' . $description . ' WHERE id = ' . $id . ';';
			$this->open();
			$result = mysql_query($sql, $con);
			$this->close();
			return $result;
		}// end function

	// interested_in // --------------------

	public function createInterested_in($interested_in) {
		global $con;
			$volunteer_id = $interested_in->getVolunteer();
			$interest_id = $interested_in->getInterest();
		$sql = 'INSERT INTO interested_in (volunteer_id, interest_id) VALUES (' . $volunteer_id . ', ' . $interest_id . ');';
		$this->open();
		$result = mysql_query($sql, $con);
		$id = ($result) ? mysql_insert_id() : $result;
		$this->close();
		return $id;
	}// end function

		public function updateInterested_in($interested_in) {
			global $con;
			$volunteer = $interested_in->getVolunteer();
			$interest = $interested_in->getInterest();
			$sql = 'UPDATE interested_in SET volunteer = ' . $volunteer . ', interest = ' . $interest . ' WHERE id = ' . $id . ';';
			$this->open();
			$result = mysql_query($sql, $con);
			$this->close();
			return $result;
		}// end function

	// labor // --------------------

	public function createLabor($labor) {
		global $con;
			$donation_id = $labor->getDonation();
			$amount = $labor->getAmount();
			$method = $labor->getMethod();
			$project_id = $labor->getProject();
		$sql = 'INSERT INTO labor (donation_id, amount, method, project_id) VALUES (' . $donation_id . ', ' . $amount . ', ' . $method . ', ' . $project_id . ');';
		$this->open();
		$result = mysql_query($sql, $con);
		$id = ($result) ? mysql_insert_id() : $result;
		$this->close();
		return $id;
	}// end function

		public function updateLabor($labor) {
			global $con;
			$donation = $labor->getDonation();
			$amount = $labor->getAmount();
			$method = $labor->getMethod();
			$project = $labor->getProject();
			$sql = 'UPDATE labor SET donation = ' . $donation . ', amount = ' . $amount . ', method = ' . $method . ', project = ' . $project . ' WHERE id = ' . $id . ';';
			$this->open();
			$result = mysql_query($sql, $con);
			$this->close();
			return $result;
		}// end function

	// marital_status // --------------------

	public function createMarital_status($marital_status) {
		global $con;
			$id = $marital_status->getId();
			$title = $marital_status->getTitle();
			$description = $marital_status->getDescription();
		$sql = 'INSERT INTO marital_status (id, title, description) VALUES (' . $id . ', ' . $title . ', ' . $description . ');';
		$this->open();
		$result = mysql_query($sql, $con);
		$id = ($result) ? mysql_insert_id() : $result;
		$this->close();
		return $id;
	}// end function

		public function updateMarital_status($marital_status) {
			global $con;
			$id = $marital_status->getId();
			$title = $marital_status->getTitle();
			$description = $marital_status->getDescription();
			$sql = 'UPDATE marital_status SET title = ' . $title . ', description = ' . $description . ' WHERE id = ' . $id . ';';
			$this->open();
			$result = mysql_query($sql, $con);
			$this->close();
			return $result;
		}// end function

	// material // --------------------

	public function createMaterial($material) {
		global $con;
			$donation_id = $material->getDonation();
			$value = $material->getValue();
			$description = $material->getDescription();
		$sql = 'INSERT INTO material (donation_id, value, description) VALUES (' . $donation_id . ', ' . $value . ', ' . $description . ');';
		$this->open();
		$result = mysql_query($sql, $con);
		$id = ($result) ? mysql_insert_id() : $result;
		$this->close();
		return $id;
	}// end function

		public function updateMaterial($material) {
			global $con;
			$donation = $material->getDonation();
			$value = $material->getValue();
			$description = $material->getDescription();
			$sql = 'UPDATE material SET donation = ' . $donation . ', value = ' . $value . ', description = ' . $description . ' WHERE id = ' . $id . ';';
			$this->open();
			$result = mysql_query($sql, $con);
			$this->close();
			return $result;
		}// end function

	// money // --------------------

	public function createMoney($money) {
		global $con;
			$donation_id = $money->getDonation();
			$amount = $money->getAmount();
			$method = $money->getMethod();
		$sql = 'INSERT INTO money (donation_id, amount, method) VALUES (' . $donation_id . ', ' . $amount . ', ' . $method . ');';
		$this->open();
		$result = mysql_query($sql, $con);
		$id = ($result) ? mysql_insert_id() : $result;
		$this->close();
		return $id;
	}// end function

		public function updateMoney($money) {
			global $con;
			$donation = $money->getDonation();
			$amount = $money->getAmount();
			$method = $money->getMethod();
			$sql = 'UPDATE money SET donation = ' . $donation . ', amount = ' . $amount . ', method = ' . $method . ' WHERE id = ' . $id . ';';
			$this->open();
			$result = mysql_query($sql, $con);
			$this->close();
			return $result;
		}// end function

	// mortgage // --------------------

	public function createMortgage($mortgage) {
		global $con;
			$id = $mortgage->getId();
			$person_id = $mortgage->getPerson();
			$amount = $mortgage->getAmount();
			$status = $mortgage->getStatus();
			$project_id = $mortgage->getProject();
			$bank_id = $mortgage->getBank();
		$sql = 'INSERT INTO mortgage (id, person_id, amount, status, project_id, bank_id) VALUES (' . $id . ', ' . $person_id . ', ' . $amount . ', ' . $status . ', ' . $project_id . ', ' . $bank_id . ');';
		$this->open();
		$result = mysql_query($sql, $con);
		$id = ($result) ? mysql_insert_id() : $result;
		$this->close();
		return $id;
	}// end function

		public function updateMortgage($mortgage) {
			global $con;
			$id = $mortgage->getId();
			$person = $mortgage->getPerson();
			$amount = $mortgage->getAmount();
			$status = $mortgage->getStatus();
			$project = $mortgage->getProject();
			$bank = $mortgage->getBank();
			$sql = 'UPDATE mortgage SET person = ' . $person . ', amount = ' . $amount . ', status = ' . $status . ', project = ' . $project . ', bank = ' . $bank . ' WHERE id = ' . $id . ';';
			$this->open();
			$result = mysql_query($sql, $con);
			$this->close();
			return $result;
		}// end function

	// municipality // --------------------

	public function createMunicipality($municipality) {
		global $con;
			$id = $municipality->getId();
			$title = $municipality->getTitle();
		$sql = 'INSERT INTO municipality (id, title) VALUES (' . $id . ', ' . $title . ');';
		$this->open();
		$result = mysql_query($sql, $con);
		$id = ($result) ? mysql_insert_id() : $result;
		$this->close();
		return $id;
	}// end function

		public function updateMunicipality($municipality) {
			global $con;
			$id = $municipality->getId();
			$title = $municipality->getTitle();
			$sql = 'UPDATE municipality SET title = ' . $title . ' WHERE id = ' . $id . ';';
			$this->open();
			$result = mysql_query($sql, $con);
			$this->close();
			return $result;
		}// end function

	// office // --------------------

	public function createOffice($office) {
		global $con;
			$id = $office->getId();
			$person_id = $office->getPerson();
		$sql = 'INSERT INTO office (id, person_id) VALUES (' . $id . ', ' . $person_id . ');';
		$this->open();
		$result = mysql_query($sql, $con);
		$id = ($result) ? mysql_insert_id() : $result;
		$this->close();
		return $id;
	}// end function

		public function updateOffice($office) {
			global $con;
			$id = $office->getId();
			$person = $office->getPerson();
			$sql = 'UPDATE office SET person = ' . $person . ' WHERE id = ' . $id . ';';
			$this->open();
			$result = mysql_query($sql, $con);
			$this->close();
			return $result;
		}// end function

	// organization // --------------------

	public function createOrganization($organization) {
		global $con;
			$id = $organization->getId();
			$name = $organization->getName();
			$address_id = $organization->getAddress();
		$sql = 'INSERT INTO organization (id, name, address_id) VALUES (' . $id . ', ' . $name . ', ' . $address_id . ');';
		$this->open();
		$result = mysql_query($sql, $con);
		$id = ($result) ? mysql_insert_id() : $result;
		$this->close();
		return $id;
	}// end function

		public function updateOrganization($organization) {
			global $con;
			$id = $organization->getId();
			$name = $organization->getName();
			$address = $organization->getAddress();
			$sql = 'UPDATE organization SET name = ' . $name . ', address = ' . $address . ' WHERE id = ' . $id . ';';
			$this->open();
			$result = mysql_query($sql, $con);
			$this->close();
			return $result;
		}// end function

	// organization_contact // --------------------

	public function createOrganization_contact($organization_contact) {
		global $con;
			$organization_id = $organization_contact->getOrganization();
			$person_id = $organization_contact->getPerson();
			$phone = $organization_contact->getPhone();
			$ext = $organization_contact->getExt();
			$fax = $organization_contact->getFax();
		$sql = 'INSERT INTO organization_contact (organization_id, person_id, phone, ext, fax) VALUES (' . $organization_id . ', ' . $person_id . ', ' . $phone . ', ' . $ext . ', ' . $fax . ');';
		$this->open();
		$result = mysql_query($sql, $con);
		$id = ($result) ? mysql_insert_id() : $result;
		$this->close();
		return $id;
	}// end function

		public function updateOrganization_contact($organization_contact) {
			global $con;
			$organization = $organization_contact->getOrganization();
			$person = $organization_contact->getPerson();
			$phone = $organization_contact->getPhone();
			$ext = $organization_contact->getExt();
			$fax = $organization_contact->getFax();
			$sql = 'UPDATE organization_contact SET organization = ' . $organization . ', person = ' . $person . ', phone = ' . $phone . ', ext = ' . $ext . ', fax = ' . $fax . ' WHERE id = ' . $id . ';';
			$this->open();
			$result = mysql_query($sql, $con);
			$this->close();
			return $result;
		}// end function

	// organization_donation // --------------------

	public function createOrganization_donation($organization_donation) {
		global $con;
			$id = $organization_donation->getId();
			$donation_id = $organization_donation->getDonation();
			$organization_id = $organization_donation->getOrganization();
		$sql = 'INSERT INTO organization_donation (id, donation_id, organization_id) VALUES (' . $id . ', ' . $donation_id . ', ' . $organization_id . ');';
		$this->open();
		$result = mysql_query($sql, $con);
		$id = ($result) ? mysql_insert_id() : $result;
		$this->close();
		return $id;
	}// end function

		public function updateOrganization_donation($organization_donation) {
			global $con;
			$id = $organization_donation->getId();
			$donation = $organization_donation->getDonation();
			$organization = $organization_donation->getOrganization();
			$sql = 'UPDATE organization_donation SET donation = ' . $donation . ', organization = ' . $organization . ' WHERE id = ' . $id . ';';
			$this->open();
			$result = mysql_query($sql, $con);
			$this->close();
			return $result;
		}// end function

	// payment // --------------------

	public function createPayment($payment) {
		global $con;
			$id = $payment->getId();
			$person_id = $payment->getPerson();
			$mortgage_id = $payment->getMortgage();
			$amount = $payment->getAmount();
			$date = $payment->getDate();
			$time = $payment->getTime();
			$office_id = $payment->getOffice();
			$when_authorized = $payment->getWhen_authorized();
			$admin_id = $payment->getAdmin();
		$sql = 'INSERT INTO payment (id, person_id, mortgage_id, amount, date, time, office_id, when_authorized, admin_id) VALUES (' . $id . ', ' . $person_id . ', ' . $mortgage_id . ', ' . $amount . ', ' . $date . ', ' . $time . ', ' . $office_id . ', ' . $when_authorized . ', ' . $admin_id . ');';
		$this->open();
		$result = mysql_query($sql, $con);
		$id = ($result) ? mysql_insert_id() : $result;
		$this->close();
		return $id;
	}// end function

		public function updatePayment($payment) {
			global $con;
			$id = $payment->getId();
			$person = $payment->getPerson();
			$mortgage = $payment->getMortgage();
			$amount = $payment->getAmount();
			$date = $payment->getDate();
			$time = $payment->getTime();
			$office = $payment->getOffice();
			$when_authorized = $payment->getWhen_authorized();
			$admin = $payment->getAdmin();
			$sql = 'UPDATE payment SET person = ' . $person . ', mortgage = ' . $mortgage . ', amount = ' . $amount . ', date = ' . $date . ', time = ' . $time . ', office = ' . $office . ', when_authorized = ' . $when_authorized . ', admin = ' . $admin . ' WHERE id = ' . $id . ';';
			$this->open();
			$result = mysql_query($sql, $con);
			$this->close();
			return $result;
		}// end function

	// person // --------------------

	public function createPerson($person) {
		global $con;
			$id = $person->getId();
			$title = $person->getTitle();
			$first_name = $person->getFirst_name();
			$last_name = $person->getLast_name();
			$gender = $person->getGender();
			$dob = $person->getDob();
			$marital_status_id = $person->getMarital_status();
			$contact_id = $person->getContact();
		$sql = 'INSERT INTO person (id, title, first_name, last_name, gender, dob, marital_status_id, contact_id) VALUES (' . $id . ', ' . $title . ', ' . $first_name . ', ' . $last_name . ', ' . $gender . ', ' . $dob . ', ' . $marital_status_id . ', ' . $contact_id . ');';
		$this->open();
		$result = mysql_query($sql, $con);
		$id = ($result) ? mysql_insert_id() : $result;
		$this->close();
		return $id;
	}// end function

		public function updatePerson($person) {
			global $con;
			$id = $person->getId();
			$title = $person->getTitle();
			$first_name = $person->getFirst_name();
			$last_name = $person->getLast_name();
			$gender = $person->getGender();
			$dob = $person->getDob();
			$marital_status = $person->getMarital_status();
			$contact = $person->getContact();
			$sql = 'UPDATE person SET title = ' . $title . ', first_name = ' . $first_name . ', last_name = ' . $last_name . ', gender = ' . $gender . ', dob = ' . $dob . ', marital_status = ' . $marital_status . ', contact = ' . $contact . ' WHERE id = ' . $id . ';';
			$this->open();
			$result = mysql_query($sql, $con);
			$this->close();
			return $result;
		}// end function

	// personal_donation // --------------------

	public function createPersonal_donation($personal_donation) {
		global $con;
			$id = $personal_donation->getId();
			$donation_id = $personal_donation->getDonation();
			$person_id = $personal_donation->getPerson();
		$sql = 'INSERT INTO personal_donation (id, donation_id, person_id) VALUES (' . $id . ', ' . $donation_id . ', ' . $person_id . ');';
		$this->open();
		$result = mysql_query($sql, $con);
		$id = ($result) ? mysql_insert_id() : $result;
		$this->close();
		return $id;
	}// end function

		public function updatePersonal_donation($personal_donation) {
			global $con;
			$id = $personal_donation->getId();
			$donation = $personal_donation->getDonation();
			$person = $personal_donation->getPerson();
			$sql = 'UPDATE personal_donation SET donation = ' . $donation . ', person = ' . $person . ' WHERE id = ' . $id . ';';
			$this->open();
			$result = mysql_query($sql, $con);
			$this->close();
			return $result;
		}// end function

	// photo_id // --------------------

	public function createPhoto_id($photo_id) {
		global $con;
			$person_id = $photo_id->getPerson();
			$photo_id = $photo_id->getPhoto();
		$sql = 'INSERT INTO photo_id (person_id, photo_id) VALUES (' . $person_id . ', ' . $photo_id . ');';
		$this->open();
		$result = mysql_query($sql, $con);
		$id = ($result) ? mysql_insert_id() : $result;
		$this->close();
		return $id;
	}// end function

		public function updatePhoto_id($photo_id) {
			global $con;
			$person = $photo_id->getPerson();
			$photo = $photo_id->getPhoto();
			$sql = 'UPDATE photo_id SET person = ' . $person . ', photo = ' . $photo . ' WHERE id = ' . $id . ';';
			$this->open();
			$result = mysql_query($sql, $con);
			$this->close();
			return $result;
		}// end function

	// project // --------------------

	public function createProject($project) {
		global $con;
			$id = $project->getId();
			$is_active = $project->getIs_active();
			$municipality_id = $project->getMunicipality();
			$sponsor_id = $project->getSponsor();
			$date_of_origin = $project->getDate_of_origin();
			$start_date = $project->getStart_date();
			$estimated_completion_date = $project->getEstimated_completion_date();
			$actual_completion_date = $project->getActual_completion_date();
			$description = $project->getDescription();
			$extimated_valutation = $project->getExtimated_valutation();
			$estimated_purchase = $project->getEstimated_purchase();
			$estimated_rehab = $project->getEstimated_rehab();
			$estimated_pre_acq = $project->getEstimated_pre_acq();
			$actual_pre_acq = $project->getActual_pre_acq();
			$estimated_sponser_value = $project->getEstimated_sponser_value();
			$estimated_donation_value = $project->getEstimated_donation_value();
			$estimated_sell_price = $project->getEstimated_sell_price();
			$estimated_volunteer_hours = $project->getEstimated_volunteer_hours();
			$estimated_purchase_cost = $project->getEstimated_purchase_cost();
			$actual_purchase_cost = $project->getActual_purchase_cost();
			$materials_budger = $project->getMaterials_budger();
			$labor_budget = $project->getLabor_budget();
			$subContract_budget = $project->getSubContract_budget();
			$indirectAllocation_budget = $project->getIndirectAllocation_budget();
			$buyer_hours_required = $project->getBuyer_hours_required();
			$estimated_selling_price = $project->getEstimated_selling_price();
			$actual_appraisal_value = $project->getActual_appraisal_value();
			$actual_sell_price = $project->getActual_sell_price();
		$sql = 'INSERT INTO project (id, is_active, municipality_id, sponsor_id, date_of_origin, start_date, estimated_completion_date, actual_completion_date, description, extimated_valutation, estimated_purchase, estimated_rehab, estimated_Pre-Acq, actual_pre_acq, estimated_sponser_value, estimated_donation_value, estimated_sell_price, estimated_volunteer_hours, estimated_purchase_cost, actual_purchase_cost, materials_budger, labor_budget, subContract_budget, indirectAllocation_budget, buyer_hours_required, estimated_selling_price, actual_appraisal_value, actual_sell_price) VALUES (' . $id . ', ' . $is_active . ', ' . $municipality_id . ', ' . $sponsor_id . ', ' . $date_of_origin . ', ' . $start_date . ', ' . $estimated_completion_date . ', ' . $actual_completion_date . ', ' . $description . ', ' . $extimated_valutation . ', ' . $estimated_purchase . ', ' . $estimated_rehab . ', ' . $estimated_pre_acq . ', ' . $actual_pre_acq . ', ' . $estimated_sponser_value . ', ' . $estimated_donation_value . ', ' . $estimated_sell_price . ', ' . $estimated_volunteer_hours . ', ' . $estimated_purchase_cost . ', ' . $actual_purchase_cost . ', ' . $materials_budger . ', ' . $labor_budget . ', ' . $subContract_budget . ', ' . $indirectAllocation_budget . ', ' . $buyer_hours_required . ', ' . $estimated_selling_price . ', ' . $actual_appraisal_value . ', ' . $actual_sell_price . ');';
		$this->open();
		$result = mysql_query($sql, $con);
		$id = ($result) ? mysql_insert_id() : $result;
		$this->close();
		return $id;
	}// end function

		public function updateProject($project) {
			global $con;
			$id = $project->getId();
			$is_active = $project->getIs_active();
			$municipality = $project->getMunicipality();
			$sponsor = $project->getSponsor();
			$date_of_origin = $project->getDate_of_origin();
			$start_date = $project->getStart_date();
			$estimated_completion_date = $project->getEstimated_completion_date();
			$actual_completion_date = $project->getActual_completion_date();
			$description = $project->getDescription();
			$extimated_valutation = $project->getExtimated_valutation();
			$estimated_purchase = $project->getEstimated_purchase();
			$estimated_rehab = $project->getEstimated_rehab();
			$estimated_pre_acq = $project->getEstimated_pre_acq();
			$actual_pre_acq = $project->getActual_pre_acq();
			$estimated_sponser_value = $project->getEstimated_sponser_value();
			$estimated_donation_value = $project->getEstimated_donation_value();
			$estimated_sell_price = $project->getEstimated_sell_price();
			$estimated_volunteer_hours = $project->getEstimated_volunteer_hours();
			$estimated_purchase_cost = $project->getEstimated_purchase_cost();
			$actual_purchase_cost = $project->getActual_purchase_cost();
			$materials_budger = $project->getMaterials_budger();
			$labor_budget = $project->getLabor_budget();
			$subContract_budget = $project->getSubContract_budget();
			$indirectAllocation_budget = $project->getIndirectAllocation_budget();
			$buyer_hours_required = $project->getBuyer_hours_required();
			$estimated_selling_price = $project->getEstimated_selling_price();
			$actual_appraisal_value = $project->getActual_appraisal_value();
			$actual_sell_price = $project->getActual_sell_price();
			$sql = 'UPDATE project SET is_active = ' . $is_active . ', municipality = ' . $municipality . ', sponsor = ' . $sponsor . ', date_of_origin = ' . $date_of_origin . ', start_date = ' . $start_date . ', estimated_completion_date = ' . $estimated_completion_date . ', actual_completion_date = ' . $actual_completion_date . ', description = ' . $description . ', extimated_valutation = ' . $extimated_valutation . ', estimated_purchase = ' . $estimated_purchase . ', estimated_rehab = ' . $estimated_rehab . ', estimated_Pre-Acq = ' . $estimated_Pre-Acq . ', actual_pre_acq = ' . $actual_pre_acq . ', estimated_sponser_value = ' . $estimated_sponser_value . ', estimated_donation_value = ' . $estimated_donation_value . ', estimated_sell_price = ' . $estimated_sell_price . ', estimated_volunteer_hours = ' . $estimated_volunteer_hours . ', estimated_purchase_cost = ' . $estimated_purchase_cost . ', actual_purchase_cost = ' . $actual_purchase_cost . ', materials_budger = ' . $materials_budger . ', labor_budget = ' . $labor_budget . ', subContract_budget = ' . $subContract_budget . ', indirectAllocation_budget = ' . $indirectAllocation_budget . ', buyer_hours_required = ' . $buyer_hours_required . ', estimated_selling_price = ' . $estimated_selling_price . ', actual_appraisal_value = ' . $actual_appraisal_value . ', actual_sell_price = ' . $actual_sell_price . ' WHERE id = ' . $id . ';';
			$this->open();
			$result = mysql_query($sql, $con);
			$this->close();
			return $result;
		}// end function

	// project_donation // --------------------

	public function createProject_donation($project_donation) {
		global $con;
			$id = $project_donation->getId();
			$project_id = $project_donation->getProject();
			$donation_id = $project_donation->getDonation();
		$sql = 'INSERT INTO project_donation (id, project_id, donation_id) VALUES (' . $id . ', ' . $project_id . ', ' . $donation_id . ');';
		$this->open();
		$result = mysql_query($sql, $con);
		$id = ($result) ? mysql_insert_id() : $result;
		$this->close();
		return $id;
	}// end function

		public function updateProject_donation($project_donation) {
			global $con;
			$id = $project_donation->getId();
			$project = $project_donation->getProject();
			$donation = $project_donation->getDonation();
			$sql = 'UPDATE project_donation SET project = ' . $project . ', donation = ' . $donation . ' WHERE id = ' . $id . ';';
			$this->open();
			$result = mysql_query($sql, $con);
			$this->close();
			return $result;
		}// end function

	// project_event // --------------------

	public function createProject_event($project_event) {
		global $con;
			$event_id = $project_event->getEvent();
			$project_id = $project_event->getProject();
		$sql = 'INSERT INTO project_event (event_id, project_id) VALUES (' . $event_id . ', ' . $project_id . ');';
		$this->open();
		$result = mysql_query($sql, $con);
		$id = ($result) ? mysql_insert_id() : $result;
		$this->close();
		return $id;
	}// end function

		public function updateProject_event($project_event) {
			global $con;
			$event = $project_event->getEvent();
			$project = $project_event->getProject();
			$sql = 'UPDATE project_event SET event = ' . $event . ', project = ' . $project . ' WHERE id = ' . $id . ';';
			$this->open();
			$result = mysql_query($sql, $con);
			$this->close();
			return $result;
		}// end function

	// project_expenses // --------------------

	public function createProject_expenses($project_expenses) {
		global $con;
			$id = $project_expenses->getId();
			$title = $project_expenses->getTitle();
			$description = $project_expenses->getDescription();
			$project_id = $project_expenses->getProject();
			$type_id = $project_expenses->getType();
			$amount = $project_expenses->getAmount();
			$when_entered = $project_expenses->getWhen_entered();
			$office_id = $project_expenses->getOffice();
			$when_authorized = $project_expenses->getWhen_authorized();
			$admin_id = $project_expenses->getAdmin();
		$sql = 'INSERT INTO project_expenses (id, title, description, project_id, type_id, amount, when_entered, office_id, when_authorized, admin_id) VALUES (' . $id . ', ' . $title . ', ' . $description . ', ' . $project_id . ', ' . $type_id . ', ' . $amount . ', ' . $when_entered . ', ' . $office_id . ', ' . $when_authorized . ', ' . $admin_id . ');';
		$this->open();
		$result = mysql_query($sql, $con);
		$id = ($result) ? mysql_insert_id() : $result;
		$this->close();
		return $id;
	}// end function

		public function updateProject_expenses($project_expenses) {
			global $con;
			$id = $project_expenses->getId();
			$title = $project_expenses->getTitle();
			$description = $project_expenses->getDescription();
			$project = $project_expenses->getProject();
			$type = $project_expenses->getType();
			$amount = $project_expenses->getAmount();
			$when_entered = $project_expenses->getWhen_entered();
			$office = $project_expenses->getOffice();
			$when_authorized = $project_expenses->getWhen_authorized();
			$admin = $project_expenses->getAdmin();
			$sql = 'UPDATE project_expenses SET title = ' . $title . ', description = ' . $description . ', project = ' . $project . ', type = ' . $type . ', amount = ' . $amount . ', when_entered = ' . $when_entered . ', office = ' . $office . ', when_authorized = ' . $when_authorized . ', admin = ' . $admin . ' WHERE id = ' . $id . ';';
			$this->open();
			$result = mysql_query($sql, $con);
			$this->close();
			return $result;
		}// end function

	// project_status // --------------------

	public function createProject_status($project_status) {
		global $con;
			$id = $project_status->getId();
			$title = $project_status->getTitle();
			$description = $project_status->getDescription();
			$abbreviation = $project_status->getAbbreviation();
		$sql = 'INSERT INTO project_status (id, title, description, abbreviation) VALUES (' . $id . ', ' . $title . ', ' . $description . ', ' . $abbreviation . ');';
		$this->open();
		$result = mysql_query($sql, $con);
		$id = ($result) ? mysql_insert_id() : $result;
		$this->close();
		return $id;
	}// end function

		public function updateProject_status($project_status) {
			global $con;
			$id = $project_status->getId();
			$title = $project_status->getTitle();
			$description = $project_status->getDescription();
			$abbreviation = $project_status->getAbbreviation();
			$sql = 'UPDATE project_status SET title = ' . $title . ', description = ' . $description . ', abbreviation = ' . $abbreviation . ' WHERE id = ' . $id . ';';
			$this->open();
			$result = mysql_query($sql, $con);
			$this->close();
			return $result;
		}// end function

	// recovery_log // --------------------

	public function createRecovery_log($recovery_log) {
		global $con;
			$account_id = $recovery_log->getAccount();
			$date = $recovery_log->getDate();
			$time = $recovery_log->getTime();
		$sql = 'INSERT INTO recovery_log (account_id, date, time) VALUES (' . $account_id . ', ' . $date . ', ' . $time . ');';
		$this->open();
		$result = mysql_query($sql, $con);
		$id = ($result) ? mysql_insert_id() : $result;
		$this->close();
		return $id;
	}// end function

		public function updateRecovery_log($recovery_log) {
			global $con;
			$account = $recovery_log->getAccount();
			$date = $recovery_log->getDate();
			$time = $recovery_log->getTime();
			$sql = 'UPDATE recovery_log SET account = ' . $account . ', date = ' . $date . ', time = ' . $time . ' WHERE id = ' . $id . ';';
			$this->open();
			$result = mysql_query($sql, $con);
			$this->close();
			return $result;
		}// end function

	// requirement // --------------------

	public function createRequirement($requirement) {
		global $con;
			$id = $requirement->getId();
			$title = $requirement->getTitle();
			$description = $requirement->getDescription();
		$sql = 'INSERT INTO requirement (id, title, description) VALUES (' . $id . ', ' . $title . ', ' . $description . ');';
		$this->open();
		$result = mysql_query($sql, $con);
		$id = ($result) ? mysql_insert_id() : $result;
		$this->close();
		return $id;
	}// end function

		public function updateRequirement($requirement) {
			global $con;
			$id = $requirement->getId();
			$title = $requirement->getTitle();
			$description = $requirement->getDescription();
			$sql = 'UPDATE requirement SET title = ' . $title . ', description = ' . $description . ' WHERE id = ' . $id . ';';
			$this->open();
			$result = mysql_query($sql, $con);
			$this->close();
			return $result;
		}// end function

	// schedule // --------------------

	public function createSchedule($schedule) {
		global $con;
			$id = $schedule->getId();
			$event_id = $schedule->getEvent();
			$start_time = $schedule->getStart_time();
			$end_time = $schedule->getEnd_time();
			$description = $schedule->getDescription();
			$interest_id = $schedule->getInterest();
			$max_num_people = $schedule->getMax_num_people();
		$sql = 'INSERT INTO schedule (id, event_id, start_time, end_time, description, interest_id, max_num_people) VALUES (' . $id . ', ' . $event_id . ', ' . $start_time . ', ' . $end_time . ', ' . $description . ', ' . $interest_id . ', ' . $max_num_people . ');';
		$this->open();
		$result = mysql_query($sql, $con);
		$id = ($result) ? mysql_insert_id() : $result;
		$this->close();
		return $id;
	}// end function

		public function updateSchedule($schedule) {
			global $con;
			$id = $schedule->getId();
			$event = $schedule->getEvent();
			$start_time = $schedule->getStart_time();
			$end_time = $schedule->getEnd_time();
			$description = $schedule->getDescription();
			$interest = $schedule->getInterest();
			$max_num_people = $schedule->getMax_num_people();
			$sql = 'UPDATE schedule SET event = ' . $event . ', start_time = ' . $start_time . ', end_time = ' . $end_time . ', description = ' . $description . ', interest = ' . $interest . ', max_num_people = ' . $max_num_people . ' WHERE id = ' . $id . ';';
			$this->open();
			$result = mysql_query($sql, $con);
			$this->close();
			return $result;
		}// end function

	// serves_on // --------------------

	public function createServes_on($serves_on) {
		global $con;
			$volunteer_id = $serves_on->getVolunteer();
			$committee_id = $serves_on->getCommittee();
			$is_officer = $serves_on->getIs_officer();
		$sql = 'INSERT INTO serves_on (volunteer_id, committee_id, is_officer) VALUES (' . $volunteer_id . ', ' . $committee_id . ', ' . $is_officer . ');';
		$this->open();
		$result = mysql_query($sql, $con);
		$id = ($result) ? mysql_insert_id() : $result;
		$this->close();
		return $id;
	}// end function

		public function updateServes_on($serves_on) {
			global $con;
			$volunteer = $serves_on->getVolunteer();
			$committee = $serves_on->getCommittee();
			$is_officer = $serves_on->getIs_officer();
			$sql = 'UPDATE serves_on SET volunteer = ' . $volunteer . ', committee = ' . $committee . ', is_officer = ' . $is_officer . ' WHERE id = ' . $id . ';';
			$this->open();
			$result = mysql_query($sql, $con);
			$this->close();
			return $result;
		}// end function

	// state // --------------------

	public function createState($state) {
		global $con;
			$id = $state->getId();
			$abbreviation = $state->getAbbreviation();
			$title = $state->getTitle();
		$sql = 'INSERT INTO state (id, abbreviation, title) VALUES (' . $id . ', ' . $abbreviation . ', ' . $title . ');';
		$this->open();
		$result = mysql_query($sql, $con);
		$id = ($result) ? mysql_insert_id() : $result;
		$this->close();
		return $id;
	}// end function

		public function updateState($state) {
			global $con;
			$id = $state->getId();
			$abbreviation = $state->getAbbreviation();
			$title = $state->getTitle();
			$sql = 'UPDATE state SET abbreviation = ' . $abbreviation . ', title = ' . $title . ' WHERE id = ' . $id . ';';
			$this->open();
			$result = mysql_query($sql, $con);
			$this->close();
			return $result;
		}// end function

	// status_change // --------------------

	public function createStatus_change($status_change) {
		global $con;
			$project_id = $status_change->getProject();
			$status_id = $status_change->getStatus();
			$when_changed = $status_change->getWhen_changed();
		$sql = 'INSERT INTO status_change (project_id, status_id, when_changed) VALUES (' . $project_id . ', ' . $status_id . ', ' . $when_changed . ');';
		$this->open();
		$result = mysql_query($sql, $con);
		$id = ($result) ? mysql_insert_id() : $result;
		$this->close();
		return $id;
	}// end function

		public function updateStatus_change($status_change) {
			global $con;
			$project = $status_change->getProject();
			$status = $status_change->getStatus();
			$when_changed = $status_change->getWhen_changed();
			$sql = 'UPDATE status_change SET project = ' . $project . ', status = ' . $status . ', when_changed = ' . $when_changed . ' WHERE id = ' . $id . ';';
			$this->open();
			$result = mysql_query($sql, $con);
			$this->close();
			return $result;
		}// end function

	// tickets // --------------------

	public function createTickets($tickets) {
		global $con;
			$event_id = $tickets->getEvent();
			$id = $tickets->getId();
			$ticket_price = $tickets->getTicket_price();
			$max_num = $tickets->getMax_num();
			$current_num = $tickets->getCurrent_num();
		$sql = 'INSERT INTO tickets (event_id, id, ticket_price, max_num, current_num) VALUES (' . $event_id . ', ' . $id . ', ' . $ticket_price . ', ' . $max_num . ', ' . $current_num . ');';
		$this->open();
		$result = mysql_query($sql, $con);
		$id = ($result) ? mysql_insert_id() : $result;
		$this->close();
		return $id;
	}// end function

		public function updateTickets($tickets) {
			global $con;
			$event = $tickets->getEvent();
			$id = $tickets->getId();
			$ticket_price = $tickets->getTicket_price();
			$max_num = $tickets->getMax_num();
			$current_num = $tickets->getCurrent_num();
			$sql = 'UPDATE tickets SET event = ' . $event . ', id = ' . $id . ', ticket_price = ' . $ticket_price . ', max_num = ' . $max_num . ', current_num = ' . $current_num . ' WHERE id = ' . $id . ';';
			$this->open();
			$result = mysql_query($sql, $con);
			$this->close();
			return $result;
		}// end function

	// volunteer // --------------------

	public function createVolunteer($volunteer) {
		global $con;
			$id = $volunteer->getId();
			$person_id = $volunteer->getPerson();
			$consent_age = $volunteer->getConsent_age();
			$consent_video = $volunteer->getConsent_video();
			$consent_waiver = $volunteer->getConsent_waiver();
			$consent_photo = $volunteer->getConsent_photo();
			$consent_minor = $volunteer->getConsent_minor();
			$consent_safety = $volunteer->getConsent_safety();
			$avail_day = $volunteer->getAvail_day();
			$avail_eve = $volunteer->getAvail_eve();
			$avail_wkend = $volunteer->getAvail_wkend();
			$emergency_name = $volunteer->getEmergency_name();
			$emergency_phone = $volunteer->getEmergency_phone();
		$sql = 'INSERT INTO volunteer (id, person_id, consent_age, consent_video, consent_waiver, consent_photo, consent_minor, consent_safety, avail_day, avail_eve, avail_wkend, emergency_name, emergency_phone) VALUES (' . $id . ', ' . $person_id . ', ' . $consent_age . ', ' . $consent_video . ', ' . $consent_waiver . ', ' . $consent_photo . ', ' . $consent_minor . ', ' . $consent_safety . ', ' . $avail_day . ', ' . $avail_eve . ', ' . $avail_wkend . ', ' . $emergency_name . ', ' . $emergency_phone . ');';
		$this->open();
		$result = mysql_query($sql, $con);
		$id = ($result) ? mysql_insert_id() : $result;
		$this->close();
		return $id;
	}// end function

		public function updateVolunteer($volunteer) {
			global $con;
			$id = $volunteer->getId();
			$person = $volunteer->getPerson();
			$consent_age = $volunteer->getConsent_age();
			$consent_video = $volunteer->getConsent_video();
			$consent_waiver = $volunteer->getConsent_waiver();
			$consent_photo = $volunteer->getConsent_photo();
			$consent_minor = $volunteer->getConsent_minor();
			$consent_safety = $volunteer->getConsent_safety();
			$avail_day = $volunteer->getAvail_day();
			$avail_eve = $volunteer->getAvail_eve();
			$avail_wkend = $volunteer->getAvail_wkend();
			$emergency_name = $volunteer->getEmergency_name();
			$emergency_phone = $volunteer->getEmergency_phone();
			$sql = 'UPDATE volunteer SET person = ' . $person . ', consent_age = ' . $consent_age . ', consent_video = ' . $consent_video . ', consent_waiver = ' . $consent_waiver . ', consent_photo = ' . $consent_photo . ', consent_minor = ' . $consent_minor . ', consent_safety = ' . $consent_safety . ', avail_day = ' . $avail_day . ', avail_eve = ' . $avail_eve . ', avail_wkend = ' . $avail_wkend . ', emergency_name = ' . $emergency_name . ', emergency_phone = ' . $emergency_phone . ' WHERE id = ' . $id . ';';
			$this->open();
			$result = mysql_query($sql, $con);
			$this->close();
			return $result;
		}// end function

	// work // --------------------

	public function createWork($work) {
		global $con;
			$id = $work->getId();
			$volunteer_id = $work->getVolunteer();
			$date = $work->getDate();
			$event_id = $work->getEvent();
			$when_entered = $work->getWhen_entered();
			$office_id = $work->getOffice();
			$when_authorized = $work->getWhen_authorized();
			$admin_id = $work->getAdmin();
			$hours_worked = $work->getHours_worked();
		$sql = 'INSERT INTO work (id, volunteer_id, date, event_id, when_entered, office_id, when_authorized, admin_id, hours_worked) VALUES (' . $id . ', ' . $volunteer_id . ', ' . $date . ', ' . $event_id . ', ' . $when_entered . ', ' . $office_id . ', ' . $when_authorized . ', ' . $admin_id . ', ' . $hours_worked . ');';
		$this->open();
		$result = mysql_query($sql, $con);
		$id = ($result) ? mysql_insert_id() : $result;
		$this->close();
		return $id;
	}// end function

		public function updateWork($work) {
			global $con;
			$id = $work->getId();
			$volunteer = $work->getVolunteer();
			$date = $work->getDate();
			$event = $work->getEvent();
			$when_entered = $work->getWhen_entered();
			$office = $work->getOffice();
			$when_authorized = $work->getWhen_authorized();
			$admin = $work->getAdmin();
			$hours_worked = $work->getHours_worked();
			$sql = 'UPDATE work SET volunteer = ' . $volunteer . ', date = ' . $date . ', event = ' . $event . ', when_entered = ' . $when_entered . ', office = ' . $office . ', when_authorized = ' . $when_authorized . ', admin = ' . $admin . ', hours_worked = ' . $hours_worked . ' WHERE id = ' . $id . ';';
			$this->open();
			$result = mysql_query($sql, $con);
			$this->close();
			return $result;
		}// end function
        } //end class

?>