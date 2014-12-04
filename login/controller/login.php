<?php

	// TITLE: login controller
	// FILE: login/controller/login.php
	// AUTHOR: 
	
	
	global $act;
    	global $msg;
    	global $dir;
    	global $user;
	
	$act = (isset($_GET['act'])) ? $_GET['act'] : '';
	$msg = (isset($_GET['msg'])) ? $_GET['msg'] : ''; 
	    
	switch($act)
	{
	    //gets submitted username and password, and checks them against database
	    case 'loginCheck';
            
                //session_start();
                $user=($_GET['userName']);
                $pw=($_GET['password']);
                $dbCheck=$dbio->getLogin($user,$pw);
                
                //gets personid from username
                global $personid;
                $personid= $dbio->getPersonIdByUserName($user);

                //checks results of DB query and either errors or allows login
                if($dbCheck == null)
                {
                    //include ('view/loginpage.php');
                    $page = $dir . '/view/loginpage.php';
                    print '<script type="text/javascript">'; 
                        print 'alert("Not a valid Username or Password")'; 
                    print '</script>';
                }
                elseif($dbCheck == 1) {
                    $page = $dir . '/view/loginpage.php';
                }
                else
                {	
                    $dir='home';

                    $_SESSION['personid']=$personid;
                    $_SESSION['userName'] = (isset($_GET['userName'])) ? $_GET['userName'] : '';
                    $_SESSION['username'] = (isset($_GET['userName'])) ? $_GET['userName'] : '';
                    $page = $dir . '/view/home.php';
                }
            break;

	    case 'checkEmail';
	    $page = $dir . '/view/checkEmail.php';
	    $act='dbcheck';
	    
	    
	    break;

	    //checks submitted email against db for password resetting
	    case 'dbcheck';

	    $email=($_GET['email']);
	    
	    $checkEmail=$dbio->getEmailCheck($email);
	    


	    if($checkEmail == $email){
	    	$page = $dir . '/view/loginpage.php';
	    	print '<script type="text/javascript">'; 
			print 'alert("Reset Password is mailed to you on '.$email.'. Please enter a new password after loggin in with the reset password")'; 
			print '</script>';

	    }

	    else{
	    	$page = $dir . '/view/checkEmail.php';
	    	print '<script type="text/javascript">'; 
			print 'alert("Enter your email which you entered while registering with Habitat for Humanity OR Contact our office")'; 
			print '</script>';
	    }

	    break;

	    

	    default:
	   	$page = $dir . '/view/loginpage.php';
	    break;
	}

 ?>
