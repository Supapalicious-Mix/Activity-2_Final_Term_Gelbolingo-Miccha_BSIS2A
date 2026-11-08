<?php
    require_once "config.php";

    if(!isset($_SESSION['user_id']) && !isset($_SESSION['username']) && !isset($_SESSION['role'])){
        header("location: index.php");
    }

    if($_SESSION['role'] !== 'admin'){
         header("location: dashboard.php");
    }

    $userid = $_GET['userid'];

    $approveuser = mysqli_query($conn, "UPDATE users SET status = 'pending' WHERE id = '$userid'");

    if($approveuser){
        echo "
          <script>  
          alert('User is disabled');

            window.location.href='users.php';
          </script>
        ";
    }
    else{
        echo "
        <script>
            alert('Something went wrong. Please Try again.');

            window.location.href='users.php';
        </script>
        ";
        }
?>