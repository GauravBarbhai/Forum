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
    <div id="carouselExampleIndicators" class="carousel slide">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
      </div>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="media/slider1.jpg" style="height: 700px;" class="d-block w-100" alt="media/py1.jpg">
        </div>
        <div class="carousel-item">
          <img src="media/slider2.jpg" style="height: 500px;" class="d-block w-100" alt="media/py1.jpg">
        </div>
        <div class="carousel-item">
          <img src="media/slider3.jpg" style="height: 500px;" class="d-block w-100" alt="media/py1.jpg">
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
    <div class="container my-3">
        <h2 class="text-center my-3">Iforums - Browse Categories</h2>
        <div class="row my-3">
                <?php   
                  $get_data = "SELECT * FROM `categories`";
                  $result = mysqli_query($conn,$get_data);
                  while ($row = mysqli_fetch_assoc($result)) {
                    $id = $row['cat_id'];
                    $cat_name = $row['cat_name'];
                    $cat_desc = $row['cat_description'];
                    echo ' <div class="col-md-4 my-3">
                    <div class="card" style="width: 18rem;">
                    <img src="media/py1.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"> <a href = "Threadlist.php?catid='.$id.'">'.$cat_name.'</a></h5>
                        <p class="card-text">'.substr($cat_desc,0,30).'...</p>
                        <a href="Threadlist.php?catid='.$id.'" class="btn btn-primary">View Threads</a>
                    </div>
                    </div>
                    </div>';
                  }
                ?>
        </div>
    </div>
    <?php include 'partials/footer.php'?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  </body>
</html>