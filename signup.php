<?php
    // assigning variables values once the save button has been clicked
    if(isset($_POST['save'])){
        // initialising variables to a default value
        $firstname = $surname = $email = $password = ""; 
        $phonenumber = 0; 

        $firstname = $_POST['fname'];
        $surname = $_POST['surname'];
        $phonenumber = $_POST['phonenumber'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        // inputs array
        $error = array("firstname"=>"","surname"=>"","phonenumber"=>"","email"=>"","password"=>"","general"=>"");

        $success = "";


        // Form Validation
        if(empty($firstname)){
            $error ["firstname"] = "<p style='color:red;'>Please enter Your Name </p>";
        }else{
            //treats all tags received as normal texts...prevents xss attacks
            $firstname = htmlspecialchars($firstname);

            //Checking a parameter by use of regular expressions
            if(!preg_match("/^([a-zA-Z' ]+)$/","$firstname")){
            $error ["firstname"] ="<p style='color:red;'>Please use lettters a to z only </p>";
            }
        }
        if(empty($surname)){
            $error ["surname"] ="<p style='color:red;'>Please enter Your surname </p>";
        }else{
            $surname = htmlspecialchars($surname);

            // Checking surname
            if(!preg_match("/^([a-zA-Z' ]+)$/","$surname")){
                $error ["surname"] = "<p style='color:red;'>Please use lettters a to z only </p>";
            }
        }
        if(empty($phonenumber)){
            $error ["phonenumber"] = "<p style='color:red;'>Please enter Your phone number </p>";
        }else{
            $phonenumber = htmlspecialchars($phonenumber);

            // Validating Phone Number
            // if(preg_match('/^[0-9]{10}+$/', $phone)) {
            //     echo "Valid Phone Number";
            //     } else {
            //     echo "Invalid Phone Number";
            // }

            // checking whether phone number is a number
            if(!is_numeric($phonenumber)){
                $error ["phonenumber"] ="<p style='color:red;'>Phone Number must be numbers between 0 to 9 </p>";
            }
            // checking whether phone number is of valid length
            if(strlen($phonenumber) != 10){
                $error ["phonenumber"] = "<p style='color:red;'>Phone Number must have ten digits</p>";
            }
        }
        if(empty($email)){
            $error ["email"] = "<p style='color:red;'>Please enter Your email </p>";
        }else{
            $email = htmlspecialchars($email);

            // Checking email
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error ["email"] = "<p style='color:red;'>Invalid email address ,($email) </p>";   
            }
        }
        if(empty($password)){
            $error ["password"] = "<p style='color:red;'>Please enter Your password </p>";
        }else{
            $password = htmlspecialchars($password);

            // Checking Password
            if(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,12}$/', $password)) {
                $error ["password "] = 'the password does not meet the requirements!';
            }
        }
        if(count($error)){
            $error ["general"] = "<p style='color:red;' > Please handle the errors before proceeding  </p>";
        }else{
           $success =  "<p style='color:green;' > Successful Signup!!! <a>Log In</a> </p>";

        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Design by foolishdeveloper.com -->
    <title>Sign Up Form</title>
 
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <!--Stylesheet-->
    <style media="screen">
      *,
*:before,
*:after{
    padding: 0;
    margin: 0;
    box-sizing: border-box;
}
body{
    background-color: #080710;
}
.background{
    width: 430px;
    height: 520px;
    position: absolute;
    transform: translate(-50%,-50%);
    left: 50%;
    top: 50%;
}
.background .shape{
    height: 200px;
    width: 200px;
    position: absolute;
    border-radius: 50%;
}
.shape:first-child{
    background: linear-gradient(
        #1845ad,
        #23a2f6
    );
    left: -80px;
    top: -80px;
}
.shape:last-child{
    background: linear-gradient(
        to right,
        #ff512f,
        #f09819
    );
    right: -30px;
    bottom: -80px;
}
form{
    /* height: 520px; */
    width: 400px;
    /* overflow: scroll; */
    background-color: rgba(255,255,255,0.13);
    position: absolute;
    transform: translate(-50%,-50%);
    top: 50%;
    left: 50%;
    border-radius: 10px;
    backdrop-filter: blur(10px);
    border: 2px solid rgba(255,255,255,0.1);
    box-shadow: 0 0 40px rgba(8,7,16,0.6);
    padding: 50px 35px;
}
form *{
    font-family: 'Poppins',sans-serif;
    color: #ffffff;
    letter-spacing: 0.5px;
    outline: none;
    border: none;
}
form h3{
    font-size: 32px;
    font-weight: 500;
    line-height: 42px;
    text-align: center;
}

label{
    display: block;
    margin-top: 30px;
    font-size: 16px;
    font-weight: 500;
}
input{
    display: block;
    height: 50px;
    width: 100%;
    background-color: rgba(255,255,255,0.07);
    border-radius: 3px;
    padding: 0 10px;
    margin-top: 8px;
    font-size: 14px;
    font-weight: 300;
}
::placeholder{
    color: #e5e5e5;
}
input [type="submit" i]{
    margin-top: 50px;
    width: 100%;
    background-color: #ffffff;
    color: #080710;
    padding: 15px 0;
    font-size: 18px;
    font-weight: 600;
    border-radius: 5px;
    cursor: pointer;
}
.social{
  margin-top: 30px;
  display: flex;
}
.social div{
  background: red;
  width: 150px;
  border-radius: 3px;
  padding: 5px 10px 10px 5px;
  background-color: rgba(255,255,255,0.27);
  color: #eaf0fb;
  text-align: center;
}
.social div:hover{
  background-color: rgba(255,255,255,0.47);
}
.social .fb{
  margin-left: 25px;
}
.social i{
  margin-right: 4px;
}

    </style>
</head>
<body>
    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    <form action="app.php" method="post" >
        <h3>SignUp Here</h3>

        <!--  name attribute to pick data from the field targeted -->
        <label for="firstname">First name</label>
        <input type="text" placeholder="Atoti" id="fname" name="fname" value="<?php if(isset($firstname)){echo $firstname;} ?>" >
        <?php if(isset($error['firstname'])){echo $error['firstname'];} ?>

        <label for="surname">Surname</label>
        <input type="text" placeholder="Mkenya" id="surname" name="surname" value="<?php if(isset($surname)){echo $surname;} ?>" >
        <?php if(isset($error['surname'])){echo $error['surname'];} ?>

        <label for="phonenumber">Phone Number</label>
        <input type="number" placeholder="07********" id="phonenumber" name="phonenumber" value="<?php if(isset($phonenumber)){echo $phonenumber;} ?>" >
        <?php if(isset($error['phonenumber'])){echo $error['phonenumber'];} ?>

        <label for="email">Email Address</label>
        <input type="text" placeholder="example@gmail.com" id="email" name="email" value="<?php if(isset($email)){echo $email;} ?>" >
        <?php if(isset($error['email'])){echo $error['email'];} ?>

        <label for="password">Password</label>
        <input type="password" placeholder="P*******d" id="password" name="password" value="<?php if(isset($password)){echo $password;} ?>" >
        <?php if(isset($error['password'])){echo $error['password'];} ?>
        <br/>

        <?php if(isset($error['general'])){echo $error['general'];} ?>
        <?php if(isset($success)){echo $success;} ?>

        <input  type="submit" id="save" name="save"  value="SignUp" />
        <div class="social">
          <div class="go"><i class="fab fa-google"></i>  Google</div>
          <div class="fb"><i class="fab fa-facebook"></i>  Facebook</div>
        </div>
    </form>
</body>
</html>
