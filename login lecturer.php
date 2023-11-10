<?php
if (isset($_SESSION['staffId'])) {
    // Unset all session variables
    $_SESSION = array();

    // Destroy the session
    session_destroy();
}

session_start();
include("connect.php");

?>


<!DOCTYPE html>
<html>
	<head>
		<title>Lecturer Login</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width,initial-scale=1.0">
		<style>
          @import url('https://fonts.googleapis.com/css?family=Roboto:300');

* {
  box-sizing: border-box;
}

body {
  font-family: 'Roboto', sans-serif;
  font-weight: 300;
  background: #f7f6f6;
  color: #101010;
  overflow: hidden;
}

h1,
h2,
h3,
h4,
h5,
h6 {
  font-weight: 300;
}

#wrapper {
  display: flex;
  flex-direction: row;
}

#left {
  display: flex;
  flex-direction: column;
  flex: 1;
  align-items: center;
  justify-content: center;
  height: 100vh;
}

#right {
  flex: 1;
}

/* Sign In */
#signin {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  width: 80%;
  padding-bottom: 1rem;
}

#signin form {
  width: 80%;
  padding-bottom: 3rem;
}

#signin .logo {
  margin-bottom: 8vh;
}

#signin .logo img {
  width: 150px;
}

#signin label {
  font-size: 0.9rem;
  line-height: 2rem;
  font-weight: 500;
}

#signin .text-input {
  margin-bottom: 1.3rem;
  width: 100%;
  border-radius: 2px;
  background: #ffffff;
  border: 1px solid #555;
  color: #090909;
  padding: 0.5rem 1rem;
  line-height: 1.3rem;
}

#signin .primary-btn {
  width: 100%;
}

#signin .secondary-btn,
.or,
.links {
  width: 60%;
}

#signin .links a {
  display: block;
  color: #fff;
  text-decoration: none;
  margin-bottom: 1rem;
  text-align: center;
  font-size: 0.9rem;
}

#signin .or {
  display: flex;
  flex-direction: row;
  margin-bottom: 1.2rem;
  align-items: center;
}

#signin .or .bar {
  flex: auto;
  border: none;
  height: 1px;
  background: #262424;
}

#signin .or span {
  color: #ccc;
  padding: 0 0.8rem;
}

/* Showcase */
#showcase {
  display: flex;
  justify-content: center;
  align-items: center;
  background: url('https://i.pinimg.com/564x/c0/88/93/c08893b86f5baaf6749700afbad3772e.jpg') no-repeat center center / cover;
  height: 100vh;
  text-align: center;
}

#showcase .showcase-text {
  font-size: 3rem;
  width: 100%;
  color: #faf7f7;
  margin-bottom: 1.5rem;
}

/* Button */
.primary-btn {
  padding: 0.7rem 1rem;
  height: 2.7rem;
  display: block;
  border: 0;
  border-radius: 2px;
  font-weight: 500;
  background: #f96816;
  color: #fff;
  text-decoration: none;
  cursor: pointer;
  text-align: center;
  transition: all 0.5s;
}

.primary-btn:hover {
  background-color: #ff7b39;
}

.secondary-btn {
  padding: 0.7rem 1rem;
  height: 2.7rem;
  display: block;
  border: 1px solid #d19a23;
  border-radius: 2px;
  font-weight: 500;
  background: none;
  color: #d8d229;
  text-decoration: none;
  cursor: pointer;
  text-align: center;
  transition: all 0.5s;
}

.secondary-btn:hover {
  border-color: #757c0d;
  color: #a4b810;
}

/* Media Queries */
@media (min-width: 1200px) {
  #left {
    flex: 4;
  }

  #right {
    flex: 6;
  }
}

@media (max-width: 768px) {
  body {
    overflow: auto;
  }

  #right {
    display: none;
  }

  #left {
    justify-content: start;
    margin-top: 4vh;
  }

  #signin .logo {
    margin-bottom: 2vh;
  }

  #signin .text-input {
    margin-bottom: 0.7rem;
  }

  #main-footer {
    padding-top: 1rem;
  }
}

		</style>
	</head>
	
	<body>

  <?php
    if($_SERVER["REQUEST_METHOD"] == "POST") {
      $staffId = filter_input(INPUT_POST, "staffId", FILTER_SANITIZE_SPECIAL_CHARS);
      $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);

      if(empty($staffId) || empty($password)) {
        echo "Please enter both Staff Id and password";
      } else {
        //Check if the staff Id and password match your database
      
        $query = "SELECT * FROM lecturers WHERE staffId = '$staffId' AND password = '$password'";
        $result = mysqli_query($conn, $query);
        
        if($result) {
            $row = mysqli_fetch_assoc($result); // Fetch a row from the result set
        
            if($row) {
                // Login successful
                $_SESSION['staffId'] = $_POST['staffId'];
                header("Location: example.html");
                exit(); // Make sure to exit after a header redirect
            } else {
                // Staff Id and/or password are incorrect
                echo "Incorrect Staff ID or Password";
            }
        } else {
            // Error in the SQL query
            echo "Error in SQL query: " . mysqli_error($conn);
        }
      }
    }
  ?>

		<div id="wrapper">
            <div id="left">
              <div id="signin">
                <div class="logo">
                  <img src="https://cdn-icons-png.flaticon.com/512/234/234723.png">
                </div>
                <form action="login lecturer.php" method="post">
                  <div>
                    <label>staff ID </label>
                    <input type="text" class="text-input" name="staffId"/>
                  </div>
                  <div>
                    <label>Password </label>
                    <input type="password" class="text-input" name="password"/>
                  </div>
                  <button type="submit" class="primary-btn">Log in</button>
                </form>
                <div class="or">
                  <hr class="bar" />
                  <span>♡</span>
                  <hr class="bar" />
                </div>
              </div>
            </div>
            <div id="right">
              <div id="showcase">
                <div class="showcase-content">
                  <h1 class="showcase-text">
                    LIBRARY <strong>INVENTORY</strong> MANAGEMENT SYSTEM 
                </div>
              </div>
            </div>
          </div>
	</body>
</html>
 