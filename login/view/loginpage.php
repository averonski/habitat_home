<?php

// TITLE: login page view
// FILE: login/view/loginpage.php
// AUTHOR: 

global $act;
global $sub;
global $dir;
global $msg;

$act='loginCheck';

?>
 <!--script checks if both username and password have been entered-->
<script type="text/javascript">
		//checks if username or password is blank or undefined; if either is it prompts for info enrty; else submits the data
		function verify()
        	{
            		if (document.getElementById('userName').value=="" || document.getElementById('userName').value==undefined)
                	{
                    		alert ("Please Enter your 'User Id'");
                    		//return false;
                	}

               		else if (document.getElementById('password').value=="" || document.getElementById('password').value==undefined)
               		{
                    		alert ("Please Enter your 'Password'");
                    		//return false;
               		}
               else
               {
                	document.getElementById('loginUser').submit();
               }

            }
</script>

<!--login page. has form for username and password, registering, and forgot password-->
	<div class="body">
	<img src="img/habitat_logo.jpg" alt="Habitat for Humanity Logo" height="198px" width="600px" />

	
	<div id="loginBox">
	    <!--form for submitting username and password, going to registration, and recovering passwords-->
	    
            <form id="loginUser" name="loginUser" action="index.php" method="get">
	    
	    <input name="dir" type="hidden" value="<?php echo $dir;?>" >
	    <input name="act" type="hidden" value="<?php echo $act;?>" >
            <h2 class="center habitatBlue">Login</h2><br>
                
                
                <label>User Id:</label><input id="userName" name="userName" type="text" placeholder="example@provider.com"><br><br>
		<label>Password:</label><input id="password" name="password" type="password" placeholder="**********"><br><br>
                   
                <div class ="center">
                    <input type="submit" value="submit" onclick="verify();"> &nbsp; &nbsp; <a href="index.php?act=checkEmail" class="aForgot">Forgot Password?</a><br>
		<br>
             
                <input type = button onclick="location.href='./register/'" value="New? Register here">
                <br><br>
                    <a href="http://www.yorkhabitat.org" target="_blank">York Habitat Website</a>
                <br><br>
		</div>
            </form>  
        </div>
</div>
