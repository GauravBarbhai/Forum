<?php
$showError = "false";
if($_SERVER['REQUEST_METHOD'] == "POST"){
    include '_dbconnect.php';
    $user_email = $_POST['signupEmail'];
    $pass = $_POST['signupPassword'];
    $cpass = $_POST['signupCpassword'];
    $existsSql = "SELECT * FROM `users` WHERE `user_email` = '$user_email'";
    $result = mysqli_query($conn,$existsSql);
    $row = mysqli_num_rows($result);
    if($row > 0){
        $showError = "Email already exists";
    }

    else{
        if($pass == $cpass ){
            $hash = password_hash($pass , PASSWORD_DEFAULT);
            $signup_users = "INSERT INTO `users`(`user_email`,`user_pass`,`user_date`) VALUES ('$user_email','$hash',current_timestamp())";
            $result = mysqli_query($conn,$signup_users);
            if($result){
                header("Location: /CWH_forum/index.php?signupsuccess=true");
                exit();
            }
        }
        else {
            $showError = "Password does not matched";
        }
    }
    header("Location: /CWH_forum/index.php?signupsuccess=false&error=$showError");
}

?>