<?php

// TITLE: account contact info view
// FILE: account/view/prefs.php
// AUTHOR: 
// view and update contact preferences

// gets a person's id from session, and gets the preferential contact preferences
$pid = $_SESSION['personid'];

// checkes for update vairable
if($update)
	echo '<div class="alert alert-dismissable alert-success"><button type="button" class="close" data-dismiss="alert">×</button><strong>UPDATED</strong> You successfully updated the information.</div>';
	
?>
<!--html-->
<!--this info is missing from the database. It may need to be added-->
<h2>Preferences</h2>

<hr>
<br>
<!-- input to view and update contact preferences -->
<form action="index.php" method="GET">
	<input name="dir" type="hidden" value="<?php echo $dir; ?>" >
	<input name="sub" type="hidden" value="<?php echo $sub; ?>" >
	<input name="act" type="hidden" value="update" >
	<input name="pid" type="hidden" value="<?php echo $pid; ?>" >
<!--	<dl>
	    <dt>Receive Email?</dt>
		<dd><input type="radio" name="mail"id="yes" value="1" <?php echo $email ? 'checked' : ''; ?>><label>Yes</label></dd>
		<dd><input type="radio" name="mail"id="no" value="0" <?php echo !$email ? 'checked' : ''; ?>><label>No</label></dd>
	    <dt>Receive Mail?</dt>
		<dd><input type="radio" name="email"id="yes" value="1" <?php echo $mail ? 'checked' : ''; ?>><label>Yes</label></dd>
		<dd><input type="radio" name="email"id="no" value="0" <?php echo !$mail ? 'checked' : ''; ?>><label>No</label></dd>
	    <dt>Receive Calls?</dt>
		<dd><input type="radio" name="calls"id="yes" value="1" <?php echo $phone ? 'checked' : ''; ?>><label>Yes</label></dd>
		<dd><input type="radio" name="calls"id="no" value="0" <?php echo !$phone ? 'checked' : ''; ?>><label>No</label></dd>
	</dl>-->
	<input type="submit" value="Update">
</form>
<hr>
<h5>
 Update your preferred methods of contact for Habitat for Humanity
</h5>
<!--<span class="note">
    Update your contact preferences here. <br>
    Email may still be used in case you forget your password and start an account recovery.
</span> -->
