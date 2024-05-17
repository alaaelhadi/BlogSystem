<?php
	include_once("includes/conn.php");
	include_once("includes/validation.php");
	if($_SERVER["REQUEST_METHOD"] === "POST"){
		try{
			$title = $_POST["title"];
			$content = $_POST["content"];

			// Title VALIDATION 
			$titleValidation= new Validation("title", $title);
			$titleResult=$titleValidation->required(); 
			if($titleValidation->hasErrors()){
				$titleErrors=$titleValidation->getErrors();
			}

			// Content VALIDATION 
			$contentValidation= new Validation("content", $content);
			$contentResult=$contentValidation->required(); 
			if($contentValidation->hasErrors()){
				$contentErrors=$contentValidation->getErrors();
			}

			if(empty($titleErrors) && empty($contentErrors))
			{
				$sql = "INSERT INTO `posts`(`title`, `content`) VALUES (?, ?)";
				$stmt = $conn->prepare($sql);
				$stmt->execute([$title, $content]);
				echo "<script>alert('Inserted successfully')</script>";
			}
		}catch(PDOException $e){
			echo "Connection failed: " . $e->getMessage();
		}
	}
?>
<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>Insert Post</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
		<link rel="stylesheet" href="css/style1.css">
		<link rel="stylesheet" href="css/style2.css">
	</head>

	<body>
		<!-- Start Navbar -->
		<?php
    	  include_once("includes/nav.php");
  		?>
		<!-- End Navbar -->

		<div class="container">
			<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="m-auto" style="max-width:600px" enctype="multipart/form-data">
				<h3 class="my-4">Insert Post</h3>
				<hr class="my-4" />
				<div class="form-group mb-3 row"><label for="title2" class="col-md-5 col-form-label">Post Title</label>
					<div class="col-md-7">
						<input type="text" class="form-control form-control-lg" id="title2" name="title" value="<?php if(isset($_POST['title'])){echo $_POST['title'] ;} ?>" required placeholder="Enter Post Title">
						<?php 
							if(isset($titleErrors))
							{
								foreach($titleErrors as $error)
								{
									echo "<p class='alert alert-danger mt-1'>$error</p> ";
								}
							}
                		?>
					</div>
				</div>
                
				<hr class="bg-transparent border-0 py-1" />
				<div class="form-group mb-3 row"><label for="content4" class="col-md-5 col-form-label">Content</label>
					<div class="col-md-7">
						<textarea class="form-control form-control-lg" id="content4" name="content" value="<?php if(isset($_POST['content'])){echo $_POST['content'] ;} ?>" required placeholder="Enter Content"></textarea>
						<?php 
							if(isset($contentErrors))
							{
								foreach($contentErrors as $error)
								{
									echo "<p class='alert alert-danger mt-1'>$error</p> ";
								}
							}
                		?>
					</div>
				</div>

				<hr class="my-4" />
				<div class="form-group mb-3 row"><label for="insert10" class="col-md-5 col-form-label"></label>
					<div class="col-md-2"><button class="btn btn-primary btn-lg" type="submit"> Insert </button></div>
					<div class="col-md-2"><a href="posts.php" class="btn btn-primary btn-lg"> Cancel </a></div>
               </div>
			</form>
		</div>
	</body>

</html>

