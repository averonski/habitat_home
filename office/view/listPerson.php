<center><input type="button"  class="btn btn-primary btn-sm" onclick="history.back();" value="Back"></center>

<script type="text/javascript">
	function retrieve(n) {
		document.getElementById("pid").value=n;
		document.getElementById("viewPersonsForm").submit();
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
<h2>View Persons</h2>
<br><br>
<form id="viewPersonsForm" action="index.php" method="GET">
<input name="dir" id="dir" type="hidden" value="<?php echo $dir; ?>" >
<input name="sub" id="sub" type="hidden" value="<?php echo $sub; ?>" >
<input name="act" id="act" type="hidden" value="read" >
<input name="pid" id="pid" type="hidden" value="0">
<?php 
	$persons = $tableinfo;
            echo '<table class="table table-striped table-hover " style="width:100%"><tr><th>Title</th><th>First Name</th><th>Last Name</th><th>DOB</th><th>Phone</th><th>Street 1</th><th>Street 2</th><th>State</th><th>City</th><th>Zip</th><!--<th>Friends From</th>--></tr>';
                    foreach ($persons as $person) {
                        echo '<tr onclick="retrieve(' . $person->getId() . ');">';
                            echo '<td>' . $person->getTitle() . '</td>';
                            echo '<td>' . $person->getFirst_name() . '</td>';
                            echo '<td>' . $person->getLast_name() . '</td>';
                            echo '<td>' . $person->getDob() . '</td>';
                            echo '<td>' . $person->getContact()->getPhone() . '</td>';
                            echo '<td>' . $person->getContact()->getAddress()->getStreet1() . '</td>';
                            echo '<td>' . $person->getContact()->getAddress()->getStreet2() . '</td>';
                            echo '<td>' . $person->getContact()->getAddress()->getState()->getTitle() . '</td>';
                            echo '<td>' . $person->getContact()->getAddress()->getCity() . '</td>';
                            echo '<td>' . $person->getContact()->getAddress()->getZip() . '</td>';
                    }
                        echo '</tr>';		
            echo '</table>';
?>
<!--results can be listed here, pushing text down.-->




<!-- end-->

