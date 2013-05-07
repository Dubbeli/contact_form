<?php require_once('contact.php'); ?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>PHP simple contact form</title>
</head>
<body>
	<h2>Contact</h2>

	<?php
	if(!empty($errors)){
		echo "<div class='feedback error'>".$errors."</div>";
	} else if(!empty($success)){
		echo "<div class='feedback success'>".nl2br($success)."</div>";
	}
	?>
	<form method="POST" id="contact_form" name="contact_form" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>"> 
		<p>
			<label for="department">Department:</label><br>
			<select name="department">
				<option value="General">General</option>
				<option value="App Problems">App Problems</option>
				<option value="Website Problems">Website Problems</option>
				<option value="Sales">Sales</option>
				<option value="Press">Press</option>
				<option value="Careers">Careers</option>
				<option value="Academic">Academic</option>
			</select>
		</p>
		<p>
			<label for='email'>Email: </label><br>
			<input type="text" name="email" value='<?php echo htmlentities($visitor_email) ?>'>
		</p>
		<p>
			<label for='message'>Message:</label> <br>
			<textarea name="message"><?php echo htmlentities($user_message) ?></textarea>
		</p>
		<p>
			<img src="captcha.php?rand=<?php echo rand(); ?>" id='captchaimg' /><br>
			<label for='message'>Enter the code above here :</label><br>
			<input id="6_letters_code" name="6_letters_code" type="text"><br>
			<small>Can't read the image? click <a href='javascript: refreshCaptcha();'>here</a> to refresh</small>
		</p>
		<input type="submit" value="Send email" name='submit'>
	</form>
	<script type="text/javascript">
		function refreshCaptcha(){
			var img = document.images['captchaimg'];
			img.src = img.src.substring(0,img.src.lastIndexOf("?"))+"?rand="+Math.random()*1000;
		}
	</script>
</body>
</html>