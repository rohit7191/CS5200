<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "moviedb";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }
//
// $sql = "SELECT username from users where user_id = 1";
// $result = $conn->query($sql);
//
// if ($result->num_rows > 0) {
//     // output data of each row
//     while($row = $result->fetch_assoc()) {
//         // echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
//         //
//         echo "name: " . $row["username"];
//     }
// } else {
//     echo "0 results";
// }
//
session_start();
if(isset($_SESSION['POST']))
    $post = $_SESSION['POST'];
if(isset($post['username']) && $post['username'] != NULL) {
    $loggedin = $post['username'];
    $userid = $post['userid'];
    $role = $post['role'];
    $fname = $post['fname'];
}
?>
