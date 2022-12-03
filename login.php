<?php
    session_start(); // Starting new session
    $_SESSION = array(); // Unset all variables relating to Session
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Simplified Social Network Application - Log In</title>
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
        <h2 class="py-2 text-center">project - Simplified Social Network Application - Login</h2>
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
                    // Then we assume that the user does not already exist in the 'friends' table
                    $ExistenceOfUser = false;
                    // Assign the current server date to currentData variable
                    $currentDate = date("d/m/y");
                    $emailAddress = "";
                    $passWord = "";

                    // Checks the email address input field (isset and empty)
                    if (isset($_POST["email_address"]) && !empty($_POST["email_address"])) {
                        $emailAddress = sanitiseInput($_POST["email_address"]);
                        $emailAddress = mysqli_escape_string($conn, $emailAddress);

                        // Check the emailAddress whether or not it is followed the format
                        if(!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i", $emailAddress)) {
                            $error_message .= "<p>Please input valid email address!</p>";
                            $result = false;
                        }

                        // Checks if the email address session variable exists
                        if (!isset($_SESSION["email_address"]) && empty($_SESSION["email_address"])) {
                            $_SESSION["email_address"] = $emailAddress;
                        }

                        // Assign the email_address session value to user_email_address variable
                        $user_email_address = $_SESSION["email_address"];
                        // Linked to the checkUserExistence function to check the registration of user
                        $ExistenceOfUser = checkUserExistence($conn, $emailAddress);
                        // Check whether or not the email address existed in the 'friends' table
                        if (!$ExistenceOfUser) {
                            // Concanate error message if email address hasn't been registered.
                            $error_message .= "<p>The email address you entered, hasn't been registered!</p>";
                            $result = false;
                        }

                    } else {
                        // Concanate error message if the email address in the input field empty or not set.
                        $error_message .= "<p>Please input your email address!</p>";
                        $result = false;
                    }

                    // Checks the password input field (isset and empty)
                    if (isset($_POST["password"]) && !empty($_POST["password"])) {
                        $passWord = sanitiseInput($_POST["password"]);
                        $passWord = mysqli_escape_string($conn, $passWord);
                        if (!preg_match("/^[a-zA-Z0-9]+$/", $passWord)) {
                            $error_message .= "<p>Your password must only follow the format that containing alphanumeric characters.</p>";
                            $result = false;
                        }

                        // Linked to the checkMatchingPassword function to authenticate the password
                        $passWordMatches = checkMatchingPassword($conn, $emailAddress, $passWord);
                        // Check whether or not the input matched with password in the 'friends' table
                        if (!$passWordMatches) {
                            $error_message .= "<p>Incorrect password! Please try again.</p>";
                            $result = false;
                        }

                    } else {
                        $error_message .= "<p>Please input your password!</p>";
                        $result = false;
                    }

                    // Checks if the 'Login' button is selected
                    if (isset($_POST["login"])) {
                        // Checks whether or not there are errors to be displayed
                        if (!$result) {
                            echo "<div class='container'>
                                    <div class='alert alert-danger' role='alert'>
                                        <p> $error_message </p>
                                    </div>
                                  </div>";
                        } else {
                            if ($ExistenceOfUser) {
                                // Checks if the session variable of login status existed, if not and empty then process
                                if (!isset($_SESSION["login_status"]) && empty($_SESSION["login_status"])) {
                                    // Sets the session to 'Successful'
                                    $_SESSION["login_status"] = "Successful";
                                    echo "<div class='container'>
                                            <div class='alert alert-success' role='alert'>
                                                <p>You are now logged in.</p>
                                            </div>
                                        </div>";
                                }
                                //Assign the session value of login status to the $login_status variable
                                $login_status = $_SESSION["login_status"];
                                // Redirects to friendlist.php
                                header("Location: friendlist.php");
                            }
                        }
                    }
                }

                // Checks wether or not the email address in the login form existed and matched with email address in the 'friends' table
                function checkUserExistence($conn, $emailAddress) {
                    // First we assume the user already existed in the 'friends' table
                    $ExistenceOfUser = true;
                    $query = "SELECT * FROM friends 
                              WHERE friend_email = '$emailAddress'";
                    
                    // Then stores result set into the result pointer
                    $result = @mysqli_query($conn, $query)
                            or die("<p>Error: An error occured!!!</p><p>Error code " . mysqli_errno($conn) . ": " . mysqli_error($conn) . "</p>");
                    
                    // Checks whether or not email address existed in the 'friends' table
                    $count = @mysqli_num_rows($result);
                    if ($count == 0) {
                        $ExistenceOfUser = false;
                    }
                    
                     

                    return $ExistenceOfUser;
                }

                // Checks wether or not the password in the login form existed and matched with password in the 'friends' table
                function checkMatchingPassword($conn, $emailAddress, $passWord) {
                    $passWordMatches = false;
                    $query = "SELECT * FROM friends
                              WHERE friend_email = '$emailAddress'
                              AND password = '$passWord'";

                    // then stores result set into the result pointer
                    $result = @mysqli_query($conn, $query)
                            or die("<p>Error: An error occured!!!</p><p>Error code " . mysqli_errno($conn) . ": " . mysqli_error($conn) . "</p>");
                    
                    // Checks if email address exists in the 'friends' table
                    $count = @mysqli_num_rows($result);
                    if ($count == 1) {
                        $passWordMatches = true;
                    }
                    
                    

                    return $passWordMatches;
                }

                // Prefilling the email address in input field
                function emailAddressPreFilling() {
                    if (isset($_SESSION["email_address"]) && !empty($_SESSION["email_address"])) {
                        echo $_SESSION["email_address"];
                    }
                }
                // Closing the connection
                mysqli_close($conn); 
            ?>
            <div class="container">
                <form id="login_form" class="user_forms" action="login.php" method="post">
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
                                <label for="password" class="text_labels">Password: </label>
                                <input type="password" class="form-control" id="password" name="password"/>
                            </div>
                        </div>
                    </div>
                    <div class="row py-3">
                        <div class="col-6 text-center">
                            <input type="submit" class="btn btn-primary btn-lg" id="login" name="login" value="Login"/>
                        </div>
                        <div class="col-6 text-center">
                            <input type="reset" class="btn btn-primary btn-lg" id="clear" name="reset" value="Clear"/>
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