<?php

    // FILE: Registration Database
    // AUTHOR: sbkedia

// all methods for dbio input and ouput
// too many to explain. Ask BMW5285 (brandon Willis) if issue arrise

class DBIO {
	
	
		// ATTRIBUTES /////////////////////////////////////////////////////////////////////////////
		
		protected $con;
		
		
		// CONSTRUCTOR ////////////////////////////////////////////////////////////////////////////
		
		public function __construct() {}
		
		
		// METHODS ////////////////////////////////////////////////////////////////////////////////
		
		function open() {
			$hostname="73.52.51.66";
			$username="habitat";
			$password="habitat";
			$dbname="homes_db";
			
			 global $con;
			 $con = mysql_connect($hostname,$username, $password) or die ("no worky");
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
			EXAMPLE: 'a', 'b', 'c', 'd' -OR- 1, 2, 3, 4 -OR- ('a'), ('b'), ('c'), ('d')
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

		
		
///////////////////////////////////////////////////////////////////////////////////////////////////
		
		public function getMaritialStatus($maritial){
			global $con;
			$sql='SELECT title from marital_status where id IN ('. $maritial .')';
			$this->open();
			$results=mysql_query($sql, $con);
			$final=mysql_fetch_row($results);
			$status=$final[0];
			$this->close();
			return $status;
		}

		public function getUsername($use)
		{
			global $con;
			$sql='SELECT email FROM email WHERE email IN ("'.$use.'")';
			$this->open();
			$results=mysql_query($sql,$con);
			$final=mysql_fetch_row($results);
			$status=$final[0];
			$this->close();
			return $status;
		}

		public function getOrganization(){
			global $con;
			$sql='SELECT name from Organization';
			$orgName=array();
			$this->open();
			$results=mysql_query($sql,$con);
			while($result= mysql_fetch_array($results)){
				$int_type=new Organization();
				$int_type->setOrgName($result[0]);
				$orgName[]=$int_type;

			}
			$this->close();
			return $orgName;

		}


	   public function getAllInterestTypes() {
		  global $con;
		  $sql = 'SELECT id, title FROM interest_type';
		  $types = array();
		  $this->open();		
		  $results = mysql_query($sql, $con);
		  while($result = mysql_fetch_array($results)) {
				$int_type= new Item();
				$int_type->setId($result[0]);
				$int_type->setTitle($result[1]);
				$types[]=$int_type;
		  }// end while
		  $this->close();
		  return $types;
	   }// end function

	   
	   public function getAllInterests() {
		global $con;
		$sql = 'SELECT * FROM Interest';
		$this->open();
		$results = mysql_query($sql, $con);

			$interests = array();
			while($result = mysql_fetch_array($results)) {
				$interest = new Interest();
				$interest->setId($result[0]);
				$interest->setTypeid($result[1]);
				$interest->setTitle($result[2]);
				//$interest->setDescription($result[3]);
				$interests[] = $interest;
			}// end while
		$this->close();
		return $interests;
	}// end function

	public function getInterestsOfType($type_id) {
		global $con;
		$sql = 'SELECT * FROM interest Where type_id='.$type_id;
		$this->open();
		$results = mysql_query($sql, $con);

			$interests = array();
			while($result = mysql_fetch_array($results)) {
				$interest = new Interest();
				$interest->setId($result[0]);
				$interest->setTypeid($result[1]);
				$interest->setTitle($result[2]);
				//$interest->setDescription($result[3]);
				$interests[] = $interest;
			}// end while
		$this->close();
		return $interests;
	}// end function
    
	public function getInterestsByIds($ids) {
		global $con;
		$sql = "SELECT * FROM interest Where id IN (". $ids .");";
		$this->open();
		$results = mysql_query($sql, $con);
			$interests = array();

			while($result = mysql_fetch_array($results)) {
				$interest = new Interest();
				$interest->setId($result[0]);
				$interest->setTypeid($result[1]);
				$interest->setTitle($result[2]);
				//$interest->setDescription($result[3]);
				$interests[] = $interest;
			}// end while
		$this->close();
		return $interests;
	}// end function

	
    public function createNewPerson($street1,$street2,$city,$state,$zip,$phone,$email,$phone2,$extension,$title,$fName,$lName,$gender,$dob,$maritialStatusId,$prefEmail,$prefMail,$prefPhone){
		global $con;
		$this->open();
                
                //insert data into address
                $sql = "SELECT id
                        FROM STATE
                        WHERE title = '" .$state. "';";
                        $result = mysql_query($sql, $con);
                        while($row = mysql_fetch_array($result)) {
                            $state_id = $row[0];
                        }
                    //echo mysql_errno($con) . ": " . mysql_error($con). "\n";

		$sql =	"INSERT INTO Address
				(street1,street2,city,state_id,zip)
				VALUES
				('" .$street1. "','" .$street2. "','" .$city. "','" .$state_id. "','" .$zip. "');";
		mysql_query($sql, $con);
                    //echo mysql_errno($con) . ": " . mysql_error($con). "\n";
                
                //insert data into person
                $sql = "SELECT MAX(id)
                        FROM address;";
                        $result = mysql_query($sql, $con);
                        while($row = mysql_fetch_array($result)) {
                            $address_id = $row[0];
                        }
                    //echo mysql_errno($con) . ": " . mysql_error($con). "\n";
                
                $sql= "SELECT max(id) FROM contact;";
                    $result = mysql_query($sql, $con);
                    while($row = mysql_fetch_array($result)) {
                        $contact_id = $row[0];
                    }
                    $contact_id = (int)$contact_id + 1;
                    //print_r ($contact_id);
                    //echo mysql_errno($con) . ": " . mysql_error($con). "\n";
                    
                //$sql= "SELECT id FROM marital_status WHERE "
                
		$sql=	"INSERT INTO person
				(title,first_name,last_name,gender,dob,marital_status_id,contact_id)
				VALUES ('" .$title. "','" .$fName. "','" .$lName. "','" .$gender. "','" .$dob. "','" .$maritialStatusId. "','" .$contact_id. "');";
		mysql_query($sql, $con); 
                    //echo mysql_errno($con) . ": " . mysql_error($con). "\n";
                       
                //insert data into email
                $sql = "SELECT max(id) FROM person;";
                    $result = mysql_query($sql, $con);
                    while($row = mysql_fetch_array($result)) {
                        $person_id = $row[0];
                    }
                    //echo mysql_errno($con) . ": " . mysql_error($con). "\n";
                    
                $sql = "INSERT INTO email (email,person_id)
                        VALUES ('" .$email. "','" .$person_id. "');";
                mysql_query($sql, $con);
                    //echo mysql_errno($con) . ": " . mysql_error($con). "\n";
                    //echo $email . "," . $person_id;
                
                //insert data into contact
                $sql = "SELECT max(id) FROM email";
                    $result = mysql_query($sql, $con);
                    while($row = mysql_fetch_array($result)) {
                        $email_id = $row[0];
                    }
                    //echo mysql_errno($con) . ": " . mysql_error($con). "\n";
                
                $sql= "SELECT max(id) FROM ADDRESS;";
                    $result = mysql_query($sql, $con);
                    while($row = mysql_fetch_array($result)) {
                        $address_id = $row[0];
                    }
                    //echo mysql_errno($con) . ": " . mysql_error($con). "\n";
           
		$sql=	"INSERT INTO Contact
				(address_id,phone,phone2,email_id)
                                VALUES
				('" .$address_id. "','" .$phone. "','" .$phone2. "','" .$email_id. "');";
		mysql_query($sql, $con);
                    //echo mysql_errno($con) . ": " . mysql_error($con). "\n";
		
                //isActive,lastActive,prefEmail,prefMail,prefPhone  , 1, Null,". $prefEmail. "," .$prefMail. "," .$prefPhone." From Contact;"
		$this->close();
                
		return True;
	}//end function


    public function createNewAccount($consentAge, $consentVideo , $consentWaiver, $consentPhoto , $availDay , $availEve, $availWend, $consentMinor, $consentSafety, $emergencyName, $emergencyPhone, $churchAmbassador, $affiliation,$interestIds, $email, $password){
		global $con;
		$this->open();
                
                // create volunteer
                $sql = "SELECT max(id) FROM person;";
                    $result = mysql_query($sql, $con);
                    while($row = mysql_fetch_array($result)) {
                        $person_id = $row[0];
                    }
                    //echo mysql_errno($con) . ": " . mysql_error($con). "\n";
                
                    //', " .$churchAmbassador. ", '" .$affiliation. "' FROM Person;"
		$sql =	"INSERT INTO volunteer
				(consent_age, consent_video, consent_waiver , consent_photo, avail_day, avail_eve, avail_wkend, person_id,
				 consent_minor, consent_safety, emergency_name, emergency_phone)
				VALUES ('" .$consentAge. "','" .$consentVideo. "','" .$consentWaiver. "','" .$consentPhoto. "','" .$availDay. "','" .$availEve. "','" .$availWend. "',
				'" .$person_id. "','" .$consentMinor. "','" .$consentSafety. "','" .$emergencyName. "','" .$emergencyPhone. "');";
		mysql_query($sql, $con);
                    //echo mysql_errno($con) . ": " . mysql_error($con). "\n";
		
                //create volunteer interests
                $sql = "SELECT max(id) FROM volunteer;";
                    $result = mysql_query($sql, $con);
                    while($row = mysql_fetch_array($result)) {
                        $volunteer_id = $row[0];
                    }
                    //echo mysql_errno($con) . ": " . mysql_error($con). "\n";
                    
		foreach ($interestIds as $interestId) {
		$sql=	"INSERT INTO interested_in
                            (volunteer_id,interest_id)
                            VALUES ('" .$volunteer_id. "','" .$interestId."');";
		mysql_query($sql, $con);
		}
                    //echo mysql_errno($con) . ": " . mysql_error($con). "\n";
		
                //create account      
                $sql = "SELECT id FROM email WHERE email = '"  .$email. "';";
                    $result = mysql_query($sql, $con);
                    while($row = mysql_fetch_array($result)) {
                        $email_id = $row[0];
                    }
                    //echo mysql_errno($con) . ": " . mysql_error($con). "\n";
                    //echo $username . ", " . $email_id;
                    
		$sql =	"INSERT INTO account
				(email, password, created, person_id)
				VALUES ('" .$email_id. "','" .$password. "', now(),'" . $person_id . "');";
		mysql_query($sql, $con);
                    //echo mysql_errno($con) . ": " . mysql_error($con). "\n";
		

		$this->close();

		return True;
	}//end function

	public function createNewOrganization($organization){
		global $con;
		$this->open();

		
	}


	}// end class
?>
