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


        <div class="container">

        <?php
            include 'db_connect.php';

            if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['gender'])) {
                // Retrieve the username and password from the registration form
                $username = $_POST['username'];
                $password = $_POST['password'];
                $age = $_POST['age'];
                $gender = $_POST['gender'];

                // SQL query to check if the user is already registered
                $check_query = "SELECT * FROM register WHERE username = '$username'";
                $check_result = $connection->query($check_query);

                if ($check_result->num_rows > 0) {
                    // User is already registered
                    echo "<h3 style='color: red; text-align: center'>The Usename already exists choose another one.</h3>";
                } else {
                    // SQL query to insert the data into the database
                    $insert_query = "INSERT INTO register (username, age, gender, password) VALUES ('$username', '$age', '$gender', '$password')";

                    if ($connection->query($insert_query) === TRUE) {
                        // Registration successful, redirect to another page
                        header("Location: login.php");
                        exit();
                    } else {
                        echo "Error: " . $insert_query . "<br>" . $connection->error;
                    }
                }
            }

        ?>
        
        <h1>Welcome!</h1>
        <form method="post" action="register.php">
            <div>
                <label for="username">Full Name</label>
                <input type="text" name="username" id="username" autocomplete="off"/>

                <label for="age">Age</label>
                <input type="number" name="age" id="age"/>

                <label for="gender">Gender</label>
                <select name="gender" id="gender">
                    <option value="--"> ------</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>    

                <label for="password">Password</label>
                <input type="password" name="password" id="password" autocomplete="off"/>
        
                <button type="submit">Join</button>
            </div>
        </form>
    </div>
</body>
</html>
