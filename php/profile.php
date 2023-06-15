<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Profile</title>
    <link rel="stylesheet" href="../CSS/profile.css"/>
</head>
<body>
    <h1>Your Profile</h1>
    <div class="main-container">
        <?php
        session_start();
       include "db_connect.php";

        // Retrieve the username from the session
        if (isset($_SESSION['username'])) {
            $username = $_SESSION['username'];

            // SQL query to retrieve user data
            $query = "SELECT * FROM register WHERE username = '$username'";
            $result = $connection->query($query);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();

                $url = "../CSS/profile.css";
        	echo "<link rel='stylesheet' href='{$url}'>";

                echo '<div class="sub-container">';
                echo '<div class="container">';
                echo '<h4>Full Name:</h4>';
                echo '<p>' . $row['username'] . '</p>';
                echo '</div>';

                echo '<div class="container">';
                echo '<h4>Age:</h4>';
                echo '<p>' . $row['age'] . '</p>';
                echo '</div>';

                echo '<div class="container">';
                echo '<h4>Gender:</h4>';
                echo '<p>' . $row['gender'] . '</p>';
                echo '</div>';

                echo '<div class="container">';
                echo '<h4>Password:</h4>';
                echo '<p>' . $row['password'] . '</p>';
                echo '</div>';
                // echo '<button>Edit</button>';
                echo '</div>';
            }
        }

        ?>

        <div class="sub-container">

            <h2>Your Events:</h2>

            <?php
                include 'db_connect.php';
                include 'data.php';
                // Retrieve the username from the session
                $username = $_SESSION['username'];

                // Retrieve the event IDs associated with the user from the database
                $query = "SELECT event_id FROM user_events WHERE username = '$username'";
                $result = mysqli_query($connection, $query);

                if ($result) {
                    // Create an array to store the event IDs
                    $eventIds = array();

                    // Fetch the event IDs from the result
                    while ($row = mysqli_fetch_assoc($result)) {
                        $eventIds[] = $row['event_id'];
                    }

                    // Filter the events based on the event IDs from the database
                    $matchedEvents = array_filter($events, function($event) use ($eventIds) {
                        return in_array($event['id'], $eventIds);
                    });

                    foreach ($matchedEvents as $event) {
                        echo '<div class="card">';
                        echo '<div class="text-content">';
                        echo '<h2>'. $event['eventname'].'</h2>';
                        echo '<p>'. $event['description'] .'</p>';
                        echo '<form method="post" action="">';
                        echo '<input type="hidden" name="event_id" value="' . $event['id'] . '">';
                        echo '</form>';
                        echo '</div>';
                        echo '</div>';
                    }

                } else {
                    echo "Error: " . mysqli_error($connection);
                }
        ?>

        </div>
        
    </div>
</body>
</html>
