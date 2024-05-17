<?php
	session_start();
	if(isset($_SESSION["logged"]) and $_SESSION["logged"]){
	header("Location: posts.php");
	die();
	}
	
	if($_SERVER["REQUEST_METHOD"] === "POST"){
		include_once("includes/conn.php");
		include_once("includes/validation.php");
		try{
			$sql = "SELECT `fullname`,`password`, `isAdmin` FROM `users` WHERE email = ?";
			$email = $_POST["email"];
			$pass = $_POST["password"];
			$stmt = $conn->prepare($sql);
			$stmt->execute([$email]);
			if($stmt->rowcount() > 0){
			  $result = $stmt->fetch();
			  $fullname = $result["fullname"];
			  $isAdmin = $result["isAdmin"];
			  $hash = $result["password"];
			  $verify = password_verify($pass, $hash);
			  if($verify){
				// if($isAdmin){
					$_SESSION["logged"] = true;
					$_SESSION["fullname"] = $fullname;
					$_SESSION["isAdmin"] = $isAdmin;
					header("Location: posts.php");
					die();
				// }else{
				// 	echo("You have no permission");
				// }
			  }else{
				echo "Password is not correct";
			  }
			}else{
				echo "Email is not correct";
			}
		}catch(PDOException $e){
			echo "Connection failed: " . $e->getMessage();
		}
	}
?>
<html>
  <head>
    <meta charset="utf-8">
    <title>Login Form</title>
    <link href="css/style.css" type="text/css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<style>
		.textBox{
			width: 350px;
			outline: none;
			border-radius: 10px;
		}
		.fl{
			font-weight: 600;
		}
		.sub{
			margin-left: 140px;
			margin-top: 10px;
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
  	<div class="container" style="background: #3B84CC; width: 50%; border-radius: 20px; height: 200px">
	  <h2 style="text-align: center; color: white; padding: 10px;"> Login Form </h2>
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" autocomplete="on" style="margin-left: 200px;">
    	<!---Email---->
    	<div class="box">
			<div class="fr">
				<input type="email" required name="email" placeholder="Email" class="textBox">
				<?php
					if(isset($error)){
						echo $error1;
					}
				?>
			</div>
			<div class="clr"></div>
    	</div>
    	<!--Email----->

    	<!---Password------>
    	<div class="box">
			<div class="fr">
				<input type="Password" required name="password" placeholder="Password" class="textBox">
				<?php
					if(isset($error)){
						echo $error2;
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
