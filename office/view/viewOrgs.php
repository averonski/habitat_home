


<center><input type="button"  class="btn btn-primary btn-sm" onclick="history.back();" value="Back"></center>

<script type="text/javascript">
	function retrieve(n) {
		document.getElementById("oid").value=n;
		document.getElementById("viewOrgsForm").submit();
			}
</script>
<style>
#alignment
{
position:relative;
float:left;
width:100%;
}
</style>
<div id="alignment">
<h2>View Organizations</h2>
<br>
<form id="viewOrgsForm" action="index.php" method="GET">
<input name="dir" id="dir" type="hidden" value="<?php echo $dir; ?>" >
<input name="sub" id="sub" type="hidden" value="<?php echo $sub; ?>" >
<input name="act" id="act" type="hidden" value="edit" >
<input name="oid" id="oid" type="hidden" value="0">
<?php 
	$orgs = $tableinfo;
        //print_r($orgs[0]);
	//$contacts = $tableinfo[1];
	//$addresses = array();
//	foreach ($contacts as $contact) {
//		$address = $contact->getAddress();
//		$addresses[] = $address;
//	}

	echo '<table class="table table-striped table-hover " style="width:100%"><tr><th>Organization</th><th>Street 1</th><th>Street 2</th><th>City</th><th>State</th><th>Zip</th><th>Email</th><th>Phone</th><th>Phone 2</th><th>Ext</th></tr>';
		
		$length = count($orgs);
		for ($i = 0; $i < $length; $i++) {
			echo '<tr onclick="retrieve(' . $orgs[$i]->getId() . ');">';
			echo '<td>' . $orgs[$i]->getName() . '</td>';
			echo '<td>' . $orgs[$i]->getAddress()->getStreet1() . '</td>';
			echo '<td>' . $orgs[$i]->getAddress()->getStreet2() . '</td>';
			echo '<td>' . $orgs[$i]->getAddress()->getCity() . '</td>';
			echo '<td>' . $orgs[$i]->getAddress()->getState()->getTitle() . '</td>';
			echo '<td>' . $orgs[$i]->getAddress()->getZip() . '</td>';
			//echo '<td>' . $orgs[$i]->getContact()->getEmail()->getEmail() . '</td>';
			//echo '<td>' . $orgs[$i]->getContact()->getPhone() . '</td>';
			//echo '<td>' . $orgs[$i]->getContact()->getPhone2() . '</td>';
			//echo '<td>' . $contacts[$i]->getExtension() . '</td>';
			echo '</tr>';		
		}
			
		
		echo '</table>';
?>
</form>
</div>
<!--results can be listed here, pushing text down.-->




<!-- end-->
