<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/login.css"/>
    <title>Login</title>
</head>
<body>
    <div class="container">
        <?php
        session_start();
        include 'db_connect.php';

        if (isset($_POST['username']) && isset($_POST['password'])) {
            // Retrieve the username and password from the login form
            $username = $_POST['username'];
            $password = $_POST['password'];

            // SQL query to check if the username and password are valid
            $sql = "SELECT * FROM register WHERE username = '$username' AND password = '$password'";
            $result = $connection->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $_SESSION['username'] = $username;
                header("Location: events.php");
            } else {
                // Invalid credentials, login failed
                echo '<h4 style="color: red; text-align: center">Invalid username or password.</h4>';
            }
        }
        
        ?>
        <h1>Welcome Back!</h1>
        <form method="post" action="login.php">
            <div>
                <label for="username">Username</label>
                <input type="text" name="username" id="username" autocomplete="off"/>

                <label for="password">Password</label>
                <input type="password" name="password" id="password" autocomplete="off"/>

                <button type="submit">Login</button>
            </div>
        </form>
    </div>
</body>
</html>
