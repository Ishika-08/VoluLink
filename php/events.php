<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../CSS/events.css"/>
</head>
<body>
    <div class="container">
        <nav>
            <h3>VoluLink</h3>
            <img src="../images/EventPage/user.png" alt="user-profile" onClick="window.location.href = 'profile.php'"/>
        </nav>
        <h1>Events</h1>

        <?php
        // Database connection details
        $host = 'localhost';
        $username = 'root';
        $password = '';
        $database = 'users';

        // Establish a database connection
        $connection = mysqli_connect($host, $username, $password, $database);

        // Check if the connection was successful
        if (!$connection) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Start or resume the session
        session_start();

        // Check if the user is already logged in
        if (!isset($_SESSION['username'])) {
            // Redirect the user to the login page if not logged in
            header("Location: login.php");
            exit();
        }

        // Include the data file
        include 'data.php';

        // Check if the form is submitted
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Retrieve the selected event from the form
            $eventId = $_POST['event_id'];

            // Retrieve the username from the session
            $username = $_SESSION['username'];

            // Check if the user has already joined the event
            $checkQuery = "SELECT * FROM user_events WHERE username = '$username' AND event_id = '$eventId'";
            $checkResult = mysqli_query($connection, $checkQuery);

            if (mysqli_num_rows($checkResult) > 0) {
                // User has already joined the event
                echo "<h1 style='text-align:center; color:red'>Already registered for this event!</h1>";
            } else {
                // User hasn't joined the event yet, insert the data
                $insertQuery = "INSERT INTO user_events(username, event_id) VALUES ('$username', '$eventId')";
                $insertResult = mysqli_query($connection, $insertQuery);

                // Check if the query was successful
                if ($insertResult) {
                    echo "<h1 style='text-align:center; color:green'>Event joined successfully!</h1>";
                } else {
                    echo "Error: " . mysqli_error($connection);
                }
            }
        }
        ?>

        <div>
            <?php
            foreach ($events as $event) {
                echo '<div class="card">';
                echo '<img src="' . $event['src'] . '" alt="' . $event['eventname'] . '"/>';
                echo '<div class="text-content">';
                echo '<h2>'. $event['eventname'].'</h2>';
                echo '<p>'. $event['description'] .'</p>';

                // Retrieve users participating in the event
                $eventId = $event['id'];
                $usersQuery = "SELECT register.username, register.age, register.gender FROM register INNER JOIN user_events ON register.username = user_events.username WHERE user_events.event_id = '$eventId'";
                $usersResult = mysqli_query($connection, $usersQuery);

                echo '<h4>Participants:</h4>';
                if (mysqli_num_rows($usersResult) > 0) {
                    echo '<table style="border: 1px solid;  width: 100%; text-align:center">';
                    echo '<thead>';
                    echo '<tr><th style="border: 1px solid">Username</th><th style="border: 1px solid">Age</th><th style="border: 1px solid">Gender</th></tr>';
                    echo '</thead>';
                    echo '<tbody>';
                    while ($row = mysqli_fetch_assoc($usersResult)) {
                        echo '<tr>';
                        echo '<td style="border: 1px solid">' . $row['username'] . '</td>';
                        echo '<td style="border: 1px solid">' . $row['age'] . '</td>';
                        echo '<td style="border: 1px solid">' . $row['gender'] . '</td>';
                        echo '</tr>';
                    }
                    echo '</tbody>';
                    echo '</table>';
                } else {
                    echo '<p>--</p>';
                }

                echo '<form method="post" action="">';
                echo '<input type="hidden" name="event_id" value="' . $event['id'] . '">';
                echo '<button type="submit">Join</button>';
                echo '</form>';
                echo '</div>';
                echo '</div>';
            }
            ?>
        </div>
    </div>
</body>
</html>
