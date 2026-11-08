
<?php
    require_once "config.php";

    if(!isset($_SESSION['user_id']) || !isset($_SESSION['username']) || !isset($_SESSION['role'])){
        header("location: index.php");
        exit();
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>

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
    }

    /* Navigation */
    .nav {
        display: flex;
        flex-direction: row;
        gap: 30px;
        align-items: center;
        padding: 20px 40px;
        background-color: white;
        box-shadow: 0 2px 10px rgba(0,0,0,0.08);
    }

    .nav a {
        text-decoration: none;
        color: #334155;
        font-size: 15px;
        font-weight: bold;
        transition: 0.3s;
    }

    .nav a:hover {
        text-decoration: underline;
        color: #2563eb;
    }

    /* Main Content */
    .main {
        padding: 40px;
    }

    .main h1,
    .main h3 {
        color: #1e3a8a;
    }

    .main h1 {
        font-size: 28px;
    }

    .main h3 {
        font-size: 23px;
        margin-bottom: 20px;
    }

    /* Add Product Form */
    form {
        display: flex;
        flex-direction: row;
        gap: 30px;
        max-width: 900px;
        background-color: white;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(30,64,175,0.08);
    }

    form > div {
        display: flex;
        flex-direction: column;
        gap: 20px;
        flex: 1;
    }

    form > div > div {
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
        background-color: #f8fbff;
        color: #334155;
        font-size: 14px;
        transition: 0.3s;
    }

    input[type="text"]:focus,
    input[type="number"]:focus,
    textarea:focus {
        border-color: #2563eb;
        background-color: white;
        box-shadow: 0 0 5px rgba(37,99,235,0.2);
    }

    textarea {
        resize: vertical;
        min-height: 120px;
    }

    /* Add Product Button */
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
    }

    input[type="submit"]:hover {
        background-color: #1e40af;
        transform: translateY(-2px);
    }

    /* Divider */
    hr {
        border: none;
        border-top: 1px solid #bfdbfe;
        margin: 35px 0;
    }

    /* Product Table */
    table {
        border-collapse: collapse;
        width: 100%;
        max-width: 1200px;
        background-color: white;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(30,64,175,0.08);
    }

    table, th, tr, td {
        border: 1px solid #dbeafe;
    }

    th {
        background-color: #2563eb;
        color: white;
        padding: 15px;
        font-size: 14px;
        text-align: center;
    }

    td {
        text-align: center;
        padding: 14px;
        font-size: 14px;
        color: #334155;
    }

    tbody tr:nth-child(even) {
        background-color: #f0f7ff;
    }

    tbody tr:hover {
        background-color: #dbeafe;
        transition: 0.2s;
    }

    /* Action Buttons */
    button {
        border: none;
        padding: 9px 16px;
        border-radius: 6px;
        background-color: #2563eb;
        color: white;
        font-size: 13px;
        font-weight: bold;
        cursor: pointer;
        transition: 0.3s;
        margin: 3px;
    }

    button:hover {
        background-color: #1e40af;
        transform: translateY(-2px);
    }

    /* Delete Button */
    button:last-child {
        background-color: #dc2626;
    }

    button:last-child:hover {
        background-color: #991b1b;
    }

    /* Responsive Design */
    @media (max-width: 768px) {

        .nav {
            flex-wrap: wrap;
            gap: 15px;
            padding: 18px 20px;
        }

        .main {
            padding: 25px 15px;
            overflow-x: auto;
        }

        form {
            flex-direction: column;
            padding: 20px;
        }

        .main h1 {
            font-size: 24px;
        }

        table {
            min-width: 800px;
        }
    }

</style>
</head>

<body>

    <div class="nav">
        <a href="dashboard.php">Dashboard</a>
        <a href="products.php">Products</a>

        <?php if ($_SESSION['role'] === 'admin'):?>
        <a href="users.php">User Management</a>
        <?php endif; ?>

        <a href="logout.php">Logout</a>
    </div>

    <br>

    <div class="main">

        <div>
            <h3>Add Product</h3>
            <br>

            <form action="" method="post">

                <div>
                    <div>
                        <label for="">Product Name:</label>
                        <input type="text" name="product_name" id="" required>
                    </div>

                    <div>
                        <label for="">Description:</label>
                        <textarea name="description" id="" cols="50" rows="5" required></textarea>
                    </div>
                </div>

                <div>
                    <div>
                        <label for="">Prices:</label>
                        <input type="number" name="price" id="" required>
                    </div>

                    <div>
                        <label for="">Quantity:</label>
                        <input type="number" name="quantity" id="" required>
                    </div>

                    <br>

                    <div>
                        <input type="submit" value="Add Product" name="addproductbtn">
                    </div>
                </div>

            </form>
        </div>

        <hr>

        <br>

        <div>
            <h1>Product List</h1>
            <br>

            <table>
                <thead>
                    <tr>
                        <th>Product ID</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Quantity</th>
                        <th>Prices</th>
                        <th>Date Saved</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    $fetchproduct = mysqli_query($conn, "SELECT * FROM products");

                    if(mysqli_num_rows($fetchproduct)>0){
                        while($product = mysqli_fetch_assoc($fetchproduct)){
                    ?>

                    <tr>
                        <td><?php echo $product['id']; ?></td>
                        <td><?php echo $product['name']; ?></td>
                        <td><?php echo $product['description']; ?></td>
                        <td><?php echo $product['quantity']; ?></td>
                        <td><?php echo $product['price']; ?></td>
                        <td><?php echo $product['created_at']; ?></td>

                        <td>
                            <button onclick="window.location.href='editprod.php?productid=<?php echo $product['id']; ?>'">Edit</button>

                            <button onclick="window.location.href='deleteprod.php?productid=<?php echo $product['id']; ?>'">Delete</button>
                        </td>
                    </tr>

                    <?php
                        }
                    }else{
                    ?>

                    <tr>
                        <td colspan="7">No products found.</td>
                    </tr>

                    <?php
                    }
                    ?>

                </tbody>
            </table>
        </div>

    </div>

</body>
</html>

<?php

if(isset($_POST['addproductbtn'])){
    $name = $_POST['product_name'];
    $desc = $_POST['description'];
    $q = $_POST['quantity'];
    $price = $_POST['price'];

    $userid = $_SESSION['user_id'];

    $insertquery = "INSERT INTO products (name,description,quantity,price,created_by) VALUES ('$name','$desc','$q','$price','$userid')";

    $insertfunc = mysqli_query($conn, $insertquery);

    if($insertfunc){
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
