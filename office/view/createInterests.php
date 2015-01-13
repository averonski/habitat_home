<?php
//Author: bmw5285; copied from j*p*

echo '<center><input type="button"  class="btn btn-primary btn-sm" onclick="history.back();" value="Back"></center>';
echo "<br><br>";

$newInterest = new Interest;

if($_GET['act'] == "createInterest")
{
	echo '<form action="" method="post">';
		echo '<select id="interestTypeName" name="interestTypeName">';
			echo '<option value="" disabled selected>-Select Interest Type-</option>';
				$intTypes = $dbio->listInterest_type();
				foreach ($intTypes as &$intType)
				{
                                    $interestType = $intType->getTitle();
                                    $interestType_id = $intType->getId();
                                    echo "<option value = '{$interestType_id}' name = '{$interestType}'>{$interestType}</option>";
				}
		echo "</select>";
		echo "Title: <input type='text' name='title'><br>";
		echo "Description: <input type='text' name='description'>";
		echo "<input type='submit' name='weOnTheMoon' value='Submit'>";
	echo "</form>";
	if (isset($_POST['weOnTheMoon']))
	{
                $newInterest->setType($_POST['interestTypeName']);
		$newInterest->setTitle($_POST['title']);
		$newInterest->setDescription($_POST['description']);
		if (empty($newInterest->getType()) || empty($newInterest->getTitle()))
			{
                            echo "Required field missing";
			}
			else
			{
                            createInterest($newInterest);
			}
	}
}



if($_GET['act'] == "createInterestType")
{
    $newInterestType = new Interest_type;
    echo "<form action='' method='post'>";
            echo "Title: <input type='text' name='title'><br>";
            echo "Description: <input type='text' name='description'>";
            echo "<input type='submit' name='weOnTheMoon' value='Submit'>";
    echo "</form>";
    if (isset($_POST['weOnTheMoon']))
    {
        if (isset($_POST['title']) && isset($_POST['description']))
        {
                $newInterestType->setTitle($_POST['title']);
                $newInterestType->setDescription($_POST['description']);
                if (empty($newInterestType->getTitle()))
                {
                    echo "Required field missing";
                }
                else
                {
                    createInterest_type($newInterestType);
                }
        }
    }
}
?>
