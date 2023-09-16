<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Iforum - Coding Forums</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  </head>
  <body>
    <?php include 'partials/_dbconnect.php' ?>
    <?php include 'partials/header.php' ?>
    <div class="container my-3">
        <?php  
          $id = $_GET['catid'];
          $get_category = "SELECT * FROM `categories` WHERE cat_id = $id ";
          $result = mysqli_query($conn,$get_category);
          while ($row = mysqli_fetch_assoc($result)) {
              $catname = $row['cat_name'];
              $catdesc = $row ['cat_description'];
          }
        ?>

    <?php
        $showAlert = FALSE;
        $method = $_SERVER['REQUEST_METHOD'];
        if($method=='POST'){
          $id = $_GET['catid'];
          $th_title = $_POST['td_title'];
          $th_desc = $_POST['td_desc'];

          $th_title = str_replace("<","&lt;",$th_title);
          $th_title = str_replace(">","&gt;",$th_title);

          $th_desc = str_replace("<","&lt;",$th_desc);
          $th_desc = str_replace(">","&gt;",$th_desc);

          $sno = $_POST['sno'];
          $set_thread = "INSERT INTO `threads` (`thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `date`) VALUES ('$th_title', '$th_desc', '$id', '$sno', current_timestamp())";
          $result = mysqli_query($conn,$set_thread);
          $showAlert = TRUE;
          if($showAlert){
            echo '
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> Your thread has been added ! Please wait for community to respond.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            ';
          }
        }
    ?>
        <h1 class="display-4">Welcome to <?php echo $catname; ?> forums</h1>
        <p class="lead"> <?php echo $catdesc; ?> </p>
        <p>This is a peer to peer forum. No Spam / Advertising / Self-promote in the forums is not allowed. Do not post copyright-infringing material. Do not post “offensive” posts, links or images. Do not cross post questions. Remain respectful of other members at all times.</p>
    </div>

   <?php
   if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
     echo ' <div class="container">
      <h4 class="mb-3">Start a Discussion</h4>
        <form action = "'. $_SERVER['REQUEST_URI'] .'" method="POST">
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Problem Title</label>
            <input type="text" class="form-control" id="td_title" name="td_title"  aria-describedby="emailHelp">
            <div id="emailHelp" class="form-text">Keep your title as short as possible</div>
            <input type="hidden" name="sno" value="'.$_SESSION['sno'].'";
          </div>
          <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Explain your problem</label>
            <textarea class="form-control" id="td_desc" name="td_desc" rows="3"></textarea>
          </div>
          <button type="submit" class="btn btn-success ">Submit</button>
        </form>
      </div>';
    }
    else{
      echo '<div class = "container">
      <h4 class="mb-3">Start a Discussion</h4>
      <p class="lead"> To start a discussion you need to login.
      </div>';
    }
    ?>
     <div class="container">   
        <h2 class="mt-4">Browse Questions</h2>
        <?php  
          $id = $_GET['catid'];
          $get_thread = "SELECT * FROM `threads` WHERE thread_cat_id = $id ";
          $result = mysqli_query($conn,$get_thread);
          $noResult = TRUE;
          while ($row = mysqli_fetch_assoc($result)) {
              $noResult = FALSE;
              $threadid = $row['thread_id'];
              $title = $row ['thread_title'];
              $td_desc = $row['thread_desc'];
              $thread_user_id = $row['thread_user_id'];
              $get_user_email = "SElECT * FROM `users` WHERE sno = '$thread_user_id'";
              $result2 = mysqli_query($conn,$get_user_email);
              $row2 = mysqli_fetch_assoc($result2);
          echo  ' <div class="d-flex border p-3">
                <img src="https://cdn.pixabay.com/photo/2016/11/18/23/38/child-1837375_960_720.png" alt="..."
                    class="flex-shrink-0 me-3 rounded-circle" style="width:60px;height:60px;">
                <div>
                    <h4><a href="thread.php?threadid='.$threadid.'">'.$title.'</a></h4>
                    <b>Asked by: '.$row2['user_email'].'</b>
                    <p>'.$td_desc.'.</p>
                </div>
            </div>';
          }
          
          if($noResult){
            echo  '
             <div class="d-flex border p-3">
            <div>
                <p class="display-6">No Threads Found </p>
                <p>Be first to comment</p>
            </div>
            </div>';
          }
       ?>
    </div>  
    <?php include 'partials/footer.php'?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  </body>
</html>