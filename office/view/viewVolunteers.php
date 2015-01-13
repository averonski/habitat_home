


<center><input type="button"  class="btn btn-primary btn-sm" onclick="history.back();" value="Back"></center>

<script type="text/javascript">
	function retrieve(n) {
		document.getElementById("pid").value=n;
		document.getElementById("viewVolunteerForm").submit();
			}
</script>

<br><br>
<form id="viewVolunteerForm" action="index.php" method="GET">
<input name="dir" id="dir" type="hidden" value="<?php echo $dir; ?>" >
<input name="sub" id="sub" type="hidden" value="<?php echo $sub; ?>" >
<input name="act" id="act" type="hidden" value="read" >
<input name="pid" id="pid" type="hidden" value="0">
<?php 
	$volunteers = $tableinfo;
	echo '<table class="table table-striped table-hover " style="width:100%"><tr><th>Title</th><th>First Name</th><th>Last Name</th><th>Phone</th><th>Street 1</th><th>Address 2</th><th>City</th><th>State</th><th>Zip</th><th>Email</th></tr>';
	 foreach  ($volunteers as $volunteer) {

                            $person_id = $volunteer->getId();
                            $title = $volunteer->getTitle();
                            $first_name = $volunteer->getFirst_name();
                            $last_name = $volunteer->getLast_name();
                            $dob = $volunteer->getDob();
                            $contact = $volunteer->getContact();
                            
                                $phone = $volunteer->getContact()->getPhone();
                                $email = $volunteer->getContact()->getEmail()->getEmail();
                                $phone2 = $volunteer->getContact()->getPhone2();
                                //$extension = $volunteer->getContact()->getExtension();
                            
                                    $address_id = $volunteer->getContact()->getAddress()->getId();
                                    $street1 = $volunteer->getContact()->getAddress()->getStreet1();
                                    $street2 = $volunteer->getContact()->getAddress()->getStreet2();
                                    $city = $volunteer->getContact()->getAddress()->getCity();
                                    $state = $volunteer->getContact()->getAddress()->getState()->getTitle();
                                    $zip = $volunteer->getContact()->getAddress()->getZip();

				echo '<tr onclick="retrieve(' . $person_id . ');">'; 
				
				echo '<td>' . $title .'</td>';
                                echo '<td>' . $first_name .'</td>';
                                echo '<td>' . $last_name .'</td>';
				echo '<td class="right">' . $phone . '</td>';
				echo '<td class="right">' . $street1 . '</td>';
                                echo '<td class="right">' . $street2 . '</td>';
                                echo '<td class="right">' . $city . '</td>';
                                echo '<td class="right">' . $state . '</td>';
                                echo '<td class="right">' . $zip . '</td>';
				echo '<td>' . $email . '</td>';
							
				echo '</tr>';
			}
		echo '</table>';
?>
</form>
<!--results can be listed here, pushing text down.-->




<!-- end-->
