<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Start the session
session_start();

require "../dbconnect.php";

$firstname = $_SESSION['firstname'];
$othernames = $_SESSION['othernames'];
$user_id = $_SESSION['user_id'];

// Listening To submit button clicks
if (isset($_POST['vie-submit'])) {
    $election_id = $position_id = 0;
    $error = $success = "";

    $election_id = $_POST['election'];
    $position_id = $_POST['position'];

    // echo $election_id, "", $position_id;

    if (!is_numeric($election_id)) {
        $error = "An unexpected Error occured. Please try again.";
        exit;
    }
    if (!is_numeric($position_id)) {
        $error = "An unexpected Error occured. Please try again.";
        exit;
    }

    //check whether student has alreday registered for this election
    $sql = "SELECT * FROM candidate WHERE user__id=$user_id AND election_id=$election_id";
    $result = mysqli_query($dbconnect, $sql);
    $row = mysqli_num_rows($result);

    $row = mysqli_num_rows($result);
    //$success=$row;

    if ($row > 0) {
        $error = "<p style='color:red;'>You have already registred for this position.</p>";
    } else {
        //   saving data to database
        $sql = "INSERT INTO candidate (user__id,position_id, election_id) VALUES($user_id,$position_id,$election_id)";

        if ($dbconnect->query($sql) === TRUE) {
            $success = "<p style='color:green;'>You have successfully registered.</p>";
        } else {
            $error = "<p style='color:red;'> Error:" . $dbconnect->error . "</p>";
        }
    }
}


?>



<?php require("header.php") ?>



<div class="breadcome-area">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="breadcome-list">
                    <div class="row">
                        <div class="text-center m-b-md custom-login">
                            <h3 style="color: gold">REGISTER TO VIE</h3>
                        </div>
                        <div class="hpanel">
                            <div class="panel-body">
                                <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST" id="vieform">
                                    <div class="form-group">
                                        <label class="control-label" for="election">Election</label>
                                        <select name="election" id="election">
                                            <?php
                                            // Retrieving data from database
                                            $sql = "SELECT * FROM election WHERE active = 1 ";
                                            $result = mysqli_query($dbconnect, $sql);
                                            $election = mysqli_fetch_all($result, MYSQLI_ASSOC);

                                            foreach ($election as $elect) { ?>
                                                <option value="<?php echo $elect['id']; ?>"><?php echo $elect['name']; ?></option>
                                            <?php }

                                            ?>

                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="position">Position</label>
                                        <select name="position" id="position">
                                            <?php
                                            // Retrieving data from database
                                            $sql = "SELECT * FROM position ";
                                            $result = mysqli_query($dbconnect, $sql);
                                            $position = mysqli_fetch_all($result, MYSQLI_ASSOC);

                                            foreach ($position as $post) { ?>
                                                <option value="<?php echo $post['id']; ?>"><?php echo $post['name']; ?></option>
                                            <?php }

                                            ?>

                                        </select>
                                    </div>
                                    <?php if (isset($success)) : echo $success;
                                    endif; ?>
                                    <?php if (isset($error)) : echo $error;
                                    endif; ?>
                                    <input type="submit" id="vie-submit" name="vie-submit" value="Register" class="btn btn-success btn-block loginbtn" />

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php require("footer.php") ?>