<?php
    require_once "config.php";

    if(!isset($_SESSION['user_id']) && !isset($_SESSION['username']) && !isset($_SESSION['role'])){
        header("location: index.php");
    }


    $productid = $_GET['productid'];

    $deleteproduct = mysqli_query($conn, "DELETE FROM products WHERE id = '$productid'");

    if($deleteproduct){
        echo "
          <script>  
          alert('Deleted Successfully');

            window.location.href='products.php';
          </script>
        ";
    }
    else{
        echo "
        <script>
            alert(Something went wrong. Please Try again.');

            window.location.href='products.php';
        </script>
        ";
        }
?>
