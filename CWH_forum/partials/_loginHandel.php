<?php

if($_SERVER['REQUEST_METHOD'] == "POST"){
    include '_dbconnect.php';
    session_start();
    $email = $_POST['loginEmail'];
    $pass = $_POST['loginPass'];
    $get_user = "SELECT * FROM `users` WHERE `user_email` = '$email'";
    $result = mysqli_query($conn,$get_user);
    $numRows = mysqli_num_rows($result);
    if($numRows == 1){
        $row = mysqli_fetch_assoc($result);
        if(password_verify($pass , $row['user_pass'])){
            $_SESSION['loggedin'] = true;
            $_SESSION['useremail'] = $email;
            $_SESSION['sno'] = $row['sno'];
            header("Location: /CWH_forum/index.php");
            exit();
        }
        else{
            $_SESSION['loggedin'] = false;
        }
        header("Location: /CWH_forum/index.php");
    }
    else{
        $_SESSION['loggedin'] = false;
        header("Location: /CWH_forum/index.php");
    }
}

?>