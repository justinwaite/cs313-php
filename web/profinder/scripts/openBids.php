<?php
/**
 * Created by PhpStorm.
 * User: justin
 * Date: 10/22/16
 * Time: 1:47 PM
 */

session_start();

$servername = "us-cdbr-iron-east-04.cleardb.net";
$username = "b1633b6a10ff99";
$password = "8ad6b63d";
$dbName = "heroku_5866a6643d6eccb";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbName);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (!mysqli_select_db($conn, $dbName)) {
    die("Uh oh, couldn't select database $dbName");
}

$sql = "select b.cost, j.title, j.description from bid b join job j on j.id = b.job_id where b.accepted = 1 and placed_by = ". $_SESSION["user"]["id"];
$bids = mysqli_query($conn, $sql);

$results = [];
if ($bids != null && $bids->num_rows > 0) {
    while ($row = $bids->fetch_assoc()) {
        $results[] = $row;
    }
}
else
{
}

echo json_encode($results);

//echo json_encode($bids);
