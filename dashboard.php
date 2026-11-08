
<?php
    require_once "config.php";

    if(!isset($_SESSION['user_id']) || !isset($_SESSION['username']) || !isset($_SESSION['role'])){
        header("location: index.php");
        exit();
    }

    $totaluser = $conn->query("SELECT COUNT(*) AS total FROM users")->fetch_assoc()['total'];
    $totalpending = $conn->query("SELECT COUNT(*) AS total FROM users WHERE status = 'pending'")->fetch_assoc()['total'];
    $totalproduct = $conn->query("SELECT COUNT(*) AS total FROM products")->fetch_assoc()['total'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

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
        background-color: #ffffff;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
    }

    .nav a {
        text-decoration: none;
        color: #334155;
        font-size: 15px;
        font-weight: bold;
        transition: 0.3s;
    }

    .nav a:hover {
        color: #2563eb;
    }

    /* Main Content */
    .main {
        padding: 40px;
    }

    .main h1 {
        font-size: 30px;
        color: #1e3a8a;
        margin-bottom: 30px;
    }

    /* Dashboard Cards */
    .cards {
        display: flex;
        flex-direction: row;
        gap: 25px;
        flex-wrap: wrap;
    }

    .card {
        width: 250px;
        min-height: 150px;
        border-radius: 12px;
        text-align: left;
        color: white;
        padding: 25px;
        box-shadow: 0 4px 12px rgba(30, 64, 175, 0.12);
        transition: 0.3s;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 18px rgba(30, 64, 175, 0.18);
    }

    .card h3 {
        font-size: 15px;
        font-weight: normal;
        margin-bottom: 20px;
    }

    .card h2 {
        font-size: 35px;
        font-weight: bold;
    }

    /* Individual Card Colors */
    .card:nth-child(1) {
        background-color: #2563eb !important;
    }

    .card:nth-child(2) {
        background-color: #3b82f6 !important;
    }

    .card:nth-child(3) {
        background-color: #1e40af !important;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .nav {
            flex-wrap: wrap;
            gap: 15px;
            padding: 18px 20px;
        }

        .main {
            padding: 25px 20px;
        }

        .cards {
            flex-direction: column;
        }

        .card {
            width: 100%;
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
        <h1>Welcome!</h1>

        <br>

        <div class="cards">

            <div class="card">
                <h3>Total of Users</h3>
                <h2><?php echo $totaluser?></h2>
            </div>

            <div class="card">
                <h3>Total of Not Approved Users</h3>
                <h2><?php echo $totalpending?></h2>
            </div>

            <div class="card">
                <h3>Total of Products</h3>
                <h2><?php echo $totalproduct?></h2>
            </div>

        </div>
    </div>

</body>
</html>
