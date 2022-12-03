<?php
    // Starting new session
    session_start();
    // Unset all session variables
    $_SESSION = array();
    // Check whether or not the num_of_friends session variable exists
    if (!isset($_SESSION["num_of_friends"]) && empty($_SESSION["num_of_friends"])) {
        // Creating and initiliazing the num_of_friends session variable
        $_SESSION["num_of_friends"] = 0;
    }
    // Assign the value to $user_friends_count
    $user_friends_count = $_SESSION["num_of_friends"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Simplified Social Network Application - Sign Up</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link href="framework/css/style.css" rel="stylesheet">
    <!-- Bootstrap -->
    <link href="framework/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
<div>
<nav class="navbar sticky-top navbar-expand-lg bg-dark navbar-dark">
    <div class="container-fluid">
        <a class="navbar-brand ps-3" href="index.php">
            <img src="images/lg.png" alt="Logo" style="height:35px;">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <a class="nav-item nav-link active ps-4" href="login.php">Log In<span class="sr-only"></span></a>
                    <a class="nav-item nav-link active ps-4" href="signup.php">Sign Up<span class="sr-only"></span></a>
                    <a class="nav-item nav-link active ps-4" href="about.php">About Us<span class="sr-only"></span></a>
                    <a class="nav-item nav-link active ps-4" href="friendlist.php">Friend List<span class="sr-only"></span></a>
                    <a class="nav-item nav-link active ps-4" href="friendadd.php">Add Friend<span class="sr-only"></span></a>
                    <li class="nav-item dropdown ps-4">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Support
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#">Help Centre</a></li>
                        <li><a class="dropdown-item" href="#">Support Inbox</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#">Report a Problem</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
        <h2 class="py-2 text-center">project - Simplified Social Network Application - Sign Up</h2>
            <?php
                require_once("settings.php");
                // Connects to MySQL server
                $conn = @mysqli_connect($host, $username, $password, $sql_database_name)
                        or die("<p>Unable to connect to database server.</p>");
                
                // Linked to validateInput function in order to validate the input data
                validateInput($conn);

                // sanitiseInput function in order to sanitise the input before system process
                function sanitiseInput($data) {
                    // Delete trailing or leading the spaces
                    $data = trim($data);
                    // Delete backslashes in front of the quotes
                    $data = stripslashes($data);
                    // HTML encode in order to prevent html injection
                    $data = htmlspecialchars($data);
                    return $data;
                }
                
                // validateInput function in order to validate the input
                function validateInput($conn)
                {
                    // error_message to store the error messages
                    $error_message = "";
                    // At first we assume that there are no errors
                    $result = true;
                    
                    $ExistenceOfUser = false;
                    // Assign the current server date
                    $currentDate = date("Y-m-d");
                    // Stores form data in an associative array
                    $details_Of_Profile = array(
                        "email_address" => "",
                        "password" => "",
                        "profile_name" => "",
                        "date_started" => $currentDate,
                        "num_of_friends" => 0
                    );

                    // Checks the email address input field (isset and empty)
                    if (isset($_POST["email_address"]) && !empty($_POST["email_address"])) {
                        $details_Of_Profile["email_address"] = sanitiseInput($_POST["email_address"]);
                        $details_Of_Profile["email_address"] = mysqli_escape_string($conn, $details_Of_Profile["email_address"]);

                        // Check the email Address whether or not it is followed the format
                        if(!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i", $details_Of_Profile["email_address"])) {
                            // Adds error message for invalid email address input
                            $error_message .= "<p>Please input valid email address!</p>";
                            $result = false;
                        }

                        // Checks if the email address session variable is empty and not set
                        if (!isset($_SESSION["email_address"]) && empty($_SESSION["email_address"])) {
                            $_SESSION["email_address"] = $details_Of_Profile["email_address"];
                        }

                        // Assign the email_address session value to user_email_address variable
                        $user_email_address = $_SESSION["email_address"];
                        // Linked to the checkUserExistence function to check the registration of user
                        $ExistenceOfUser = checkUserExistence($conn, $details_Of_Profile["email_address"]); 

                        // Check whether or not the email address existed in the 'friends' table
                        if ($ExistenceOfUser) {
                            // Concanate error message if email address has been registered.
                            $error_message .= "<p>Email address you entered already existed!</p>";
                            $result = false;
                        }

                    } else {
                        // Concanate error message if the email address in the input field empty or not set.
                        $error_message .= "<p>Please input your email address!</p>";
                        $result = false;
                    }

                    // Checks the profile name input field (isset and empty)
                    if (isset($_POST["profile_name"]) && !empty($_POST["profile_name"])) {
                        $details_Of_Profile["profile_name"] = sanitiseInput($_POST["profile_name"]);
                        $details_Of_Profile["profile_name"] = mysqli_escape_string($conn, $details_Of_Profile["profile_name"]);

                        // Checks the profile name input data follows the correct format
                        if (!preg_match("/^[a-zA-Z ]+$/", $details_Of_Profile["profile_name"])) {
                            // Concanate error message if profile name input data doesn't follow correct format
                            $error_message .= "<p>Your profile name must follow the correct format that containing letters and a space.</p>";
                            $result = false;
                        }

                        // Checks weather or not the session variable of profile name existed.
                        if (!isset($_SESSION["profile_name"]) && empty($_SESSION["profile_name"])) {
                            $_SESSION["profile_name"] = $details_Of_Profile["profile_name"];
                        }
                        // Assign the value to $user_profile_address
                        $user_profile_name = $_SESSION["profile_name"];

                    } else {
                        // Concanate error message if the profile name in input field is empty or not set
                        $error_message .= "<p>Please input your profile name.</p>";
                        $result = false;
                    }

                    // Checks whether or not the password in input field is not empty and set
                    if (isset($_POST["password"]) && !empty($_POST["password"])) {
                        $details_Of_Profile["password"] = sanitiseInput($_POST["password"]);
                        $details_Of_Profile["password"] = mysqli_escape_string($conn, $details_Of_Profile["password"]);

                        // Checks if the password input follows the correct format
                        if (!preg_match("/^[a-zA-Z0-9]+$/", $details_Of_Profile["password"])) {
                            // Adds error message if password input data is invalid
                            $error_message .= "<p>Your password must only follow the format that containing alphanumeric characters.</p>";
                            $result = false;
                        }

                        // Checks if the confirm password input field is not empty.
                        if (isset($_POST["confirm_password"]) && !empty($_POST["confirm_password"])) {
                            $confirm_password = sanitiseInput($_POST["confirm_password"]);

                            // Checks if the confirm password input follows the correct format that only containing alphanumeric characters
                            if (!preg_match("/^[a-zA-Z0-9]+$/", $confirm_password)) {
                                // Concanate error message if confirm password input data doesn't follow the format
                                $error_message .= "<p>Your confirm password must only follow the format that containing alphanumeric characters.</p>";
                                $result = false;
                            }

                            // Checks if the password input is not matched confirm password input
                            if ($confirm_password != $details_Of_Profile["password"]) {
                                // Concanate error message if confirm password doesn't not match the password
                                $error_message .= "<p>Your confirm password doesn't match. Please enter correct password!</p>";
                                $result = false;
                            }

                        } else {
                            // Concanate error message if the confirm password input is empty and not set.
                            $error_message .= "<p>Please enter confirm password!</p>";
                            $result = false;
                        }

                    } else {
                        // Concanate error message if the password input is empty and not set.
                        $error_message .= "<p>Please enter your password!</p>";
                        $result = false;
                    }

                    // Check whether or not the 'Register' button is selected
                    if (isset($_POST["register"])) {
                        // In case there are errors, If statement would be used to display those error messages.
                        if (!$result) {
                            // Displaying error messages.
                            echo "<div class='container'> 
                                    <div class='alert alert-danger' role='alert'>
                                        <p> $error_message </p>
                                    </div>
                                  </div>";
                        } else {
                            // Check if the user exists or not in the 'friends' table
                            if (!$ExistenceOfUser) {
                                // Check whether or not the session variable of login status exists
                                if (!isset($_SESSION["login_status"]) && empty($_SESSION["login_status"])) {
                                    // Sets the session to 'Successful'
                                    $_SESSION["login_status"] = "Successful";
                                    addNewUser($conn, $details_Of_Profile);
                                }
                                //Assign the session value of login status to the $login_status variable
                                $login_status = $_SESSION["login_status"];
                                // Redirects to friendadd.php
                                header("Location: friendadd.php");
                            }
                        }
                    }
                }

                // Checks wether or not the email address in the login form existed and matched with email address in the 'friends' table
                function checkUserExistence($conn, $emailAddress) {
                    // First we assume the user hasn't already existed in the 'friends' table
                    $ExistenceOfUser = false;
                    $query = "SELECT * FROM friends 
                              WHERE friend_email = '$emailAddress'";
                    
                    // Then stores result set into the result pointer
                    $result = @mysqli_query($conn, $query)
                            or die("<p>Error: An error occured!!!</p><p>Error code " . mysqli_errno($conn) . ":" . mysqli_error($conn) . "</p>");
                    
                    // Checks whether or not email address existed in the 'friends' table
                    if (@mysqli_num_rows($result) > 0) {
                        $ExistenceOfUser = true;
                    }
                    
                    

                    return $ExistenceOfUser;
                }

                // Adds input data to the 'friends' table in database
                function addNewUser($conn, $details_Of_Profile) {
                    $values = "'" . implode("', '", array_values($details_Of_Profile)) . "'";
                    $query = "INSERT INTO friends (friend_email, password, profile_name, date_started, num_of_friends) 
                              VALUES ($values);";
                    $results = @mysqli_query($conn, $query)
                             or die("<p>Error: An error occured!!!</p><p>Error code " . mysqli_errno($conn) . ": " . mysqli_error($conn) . "</p>");
                    
                    // Displaying success message if the user is successfully added to the table.
                    echo "<div class='container'> 
                            <div class='alert alert-success' role='alert'>
                                <p>Registration successfully!!!</p>
                            </div>
                        </div>";
                }

                // Prefilling the email address in input field
                function emailAddressPreFilling() {
                    if (isset($_SESSION["email_address"]) && !empty($_SESSION["email_address"])) {
                        echo $_SESSION["email_address"];
                    }
                }

                // Prefilling the profile name in input field
                function ProfileNamePreFilling() {
                    if (isset($_SESSION["profile_name"]) && !empty($_SESSION["profile_name"])) {
                        echo $_SESSION["profile_name"];
                    }
                }
                // Closing the connection
                mysqli_close($conn);
            ?>
            <div class="container">
                <form id="sign_up_form" class="user_forms" action="signup.php" method="post">
                    <div class="row py-1">
                        <div class="col">
                            <div class="form-group">
                                <label for="email_address" class="text_labels">Email address: </label>
                                <input type="email" class="form-control" id="email_address" name="email_address" value="<?php emailAddressPreFilling() ?>"/>
                            </div>
                        </div>
                    </div>
                    <div class="row py-1">
                        <div class="col">
                            <div class="form-group">
                                <label for="profile_name" class="text_labels">Profile Name: </label>
                                <input type="text" class="form-control" id="profile_name" name="profile_name" value="<?php ProfileNamePreFilling() ?>"/>
                            </div>
                        </div>
                    </div>
                    <div class="row py-1">
                        <div class="col">
                            <div class="form-group">
                                <label for="password" class="text_labels">Password: </label>
                                <input type="password" class="form-control" id="password" name="password"/>
                            </div>
                        </div>
                    </div>
                    <div class="row py-1">
                        <div class="col">
                            <div class="form-group">
                                <label for="confirm_password" class="text_labels">Confirm Password: </label>
                                <input type="password" class="form-control" id="confirm_password" name="confirm_password"/>
                            </div>
                        </div>
                    </div>
                    <div class="row py-3">
                        <div class="col-6 text-center">
                            <input type="submit" class="btn btn-primary btn-lg" id="register" name="register" value="Register"/>
                        </div>
                        <div class="col-6 text-center">
                            <input type="reset" class="btn btn-primary btn-lg" id="clear" name="clear" value="Clear"/>
                        </div>
                    </div>
                </form>
                <div class='py-2 text-center'>
                    <a href='index.php' class='btn btn-secondary'>Home Page</a>
                </div>
            </div>
    <footer class="bg-dark text-light">
        <div class="container-lg">
            <div class="row">
                <div class="col-lg-4">
                    <div class="p py-4 text-center">Address</div>
                </div>
                <div class="col-lg-4">
                    <div class="p py-4 text-center">Copyright © 2021, ZKL, Inc. All rights reserved.</div>
                </div>
                <div class="col-lg-4">
                    <div class="p py-4 text-center">Contact us: <a href="mailto:mailto:name@mail.com" style="color:orangered">name@mail.com</a></div>
                </div>
            </div>
        </div>
    </footer>
</body>
<!-- boostrap js  -->
<script src="framework/js/bootstrap.bundle.min.js"></script>
</html> 