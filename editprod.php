
<?php
    require_once "config.php";

    if(!isset($_SESSION['user_id']) || !isset($_SESSION['username']) || !isset($_SESSION['role'])){
        header("location: index.php");
        exit();
    }

    $productid = $_GET['productid'];

    $fetchproduct = mysqli_query($conn, "SELECT * FROM products WHERE id = '$productid'");

    if(mysqli_num_rows($fetchproduct) === 0){
        echo "
          <script>  
          alert('No Product found with that ID.');

            window.location.href='products.php';
          </script>
        ";
        exit();
    }

   $product = mysqli_fetch_assoc($fetchproduct);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>

<style>

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: Arial, sans-serif;
    }

    body {
        background-color: #f0f5ff;
        color: #1e293b;
        min-height: 100vh;
        padding: 40px;
    }

    /* Main Heading */
    h3 {
        color: #1e3a8a;
        font-size: 26px;
        margin-bottom: 25px;
        text-align: center;
    }

    /* Form Container */
    form {
        display: flex;
        flex-direction: row;
        justify-content: center;
        gap: 30px;
        max-width: 850px;
        margin: auto;
        padding: 35px;
        background-color: white;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(30, 64, 175, 0.10);
    }

    /* Form Columns */
    form > div {
        display: flex;
        flex-direction: column;
        gap: 20px;
        flex: 1;
    }

    form div div {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    /* Labels */
    label {
        color: #1e40af;
        font-size: 14px;
        font-weight: bold;
    }

    /* Input Fields */
    input[type="text"],
    input[type="number"],
    textarea {
        width: 100%;
        padding: 12px;
        border: 1px solid #bfdbfe;
        border-radius: 7px;
        outline: none;
        font-size: 14px;
        color: #334155;
        background-color: #f8fbff;
        transition: 0.3s;
    }

    input:focus,
    textarea:focus {
        border-color: #2563eb;
        box-shadow: 0 0 5px rgba(37, 99, 235, 0.2);
        background-color: white;
    }

    textarea {
        resize: vertical;
        min-height: 130px;
    }

    /* Save Button */
    input[type="submit"] {
        background-color: #2563eb;
        color: white;
        border: none;
        padding: 13px 20px;
        border-radius: 7px;
        font-size: 14px;
        font-weight: bold;
        cursor: pointer;
        transition: 0.3s;
        margin-top: 10px;
    }

    input[type="submit"]:hover {
        background-color: #1e40af;
        transform: translateY(-2px);
    }

    /* Responsive Design */
    @media (max-width: 768px) {

        body {
            padding: 20px;
        }

        form {
            flex-direction: column;
            padding: 25px;
            gap: 20px;
        }

        h3 {
            font-size: 22px;
        }

        textarea {
            width: 100%;
        }
    }

</style>
</head>

<body>

    <h3>Edit Product ID <?php echo $product['id'];?></h3>

    <br>

    <form action="" method="post">

        <div>
            <div>
                <label for="">Product Name:</label>
                <input type="text" name="product_name" id="" required value='<?php echo $product['name'];?>'>
            </div>

            <div>
                <label for="">Description:</label>
                <textarea name="description" id="" cols="50" rows="5" required><?php echo $product['description'];?></textarea>
            </div>
        </div>

        <div>
            <div>
                <label for="">Prices:</label>
                <input type="number" name="price" id="" required value='<?php echo $product['price'];?>'>
            </div>

            <div>
                <label for="">Quantity:</label>
                <input type="number" name="quantity" id="" required value='<?php echo $product['quantity'];?>'>
            </div>

            <br>

            <div>
                <input type="submit" value="Save Product" name="savebtn">
            </div>
        </div>

    </form>

</body>
</html>

<?php

if(isset($_POST['savebtn'])){
    $name = $_POST['product_name'];
    $desc = $_POST['description'];
    $q = $_POST['quantity'];
    $price = $_POST['price'];

    $updatequery = "UPDATE products SET name='$name', description='$desc', quantity='$q', price='$price' WHERE id='$productid'"; 

    $updatefunc = mysqli_query($conn, $updatequery);

    if($updatefunc){
        echo "
            <script>
            alert('Product Added Successfully');
            window.location.href='products.php';
            </script>
            ";
    }
    else{
        echo "
            <script>
            alert('Something went wrong. Please try again later!');
            window.location.href='products.php';
            </script>
            ";
    }
}
?>

