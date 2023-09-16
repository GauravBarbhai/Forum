<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Iforum - Coding Forums</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  </head>
  <body>
    <?php include 'partials/header.php' ?>
    <?php include 'partials/_dbconnect.php' ?>

    <style>
        .container{
            min-height: 100vh; 
        }
    </style>

    <div class="container my-3">
        <h1 class="py-3">Search Results for <em>" <?php echo $_GET['search'] ?> " </em></h1>
        <?php
            $noResult = true;  
            $query = $_GET['search'];
            $get_category = "SELECT * FROM `threads` WHERE MATCH (thread_title,thread_desc) against ('$query')";
            $result = mysqli_query($conn,$get_category);
            while ($row = mysqli_fetch_assoc($result)) {
                $td_title = $row['thread_title'];
                $td_desc = $row ['thread_desc'];
                $td_id = $row['thread_id'];
                $noResult = false;
                echo '<div class="result">
                <h3> <a href="thread.php?threadid='.$td_id.'" class="text-dark">'.$td_title.'</a></h3>
                <p>'.$td_desc.'</p>
            </div>';
            }
            if($noResult){
                echo  ' <div class="d-flex border p-3">
                <div>
                    <h2> No Search Results </h2>
                </div>
            </div>';
            }
        ?>        
        
    </div>
    <?php include 'partials/footer.php'?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  </body>
</html>