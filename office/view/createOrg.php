<?php

    if($updated)
		echo '<div class="alert alert-dismissable alert-success"><button type="button" class="close" data-dismiss="alert">×</button><strong>UPDATED</strong> You successfully created an organization.</div>';
?>
<center><input type="button"  class="btn btn-primary btn-sm" onclick="history.back();" value="Back"></center>
<hr>
<form action="index.php" method="GET" class="form-horizontal">
    <input name="dir" type="hidden" value="<?php echo $dir; ?>" >
    <input name="sub" type="hidden" value="<?php echo $sub; ?>" >
    <input name="act" type="hidden" value="confirmCreate" >
    <fieldset>
    <legend> Create Organization</legend>
	<div class="form-group">
  <label for="inputname" class="col-lg-2 control-label">Organization Name :</label>
      <div class="col-lg-10">
        <input name="orgname" type="text" placeholder="name"  >
    <span class="required">*</span>
      </div>
    </div>
    <div class="form-group">
      <label for="inputstreet1" class="col-lg-2 control-label">Street :</label>
      <div class="col-lg-10">
        <input name="street1" type="text" placeholder="street 1"  >
		<span class="required">*</span>
      </div>
    </div>
    <div class="form-group">
      <label for="inputstreet2" class="col-lg-2 control-label">Apt/Suit :</label>
      <div class="col-lg-10">
        <input name="street2" type="text" placeholder="street 2"  >
      </div>
    </div>
    <div class="form-group">
      <label for="inputcity" class="col-lg-2 control-label">City :</label>
      <div class="col-lg-10">
        <input name="city" type="text" placeholder="city"  >
		<span class="required">*</span>
      </div>
    </div>
    <div class="form-group">
      <label for="inputState" class="col-lg-2 control-label">State :</label>
      <div class="col-lg-10">
        <select name="state">
            <?php
                $states = listState();
                foreach($states as $state) {
                    ?>
                        <option name = "<?php echo $state->getTitle() ?>" value = "<?php echo $state->getId() ?>"> <?php echo $state->getTitle() ?> </option>
                    <?php
                }
            ?>
        </select>
		<span class="required">*</span>
      </div>
    </div>
     <div class="form-group">
      <label for="inputzip" class="col-lg-2 control-label">Zip :</label>
      <div class="col-lg-10">
        <input name="zip" type="text" placeholder="zip" >
    <span class="required">*</span></label>
      </div>
    </div>
    <!-- <div class="form-group">
      <label for="inputphone" class="col-lg-2 control-label">Phone :</label>
      <div class="col-lg-10">
        <input name="phone" type="text" placeholder="phone"  >
		<span class="required">*</span></label>
      </div>
    </div>
		<div class="form-group">
      <label for="inputemail" class="col-lg-2 control-label">Email :</label>
      <div class="col-lg-10">
        <input name="email" type="text" placeholder="email"  >
		<span class="required">*</span>
      </div>
    </div>
    <div class="form-group">
      <label for="inputworkPhone" class="col-lg-2 control-label">Work Phone :</label>
      <div class="col-lg-10">
      	<input name="workPhone" type="text" placeholder="work phone"  >
      </div>
    </div>
    <div class="form-group">
      <label for="inputworkExt" class="col-lg-2 control-label">Extension :</label>
      <div class="col-lg-10">
       <input name="workExt" type="text" placeholder="ext"  >
		<span class="required">*</span>
      </div> 
    </div> -->
    
    <input type="submit" value="Create">
</form>
<hr>
