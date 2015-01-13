<?php

    $account = edit();
    //print_r($account);

    //sets account info
    $uname = $account->getEmail()->getEmail();
    $title = $account->getPerson()->getTitle();
    $fName = $account->getPerson()->getFirst_name();
    $lName = $account->getPerson()->getLast_name();
    $dob = $account->getPerson()->getDob();
    $street1 = $account->getPerson()->getContact()->getAddress()->getStreet1();
    $street2 = $account->getPerson()->getContact()->getAddress()->getStreet2();
    $city = $account->getPerson()->getContact()->getAddress()->getCity();
    $state = $account->getPerson()->getContact()->getAddress()->getState()->getTitle();
    $zip = $account->getPerson()->getContact()->getAddress()->getZip();
    $phone = $account->getPerson()->getContact()->getPhone();
    //$employer = 'abc company';
    $workPhone = $account->getPerson()->getContact()->getPhone2();
    //$workExt = $account->getPerson()->getContact()->getExtension();
    //$jobTitle = 'engineer';

    if($updated)
		echo '<div class="alert alert-dismissable alert-success"><button type="button" class="close" data-dismiss="alert">×</button><strong>UPDATED</strong> You successfully updated the information.</div>';
?>

<hr>
<form action="index.php" method="GET" class="form-horizontal">
    <input name="dir" type="hidden" value="<?php echo $dir; ?>" >
    <input name="sub" type="hidden" value="<?php echo $sub; ?>" >
    <input name="pid" type="hidden" value="<?php echo $_SESSION['personid']; ?>" >
    <input name="act" type="hidden" value="update" >
    <fieldset>
    <legend>Account Info</legend>
	<div class="form-group">
      <label for="inputTitle" class="col-lg-2 control-label">Title</label>
      <div class="col-lg-10">
        <select name="title" type="text">
		    <option value="Mr" selected="selected">Mr.</option>;
		    <option value="Mrs">Mrs.</option>;
		    <option value="Ms">Ms.</option>;
		    <option value="Dr">Dr.</option>;
		    <span class="required">*</span>
		</select>
      </div>
    </div>
    <div class="form-group">
      <label for="inputuName" class="col-lg-2 control-label">Username :</label>
      <div class="col-lg-10">
        <input name="uName" type="text" placeholder="username" value="<?php echo $uname; ?>" >
		<span class="required">*</span>
      </div>
    </div>
	<div class="form-group">
      <label for="inputfName" class="col-lg-2 control-label">First Name :</label>
      <div class="col-lg-10">
        <input name="fName" type="text" placeholder="first name" value="<?php echo $fName; ?>" >
		<span class="required">*</span>
      </div>
    </div>
		<div class="form-group">
      <label for="inputlName" class="col-lg-2 control-label">Last Name :</label>
      <div class="col-lg-10">
        <input name="lName" type="text" placeholder="last name" value="<?php echo $lName; ?>"  >
		<span class="required">*</span>
      </div>
    </div>
    <div class="form-group">
      <label for="inputdob" class="col-lg-2 control-label">DOB :</label>
      <div class="col-lg-10">
        <input name="dob" type="text" placeholder="Date of Birth" value="<?php echo $dob; ?>"  >
    <span class="required">*</span>
      </div>
    </div>
    <div class="form-group">
      <label for="inputstreet1" class="col-lg-2 control-label">Street :</label>
      <div class="col-lg-10">
        <input name="street1" type="text" placeholder="street 1" value="<?php echo $street1; ?>" >
		<span class="required">*</span>
      </div>
    </div>
    <div class="form-group">
      <label for="inputstreet2" class="col-lg-2 control-label">Apt/Suit :</label>
      <div class="col-lg-10">
        <input name="street2" type="text" placeholder="street 2" value="<?php echo $street2; ?>" >
      </div>
    </div>
    <div class="form-group">
      <label for="inputcity" class="col-lg-2 control-label">City :</label>
      <div class="col-lg-10">
        <input name="city" type="text" placeholder="city" value="<?php echo $city; ?>" >
		<span class="required">*</span>
      </div>
    </div>
    <div class="form-group">
      <label for="inputState" class="col-lg-2 control-label">State :</label>
      <div class="col-lg-10">
        <select name="state">
		    <option value="20">MD</option>
		    <option value="38" selected="selected">PA</option>
		    <option value="43">TX</option>
		</select>
		<span class="required">*</span>
      </div>
    </div>
    <div class="form-group">
      <label for="inputzip" class="col-lg-2 control-label">Zip :</label>
      <div class="col-lg-10">
        <input name="zip" type="text" placeholder="zip" value="<?php echo $zip; ?>" >
    <span class="required">*</span></label>
      </div>
    </div>
    <div class="form-group">
      <label for="inputphone" class="col-lg-2 control-label">Phone :</label>
      <div class="col-lg-10">
        <input name="phone" type="text" placeholder="phone" value="<?php echo $phone; ?>" >
		<span class="required">*</span></label>
      </div>
    </div>
<!--		<div class="form-group">
      <label for="inputemail" class="col-lg-2 control-label">Email :</label>
      <div class="col-lg-10">
        <input name="email" type="text" placeholder="email" value="<?php //echo $uname; ?>" >
		<span class="required">*</span>
      </div>-->
    </div>
    <div class="form-group">
      <label for="inputemployer" class="col-lg-2 control-label">Employer :</label>
      <div class="col-lg-10">
       <input name="employer" type="text" placeholder="employer" value="<?php echo $employer; ?>" >
      </div>
    </div>
    <div class="form-group">
      <label for="inputworkPhone" class="col-lg-2 control-label">Work Phone :</label>
      <div class="col-lg-10">
      	<input name="workPhone" type="text" placeholder="work phone" value="<?php echo $workPhone; ?>" >
      </div>
    </div>
    <div class="form-group">
      <label for="inputworkExt" class="col-lg-2 control-label">Extension :</label>
      <div class="col-lg-10">
       <input name="workExt" type="text" placeholder="ext" value="<?php echo $workExt; ?>" >
		<span class="required">*</span>
      </div>
    </div>
    <div class="form-group">
      <label for="inputjobTitle" class="col-lg-2 control-label">Job Title :</label>
      <div class="col-lg-10">
       <input name="jobTitle" type="text" placeholder="job title" value="<?php echo $jobTitle; ?>" >
		<span class="required">*</span>
      </div>
    </div>
    <input type="submit" value="Update">
</form>
<hr>
