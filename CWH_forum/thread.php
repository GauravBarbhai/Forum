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
    <?php  
          $id = $_GET['threadid'];
          $get_category = "SELECT * FROM `threads` WHERE thread_id = $id ";
          $result = mysqli_query($conn,$get_category);
          while ($row = mysqli_fetch_assoc($result)) {
              $td_title = $row['thread_title'];
              $td_desc = $row ['thread_desc'];
              $td_user_id = $row['thread_user_id'];

              $get_user = "SElECT * FROM `users` WHERE sno = '$td_user_id'";
              $result2 = mysqli_query($conn,$get_user);
              $row2 = mysqli_fetch_assoc($result2);
              $posted_by = $row2['user_email'];
          }
    ?>
    <?php
        $showAlert = FALSE;
        $method = $_SERVER['REQUEST_METHOD'];
        if($method=='POST'){
          $comment_content = $_POST['comment'];
          $comment_content = str_replace("<","&lt;",$comment_content);
          $comment_content = str_replace(">","&gt;",$comment_content);
          $sno = $_POST['sno'];
          $set_thread = "INSERT INTO `comments` (`comment_content`, `thread_id`, `comment_by`, `comment_time`) VALUES ('$comment_content', '$id', '$sno', current_timestamp())";
          $result = mysqli_query($conn,$set_thread);
          
          $showAlert = TRUE;
          if($showAlert){
            echo '
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> Your comment has been added !
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            ';
          }
        }
    ?>
    <div class="container my-3">
        <h1 class="display-4"><?php echo $td_title; ?></h1>
        <p class="lead"> <?php echo $td_desc; ?> </p>
        <p>This is a peer to peer forum. No Spam / Advertising / Self-promote in the forums is not allowed. Do not post copyright-infringing material. Do not post “offensive” posts, links or images. Do not cross post questions. Remain respectful of other members at all times.</p>
        <p><b>Posted By :- <?php echo $posted_by ?></b></p>
    </div>
    <?php
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
      echo ' <div class="container">
      <h4 class="mb-3">Post a Comment</h4>
        <form action = "'.$_SERVER['REQUEST_URI'] .'" method="POST">
          <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Write a Comment</label>
            <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
            <input type="hidden" name="sno" value="'.$_SESSION['sno'].'";
          </div>
          <button type="submit" class="btn btn-success mb-4">Post Comment</button>
        </form>';
    }
    else{
      echo '<div class = "container">
      <h4 class="mb-3">Post a comment</h4>
      <p class="lead"> To post a comment you need to login.
      </div>';
    }
    ?>

    <div class="container">
        <h2 class="mb-2">Discussions</h2>
        <?php  
          $id = $_GET['threadid'];
          $get_comments = "SELECT * FROM `comments` WHERE thread_id = $id ";
          $result = mysqli_query($conn,$get_comments);
          $noResult = TRUE;
          while ($row = mysqli_fetch_assoc($result)) {
              $noResult = FALSE;
              $ct_id = $row['comment_id'];
              $ct_content = $row ['comment_content'];
              $ct_time = $row['comment_time'];
              $comment_by= $row['comment_by'];
              $get_user_email = "SElECT * FROM `users` WHERE sno = '$comment_by'";
              $result2 = mysqli_query($conn,$get_user_email);
              $row2 = mysqli_fetch_assoc($result2);
          
          echo  ' <div class="d-flex border p-3">
                <img src="https://cdn.pixabay.com/photo/2016/11/18/23/38/child-1837375_960_720.png" alt="..."
                    class="flex-shrink-0 me-3 rounded-circle" style="width:60px;height:60px;">
                <div>
                    <b>'.$row2['user_email'].' at '.$ct_time.' </b>
                    <p>'.$ct_content.'.</p>
                </div>
            </div>';
          }
          if($noResult){
            echo  '
             <div class="d-flex border p-3">
            <div>
                <p class="display-6">No Comments Found </p>
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