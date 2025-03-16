<?php 
session_start();
$rec_err_array = array();
if (isset($_GET['err_array'])) {
  $rec_err_array = explode(',', $_GET['err_array']);
}
if (isset($_SESSION['ID'])) { 
  $name = $_SESSION['name'];
  echo '
  <script>
    window.onload = function() {
      document.getElementById("login_header_link").style.display = "none";
      document.getElementById("logout_header_link").style.display = "inline-block";
      alert("Welcome " + "'.$name.'" + "! You have successfully logged in");
    }
  </script>';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Electrical Panels</title>
  <link rel="stylesheet" href="Panels_css.css">
  <link rel="icon" href="data/ico.jfif">
</head>
<body>
  <header>
    <h1>Electrical Panels</h1>
    <nav>
      <a href="#products">Products</a>
      <a href="#sidebar" id="login_header_link" data-target="card-login" class="flip-link">Login</a>
      <a href="server_test.php?form_type=logout" id="logout_header_link" >Logout</a>
      <a href="#contact" id="contact_header_link" data-target="card-contact" class="flip-link">Contact Us</a>
    </nav>
  </header>

  <main>
    <section id="sidebar_login">
      <div class="sidebar" id="sidebar">
        <button class="toggle-btn" id="toggle-btn">◄</button>
        <div class="card">
          <div class="inner-box" id="card">
              <!-- Login Form -->
              <div class="card-login" id="card-login">
                  <h2>LOGIN</h2>
                  <form action="server_test.php" method="get" id="loginform">
                    <input type="hidden" name="form_type" value="login">
                    <input id="email_login" name="email" type="email" class="input-box" placeholder="Email" required>
                    <input id="password_login" name="password" type="password" class="input-box" placeholder="Password" required>
                    <button type="submit" class="submit-btn" onclick="logincookie()">Login</button>
                    <br><input type="checkbox" name="Remember me" id="remember_me" style="margin-top: 10px;"> Remember me
                    <p>Don't have an account? <a class="flip-link" id="signup_link" data-target="card-signup" href="#" >Sign Up</a></p>
                  </form>
              </div>

              <!-- Signup Form -->
              <div class="card-signup" id="card-signup">
                  <h2>SIGN UP</h2>
                  <form action="server_test.php" method="post" id="signupform">
                      <input type="hidden" name="form_type" value="signup">
                      <input id="username_signup" name="username" type="text" class="input-box" placeholder="Username" required>
                      <input id="email_signup" name="email" type="email" class="input-box" placeholder="Email" required>
                      <input id="password_signup" name="password" type="password" class="input-box" placeholder="Password" required>
                      <font style="color: brown;"><?php if(in_array("password",$rec_err_array)){echo "<br>Please enter more than 5 characters";} ?></font>
                      <button type="submit" class="submit-btn" id="signupbtn">Sign Up</button>
                      <p>Already have an account? <a class="flip-link" data-target="card-login" style="color: rgb(0, 20, 122);" href="#" onclick="flipCard()">Login</a></p>
                  </form>
              </div>

              <!-- Contact us Form -->
              <div class="card-contact" id="card-contact">
                <h2>Contact Us</h2>
                <form enctype="multipart/form-data" action="server_test.php" method="post">
                  <input type="hidden" name="form_type" value="contactus">
                  <input id="username_contact" name="username" type="text" class="input-box" placeholder="Name" required>
                  <input id="phoneNumber_contact" name="phoneNumber" type="tel" class="input-box" placeholder="Phone Number" required>
                  <input id="email_contact" name="email" type="email" class="input-box" placeholder="Email" required>
                  <textarea id="message_contact" name="message" class="input-box" placeholder="Message" required></textarea>
                  <label for="file_contact"><br>Or upload pdf file:</label>
                  <input id="avatar" class="view-details" name="avatar" type="file" class="input-box" accept=".pdf" required>
                  <button class="submit-btn"  type="submit">Send</button>
                </form>

              </div>
          </div>
      </div>
      </div>
    </section>


    <section id="products">
    <div class="overlay" id="overlay"></div>
    <div class="popuplogin" id="popuplogin">
        <p></p>
        <button class="view-details" id="open_login_sidebar">Login</button>
        <button class="view-details" onclick="closePopup()">Close</button>
    </div>
      <h2>Our Products</h2>
      <div class="product-list">
        <!-- Each product card -->
        <div class="product-card" data-id="1">
          <img id="flush" src="data/backgrounds/Capture8.PNG" alt="Energis-F" onmouseover ="backgroundChange2()" onmouseout="backgroundreset2()">
          <h3>Flush Panels</h3>
          <p>incoming 125A</p>
          <button class="view-details" onclick="viewDetails(1)">View More Details</button>
        </div>
        <div class="product-card" data-id="2" onmouseover="backgroundChange()" onmouseout="backgroundreset()">
          <img src="data/backgrounds/Capture1.PNG" alt="ATS">
          <h3>Surface Mounted Panels</h3>
          <p></p>
          <button class="view-details" onclick="viewDetails(2)">View More Details</button>
        </div>
        <div class="product-card" data-id="3">
          <img src="data/backgrounds/Capture12.PNG" alt="Wall Mounted Panels">
          <h3>Wall Mounted Panels</h3>
          <p></p>
          <button class="view-details" onclick="viewDetails(3)">View More Details</button>
        </div>
        <div class="product-card" data-id="4">
          <img src="data/backgrounds/Capture16.PNG" alt="Fan">
          <h3>Celling Double Fan</h3>
          <p></p>
          <button class="view-details" onclick="viewDetails(4)">View More Details</button>
        </div>
        <div class="product-card" data-id="5">
          <img src="data/backgrounds/Capture18.PNG" alt="Ventilation">
          <h3>Ventilation</h3>
          <p></p>
          <button class="view-details" onclick="viewDetails(5)">View More Details</button>
        </div>
      </div>
    </section>


  </main>

  <footer>
    <p>   &copy; 2024 Electrical Panels</p>
  </footer>

  <script src="Panels_JS.JS"></script>
</body>
</html>
