<?php
    include_once("includes/conn.php");
    $status = false;
    if(isset($_GET["id"])){
		$id = $_GET["id"];
		$status = true;
	}
    if($status){
        try{
            $sql = "SELECT * FROM `posts` where id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$id]);
            $result = $stmt->fetch();
            $title = $result["title"];
            $content = $result["content"];
            $created_at = $result["created_at"];
          }catch(PDOException $e){
              echo "Connection failed: " . $e->getMessage();
          }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Posts</title>
    <link rel="stylesheet" href="css/posts.css">
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

  <div id="wrapper">
    
  
    <h1>Details about <?php echo $title ?></h1>
    
    <div class="container">
    
        <div class="row">
            <p style="margin: 40px; font-size: 25px; font-weight: bold;"> Post title: <span style="font-size: 18px; font-weight: 400;"> <?php echo $title ?> </span> </p>
        </div>
        <div class="row">
            <p style="margin: 40px; font-size: 25px; font-weight: bold;">Created at: <span style="font-size: 18px; font-weight: 400;"> <?php echo date('d F Y', strtotime($created_at)) ?> </span> </p>
        </div>
        <div class="row">
            <p style="margin: 40px; font-size: 25px; font-weight: bold;">Content: <span style="font-size: 18px; font-weight: 400;"> <?php echo $content ?> </span> </p>
        </div>
    </div>
  </div> 
</body>
<?php
    }else{
        echo "Invalid request";
    }
?>
</html>