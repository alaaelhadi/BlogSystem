<?php
  try{
    include_once("includes/conn.php");
    include_once("includes/logged.php");
    $sql = "SELECT * FROM `posts`";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
  }catch(PDOException $e){
      echo "Connection failed: " . $e->getMessage();
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Posts</title>
    <link rel="stylesheet" href="css/posts.css">
    <link rel="stylesheet" href="css/style2.css">
</head>
<body>
  <!-- Start Navbar -->
  <?php
    include_once("includes/nav.php");
  ?>
  <!-- End Navbar -->

  <div id="wrapper">
    <h1>Posts</h1>
    
    <table id="keywords" cellspacing="0" cellpadding="0">
      <thead>
        <tr>
        <th><span>ID</span></th>
          <th><span>Title</span></th>
          <th><span>Content</span></th>
          <th><span>Created At</span></th>
          <th><span>Show</span></th>
          <th><span>Update</span></th>
          <th><span>Delete</span></th>
        </tr>
      </thead>
      <tbody>
      <?php
        foreach($stmt->fetchAll() as $row){
          $id = $row["id"];
          $title = $row["title"];
          $content = $row["content"];
          $created_at = $row["created_at"];
      ?>
        <tr>
          <td class="lalign"><?php echo $id ?></td>
          <td><?php echo $title ?></td>
          <td><?php echo substr_replace($content, "...", 20) ?></td> 
          <td><?php echo date('d F Y', strtotime($created_at)) ?></td>  
          <td><a href="showPost.php?id=<?php echo $id ?>"><img src="../assets/imgs/show.jpg" alt="Show" style="width:40px; height:40px;"></a></td>
          <td><a <?php if(isset($_SESSION["isAdmin"]) && $_SESSION["isAdmin"]){ ?> href="updatePost.php?id=<?php echo $id ?>" <?php } ?>><img src="../assets/imgs/update.jpg" alt="Update"></a></td>
          <td><a <?php if(isset($_SESSION["isAdmin"]) && $_SESSION["isAdmin"]){ ?> href="deletePost.php?id=<?php echo $id ?>" onclick="return confirm('Are you sure you want to delete <?php echo $title ?> ?')" <?php } ?>><img  src="../assets/imgs/delete.jpg" alt="Delete"></a></td>
        </tr>
      <?php
        }
      ?>
      </tbody>
    </table>
  </div> 
</body>
</html>