<?php
	include_once("includes/conn.php");
	include_once("includes/validation.php");
	$status = false;
	if(isset($_GET["id"])){
		$id = $_GET["id"];
		$status = true;
	}elseif($_SERVER["REQUEST_METHOD"] === "POST"){
		$status = true;
		$id = $_POST["id"];
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
			$sql = "UPDATE `posts` SET `title`=?,`content`=? WHERE id=?"; 
			$stmt = $conn->prepare($sql);
			$stmt->execute([$title, $content, $id]);
			echo "<script>alert('Updated successfully')</script>";
		}
	}
	if($status){
		try{
			$sql = "SELECT * FROM `posts` WHERE id=?";
			$stmt = $conn->prepare($sql);
			$stmt->execute([$id]);
			$result = $stmt->fetch();
			$title = $result["title"];
			$content = $result["content"];
		}catch(PDOException $e){
			echo "Can't get post data: " . $e->getMessage();
		}
	}
?>
<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>Update Post</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
		<link rel="stylesheet" href="css/style1.css">
		<link rel="stylesheet" href="css/style2.css">
	</head>
	<?php
		if($status){
	?>
	<body>
		<!-- Start Navbar -->
		<?php
    	  include_once("includes/nav.php");
  		?>
		<!-- End Navbar -->

		<div class="container">
			<form  method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="m-auto" style="max-width:600px" enctype="multipart/form-data">
				<h3 class="my-4"> Update <?php echo $title ?> </h3>
				<hr class="my-4" />
				<div class="form-group mb-3 row"><label for="title2" class="col-md-5 col-form-label">Post Title</label>
					<div class="col-md-7"><input type="text" class="form-control form-control-lg" id="title2" name="title" value="<?php echo $title ?>" required placeholder="Enter Post Title"></div>
				</div>
                
				<hr class="bg-transparent border-0 py-1" />
				<div class="form-group mb-3 row"><label for="content4" class="col-md-5 col-form-label">Content</label>
					<div class="col-md-7"><textarea  class="form-control form-control-lg" id="content4" name="content" required placeholder="Enter Content"> <?php echo $content ?>  </textarea></div>
				</div>

				<input type="hidden" name="id" value="<?php echo $id ?>">

				<hr class="my-4" />
				<div class="form-group mb-3 row"><label for="insert10" class="col-md-5 col-form-label"></label>
					<div class="col-md-2"><button class="btn btn-primary btn-lg" type="submit"> Update </button></div>
					<div class="col-md-2"><a href="posts.php" class="btn btn-primary btn-lg"> Cancel </a></div>
               </div>
			</form>
		</div>
	</body>
	<?php
		}else{
			echo "Invalid request";
		}
	?>
</html>