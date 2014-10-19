<?php

    // FILE: Volunteer Interest View
    // AUTHOR: des301
	// Modified by: bmw5285 //very slightly

    global $dir;
    global $sub;
    global $act;
    global $msg;
    global $dbio;
    $pid = $_SESSION['personid'];
    //print_r($pid);

    $columnCount = 3;

    $interestTypes = $dbio->listInterest_type();
    $volId = $dbio->readVolunteerByPid($pid);
    $volInterestedIn = $dbio->readInterested_in($volId->getId());
    print_r($volInterestedIn[1]->getInterest()[0]->getId());
    //$interests = $dbio->readInterest($volInterestedIn->getInterest());
    //print_r($interests);

    if(isset($updated))
		echo '<div class="alert alert-dismissable alert-success"><button type="button" class="close" data-dismiss="alert">×</button><strong>UPDATED</strong> You successfully updated the information.</div>';
?>
    <h2>Your Volunteer Interests</h2>
    <hr>
    <button onclick="swapAll('show');">Show All</button>
    <button onclick="swapAll('hide');">Hide All</button>
    <br>

    <form action="index.php" method="GET">
	<input name="dir" type="hidden" value="<?php echo $dir; ?>">
	<input name="sub" type="hidden" value="<?php echo $sub; ?>">
	<input name="act" type="hidden" value="updateInterests">
<?php		
    foreach ($interestTypes as $it) {

	echo '<h4 class="show" onclick="swap(this);">' .  $it->getTitle() . '</h4>';
	echo '<div>';

	$typeInts = array();
	foreach ($volInterestedIn as $int) {
	    if ($int->getInterest()[0]->getId() == $it->getId()) {
		$typeInts[] = $int;
                //print_r($typeInts);
	    }
	}

	$numCol = floor(sizeof($typeInts) / $columnCount);
	$remainder = sizeof($typeInts) % $columnCount;
	
	echo '<table class="intTable">';

	for ($i = 0; $i < $numCol; $i++) {			

	    echo '<tr>';

	    for ($j = 0; $j < $columnCount; $j++) {
		$n = $columnCount * $i + $j;
		$id = $typeInts[$n]->getInterest()[0]->getId();
		$title = $typeInts[$n]->getInterest()[0]->getTitle();
		$checked = ($typeInts[$n]->getInterest()[0]->getTitle()) ? 'checked="checked"' : '';
		echo '<td><input type="checkbox" name="interestVol[]" value="' . $id . '" ' . $checked . ' /><label>' . $title . '</label></td>';
	    }// end for

	    echo '</tr>';

	}// end for

	echo '<tr>';

	$max = sizeof($typeInts);

	for ($i = $max - $remainder; $i < $max; $i++) {

	    $id = $typeInts[$i]->getInterest()[0]->getId();
	    $title = $typeInts[$i]->getInterest()[0]->getTitle();
	    $checked = ($typeInts[$i]->getInterest()[0]->getTitle()) ? 'checked="checked"' : '';

	    echo '<td><input type="checkbox" name="interestVol[]" value="' . $id . '" ' . $checked . ' /><label>' . $title . '</label></td>';

	}// end for

	for ($i = 0; $i < ($columnCount - $remainder); $i++) {echo '<td></td>';}
	echo '</tr></table></div>';

    }// end foreach
    
?>
	<!--
    <br>
    <button onclick="swapAll('show');">Show All</button>
    <button onclick="swapAll('hide');">Hide All</button><br>
 -->
    <br>
    <input type="submit" value="Update">
</form>
<hr>
<h5>
    Check the box next to the type of work you are interested in performing for Habitat York
</h5>
