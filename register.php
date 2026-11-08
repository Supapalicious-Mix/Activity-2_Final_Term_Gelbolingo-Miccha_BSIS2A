
<?php
    require_once "config.php";
    
 

    $mess = [];
    $errors = [];

    if($_SERVER['REQUEST_METHOD'] === "POST"){
        $uname = trim($_POST['uname']);
        $password = $_POST['password'];
        $password2 = $_POST['password2'];
        
        if($password === $password2){

            // Check if username already exists
            $check = $conn->prepare("SELECT id FROM users WHERE username=?");
            $check->bind_param('s', $uname);
            $check->execute();
            $check->store_result();

            if($check->num_rows > 0){
                $errors[] = "Username already exists. Please choose another.";
            }else{

                $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?,?)");
                $stmt->bind_param('ss', $uname, $password);

                if($stmt->execute()){
                    $mess[] = "Registered successfully. Please wait for admin approval of your account.";
                }else{
                    $errors[] = "Something went wrong. Please try again later.";
                }

                $stmt->close();
            }

            $check->close();

        }else{
            $errors[] = "Passwords should match.";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REGISTER</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: linear-gradient(135deg, #0f172a, #1e3a8a);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .register-container {
            background: white;
            width: 100%;
            max-width: 420px;
            padding: 40px 35px;
            border-radius: 15px;
            box-shadow: 0 15px 40px rgba(0,0,0,0.25);
        }

        h1 {
            color: #1e3a8a;
            font-size: 28px;
            margin-bottom: 10px;
            text-align: center;
        }

        h2 {
            color: #64748b;
            font-size: 15px;
            font-weight: normal;
            text-align: center;
            margin-bottom: 30px;
        }

        label {
            display: block;
            color: #334155;
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 8px;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 13px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            font-size: 15px;
            outline: none;
            transition: 0.3s;
        }

        input[type="text"]:focus,
        input[type="password"]:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37,99,235,0.15);
        }

        input[type="submit"] {
            width: 100%;
            padding: 13px;
            background: #2563eb;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }

        input[type="submit"]:hover {
            background: #1d4ed8;
        }

        .error-message {
            background: #fee2e2;
            color: #b91c1c;
            border: 1px solid #fecaca;
            padding: 10px;
            border-radius: 6px;
            font-size: 13px;
            margin-bottom: 10px;
            text-align: center;
        }

        .success-message {
            background: #dcfce7;
            color: #15803d;
            border: 1px solid #bbf7d0;
            padding: 10px;
            border-radius: 6px;
            font-size: 13px;
            margin-bottom: 10px;
            text-align: center;
        }

        .login-link {
            text-align: center;
            color: #64748b;
            font-size: 14px;
            margin-top: 20px;
        }

        .login-link a {
            color: #2563eb;
            font-weight: bold;
            text-decoration: none;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        @media (max-width: 480px) {
            .register-container {
                padding: 30px 22px;
            }

            h1 {
                font-size: 24px;
            }
        }
    </style>
</head>

<body>

    <div class="register-container">

        <h1>Perfume Inventory System</h1>
        <h2>Create Your Account</h2>

        <?php foreach ($errors as $e): ?>
            <p class="error-message"><?= h($e) ?></p>
        <?php endforeach; ?>

        <?php foreach ($mess as $m): ?>
            <p class="success-message"><?= h($m) ?></p>
        <?php endforeach; ?>

        <form action="" method="post">

            <label for="uname">Username:</label>
            <input type="text" name="uname" id="uname"
                   placeholder="Enter Username" required autofocus>

            <br><br>

            <label for="password">Password:</label>
            <input type="password" name="password" id="password"
                   placeholder="Enter Password" required>

            <br><br>

            <label for="password2">Re-enter Password:</label>
            <input type="password" name="password2" id="password2"
                   placeholder="Re-enter Password" required>

            <br><br>

            <input type="submit" value="Register">

        </form>

        <p class="login-link">
            Already have an Account? <a href="index.php">Sign In</a>
        </p>

    </div>

</body>
</html>
