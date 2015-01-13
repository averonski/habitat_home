<?php
/* 
 * file: createVolunteer.php
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * Author: 
 */
 
 //variables
 
        global $dir;
        global $sub;
        global $act;
        global $msg;
        
        $vid = filter_input(INPUT_GET, 'vid', FILTER_SANITIZE_STRING);
        
        $volunteer = $dbio->readVolunteer($vid);

        $title = $volunteer->getPerson()->getTitle(); 
        $first_name = $volunteer->getPerson()->getFirst_name();
        $last_name = $volunteer->getPerson()->getLast_name();
        $dob = $volunteer->getPerson()->getDob();
        $contact = $volunteer->getPerson()->getContact();
                                                
        $phone = $volunteer->getPerson()->getContact()->getPhone();
        $email = $volunteer->getPerson()->getContact()->getEmail()->getEmail();
        $phone2 = $volunteer->getPerson()->getContact()->getPhone2();
        //$extension = $volunteer->getPerson()->getContact()->getExtension();
                          
        $address_id = $volunteer->getPerson()->getContact()->getAddress()->getId();
        $street1 = $volunteer->getPerson()->getContact()->getAddress()->getStreet1();
        $street2 = $volunteer->getPerson()->getContact()->getAddress()->getStreet2();
        $city = $volunteer->getPerson()->getContact()->getAddress()->getCity();
        $state = $volunteer->getPerson()->getContact()->getAddress()->getState()->getTitle();
        $zip = $volunteer->getPerson()->getContact()->getAddress()->getZip();
            
            if($updated){
		echo '<div class="alert alert-dismissable alert-success"><button type="button" class="close" data-dismiss="alert">×</button><strong>UPDATED</strong> You successfully updated the information.</div>';
            }
        
?>


<html>

    <body>		
		<!-- start Form -->

    <form action="index.php" method="GET">
    <input name="dir" type="hidden" value="<?php echo $dir; ?>" >
    <input name="sub" type="hidden" value="<?php echo $sub; ?>" >
    <input name="vid" type="hidden" value="<?php echo $_SESSION['personid']; ?>" >
    <input name="act" type="hidden" value="update" >

		
		
	
	<h4 class="show" onclick="swap(this);">Personal Information</h4><div>
               <table class="intTable">
                  
                <tr><td>
		Title<span class="mandatory">* </span></td> 
                    <td><input name="title" id="title" value ="<?php echo $title; ?>"></label>
		<!-- <option></option>
  		<option>Mr.</option>
  		<option>Mrs.</option>
  		<option>Ms.</option>
  		<option>Dr.</option>
                    </select> -->
                    </td><tr><br> 
                   
		<tr><td>First Name<span class="mandatory">* </span></td><td> <input name="first_name" type="text" id="first_name" value="<?php echo $first_name; ?>" ></label>
		</td></tr>
		<tr><td>Last Name<span class="mandatory">* </span></td><td> <input name="last_name" type="text" id="last_name" value="<?php echo $last_name; ?>"></label></td></tr>
                <tr><td>D.O.B.<span class="mandatory">*</span> </td><td><input name="dob" type="text" id="dob" value="<?php echo $dob; ?>"></label></td></tr>
               </table></div>
        <br/>
              <h4 class="show" onclick="swap(this);">Contact Information</h4><div>
               <table class="intTable">
		<tr><td>Phone<span class="mandatory">*</span></td><td> <input name="phone" type="text" id="phone" value="<?php echo $phone; ?>"></label></td></tr><br>
		<tr><td>Phone2<span class="mandatory">*</span></td><td> <input name="phone2" type="text" id="phone2" value="<?php echo $phone2; ?>"></label></td></tr><br>
                <!--<tr><td>Extension<span class="mandatory">*</span></td><td> <input name="extension" type="text" id="extension" value="<?php// echo $extension; ?>"></label></td></tr><br>-->
		<tr><td>Email<span class="mandatory">*</span> </td><td><input name="email" type="text" id="email" value="<?php echo $email; ?>"></label></td></tr>
                
               </table></div>
        <br/>
	     <h4 class="show" onclick="swap(this);">Address</h4><div>
               <table class="intTable">
		<tr><td>Street 1<span class="mandatory">*</span></td><td> <input name="street1" type="text" id="street1" value="<?php echo $street1; ?>"></td></tr><br>
		<tr><td>Street 2</td><td><input name="street2" type="text" id="street2" value="<?php echo $street2; ?>"></label></td></tr>
		<tr><td>City<span class="mandatory">*</span> </td><td><input name="city" type="text" id="city" value="<?php echo $city; ?>"></label></td></tr>
		<tr><td>State<span class="mandatory">*</span> </td><td><input name="state" type="text" id="state" value="<?php echo $state; ?>"></label></td></tr>
		<tr><td>Zip<span class="mandatory">*</span> </td><td><input name="zip" type="text" id="zip" value="<?php echo $zip; ?>"></label></td></tr> 
               </table></div>

		
		
		<br>
		
		<!-- form validation -->
		
		<script type="text/javascript">

            function check()
            {
            	if (document.getElementById('title').value==""
                 || document.getElementById('title').value==undefined)
                {
                    alert ("Please Select your 'Title'");
                    return false;
                }

                else if (document.getElementById('fname').value==""
                 || document.getElementById('fname').value==undefined)
                {
                    alert ("Please Enter your 'First Name'");
                    return false;
                }

                else if(document.getElementById('lname').value==""
                	||document.getElementById('lname').value==undefined)
                {
                	alert("Please Enter your 'Last Name'");
                	return false;
                }

                else if(document.getElementById('dob').value==""
                	||document.getElementById('dob').value==undefined)
                {
                	alert("Please Enter your 'Date of Birth'");
                	return false;
                }

                else if(document.getElementById('gender').value==""
                	||document.getElementById('gender').value==undefined)
                {
                	alert("Please Select your 'Gender'");
                	return false;
                }

                else if(document.getElementById('street1').value==""
                	||document.getElementById('street1').value==undefined)
                {
                	alert("Please Enter your 'street 1' Address");
                	return false;
                }

                else if(document.getElementById('city').value==""
                	||document.getElementById('city').value==undefined)
                {
                	alert("Please Enter the 'City'");
                	return false;
                }

                else if(document.getElementById('state').value==""
                	||document.getElementById('state').value==undefined)
                {
                	alert("Please Enter the 'State'");
                	return false;
                }

                else if(document.getElementById('zip').value==""
                	||document.getElementById('zip').value==undefined)
                {
                	alert("Please Enter the 'Zip' code");
                	return false;
                }

                else if(document.getElementById('phone').value==""
                	||document.getElementById('phone').value==undefined)
                {
                	alert("Please Enter your 'Phone' number");
                	return false;
                }

                else if(document.getElementById('email').value==""
                	||document.getElementById('email').value==undefined)
                {
                	alert("Please Enter your 'Email' address");
                	return false;
                }

                else if(document.getElementById('emergencyname').value==""
                    ||document.getElementById('emergencyname').value==undefined)
                {
                    alert("Please Enter the 'Emergency Contact's Name address");
                    return false;
                }

                else if(document.getElementById('emergencyphone').value==""
                    ||document.getElementById('emergencyphone').value==undefined)
                {
                    alert("Please Enter the 'Emergency Contact's Phone'");
                    return false;
                }
  


                return true;
            }

        </script>
        
		<input type="submit" value="update">

		<br>
	</form>
	
	<!-- end form -->
	
	<br>
	<hr>
	<span class="note"><span class="mandatory">*</span> Required<br>
	Email address is essential in order to receive monthly updates and special invitations
	</span>
    </body>   
</html>
