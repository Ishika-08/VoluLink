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
        <h1>Events</h1>

        <div>
       <?php
// Include the data file
include 'data.php';

// Generate HTML
foreach ($events as $event) {

    echo '<div class="card">';
        echo '<img src="' . $event['src'] . '" alt="' . $event['eventname'] . '"/>';
            echo '<div class="text-content">';
                    echo '<h2>'. $event['eventname'].'</h2>';
                    echo '<p>'. $event['description'] .'</p>';
                    echo '<button>Join</button>';
            echo '</div>';
    echo '</div>';
}
?>


            
        </div>
    </div>
</body>
</html>