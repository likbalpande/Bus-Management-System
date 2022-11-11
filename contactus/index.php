<?php
    $auth=false;
    session_start();
    if(isset($_SESSION['userId'])){
        echo('User SignedIn<br>');
        $auth = true;
    }
    else{
        echo('User NOT SignedIn');
    }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SSL BUS Services</title>
    <link rel="stylesheet" href="styles1.css" />
    <link
      rel="stylesheet"
      href="https://use.fontawesome.com/releases/v5.14.0/css/all.css"
      integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc"
      crossorigin="anonymous"
    />
    <link
      href="https://fonts.googleapis.com/css2?family=Kumbh+Sans:wght@400;700&display=swap"
      rel="stylesheet"
    />
  </head>
  <script src="routes/routes.js"></script>
  <body>
    <!-- Navbar Section -->
    <nav class="navbar">
            <div class="navbar__container">
                <a href="/SSL-Project" id="navbar__logo"><i class="fas fa-bus"></i>SSL Bus Services</a>
                <div class="navbar__toggle" id="mobile-menu">
                <span class="bar"></span> <span class="bar"></span>
                <span class="bar"></span>
                </div>
                <ul class="navbar__menu">
                  <?php
                      if($auth){
                      echo('
                          <li class="navbar__item">
                              <a href="/SSL-Project/routes" class="navbar__links">Booking&nbsp;History</a>
                          </li>
                          <li class="navbar__item">
                              <a href="/SSL-Project" class="navbar__links">Home</a>
                          </li>
                          <li class="navbar__item">
                            <a href="/SSL-Project/routes" class="navbar__links">Search&nbsp;Route</a>
                          </li>
                          ');
                      }
                      else{
                          echo('
                          <li class="navbar__item">
                          <a href="/SSL-Project/signin/index.php" class="navbar__links">Log&nbsp;In</a>
                          </li>
                          <li class="navbar__item">
                              <a href="/SSL-Project" class="navbar__links">Home</a>
                          </li>
                          <li class="navbar__item">
                            <a href="/SSL-Project/routes" class="navbar__links">Search&nbsp;Route</a>
                          </li>
                      ');
                      }
                      // <!-- <li class="navbar__btn"><a href="/" class="button">BUS TICKETS</a></li> -->
                      echo('
                      <li class="navbar__item">
                          <a href="/SSL-Project" class="navbar__links">About&nbsp;Us</a>
                      </li>
                      ');
                      if($auth){
                      echo('
                        <li class="navbar_item profileSection">
                          <img src="https://cdn.iconscout.com/icon/free/png-256/profile-417-1163876.png" alt="Avatar" class="avatar">
                          <div class="profileContent">
                              <div class="profileMenuContent">Edit Profile</div>
                              <div class="profileMenuContent">Bookings</div>
                              <div class="profileMenuContent">Bus&nbsp;Pass</div>
                              <div class="profileMenuContent">Help</div>
                              <div class="profileMenuContent"><a href="/SSL-Project/signin/index.php">Logout</a></div>
                          </div>
                        </li>
                      ');
                      }
                  ?>
                </ul>
            </div>
        </nav>
       <h1> CONTACT US </h1><br>
    <div class="row">
       <div class="column1" style="background-color:#aaa;">
         <i style="font-size:24px" class="fa">&#xf0e0; <a href="mailto:ssl@gmail.com">EMAIL</a></i>
         <br>
         <br>
         <br>
         <i style="font-size:24px" class="fa">&#xf095; <a href="tel:9813456789">CONTACT NUMBER</a> : </i>  
       </div>
      <div class="column2" style="background-color:#bbb;">
          <form>
            <label for="name">NAME</label><br>
            <input type="text" id="name" name="name"><br>
            <label for="email">EMAIL</label><br>
            <input type="email" id="email" name="email"><br>
            <label for="comp">COMPLAINT</label><br>
            <textarea id="comp" name="comp" rows="4" cols="50"></textarea> 
            <br> <br>

            <input type="submit" id="s" name="s"><br> 
          </form>   

      </div>
    </div>
    <br>
    <br>
    <br>
   
    </body>             

</html>