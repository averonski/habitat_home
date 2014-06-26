<?php

// TITLE: account personal info view
// FILE: login/view/checkEmail.php
// AUTHOR: 

global $act;
global $msg;

?>

<html>
<body>
<!--submits email to server-->
<form>
	<input name="act" type="hidden" value="<?php echo $act; ?>" >
	Email id: <input type="text" name="email">
	<input type="submit" name="submit">

</body>
</html>
