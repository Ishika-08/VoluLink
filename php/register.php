<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/register.css"/>
    <title>Registration</title>
</head>
<body>
        <?php
        // Establish database connection
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "users";

        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        if (isset($_POST['username']) && isset($_POST['password'])) {
            // Retrieve the username and password from the registration form
            $username = $_POST['username'];
            $password = $_POST['password'];

            // SQL query to check if the user is already registered
            $check_query = "SELECT * FROM register WHERE username = '$username'";
            $check_result = $conn->query($check_query);

            if ($check_result->num_rows > 0) {
                // User is already registered
                echo "<h2 class='error'>The user is already registered</h2>";
            } else {
                // SQL query to insert the data into the database
                $insert_query = "INSERT INTO register (username, password) VALUES ('$username', '$password')";

                if ($conn->query($insert_query) === TRUE) {
                    // Registration successful, redirect to another page
                    header("Location: events.php");
                    exit();
                } else {
                    echo "Error: " . $insert_query . "<br>" . $conn->error;
                }
            }
        }
        
        $conn->close();
        ?>
        <div class="container">
        <h1>Welcome!</h1>
        <form method="post" action="register.php">
            <div>
                <label for="username">Username</label>
                <input type="text" name="username" id="username" autocomplete="off"/>
        
                <label for="password">Password</label>
                <input type="password" name="password" id="password" autocomplete="off"/>
        
                <button type="submit">Join</button>
            </div>
        </form>
    </div>
</body>
</html>
