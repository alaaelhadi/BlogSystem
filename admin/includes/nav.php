<!-- Start Navbar -->
<nav id='menu'>
    <input type='checkbox' id='responsive-menu' onclick='updatemenu()'><label></label>
    <ul>
      <li><a> Hi <?php if (isset($_SESSION['fullname'])) { ?> <?php echo $_SESSION['fullname']; } ?> </a></li>
      <li><a href=''>Home</a></li>
      <li><a class='dropdown-arrow' href=''>Posts</a>
        <ul class='sub-menus'>
          <li><a href='posts.php'>Posts List</a></li>
          <li><a href='insertPosts.php'>Add Post</a></li>
        </ul>
      </li>
    </ul>
</nav>
<!-- End Navbar -->