<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);



require "dbconnect.php";

require("my_functions.php");

// Listening To submit button clicks
if (isset($_POST['login'])) {
  $email = $password = $login_success = $login_error = "";

  $email = $_POST['email'];
  $password = $_POST['password'];

  // XSS attacks prevention --> preventing sql attacks
  $email = sanitize($email);
  $password = sanitize($password);


  // Encrypt
  $password = crypt($password, "vote_22");

  // echo $email, $password;


  // Retrieving data from database
  $sql = "SELECT * FROM user WHERE emailaddress = '$email' ";
  $result = mysqli_query($dbconnect, $sql);

  // array containing user details fron the database
  $user = mysqli_fetch_assoc($result);


  // Password of user from database
  $pass_from_db = $user['userpassword'];
  // echo $pass_from_db, "------", $password;



  if ($pass_from_db == $password) {
    $login_success = "<p style='color:green' >Logged In Successfully</p>";
    // save user info on a session
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['firstname'] = $user['firstname'];
    $_SESSION['othernames'] = $user['othernames'];
    $_SESSION['emailaddress'] = $user['emailaddress'];
    $_SESSION['contact'] = $user['contact'];

    // Redirecting user to dahsboard once authentication is complete
    header('Location:template/index.php');
  } else {
    $login_error = "<p style='color:red' >Logging in Failed. Please try again</p>";
  }
}

?>

<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  <title>Login HERE</title>
  <meta name="description" content="" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <!-- favicon
		============================================ -->
  <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico" />
  <!-- Google Fonts
		============================================ -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet" />
  <!-- Bootstrap CSS
		============================================ -->
  <link rel="stylesheet" href="css/bootstrap.min.css" />
  <!-- Bootstrap CSS
		============================================ -->
  <link rel="stylesheet" href="css/font-awesome.min.css" />
  <!-- owl.carousel CSS
		============================================ -->
  <link rel="stylesheet" href="css/owl.carousel.css" />
  <link rel="stylesheet" href="css/owl.theme.css" />
  <link rel="stylesheet" href="css/owl.transitions.css" />
  <!-- animate CSS
		============================================ -->
  <link rel="stylesheet" href="css/animate.css" />
  <!-- normalize CSS
		============================================ -->
  <link rel="stylesheet" href="css/normalize.css" />
  <!-- main CSS
		============================================ -->
  <link rel="stylesheet" href="css/main.css" />
  <!-- morrisjs CSS
		============================================ -->
  <link rel="stylesheet" href="css/morrisjs/morris.css" />
  <!-- mCustomScrollbar CSS
		============================================ -->
  <link rel="stylesheet" href="css/scrollbar/jquery.mCustomScrollbar.min.css" />
  <!-- metisMenu CSS
		============================================ -->
  <link rel="stylesheet" href="css/metisMenu/metisMenu.min.css" />
  <link rel="stylesheet" href="css/metisMenu/metisMenu-vertical.css" />
  <!-- calendar CSS
		============================================ -->
  <link rel="stylesheet" href="css/calendar/fullcalendar.min.css" />
  <link rel="stylesheet" href="css/calendar/fullcalendar.print.min.css" />
  <!-- forms CSS
		============================================ -->
  <link rel="stylesheet" href="css/form/all-type-forms.css" />
  <!-- style CSS
		============================================ -->
  <link rel="stylesheet" href="style.css" />
  <!-- responsive CSS
		============================================ -->
  <link rel="stylesheet" href="css/responsive.css" />
  <!-- modernizr JS
		============================================ -->
  <script src="js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body>
  <div class="color-line"></div>
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="back-link back-backend">
          <a href="#" class="btn btn-primary">Back to Home</a>
        </div>
      </div>
    </div>
  </div>
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12"></div>
      <div class="col-md-4 col-md-4 col-sm-4 col-xs-12">
        <div class="text-center m-b-md custom-login">
          <h3 style="color: gold">PLEASE LOGIN TO VOTE</h3>
        </div>
        <div class="hpanel">
          <div class="panel-body">
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" id="loginForm">
              <div class="form-group">
                <label class="control-label" for="email">Email</label>
                <input type="email" placeholder="example@gmail.com" title="Please enter you email" required="required" value="" name="email" id="email" class="form-control" />
              </div>
              <div class="form-group">
                <label class="control-label" for="password">Password</label>
                <input type="password" title="Please enter your password" required="required" value="" name="password" id="password" class="form-control" />
              </div>

              <?php if (isset($login_success)) : echo $login_success;
              endif; ?>
              <?php if (isset($login_error)) : echo $login_error;
              endif; ?>
              <input type="submit" id="login" name="login" value=" Login" class="btn btn-success btn-block loginbtn" />
              <a class="btn btn-default btn-block" href="signup.php">Register</a>
            </form>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12"></div>
    </div>

    <?php require("template/footer.php") ?>