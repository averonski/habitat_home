<center><input type="button"  class="btn btn-primary btn-sm" onclick="history.back();" value="Back"></center>

<script type="text/javascript">
	function retrieve(n) {
		document.getElementById("accid").value=n;
		document.getElementById("viewAccountForm").submit();
			}
</script>

<br><br>
<form id="viewAccountForm" action="index.php" method="GET">
<input name="dir" id="dir" type="hidden" value="<?php echo $dir; ?>" >
<input name="sub" id="sub" type="hidden" value="<?php echo $sub; ?>" >
<input name="act" id="act" type="hidden" value="viewAccount" >
<input name="accid" id="accid" type="hidden" value="0">
<?php 
	$accounts = search();

	echo '<table class="table table-striped table-hover " style="width:100%"><tr><th>Username </th><th>Title</th><th>First Name</th><th>Last Name</th><th>DOB</th><th>Phone</th><th>Street 1</th><th>Street 2</th><th>City</th><th>State</th><th>Zip</th></tr>';
	
	foreach ($accounts as $account) {
            
            if (empty($dbio->readAdminByPid($account->getPerson()->getId())->getId())) {
                
		echo '<tr onclick="retrieve(' . $account->getId() . ');">';
                    echo '<td>' . $account->getEmail()->getEmail() . '</td>';
                    echo '<td>' . $account->getPerson()->getTitle() . '</td>';
                    echo '<td>' . $account->getPerson()->getFirst_name() . '</td>';
                    echo '<td>' . $account->getPerson()->getLast_name() . '</td>';
                    echo '<td>' . $account->getPerson()->getDob() . '</td>';
                    echo '<td>' . $account->getPerson()->getContact()->getPhone() . '</td>';
                    echo '<td>' . $account->getPerson()->getContact()->getAddress()->getStreet1() . '</td>';
                    echo '<td>' . $account->getPerson()->getContact()->getAddress()->getStreet2() . '</td>';
                    echo '<td>' . $account->getPerson()->getContact()->getAddress()->getState()->getTitle() . '</td>';
                    echo '<td>' . $account->getPerson()->getContact()->getAddress()->getCity() . '</td>';
                    echo '<td>' . $account->getPerson()->getContact()->getAddress()->getZip() . '</td>';
                
            }
                echo '</tr>';
	}
        echo '</table>';
?>
</form>
<!--results can be listed here, pushing text down.-->