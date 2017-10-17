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
    // $sql = "SELECT id, firstName, lastName FROM User";
    // $result = $conn->query($sql);
    
    // if ($result->num_rows > 0) {
    //     // output data of each row
    //     while($row = $result->fetch_assoc()) {
    //         echo "user id: ".$row["id"] . ": ".$row["firstName"]. " ".$row["lastName"]."<br>";
    //     }
    // } else {
    //     echo "0 results";
    // }
        $sql = "SELECT deviceName, deviceType, status FROM Device";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo "Device: ".$row["deviceName"] . ": ".$row["deviceType"]. " ".$row["status"]."<br>";
            }
        } 
        else {
            echo "0 results";
        }
    
    $conn->close();
?>

<?php
    function displayDevices() {
        $sql = "SELECT deviceName, deviceType, status FROM Device";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo "user id: ".$row["deviceName"] . ": ".$row["deviceType"]. " ".$row["status"]."<br>";
            }
        } 
        else {
            echo "0 results";
        }
    }


?>

<!DOCTYPE html>
<html>
    <head>
        <title>Tech Checkout</title>
        <style type="text/css">
           @import url("styles.css"); 
        </style>
          
    </head>
    <body>
         <h1> Technology Checkout</h1>
         <form>
        
            <td>Device:
    
            <input Type="text" name ="deviceName" placeholder ="Device Name" >
             Type: 
             <select name="deviceType" >
                 <option value = "">Select One</option>
                 <?=getDeviceTypes()?>
             </select>
             
             <input type= "checkbox" name= "available" id ="available" value="available">
             <label for="available" > Available</label>
             
             <input type= "checkbox" name= "sort" id ="sort" value="sort">
             <label for="sort" > Sort By Price</label>
             
              <input type= "checkbox" name= "sort1" id ="sort1" value="sort1">
             <label for="sort1" > Sort By Name</label>
             
             <input type="submit" name ="submit" value="Search"/></td>
         </form>
         <br /><hr><br />
         
         <form action="displayCart.php">
           <?=displayDevices()?>  
           <br />
           <input type="submit" value="Continue">
         </form>  
        
    </body>
</html>