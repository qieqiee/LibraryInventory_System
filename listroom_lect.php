<?php

include("connect.php");
session_start();



$staffId = $_SESSION['staffId'];
$roomIds = $_SESSION['room_ids'];
$date = $_SESSION['date'];
$capacity = $_SESSION['capacity'];
$checkin = $_SESSION['checkin'];
$checkout = $_SESSION['checkout'];
// Initialize an array to store individual room IDs
$individualRoomIds = array();
$length=sizeof($roomIds);
if($length==0){
  echo"All room fully booked";
}
else{
  echo"";
}

// Loop through the room IDs and store them in separate variables
foreach ($roomIds as $index => $roomId) {
   $variableName = "room_$index"; // Create a variable name like room_0, room_1, etc.
    $$variableName = $roomId; // Create the variable with the dynamic name
    $individualRoomIds[] = $roomId; 
    // Store the ID in an array if needed
}


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
    /* Font */
@import url('https://fonts.googleapis.com/css?family=Quicksand:400,700');

/* Design */
*,
*::before,
*::after {
  box-sizing: border-box;
}

html {
  background-color: #ecf9ff;
}

body {
  color: #272727;
  font-family: 'Quicksand', serif;
  font-style: normal;
  font-weight: 400;
  letter-spacing: 0;
  padding: 1rem;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
}


    /* Nav ------------------------------------------- */

    .nav {
            position: relative;
            display: flex;
            align-items: center;
            width: 100%;
            z-index: 2;
        }
        .nav-3 {
            justify-content: space-between;
            border-bottom: 1px solid var(--color-flag);
        }

.main{
  max-width: 1200px;
  margin: 0 auto;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
}

h1 {
    font-size: 24px;
    font-weight: 400;
    text-align: center;
}

img {
  height: auto;
  max-width: 100%;
  vertical-align: middle;
}

.btn {
  color: #ffffff;
  padding: 0.8rem;
  font-size: 14px;
  text-transform: uppercase;
  border-radius: 4px;
  font-weight: 400;
  display: block;
  width: 100%;
  cursor: pointer;
  border: 1px solid rgba(255, 255, 255, 0.2);
  background: transparent;
}

.btn:hover {
  background-color: rgba(255, 255, 255, 0.12);
}

.cards {
  display: flex;
  flex-wrap: wrap;
  list-style: none;
  margin: 0;
  padding: 0;
  display: flex;
  flex-direction: row;
  align-items: center;
  justify-content: center;
}

.cards_item {
  display: flex;
  padding: 1rem;
}

@media (min-width: 40rem) {
  .cards_item {
    width: 50%;
  }
}

@media (min-width: 56rem) {
  .cards_item {
    width: 33.3333%;
  }
}

.card {
  background-color: white;
  border-radius: 0.25rem;
  box-shadow: 0 20px 40px -14px rgba(0, 0, 0, 0.25);
  display: flex;
  flex-direction: column;
  overflow: hidden;
}

.card_content {
  padding: 1rem;
  background: linear-gradient(to bottom left, #46494f 40%, #141415 100%);
}

.card_title {
  color: #ffffff;
  font-size: 1.1rem;
  font-weight: 700;
  letter-spacing: 1px;
  text-transform: capitalize;
  margin: 0px;
}

.card_text {
  color: #ffffff;
  font-size: 0.875rem;
  line-height: 1.5;
  margin-bottom: 1.25rem;    
  font-weight: 400;
}
.made_by{
  font-weight: 400;
  font-size: 13px;
  margin-top: 35px;
  text-align: center;
}
</style>

<body>
<nav class="nav nav-3">
    <a href="roomform_lect.php" class="btn-home">
        <i class="fa fa-chevron-left" aria-hidden="true"></i>
    </a>
</nav>
    <div class="main">
        <h1>MEETING ROOM</h1>
        <ul class="cards">
        <?php
$roomIds = $_SESSION['room_ids'];
$length = sizeof($roomIds);

for ($i = 0; $i <$length; $i++) {
    if ($roomIds[$i] == 'R01') {
        $sql = "SELECT * FROM `rooms` WHERE roomid = 'R01'";
    } elseif ($roomIds[$i] == 'R03') {
        $sql = "SELECT * FROM `rooms` WHERE roomid = 'R03'";
    } elseif ($roomIds[$i] == 'R04') {
        $sql = "SELECT * FROM `rooms` WHERE roomid = 'R04'";
    } else {
        continue; // Skip to the next iteration if no matching condition is found
    }

    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<li class='cards_item'>";
        echo "<div class='card'>";
        echo "<div class='card_image'><img src='" . $row['img'] . "'></div>";
        echo "<div class='card_content'>";
        echo "<h2 class='card_title'>" . $row['name'] . "</h2>";
        echo "<p class='card_text'>Capacity: " . $row['capacity'] . " person <br> Amenities: Projector, Whiteboard, Plugs</p>";
        echo "<form action='listroom_lect.php' method='post'><input type='hidden' value='" . $row['roomid'] . "' name='roomid'/><button class='btn card_btn' type='submit' name='book'>BOOK</button></form>";
        echo "</div>";
        echo "</div>";
        echo "</li>";
    }
}
?>

            
        </ul>
        <?php
        if(isset($_POST['book'])){
          $roomid=$_POST['roomid'];
          $sql2 = "INSERT INTO `roombook_lect` (`bookingid`, `date`, `checkin_time`, `checkout_time`, `staffId`, `roomid`) VALUES (NULL, '$date', '$checkin', '$checkout', '$staffId', '$roomid')";


          $result2 = mysqli_query($conn, $sql2);
          echo "<script>alert('Room successfully booked');</script>";
          echo "<script>window.location.href='roomform_lect.php';</script>";
        }
        
        ?>
        
      </div>
      
      
      <h3 class="made_by">Made with ♡</h3>
</body>