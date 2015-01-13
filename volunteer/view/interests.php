<?php

    // FILE: Volunteer Interest View
    // AUTHOR: des301
    // Modified by: bmw5285
    //shows volunteers current interests and updates them;; currently broken

    global $dir;
    global $sub;
    global $act;
    global $msg;
    global $dbio;
    $pid = $_SESSION['personid'];

    $columnCount = 3;
    
    //variables
    $interests = $dbio->listInterest();
    $interestTypes = $dbio->listInterest_type();
    $volunteer = $dbio->readVolunteerByPid($pid);
    $volInterestedIn = $dbio->readInterested_in_by_volunteer($volunteer->getId());
    $interestsChunked = array_chunk($interests, 3);
 
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
    //creates tables with interests
    foreach ($interestTypes as $it) {
	echo '<h4 class="show" onclick="swap(this);">' .  $it->getTitle() . '</h4>';
            echo '<div>';
                echo '<table class="intTable">';
                foreach ($interestsChunked as $row) {
                    echo '<tr>';
                        foreach ($row as $interest) {
                            if ($interest->getType()->getId() == $it->getId()) {
                                $id = $interest->getId();
                                $title = $interest->getTitle();
                                $i=0;
                                $j=0;
                                foreach ($volInterestedIn as $vii) {
                                    if ($vii->getInterest()->getId() == $interest->getId()) {
                                        echo "<td><input type='checkbox' name='interestVol[]' value='{$id}' checked='checked'/><label>{$title}</label></td>";
                                        $j = $vii->getInterest()->getId();
                                    } elseif(!($i>=1) && $j != $interest->getId()) {
                                        echo "<td><input type='checkbox' name='interestVol[]' value='{$id}'/><label>{$title}</label></td>";
                                        $i++;
                                    } 
                                }
                            }
                        }
                    echo '</tr>';
                }
                echo '</table>';
            echo '</div>';
    }
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
<span class="note">
    Check the box next to the type of work you are interested in performing for Habitat York
</span>
