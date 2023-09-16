<?php
include 'partials/_dbconnect.php';
session_start();
echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<a class="navbar-brand" href="/CWH_forum">Iforums</a>
<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
  <span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="navbarSupportedContent">
  <ul class="navbar-nav me-auto mb-2 mb-lg-0">
    <li class="nav-item">
      <a class="nav-link active" aria-current="page" href="/CWH_forum">Home</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="about.php">About</a>
    </li>
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        Categories
      </a>
      ';
      $get_categories = "SELECT * FROM `categories` ";
      $result = mysqli_query($conn,$get_categories);
      while ($row = mysqli_fetch_assoc($result)){
      echo '
       <ul class="dropdown-menu">
       <li> <a class="dropdown-item" href="threadlist.php?catid='. $row['cat_id'] .'">'. $row['cat_name'] .'</a></li>
        </ul>
        </li>';
      }
    echo '
    <li class="nav-item">
      <a class="nav-link " href = "contact.php">Contact</a>
    </li>
  </ul>';
  if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
    echo ' <div class="row gx-10">
    <div class="col-4 ">
        <form class="d-flex" role="search" action="search.php" method = "get">
              <input class="form-control me-2" name="search" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-success" type="submit">Search</button>
        </form>
    </div> 
           <div class ="col-5 ">
              <p class="text-light my-1 mx-2">Welcome ! '.$_SESSION['useremail'].'</p>
           </div>
            <div class = "d-inline-flex col-3 px-0">
               <a href="partials/_logout.php" role="button" class = "btn btn-outline-success">Logout</a>
            </div>
    </div>'; 
  }
  else{
    echo '<div class="row gx-10">
    <div class="col-6">
        <form class="d-flex" role="search">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-success" type="submit">Search</button>
        </form>
    </div>
    <div class="col-2">
     <button class=" btn btn-outline-success ml-2" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
    </div>
    <div class="col-3 px-3">
     <button class=" btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#signUpModal">Signup</button>
    </div> 
</div>';
  }
echo'    
</div>
</nav>';

include '_loginModal.php';
include '_signUp.php';
if(isset($_GET['signupsuccess']) && $_GET['signupsuccess'] == "true"){
  echo '
    <div class="alert alert-success alert-dismissible fade show my-0" role="alert">
      <strong>Success!</strong> Your signup is done successfully. Now you can login to our site.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  ';
}
if(isset($_GET['error']) && $_GET['signupsuccess'] == "false"){
  echo '
    <div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
      <strong>Error!</strong> '.$_GET['error'].'
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  ';
}
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == false){
  echo '
    <div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
      <strong>Error!</strong> Invalid Email or Password.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  ';
}

?>