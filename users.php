
<?php
    require_once "config.php";

    if(!isset($_SESSION['user_id']) || !isset($_SESSION['username']) || !isset($_SESSION['role'])){
        header("location: index.php");
        exit();
    }

    if($_SESSION['role'] !== 'admin'){
         header("location: dashboard.php");
         exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>

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
        color: #2563eb;
        text-decoration: underline;
    }

    /* Main Content */
    .main {
        padding: 40px;
    }

    .main h1 {
        color: #1e3a8a;
        font-size: 30px;
        margin-bottom: 20px;
    }

    /* Table */
    table {
        border-collapse: collapse;
        width: 100%;
        max-width: 1100px;
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
        padding: 9px 18px;
        border-radius: 6px;
        background-color: #2563eb;
        color: white;
        font-size: 13px;
        font-weight: bold;
        cursor: pointer;
        transition: 0.3s;
    }

    button:hover {
        background-color: #1e40af;
        transform: translateY(-2px);
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
        }

        .main h1 {
            font-size: 25px;
        }

        table {
            min-width: 650px;
        }

        .main {
            overflow-x: auto;
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

    <div class="main">
        <h1>User Management</h1>
        <br>

        <table>
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Status</th>
                    <th>Role</th>
                    <th>Date Created</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                <?php
                    $fetchquery = "SELECT * FROM users";

                    $fetch = mysqli_query($conn, $fetchquery);

                    if(mysqli_num_rows($fetch)>0){
                        while($user = mysqli_fetch_assoc($fetch)){
                ?>
                <tr>
                    <td><?php echo $user['username'];?></td>
                    <td><?php echo $user['status'];?></td>
                    <td><?php echo $user['role'];?></td>
                    <td><?php echo $user['created_at'];?></td>

                    <td>
                        <?php if($user['status'] !== 'approved'): ?>
                        <button onclick="window.location.href='approve.php?userid=<?php echo $user['id']; ?>'">Approve</button>

                        <?php elseif($user['status'] === 'approved'):?>
                        <button onclick="window.location.href='disable.php?userid=<?php echo $user['id']; ?>'">Disable</button>
                        <?php endif;?>
                    </td>
                </tr>

                <?php
                        }
                    }
                    else{
                ?>
                <tr>
                    <td colspan="5">No User Found.</td>
                </tr>

                <?php
                    }
                ?>
            </tbody>
        </table>
    </div>

</body>
</html>
