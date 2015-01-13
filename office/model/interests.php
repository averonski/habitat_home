<?php

	// TITLE: Office Interests Model
	// FILE: office/model/interests.php
	// AUTHOR: bmw5285d

        //this sections contains HTML in a model and needs redone. All htnl should be in the view.

        //lists all interests
	function listInterests()
	{
		$dbio = new DBIO();
		$ints = $dbio->listInterest();
		echo '<table class="table table-striped table-hover " style="width:100%"><tr><th>ID</th><th>Type ID</th><th>Title</th><th>Description</th></tr>';
		foreach ($ints as &$int)
		{
			echo '<input id="dir" type="hidden" value="office">';
			echo '<input id="sub" type="hidden" value="interests">';
			echo '<input id="act" type="hidden" value="viewInterest">';
			echo '<tr onclick="retreive(' . $int->getId() . ');">';
			echo '<td>' . $int->getId() . '</td>';
			echo '<td>' . $int->getType()->getTitle() . '</td>';
			echo '<td>' . $int->getTitle() . '</td>';
			echo '<td>' . $int->getDescription() . '</td>';
			echo '</tr>';
		}
		echo '</table>';
	}
	
        //lists all interest types
	function listInterestTypes()
	{
		$dbio = new DBIO();
		$intTypes = $dbio->listInterest_type();
		echo '<table class="table table-striped table-hover " style="width:100%"><tr><th>ID</th><th>Title</th><th>Description</th></tr>';
		foreach ($intTypes as &$intType)
		{
			echo '<input id="dir" type="hidden" value="office">';
			echo '<input id="sub" type="hidden" value="interests">';
			echo '<input id="act" type="hidden" value="viewInterestType">';
			echo '<tr onclick="retreive(' . $intType->getId() . ');">';
			echo '<td>' . $intType->getId() . '</td>';
			echo '<td>' . $intType->getTitle() . '</td>';
			echo '<td>' . $intType->getDescription() . '</td>';
			echo '</tr>';
		}
		echo '</table>';
	}
	
        //creates an interest
	function createInterest($newInterest)
	{
            $dbio = new DBIO();
            $dbio->createInterest($newInterest);
	}
	
        //creates an interest type
	function createInterest_type($newInterestType)
	{
		$dbio = new DBIO();
                $dbio->createInterest_type($newInterestType);
	}
	
        //reads an interest based on id
	function readInterest()
	{
            $dbio = new DBIO();
            $id = $_GET['id'];
            $volInts = $dbio->readInterested_in($id);
            //print_r($volInts);
            echo '<table class="table table-striped table-hover " style="width:100%"><tr><th>Name</th><th>Interest Type</th><th>Interest</th></tr>';
            foreach($volInts as $volInt) //loop which goes through each interest and pulls data (Interest() class call)
                    {
                        echo '<input id="dir" type="hidden" value="office">';
                        echo '<input id="sub" type="hidden" value="interests">';
                        echo '<input id="act" type="hidden" value="viewInterest">';
                        $id = $volInt->getInterest()->getId();
                        $first_name = $volInt->getVolunteer()->getPerson()->getFirst_name(); //Interest() class call
                        $last_name = $volInt->getVolunteer()->getPerson()->getLast_name(); //Interest() class call
                        $type_title = $volInt->getInterest()->getType()->getTitle(); //Interest() class call
                        $interest_title = $volInt->getInterest()->getTitle(); //Interest() class call
                        echo '<tr onclick="retreive(' . $id . ');">';
                                        echo "<td>{$first_name}, {$last_name}</td>";
                                        //echo "<td>{$last_name}</td>";
                                        echo "<td>{$type_title}</td>";
                                        echo "<td>{$interest_title}</td>";
                                        //echo "<td>'{$description}'</td>";
                        echo "</tr>";
                    }
	}
	
        //reads an interest type based on id
	function readInterestType()
	{
		$dbio = new DBIO();
		$id = $_GET['id'];
                $volInts = $dbio->readInterestbyType($id);
		echo '<table class="table table-striped table-hover " style="width:100%"><tr><th>Name</th><th>Interest Type</th><th>Interest</th></tr>';
		if (is_null($volInts))
		{
			return null;
		}
		else
		{
                    foreach($volInts as $volInt) //loop which goes through each interest and pulls data (Interest() class call)
                    {
                        echo '<input id="dir" type="hidden" value="office">';
                        echo '<input id="sub" type="hidden" value="interests">';
                        echo '<input id="act" type="hidden" value="viewInterestType">';
                        foreach ($volInt->getId() as $volIntIn) {
                            $id = $volIntIn->getInterest()->getType()->getId();
                            $first_name = $volIntIn->getVolunteer()->getPerson()->getFirst_name(); //Interest() class call
                            $last_name = $volIntIn->getVolunteer()->getPerson()->getLast_name(); //Interest() class call
                            $type_title = $volIntIn->getInterest()->getType()->getTitle(); //Interest() class call
                            $interest_title = $volIntIn->getInterest()->getTitle(); //Interest() class call
                            echo '<tr onclick="retreive(' . $id . ');">';
                                echo "<td>{$first_name}, {$last_name}</td>";
                                //echo "<td>{$last_name}</td>";
                                echo "<td>{$type_title}</td>";
                                echo "<td>{$interest_title}</td>";
                                //echo "<td>'{$description}'</td>";
                            echo "</tr>";
                        }
                    }
		}
	}
	
        //reads an interest based on id
	function viewInterest()
	{
		$dbio = new DBIO();
		$id = $_GET['id'];
		$ints = $dbio->readInterest($id);
		if (is_null($ints))
		{
			return null;
		}
		else
		{
			echo "<table><form name='viewInterest' action='' method='post'";
				echo "<tr><th>Interest Type</th><th>Interest</th><th>Description</th></tr>";
				echo '<tr>';
				//echo "<td><input name = 'typeTitle' type='text' placeholder='{$ints[0]->getType_title()}'></td>";
				echo "<td><select>";
				$intTypes = $dbio->listInterest_type();
				echo "<option value='{$ints->getType()->getId()}'>{$ints->getType()->getTitle()}</option>";
				foreach ($intTypes as &$intType)
				{
					$interestType = $intType->getTitle();
					$interestId = $intType->getId();
					echo "<option value = '{$interestId}' name = '{$interestType}'>{$interestType}</option>";
				}
				echo "<select></td>";
				echo '<td><input name = "title" type="text" value="' . $ints->getTitle() . '"></td>';
				echo "<td><input name = 'description' type='text' value='{$ints->getDescription()}'></td>";
				echo "<td><input name='viewInterest' value='update' type='submit'></td>";
				echo '</tr>';
			echo '</form></table>';
			if(isset($_POST['viewInterest']))
			{
				global $con;
				$dbio = new DBIO();
				$dbio->open();
				$sql = "UPDATE Interest
						SET Interest.type_id='{$interestId}', Interest.title='{$_POST['title']}', Interest.description='{$_POST['description']}'
						WHERE interest_id = '{$id}'";
				$result = mysql_query($sql,$con);
				//echo $interestId, $_POST['title'], $_POST['description'];
				
			}
		}
	}
	
        //reads an interest based on id
	function viewInterestType()
	{
		$dbio = new DBIO();
		$id = $_GET['id'];
		$intTypes = $dbio->readInterest_type($id);
		echo "<table>"
                    . "<form name='viewInterestType' action='' method='post'";
                        echo "<tr>"
                            . "<th>Interest Type</th><th>Description</th>"
                        . "</tr>";
                            if (is_null($intTypes))
                            {
                                    return null;
                            }
                            else
                            {
                                echo '<tr>';
                                echo '<td><input name = "title" type="text" value="' . $intTypes->getTitle() . '"></td>';
                                echo "<td><input name = 'description' type='text' value='{$intTypes->getDescription()}'></td>";
                                echo "<td><input name='viewInterestType' value='update' type='submit'></td>";
                                echo '</tr>';
                            }
                    echo '</form>'
                . '</table>';
                        if(isset($_POST['viewInterestType']))
                        {
                                global $con;
                                $dbio = new DBIO();
                                $dbio->open();
                                $sql = "UPDATE Interest_Type
                                                SET Interest_Type.title='{$_POST['title']}', Interest_Type.description='{$_POST['description']}'
                                                WHERE Interest_Type.type_id = '{$id}'";
                                $result = mysql_query($sql,$con);	
                            }
        }
	
?>
