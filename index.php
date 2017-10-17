<?php
    //connect to our mysql database server
    //make a query
    $servername = 'us-cdbr-iron-east-05.cleardb.net';
    $username = "b4b2c44328820e";
    $password = "27966c6b";
    $dbname = "heroku_ec49987c2231ba0";
    //create connection
// Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
    // make a query 
    $sql = "SELECT id, firstName, lastName FROM User";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "user id: ".$row["id"] . ": ".$row["firstName"]. " ".$row["lastName"]."<br>";
        }
    } else {
        echo "0 results";
    }
    
    $conn->close();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Tech Checkout</title>
    </head>
    <body>
        
    </body>
</html>