<?php
	include_once("includes/conn.php");
	include_once("includes/validation.php");
	if($_SERVER["REQUEST_METHOD"] === "POST"){
		$fullname = $_POST["fullname"];
		$phoneNo = $_POST["phoneNo"];
		$email = $_POST["email"];
		$password = password_hash($_POST["password"], PASSWORD_DEFAULT);
		// $isAdmin = $_POST["isAdmin"];

		// FULLNAME VALIDATION 
		$fullnameValidation= new Validation("fullname", $fullname);
		$fullnameResult=$fullnameValidation->required(); 
		if($fullnameValidation->hasErrors()){
			$fullnameErrors=$fullnameValidation->getErrors();
		}

		// Email VALIDATION 
		$emailValidation= new Validation("email", $email);
        $emailResult=$emailValidation->required(); 
        $emailPattern='/^[A-Za-z0-9](([_\.\-]?[a-zA-Z0-9]+))@([A-Za-z0-9]+)(([\.\-]?[a-zA-Z0-9]+))\.([A-Za-z]{2,})$/';
        if($emailResult)
        {
            $emailPatternResult=$emailValidation->regex($emailPattern);
        }
        if($emailValidation->hasErrors()){
            $emailErrors=$emailValidation->getErrors();
        } 

		// PASSWORD VALIDATION
		$passwordValidation = new Validation("password", $password );
		$passwordResult = $passwordValidation->required();
		if($passwordValidation->hasErrors()){
			$passwordErrors=$passwordValidation->getErrors();
		}

		// PHONE VALIDATION
		$phoneNoValidation= new Validation("phoneNo", $phoneNo);
		$phoneNoResult = $phoneNoValidation->required();
		$phoneNoPattern = '/^01[0-2,5]\d{8}$/'; 
		if($phoneNoResult)
		{
			$phoneNoPatternResult = $phoneNoValidation->regex($phoneNoPattern);
		}
		if($phoneNoValidation->hasErrors()){
			$phoneNoErrors=$phoneNoValidation->getErrors();
		}

		if(empty($fullnameErrors) && empty($emailErrors) && empty($passwordErrors) && empty($phoneNoErrors))
        {
			$sql = "INSERT INTO `users`(`fullname`, `phoneNo`, `email`, `password`) VALUES (?, ?, ?, ?)";
			$stmt = $conn->prepare($sql);
			$stmt->execute([$fullname, $phoneNo, $email, $password]);
			header("Location: login.php");
			die();
		}
	}
?>
<html>
  <head>
    <meta charset="utf-8">
    <title>Registration Form</title>
    <link href="css/style.css" type="text/css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<style>
		.textBox{
			width: 350px;
			margin-bottom: 25px;
			outline: none;
			border-radius: 10px;
			/* margin-bottom: 15px; */
		}
		.fl{
			font-weight: 600;
		}
		.radio{
			margin: 10px;
		}
		.sub{
			margin-left: 145px;
			margin-top: 40px;
			width: 100px;
			background: white;
			height: 30px;
			outline: none;
			border: none;
			border-radius: 10px;
		}
	</style>
  </head>
  <body>
    <!-- Body of Form starts -->
  	<div class="container" style="background: #3B84CC; width: 50%; border-radius: 20px; height: 400px">
	  <h2 style="text-align: center; color: white; padding: 10px;"> Registration Form </h2>
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" autocomplete="on" style="margin-left: 200px;">
        <!--First name-->
    	<div class="box">
    		<div class="fr">
    			<input type="text" name="fullname" placeholder="Full Name" class="textBox" autofocus="on" required>
				<?php 
					if(isset($fullnameErrors))
					{
						foreach($fullnameErrors as $error)
						{
							echo "<p style='color: black'>$error</p> ";
						}
					}
				?>
    		</div>
    		<div class="clr"></div>
    	</div>
    	<!--First name-->

    	<!---Phone No.------>
    	<div class="box">
			<div class="fr">
				<input type="text" name="phoneNo" maxlength="11" placeholder="Phone No." class="textBox" required>
				<?php 
					if(isset($phoneNoErrors))
					{
						foreach($phoneNoErrors as $error)
						{
							echo "<p style='color: black'>$error</p> ";
						}
					}
				?>
			</div>
    		<div class="clr"></div>
    	</div>
    	<!---Phone No.---->

    	<!---Email---->
    	<div class="box">
			<div class="fr">
				<input type="email" name="email" placeholder="Email" class="textBox" required>
				<?php 
					if(isset($emailErrors))
					{
						foreach($emailErrors as $error)
						{
							echo "<p style='color: black'>$error</p> ";
						}
					}
				?>
			</div>
			<div class="clr"></div>
    	</div>
    	<!--Email----->


    	<!---Password------>
    	<div class="box">
			<div class="fr">
				<input type="Password" name="password" placeholder="Password" class="textBox" required>
				<?php 
					if(isset($passwordErrors))
					{
						foreach($passwordErrors as $error)
						{
							echo "<p style='color: black'>$error</p> ";
						}
					}
				?>
			</div>
    		<div class="clr"></div>
    	</div>
    	<!---Password---->

		<!---Submit Button------>
		<div class="box">
			<input type="Submit" name="Submit" class="sub" value="SUBMIT">
		</div>
		<!---Submit Button----->
      </form>
  </div>
  <!--Body of Form ends--->
  </body>
</html>
