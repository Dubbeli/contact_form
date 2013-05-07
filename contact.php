<?php 
$your_email ='name@domain.com';

session_start();
$errors = '';
$department = '';
$visitor_email = '';
$user_message = '';

if(isset($_POST['submit'])){
	$department = $_POST['department'];
	$visitor_email = $_POST['email'];
	$user_message = $_POST['message'];

	if(empty($visitor_email)){
		$errors .= "<p>Please provide your email.</p>";	
	} else if(!filter_var($visitor_email, FILTER_VALIDATE_EMAIL)){
		$errors .= "<p>Please enter a valid email address.</p>";	
  }

	if(IsInjected($visitor_email)){
		$errors .= "<p>Please enter a valid email address.</p>";
	}

	if(empty($user_message)){
		$errors .= "<p>Please write your message.</p>";	
	}

	if(empty($_SESSION['6_letters_code'] ) || strcasecmp($_SESSION['6_letters_code'], $_POST['6_letters_code']) != 0){
		$errors .= "<p>The captcha code does not match!</p>";
	}
	
	if(empty($errors)){
		$to = $your_email;
		$subject="New form submission";
		$from = $your_email;
		$ip = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '';
		
		$body = "$visitor_email submitted the contact form:\n".
		"Subject: $department\n".
		"Email: $visitor_email \n".
		"Message: \n ".
		"$user_message\n".
		"IP: $ip\n";	
		
		$headers = "From: $from \r\n";
		$headers .= "Reply-To: $visitor_email \r\n";
		
		mail($to, $subject, $body,$headers);
		
		$success .="<p>Your message was sent successfully. Thanks.<p>";
	}
}

// Function to validate against any email injection attempts
function IsInjected($str){
  $injections = array('(\n+)',
              '(\r+)',
              '(\t+)',
              '(%0A+)',
              '(%0D+)',
              '(%08+)',
              '(%09+)'
              );
  $inject = join('|', $injections);
  $inject = "/$inject/i";
  if(preg_match($inject,$str)){
    return true;
  }
  else{
    return false;
  }
}
?>