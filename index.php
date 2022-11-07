<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SSL BUS Services</title>
    <link rel="stylesheet" href="styles.css" />
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

  
  <?php

    function test_input($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }

    $auth = false;
    if (isset($_SERVER["HTTP_REFERER"]) and strpos($_SERVER["HTTP_REFERER"], "/SSL-Project/signin")) {
      // echo'<div>**********From signin***********</div>';
    }
    else{
      // echo'<div>********Not from signin*******</div>';
    }
    if (isset($_SERVER["HTTP_REFERER"]) and strpos($_SERVER["HTTP_REFERER"], "/SSL-Project/signin/register.php")) {
      // echo'<div>**********From register***********</div>';
      session_start();
      include('./db.php');
      // $passHash=password_hash(test_input($_POST["password"]), PASSWORD_DEFAULT);
      $passHash=$_POST["password"];
      $userName=test_input($_POST["username"]);
      $firstName=test_input($_POST["firstName"]);
      $sql="INSERT INTO users(userName, pass_word, firstName) VALUES('".$userName."', '".$passHash."', '".$firstName."');";
      if(isset($_POST["email"]) && isset($_POST["lastName"])){
        $sql="INSERT INTO users(userName, pass_word, firstName, lastName, email) VALUES('".$userName."', '".$passHash."', '".$firstName."', '".test_input($_POST["lastName"])."', '".test_input($_POST["email"])."'); ";
      }
      else if(isset($_POST["email"])){
        $sql="INSERT INTO users(userName, pass_word, firstName, email) VALUES('".$userName."', '".$passHash."', '".$firstName."', '".test_input($_POST["email"])."'); ";
      }
      else if(isset($_POST["lastName"])){
        $sql="INSERT INTO users(userName, pass_word, firstName, lastName) VALUES('".$userName."', '".$passHash."', '".$firstName."', '".test_input($_POST["lastName"])."'); ";
      }
      mysqli_query($conn,$sql);
      $sql1="SELECT userId AS id FROM users WHERE userName ='".$userName."' AND pass_word = '".$passHash."' ;";
      $user=mysqli_query($conn,$sql1);
      $count=mysqli_num_rows($user);
      if ($count>0) {
          while($row=mysqli_fetch_assoc($user)){
              $_SESSION["userId"] = $row['id'];
          }
          // echo('user id '.$_SESSION["userId"].'::');
          $_SESSION["username"] = $userName;
          $_SESSION["password"] = $passHash;
      }
    }
    else{
      // echo'<div>********Not from register*******</div>';
    }
  ?>

  <?php
    if (session_status() != PHP_SESSION_ACTIVE)session_start();
    if(isset($_SESSION['userId'])){
      // echo('User SignedIn<br>');
      // echo('UserId '.$_SESSION['userId'].'<br>');
      $auth = true;
    }
    else{
      // echo('User NOT SignedIn');
    }

  ?>
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
                          <div class="profileMenuContent"><a href="/SSL-Project/bus_pass/index.php">Bus&nbsp;Pass</a></div>
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

    <!-- Hero Section -->
    <div class="main">
      <div class="main__container">
        <div class="main__content">
          <h1>SSL BUS SERVICES</h1>
          <br><br><br><br><br><br>
          <main>
            <form action="/SSL-project/routes/index.php#availableRoutes" method="get" style="width:100%;">
                <div class="searchSection">
                    <div class="searchContainer">
                        <div id="search-from">
                            <h3>Boarding City &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Destination city</h3>
                            <?php 
                                if(array_key_exists('fromCity', $_GET)) {
                                    echo('
                                        <input id="input-from" class="main__btn" value="'.$_GET["fromCity"].'" type="text"  placeholder=" FROM" onkeyup="javascript:searchPlaces(\'from\',this.value)" name="fromCity" required>
                                    ');
                                }
                                else{
                                    echo('
                                        <input id="input-from" class="main__btn" type="text" size="16" placeholder=" FROM" onkeyup="javascript:searchPlaces(\'from\',this.value)" name="fromCity" required>
                                    ');
                                }
                            ?>

                            <span id="from-suggestions"></span>
                            <button  class="main__btndate" onclick="javascript:swapToAndFrom(event)">
                                <i class="fa-duotone fa-arrow-right-arrow-left" style="color:green;height:20px;width:20px;"></i>
                                Swap
                            </button>
                            <?php 
                                if(array_key_exists('toCity', $_GET)) {
                                    echo('
                                        <input id="input-to" class="main__btn" value="'.$_GET["toCity"].'" type="text" size="16" placeholder=" TO" onkeyup="javascript:searchPlaces(\'to\',this.value)" name="toCity" required>
                                    ');
                                }
                                else{
                                    echo('
                                        <input id="input-to" class="main__btn" type="text" size="16" placeholder=" TO" onkeyup="javascript:searchPlaces(\'to\',this.value)" name="toCity" required>
                                    ');
                                }
                            ?>
                            <span id="to-suggestions"></span>

                            <?php
                                if(array_key_exists('date', $_GET)) {
                                    echo('
                                        <input id="date" class="main__btn" type="date" value="'.$_GET["date"].'" class="search-date" name="date" required>
                                    ');
                                }
                                else{
                                    echo('
                                        <input id="date" class="main__btndate" type="date" class="search-date" name="date" required>
                                    ');
                                }
                            ?>
                            <button class="main__btn" type="submit">Search Buses</button>
                        </div>
                    </div>
                </div>
            <!-- </form>  -->
        </main>

        </div>
        <!--<div class="main__img--container">
          <img id="main__img" src="alienuforetro-1952pd.svg" />
        </div>-->
      </div>
    </div>

    <!-- Services Section -->
    <div class="services">
      <div class="services__container">
        <div class="services__card">
          <h2>Already booked tickets?</h2>
          <p>See tickets here</p>
          <button>BUS TICKETS</button>
        </div>
        <div class="services__card">
          <h2>Are you a freqeunt traveller?</h2>
          <p>Better purchase a bus pass</p>
          <button>BUS PASS</button>
        </div>
      </div>
    </div>

    <!-- Footer Section -->
    <div class="footer__container">
      <div class="footer__links">
        <div class="footer__link--wrapper">
          <div class="footer__link--items">
            <h2>About Us</h2>
            <a href="/">About&nbsp;Us</a>
            <a href="/">Routes</a> 
            <a href="/">Bus&nbsp;Pass</a>
            <a href="/">Help</a> 
          </div>
          <div class="footer__link--items">
            <h2>Contact Us</h2>
            <a href="/">Contact</a>
            <a href="/">Support</a>
            <a href="/">FAQs</a>
          </div>
        </div>
        <div class="footer__link--wrapper">

          <div class="footer__link--items">
            <h2>More</h2>
            <a href="/">Enquiry</a>
            <a href="/">Become&nbsp;Partner</a>
            <a href="/">Book&nbsp;ticket</a>
          </div>
        </div>
      </div>
      <section class="social__media">
        <div class="social__media--wrap">
          <div class="footer__logo">
            <a href="/SSL-Project/index.php" id="footer__logo"><i class="fas fa-bus"></i>SSL BUS SERVICE</a>
          </div>
          <p class="website__rights">© SSL 2022. All rights reserved</p>
          <div class="social__icons">
            <a
              class="social__icon--link"
              href="https://www.facebook.com/iitdharwadofficial/"
              target="_blank"
              aria-label="Facebook"
            >
              <i class="fab fa-facebook"></i>
            </a>
            <a
              class="social__icon--link"
              href="https://www.instagram.com/cdc.iitdh/?hl=en"
              target="_blank"
              aria-label="Instagram"
            >
              <i class="fab fa-instagram"></i>
            </a>
            <a
              class="social__icon--link"
              href="https://www.youtube.com/c/iitdharwadofficialchannel"
              target="_blank"
              aria-label="Youtube"
            >
              <i class="fab fa-youtube"></i>
            </a>
            <a
              class="social__icon--link"
              href="https://twitter.com/iitdhrwd?lang=en"
              target="_blank"
              aria-label="Twitter"
            >
              <i class="fab fa-twitter"></i>
            </a>
            <a
              class="social__icon--link"
              href="https://www.linkedin.com/company/iit-dharwad/"
              target="_blank"
              aria-label="LinkedIn"
            >
              <i class="fab fa-linkedin"></i>
            </a>
          </div>
        </div>
      </section>
    </div>

    <script src="app.js"></script>
  </body>
</html>