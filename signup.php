<?php
// error_reporting(E_ALL);
ini_set('display_errors', 1);

require "dbconnect.php";

// assigning variables values once the submit button has been clicked
if (isset($_POST['submit'])) {
    // initialising variables to a default value

    $firstname = $surname = $email = $password = "";
    $phonenumber = 0;

    $firstname = $_POST['fname'];
    $surname = $_POST['surname'];
    $phonenumber = $_POST['phonenumber'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // echo  $firstname, $surname, $email, $phonenumber, $password;

    // inputs array
    $error = array("firstname" => "", "surname" => "", "phonenumber" => "", "email" => "", "password" => "", "general" => "");

    $success = "";

    // Form Validation
    if (empty($firstname)) {
        $error["firstname"] = "<p style='color:red;'>Please enter Your Name </p>";
    } else {
        //treats all tags received as normal texts...prevents xss attacks
        $firstname = htmlspecialchars($firstname);

        //Checking a parameter by use of regular expressions
        if (!preg_match("/^([a-zA-Z' ]+)$/", "$firstname")) {
            $error["firstname"] = "<p style='color:red;'>Please use lettters a to z only </p>";
        }
    }

    if (empty($surname)) {
        $error["surname"] = "<p style='color:red;'>Please enter Your surname </p>";
    } else {
        $surname = htmlspecialchars($surname);

        // Checking surname
        if (!preg_match("/^([a-zA-Z' ]+)$/", "$surname")) {
            $error["surname"] = "<p style='color:red;'>Please use lettters a to z only </p>";
        }
    }

    if (empty($phonenumber)) {
        $error["phonenumber"] = "<p style='color:red;'>Please enter Your phone number </p>";
    } else {
        $phonenumber = htmlspecialchars($phonenumber);

        // Validating Phone Number
        // if(preg_match('/^[0-9]{10}+$/', $phone)) {
        //     echo "Valid Phone Number";
        //     } else {
        //     echo "Invalid Phone Number";
        // }

        // checking whether phone number is a number
        if (!is_numeric($phonenumber)) {
            $error["phonenumber"] = "<p style='color:red;'>Phone Number must be numbers between 0 to 9 </p>";
        }
        // checking whether phone number is of valid length
        if (strlen($phonenumber) != 10) {
            $error["phonenumber"] = "<p style='color:red;'>Phone Number must have ten digits</p>";
        }
    }

    if (empty($email)) {
        $error["email"] = "<p style='color:red;'>Please enter Your email </p>";
    } else {
        $email = htmlspecialchars($email);

        // Checking email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error["email"] = "<p style='color:red;'>Invalid email address ,($email) </p>";
        }
    }

    if (empty($password)) {
        $error["password"] = "<p style='color:red;'>Please enter Your password </p>";
    } else {
        $password = htmlspecialchars($password);
        if (!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,12}$/', $password)) {
            $error["password "] = 'the password does not meet the requirements!';
        }
        $password = crypt($password, "vote_22");
    }

    // echo empty($error) ;
    if (empty($error)) {
        $error["general"] = "<p style='color:red;' > Please handle the errors before proceeding  </p>";
    } else {
        $sql = "INSERT INTO user(firstname,othernames,contact,emailaddress,userpassword) VALUES('$firstname','$surname',$phonenumber,'$email','$password')";

        if (mysqli_query($dbconnect, $sql)) {
            $success = "<p style='color:green;'>Successful Signup!Now you can login" . "</p>";
        } else {
            $error['general'] = "<p style='color:red;'> Error: " . $dbconnect->error . "</p>";
        }

        mysqli_close($dbconnect);
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
    <link rel="stylesheet" href="styles.css" />
    <style media="screen"></style>
    <!-- <script type="text/javascript" src="./app.js" defer ></script> -->
</head>

<body>
    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    <form action="#" method="post" id="register">
        <h3>SignUp Here</h3>

        <!--  name attribute to pick data from the field targeted -->
        <label for="firstname">First name</label>
        <input type="text" placeholder="Atoti" id="fname" name="fname" maxlength="15" value="<?php if (isset($firstname)) {
                                                                                                    echo $firstname;
                                                                                                } ?>">
        <?php if (isset($error['firstname'])) {
            echo $error['firstname'];
        } ?>
        <div id="fname-error" style="color:red"></div>

        <label for="surname">Surname</label>
        <input type="text" placeholder="Mkenya" id="surname" name="surname" maxlength="15" value="<?php if (isset($surname)) {
                                                                                                        echo $surname;
                                                                                                    } ?>">
        <?php if (isset($error['surname'])) {
            echo $error['surname'];
        } ?>
        <div id="surname-error" style="color:red"></div>

        <label for="phonenumber">Phone Number</label>
        <input type="number" placeholder="07********" id="phonenumber" name="phonenumber" max="0799999999" min="0100000000" value="<?php if (isset($phonenumber)) {
                                                                                                                                        echo $phonenumber;
                                                                                                                                    } ?>">
        <?php if (isset($error['phonenumber'])) {
            echo $error['phonenumber'];
        } ?>
        <div id="phonenumber-error" style="color:red"></div>

        <label for="email">Email Address</label>
        <input type="email" placeholder="example@gmail.com" id="email" name="email" autocomplete="off" value="<?php if (isset($email)) {
                                                                                                                    echo $email;
                                                                                                                } ?>">
        <?php if (isset($error['email'])) {
            echo $error['email'];
        } ?>
        <div id="email-error" style="color:red"></div>

        <label for="password">Password</label>
        <input type="password" placeholder="P*******d" id="password" name="password" value="<?php if (isset($password)) {
                                                                                                echo $password;
                                                                                            } ?>">
        <?php if (isset($error['password'])) {
            echo $error['password'];
        } ?>
        <div id="password-error" style="color:red"></div>
        <br />

        <?php if (isset($error['general'])) {
            echo $error['general'];
        } ?>
        <?php if (isset($success)) {
            echo $success;
        } ?>

        <input type="submit" id="submit" name="submit" value="SignUp" />
        <div class="social">
            <div class="go"><i class="fab fa-google"></i> Google</div>
            <div class="fb"><i class="fab fa-facebook"></i> Facebook</div>
        </div>
    </form>
</body>

</html>