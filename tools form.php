<?php
session_start();
include("connect.php");
unset($_SESSION['toolsids']);
unset($_SESSION['borrowdate']);
unset($_SESSION['returndate']);
unset($_SESSION['type']);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Document</title>
</head>
    <style>
    body {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
    background-image: url('https://i.pinimg.com/564x/c0/88/93/c08893b86f5baaf6749700afbad3772e.jpg');
}

.container {
    text-align: center;
    padding: 100px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    background-color: #f9f9f9;
}

form {
    max-width: 400px;
    margin: 0 auto;
}

h1 {
    margin-top: 5px;
}

label, input {
    display: block;
    margin: 10px 0;
}

button {
    display: inline-block;
    background-color: #007BFF;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}
.button-home {
            background-color: red;
            border: 1px solid #ddd;
            color: white;
            padding: 10px 20px;
    }
    </style>
    <body>
        <a href="example.html" class="button-home">
            <i class="fa fa-chevron-left" aria-hidden="true"></i>
         </a>
        
        
        <div class="container">
            <form id="booking-form" method="post" action="tools form.php">
                <h1>Tools Booking</h1>
                <label for="borrowdate">Borrow Date:</label>
                <input type="date" id="borrowdate" name="borrowdate" required>
                <label for="returndate">Return Date:</label>
                <input type="date" id="returndate" name="returndate" required>
                <label for="type">Select a type:</label>
                <select name="type" id="type" required>
                    <option value="camera">Camera</option>
                    <option value="projector">Projector</option>
                </select>
                <button type="submit" name="submitbutton">Search Tool</button>
            </form>
        </div>
    </body>
    <?php
       if(isset($_POST['submitbutton'])){
        $borrowdate = $_POST["borrowdate"];
        $returndate = $_POST["returndate"];
        $type = $_POST["type"];
        
        // Convert borrowdate and returndate to datetime if needed
        $borrowdate_datetime = date("Y-m-d H:i:s", strtotime($borrowdate));
        $returndate_datetime = date("Y-m-d H:i:s", strtotime($returndate));
        
          // Query to find available rooms
          $sql = "SELECT * FROM tools
          WHERE toolsid NOT IN (
              SELECT toolsid FROM toolsbook
              WHERE (DATE(borrowdate) <= '$borrowdate_datetime' AND DATE(returndate) >= '$borrowdate_datetime')
              OR (DATE(borrowdate) <= '$returndate_datetime' AND DATE(returndate) >= '$returndate_datetime')
              OR (DATE(borrowdate) >= '$borrowdate_datetime' AND DATE(returndate) <= '$returndate_datetime')
          )
          AND type = '$type'";  

        $result = mysqli_query($conn, $sql);

        if (!empty($result)) {
            $toolsids = array(); // Initialize an array to store room IDs

            while ($row = mysqli_fetch_assoc($result)) {
                $toolsids[] = $row['toolsid']; // Store room IDs in the array
            }

            $_SESSION['tool_ids'] = $toolsids;  
            $_SESSION['borrowdate'] = $borrowdate_datetime; 
            $_SESSION['returndate'] = $returndate_datetime; 
            $_SESSION['type'] = $type; // Store the array in a session variable
            header("Location: list tools.php");
            
            
        } else {
            echo "<script>alert('Room fully booked');</script>";
        }


        //  header("Location: list room.php");         
        }//
        ?>

   
    

  