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

//Check if the user is already logged in
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

    // Insert the event and user association into the database
    $query = "INSERT INTO user_events(username, event_id) VALUES ('$username', '$eventId')";
    $result = mysqli_query($connection, $query);

    // Check if the query was successful
    if ($result) {
        echo "<h1 style='text-align:center; color:green'>Event joined successfully!</h1>";
    } else {
        echo "Error: " . mysqli_error($connection);
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
