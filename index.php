<?php
//     //connect to our mysql database server
//     //make a query
//     $servername = 'us-cdbr-iron-east-05.cleardb.net';
//     $username = "b4b2c44328820e";
//     $password = "27966c6b";
//     $dbname = "heroku_ec49987c2231ba0";
//     //create connection
// // Create connection
//     $conn = new mysqli($servername, $username, $password, $dbname);
    
//     // Check connection
//     if ($conn->connect_error) {
//         die("Connection failed: " . $conn->connect_error);
//     } 
//     // make a query 
  
//         $sql = "SELECT deviceName, deviceType, status FROM Device";
//         $result = $conn->query($sql);
        
//         if ($result->num_rows > 0) {
//             // output data of each row
//             while($row = $result->fetch_assoc()) {
//                 echo "Device: ".$row["deviceName"] . ": ".$row["deviceType"]. " ".$row["status"]."<br>";
//             }
//         } 
//         else {
//             echo "0 results";
//         }
    
//     $conn->close();
    include 'databaseConnection.php';
    $dbConn = getDatabaseConnection("heroku_ec49987c2231ba0");

    function getDeviceTypes(){
        global $dbConn;
        $sql = "SELECT DISTINCT(deviceType) 
                FROM Device
                ORDER BY deviceType" ;
          $statement= $dbConn->prepare($sql); 
          $statement->execute();
          $records = $statement->fetchALL(PDO::FETCH_ASSOC);  
          
          foreach($records as $record) {
              
              echo "<table>";
              echo "<tr>";
              echo "<option value='" . $record['deviceType'] . "'>" .
              $record['deviceType'] . "</option>";
              echo "</tr>";
              echo "</table>";
          }
    }
    
    function displayDevices() {
        global $dbConn;
        $sql = "SELECT * FROM Device WHERE 1 " ;
                if (isset($_GET['submit']))
                {
                    $namedParameters = array();
                    
                    if (!empty($_GET['deviceName'])){
                       $sql = $sql . " AND deviceName LIKE  :deviceName ";
                       $namedParameters[':deviceName'] = "%" . $_GET['deviceName'] . "%";
                    }
                    if(!empty($_GET['deviceType'])){
                        $sql = $sql . " AND deviceType = :deviceType";
                        $namedParameters[':deviceType'] = $_GET['deviceType'];
                    }
                    if(isset($_GET['available']))
                    {
                        $sql = $sql . " AND status = :status";
                        $namedParameters[':status'] = "available";
                    }
                    if(isset($_GET['price']))
                    {
                        $sql = $sql . " AND price = :price";
                        $namedParameters[':price']=$_GET['price'];
                    }
                }
                    if(isset($_GET['sort']))
                    {
                        $sortN = $_GET['sort'];
                        if($sortN = 'pricehigh')
                            {
                            $sql= $sql . 'ORDER BY price DESC';
                            }
                    }
                         if(isset($_GET['sort1']))
                         
                        {
                        $sortN1 = $_GET['sort1'];
                        
                        if ($sortN1='device')
                        {
                            $sql=$sql . 'ORDER BY deviceName';
                        }
                        
                        }
          $statement= $dbConn->prepare($sql); 
          $statement->execute($namedParameters); //Always pass the named parameters, if any
          $records = $statement->fetchAll(PDO::FETCH_ASSOC);  
          
          echo '<table>';
          foreach($records as $record) {
              echo '<tr>';
              echo "<input type='checkbox' name='cart[]'value =" . $record['deviceId'] . ">";
              echo $record['deviceName'] . " - ". $record['deviceType'] .  " - ". $record['status'] . "<br/> ";
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