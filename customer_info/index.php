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
<?php
  $number_of_seats = count($_POST["seat"]); 
  echo $number_of_seats.'<br>';
  echo '<input type="text" name="seat" value="'.$number_of_seats.'" ><br>';
  for($i=0;$i<$number_of_seats;$i++){
    echo '<input type="text" name="seat" value="'.$_POST["seat"][$i].'" ><br>';
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
  <style>
  .error {color: red;}
  </style>
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
        <?php
// define variables and set to empty values
$nameErr = $genderErr = $phonenoErr = $age ="";
$name = $email = $gender = $phoneno = $ageErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  } else {
    $name = test_input($_POST["name"]);
  }
    
  if (empty($_POST["phoneno"])) {
    $phonenoErr = "";
  } else {
    $phoneno = test_input($_POST["phoneno"]);
  }

  if (empty($_POST["age"])) {
    $ageErr = "Age is required";
  } else {
    $age = test_input($_POST["age"]);
  }

  if (empty($_POST["gender"])) {
    $genderErr = "Gender is required";
  } else {
    $gender = test_input($_POST["gender"]);
  }
  
}
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<h1>Passenger Information</h1>

<?php
$i=1;
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bus_service_system";
$conn = new mysqli($servername, $username, $password, $dbname);
while ($i<=3){

 echo '  <div class="form">
 <h3>Passenger '.$i.'</h3>
 <br>
 <form method="post" action="./">
  Name <input type="text" name="name">
  <span class="error">* <?php echo $nameErr;?></span>
  <br><br>
  Age <input type="number" name="age">
  <span class="error">*<?php echo $ageErr;?></span>
  <br><br>
  Gender
  <br>
  <input type="radio" name="gender" value="0"> Female
  <br>
  <input type="radio" name="gender" value="1"> Male
  <br>
  <input type="radio" name="gender" value="2"> Other
  <span class="error">* <?php echo $genderErr;?></span>
  <br><br>
  Phone Number <input type="mobile" name="phoneno">
  <span class="error"><?php echo $phonenoErr;?></span>
  <br><br>
 </div>';
 $i=$i+1;

}
// $sql = "INSERT INTO `customers` (`customerId`, `name`, `phoneNumber`, `bookingId`, `seatAlloted`, `age`, `gender`) 
// VALUES( 1, $name, $phoneno, 1, 1,$age, $gender);";
// $conn->query($sql);
echo '
<button class="main__btndate" type="submit">Proceed to pay</button>
</form>';
?>




    </body>
    </html>