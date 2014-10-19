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

<style>
    div.body {
        margin-left: auto;
        margin-right: auto; 
	text-align: center;
	font-family: arial, "Times New Roman";
	background-color: rgb(253, 253, 253);
    }

    label {font-weight: bold;
           padding-right: 20px;
           padding-top: 10px;
           display: inline-block;
           width: 100px;
           text-align: right;
    }
   /*possibly move below items to CSS page */
    #loginBox { 
	margin: 25px auto;
	border: 3px solid #73b41c;
	border-radius: 20px;
	box-shadow: 3px 4px #555555;
	width: 300px;
        height: auto;
	text-align: left;
	padding: 0px 20px;
    }
    
    #registerBox { /*to make the register link stand out like a button*/
        margin: 10px auto;
        border: 2px solid darkblue;
        border-radius: 20px;
	box-shadow: 1px 2px #555555;
	width: auto;
        height: auto;
	text-align: center;
    }
    
    .center {text-align: center;}
    .aForgot {font-size: 10pt; color: tomato;}
    
</style>

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

	<div class="body">
	<img src="img/habitat_logo.jpg" alt="Habitat for Humanity Logo" height="198px" width="600px" />

	
	<div id="loginBox">
	    <!--form for submitting username and password-->
	    
            <form id="loginUser" name="loginUser" action="index.php" method="get">
	    
	    <input name="dir" type="hidden" value="<?php echo $dir;?>" >
	    <input name="act" type="hidden" value="<?php echo $act;?>" >
            <h2 class="center habitatBlue">Login</h2><br>
                
                
                <label>User Id:</label><input id="userName" name="userName" type="text"><br><br>
		<label>Password:</label><input id="password" name="password" type="password"><br><br>
                   
                <div class ="center">
		<input type="submit" value="submit" onclick="verify();"> &nbsp &nbsp <a href="index.php?act=checkEmail" class="aForgot">Forgot Password?</a><br>
		
                
                <br>
                
                <button onclick="location.href='./register/'">New? Register Here</button>
               
                
                <br><br><a href="http://www.yorkhabitat.org" target="_blank">York Habitat Website</a><br><br>
		</div>
	    </form>
	</div>
    
</div>
<!-- Hosting24 Analytics Code -->
<!--<script type="text/javascript" src="http://stats.hosting24.com/count.php"></script> -->
<!-- End Of Analytics Code -->
