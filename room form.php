<?php
session_start();
include("connect.php");
unset($_SESSION['room_ids']);
unset($_SESSION['date']);
unset($_SESSION['checkin']);
unset($_SESSION['checkout']);
unset($_SESSION['capacity']);

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
.button-home i {
        }

    </style>
    <body>

    <a href="INDEX.html" class="button-home">
        <i class="fa fa-chevron-left" aria-hidden="true"></i>
    </a>
        
        <div class="container">
            <form id="booking-form" method="post" action="room form.php">
                <h1>Room Booking</h1>
                <label for="date">Date:</label>
                <input type="date" id="date" name="date" required>
                <label for="check-in">Check-in Time:</label>
                <input type="time" id="checkin" name="checkin" required>
                <label for="check-out">Check-out Time:</label>
                <input type="time" id="checkout" name="checkout" required>
                <label for="capacity">Person Capacity:</label>
                <input type="number" id="capacity" name="capacity" min="1" required>
                
                <button type="submit" name="submitbutton">Search Room</button>
              
                
            </form>
        </div>
    </body>
    <?php
        if(isset($_POST['submitbutton'])){
          $date = $_POST["date"];
          $checkin = $_POST["checkin"];
          $checkout = $_POST["checkout"];
          $capacity = $_POST["capacity"];

          // Assuming you have a function to convert time inputs to a datetime range
        $checkin_datetime = date("Y-m-d H:i:s", strtotime($date . ' ' . $checkin));
        $checkout_datetime = date("Y-m-d H:i:s", strtotime($date . ' ' . $checkout));

        $sql = "SELECT * FROM rooms
        WHERE roomid NOT IN (
            SELECT roomid FROM roombook_stud
            WHERE (
                (checkin_time <= '$checkin_datetime' AND checkout_time >= '$checkin_datetime')
                OR (checkin_time <= '$checkout_datetime' AND checkout_time >= '$checkout_datetime')
                OR (checkin_time >= '$checkin_datetime' AND checkout_time <= '$checkout_datetime')
            )
            UNION
            SELECT roomid FROM roombook_lect
            WHERE (
                (checkin_time <= '$checkin_datetime' AND checkout_time >= '$checkin_datetime')
                OR (checkin_time <= '$checkout_datetime' AND checkout_time >= '$checkout_datetime')
                OR (checkin_time >= '$checkin_datetime' AND checkout_time <= '$checkout_datetime')
            )
        )
        AND capacity >= $capacity";

        $result = mysqli_query($conn, $sql);

        if (!empty($result)) {
            $roomids = array(); // Initialize an array to store room IDs

            while ($row = mysqli_fetch_assoc($result)) {
             $roomIds[] = $row['roomid']; 
             echo$row['roomid'];// Store room IDs in the array
            }

                $_SESSION['room_ids'] = $roomIds;
                $_SESSION['date'] = $date;
                $_SESSION['checkin'] = $checkin_datetime;
                $_SESSION['checkout'] = $checkout_datetime;
                $_SESSION['capacity'] = $capacity;
                
                header("Location: list room.php");
            
            
        } else {
            echo "<script>alert('Room fully booked');</script>";
        }
    }
                ?>