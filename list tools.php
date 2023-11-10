<?php

include("connect.php");
session_start();



$staffId = $_SESSION['staffId'];
$toolsids = $_SESSION['tool_ids'];
$type = $_SESSION['type'];
$borrowdate = $_SESSION['borrowdate'];
$returndate = $_SESSION['returndate'];
// Initialize an array to store individual room IDs
$individualRoomIds = array();
$length=sizeof($toolsids);
if($length==0){
  echo"All tools fully booked";
}
else{
  echo"";
}

// Loop through the room IDs and store them in separate variables
foreach ($toolsids as $index => $toolsid) {
   $variableName = "tool_$index"; // Create a variable name like room_0, room_1, etc.
    $$variableName = $toolsid; // Create the variable with the dynamic name
    $individualToolsIds[] = $toolsid; 
    // Store the ID in an array if needed
}

// Now you have separate variables like $room_0, $room_1, etc., each containing a room ID
// You can also use the $individualRoomIds array to access all the IDs

// Example: Accessing the first room ID
//echo "First room ID: $room_0<br>";
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
    <a href="tools form.php" class="btn-home">
        <i class="fa fa-chevron-left" aria-hidden="true"></i>
    </a>
</nav>
    <div class="main">
        <h1>TOOLS</h1>
        <ul class="cards">
          <?php
          $toolsids = $_SESSION['tool_ids'];
          $length = sizeof($toolsids);
          $tool_1 = array(); // Create an array to store room 1 values
          $tool_2 = array(); // Create an array to store room 2 values
          $tool_3 = array(); // Create an array to store other values
          $tool_4 = array(); 
          $tool_5 = array(); 
          $tool_6 = array(); 
          for ($i = 0; $i < $length; $i++) {
              if ($toolsids[$i] == 'TC01') {
                  $tool_1[] = $toolsids[$i];
                  $sql = "SELECT * FROM `tools` WHERE toolsid = '$tool_1[0]'";
                  $result = mysqli_query($conn, $sql);
                  while ($row = mysqli_fetch_assoc($result)) {
                    echo"<li class='cards_item'> ";
                    echo"<div class='card'>";
                    echo "<div class='card_image'><img src='".$row['img']."'></div>";
                    echo "<div class='card_content'>";
                      echo "<h2 class='card_title'>".$row['name'] ."</h2>";
                      echo "<p class='card_text'>Type: " .$row['type'] ."<br> The Nikon D850 is a top-tier DSLR camera known for its exceptional 45.7-megapixel image quality, 4K video, versatile ISO range, and high-speed autofocus. It's a professional-grade camera with a rugged build, tilting touchscreen, and dual memory card slots.</p>";
                    
                      echo "<form action='list tools.php' method='post' ><input type='hidden' value='$tool_1[0]' name='toolsid'/><button class='btn card_btn'  type='submit' name='book'>BOOK</button></form>";
                      
                    echo "</div>";
                  echo "</div>";
                echo "</li>";

                  }  
                 
              } elseif ($toolsids[$i] == 'TC02') {
                  $tool_2[] = $toolsids[$i];
                  $sql = "SELECT * FROM `tools` WHERE toolsid = '$tool_2[0]'";
                  $result = mysqli_query($conn, $sql);
                  while ($row = mysqli_fetch_assoc($result)) {
                    echo"<li class='cards_item'> ";
                    echo"<div class='card'>";
                    echo "<div class='card_image'><img src='".$row['img']."'></div>";
                    echo "<div class='card_content'>";
                      echo "<h2 class='card_title'>".$row['name'] ."</h2>";
                      echo "<p class='card_text'>Type: " .$row['type'] ."<br> The Canon EOS Rebel T7 is an entry-level DSLR camera, perfect for beginners and photography enthusiasts. It features a 24.1-megapixel sensor, Full HD video recording, and straightforward controls for easy use.</p>";
                      echo "<form action='list tools.php' method='post' ><input type='hidden' value='$tool_2[0]' name='toolsid'/><button class='btn card_btn' type='submit' name='book' >BOOK</button></form>";
                    echo "</div>";
                  echo "</div>";
                echo "</li>";}
                    }
               elseif ($toolsids[$i] == 'TC03') {
                  $tool_3[] = $toolsids[$i];
                  $sql = "SELECT * FROM `tools` WHERE toolsid = '$tool_3[0]'";
                  $result = mysqli_query($conn, $sql);
                  while ($row = mysqli_fetch_assoc($result)) {
                    echo"<li class='cards_item'> ";
                    echo"<div class='card'>";
                    echo "<div class='card_image'><img src='".$row['img']."'></div>";
                    echo "<div class='card_content'>";
                      echo "<h2 class='card_title'>".$row['name'] ."</h2>";
                      echo "<p class='card_text'>Type: " .$row['type'] ."<br>The Canon EOS 90D is a versatile DSLR camera with a 32.5-megapixel sensor, 4K video capabilities, and high-speed shooting. It's an excellent choice for photographers and videographers seeking advanced features in a compact package.</p>";
                      echo "<form action='list tools.php' method='post' ><input type='hidden' value='$tool_3[0]' name='toolsid'/><button class='btn card_btn' type='submit' name='book' >BOOK</button></form>";
                    echo "</div>";
                  echo "</div>";
                echo "</li>";
              }}
              elseif ($toolsids[$i] == 'TP01') {
                $tool_4[] = $toolsids[$i];
                $sql = "SELECT * FROM `tools` WHERE toolsid = '$tool_4[0]'";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                  echo"<li class='cards_item'> ";
                  echo"<div class='card'>";
                  echo "<div class='card_image'><img src='".$row['img']."'></div>";
                  echo "<div class='card_content'>";
                    echo "<h2 class='card_title'>".$row['name'] ."</h2>";
                    echo "<p class='card_text'>Type: " .$row['type'] ."<br>Is a short-throw interactive classroom projector with a bright 3500 lumens output. It's designed for educational environments, making it easy to project large, clear images from a short distance, facilitating interactive lessons and presentations.</p>";
                    echo "<form action='list tools.php' method='post' ><input type='hidden' value='$tool_4[0]' name='toolsid'/><button class='btn card_btn' type='submit' name='book' >BOOK</button></form>";
                  echo "</div>";
                echo "</div>";
              echo "</li>";
            }
          }
          elseif ($toolsids[$i] == 'TP02') {
            $tool_5[] = $toolsids[$i];
            $sql = "SELECT * FROM `tools` WHERE toolsid = '$tool_5[0]'";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
              echo"<li class='cards_item'> ";
              echo"<div class='card'>";
              echo "<div class='card_image'><img src='".$row['img']."'></div>";
              echo "<div class='card_content'>";
                echo "<h2 class='card_title'>".$row['name'] ."</h2>";
                echo "<p class='card_text'>Type: " .$row['type'] ."<br> Its high-resolution, brightness, and laser technology ensure clear, vibrant visuals. With quick on/off capabilities, energy efficiency, and potential for interactivity, it's a reliable, cost-effective choice for engaging and accessible teaching and learning experiences..</p>";
                echo "<form action='list tools.php' method='post' ><input type='hidden' value='$tool_5[0]' name='toolsid'/><button class='btn card_btn' type='submit' name='book' >BOOK</button></form>";
              echo "</div>";
            echo "</div>";
          echo "</li>";
        }
      }

      elseif ($toolsids[$i] == 'TP03') {
        $tool_6[] = $toolsids[$i];
        $sql = "SELECT * FROM `tools` WHERE toolsid = '$tool_6[0]'";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
          echo"<li class='cards_item'> ";
          echo"<div class='card'>";
          echo "<div class='card_image'><img src='".$row['img']."'></div>";
          echo "<div class='card_content'>";
            echo "<h2 class='card_title'>".$row['name'] ."</h2>";
            echo "<p class='card_text'>Type: " .$row['type'] ."<br>  With 3000 ANSI lumens, it offers bright and clear visuals. In the educational context, its short-throw capability minimizes shadows, making it perfect for interactive classrooms. Its versatility and high brightness enhance engagement in educational presentations and lectures.</p>";
            echo "<form action='list tools.php' method='post' ><input type='hidden' value='$tool_6[0]' name='toolsid'/><button class='btn card_btn' type='submit' name='book' >BOOK</button></form>";
          echo "</div>";
        echo "</div>";
      echo "</li>";
    }
  }
        }
          ?> 
            
        </ul>
        <?php
        if(isset($_POST['book'])){
          $toolsid=$_POST['toolsid'];
          $sql2 = "INSERT INTO `toolsbook` (`toolsbook_id`, `borrowdate`, `returndate`, `toolsid`, `staffId`) VALUES (NULL, '$borrowdate', '$returndate', '$toolsid', '$staffId')";


          $result2 = mysqli_query($conn, $sql2);
          echo "<script>alert('Tools successfully booked');</script>";
          echo "<script>window.location.href='tools form.php';</script>";
        }
        
        ?>
        
      </div>
      
      
      <h3 class="made_by">Made with ♡</h3>
</body>