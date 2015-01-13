<?php

// TITLE: Office Accounts View
// FILE: office/view/events.php
// AUTHOR: sbkedia

?>
<style> /* css */ 

input[type=submit], #searchBy 
{
width: 150px;
height: 40px;
}

select
{
alignment: center;
}

#searchBy
{
alignment: bottom;
}
#eventType
{
font-size:15px;
height:35px;
}

</style>

<h2> Events Search </h2>
<hr>
<br>

<!-- View All button -->
<form name="input" action="index.php" method="get">
	<input name="dir" type="hidden" value="<?php echo $dir; ?>" >
	<input name="sub" type="hidden" value="<?php echo $sub; ?>" >
	<input name="act" type="hidden" value="read" >
	<input type="submit" value="View All">
</form>

<br>

<!-- Create New Event button -->
<form name="input" action="index.php" method="get"> 
	<input name="dir" type="hidden" value="<?php echo $dir; ?>" >
	<input name="sub" type="hidden" value="<?php echo $sub; ?>" >
	<input name="act" type="hidden" value="create" >
	<input type="submit" value="Create New">
</form>

<br>

<!-- Search by, drop down menu of event types -->
<form name='search' action="index.php" method="get"> 
   <input type="hidden" name="dir" value="<?php echo $dir; ?>">
   <input type="hidden" name="sub" value="<?php echo $sub; ?>">
   <input type="hidden" name="act" value="search">
   <input type="submit" name="searchBy" id="searchBy" value="Search Event Type" method="get">

	<select id="eventType" name="eventType" method="get">
		
		 <?php
		 $Event_type = readEvent_Types(); 
                 print_r($Event_type);
		 foreach ($Event_type as $EventTypeItem){ ?>
			<option value= <?php echo $EventTypeItem->getId(); ?> > <?php echo $EventTypeItem->getTitle() ?> </option>		
		<?php }// end foreach ?>

	</select>

</form>

<br><br> 


<!--<span class="notes">
<ul>
<li>View All Events will display all Events</li> 
<li>Search Events will search all events limiting the search by type</li> 
<li>Create Event will allow you to create new Events</li>
</ul>
</span>-->
<h5>
Here is where you will be able to search for an event and make changes, such as
<br><br>1. Edit Event Information
<br>2. Search Events
<br>3. Create Event
</h5>

