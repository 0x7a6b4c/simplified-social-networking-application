<?php
    session_start();

    if (isset($_SESSION["email_address"]) && !empty($_SESSION["email_address"])) {
        $user_email_address = $_SESSION["email_address"];
    }

    if (isset($_SESSION["profile_name"]) && !empty($_SESSION["profile_name"])) {
        $user_profile_name = $_SESSION["profile_name"];
    }

    if (isset($_SESSION["user_id"]) && !empty($_SESSION["user_id"])) {
        $user_id = $_SESSION["user_id"];
    }

    if (isset($_SESSION["friend_profile_name"]) && !empty($_SESSION["friend_profile_name"])) {
        $friend_profile_name = $_SESSION["friend_profile_name"];
    }

    if (isset($_SESSION["num_of_friends"]) && !empty($_SESSION["num_of_friends"])) {
        $user_friends_total = $_SESSION["num_of_friends"];
    }

    if (isset($_SESSION["login_status"]) && !empty($_SESSION["login_status"])) {
        $login_status = $_SESSION["login_status"];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Simplified Social Network Application - Friend Add</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link href="framework/css/style.css" rel="stylesheet">
    <!-- Bootstrap -->
    <link href="framework/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
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
                    <a class="nav-item nav-link active ps-4" href="friendlist.php">Friend List<span class="sr-only"></span></a>
                    <a class="nav-item nav-link active ps-4" href="friendadd.php">Add Friend<span class="sr-only"></span></a>
                    <a class="nav-item nav-link active ps-4" href="logout.php">Log Out<span class="sr-only"></span></a>
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
<h3 class='text-center'>Simplified Social Network Application</h3>
<?php
    if (isset($_SESSION["login_status"]) && !empty($_SESSION["login_status"])) {
        // Retrieving the currently logged in user's friend id
        function getUsersId($conn, $user_email_address) {
            $query = "SELECT friend_id
                      FROM friends
                      WHERE friend_email = '$user_email_address';";
            
            // Storing the result into the result variable
            $result = @mysqli_query($conn, $query)
                    or die("<p>Error: An error occured!!!</p><p>Error code " . mysqli_errno($conn) . ": " . mysqli_error($conn) . "</p>");

            // Loop through the fetching from $result to assign the updated data of friend id to the SESSION user id
            while ($row = mysqli_fetch_assoc($result)) {
                $_SESSION["user_id"] = $row["friend_id"];
                // Assign and update the friend id from database to $user_id variable
                $user_id = $_SESSION["user_id"];
            }
            
             
            return $user_id;
        }

        // Retrieving the currently logged in user's profile name
        function getUserProfileName($conn, $user_id) {
            $query = "SELECT profile_name
                      FROM friends
                      WHERE friend_id = '$user_id';";

            // Storing the result into the $result variable
            $result = @mysqli_query($conn, $query)
                    or die("<p>Error: An error occured!!!</p><p>Error code " . mysqli_errno($conn) . ": " . mysqli_error($conn) . "</p>");

            // Loop through the fetching from $result to assign the updated data of profile name to the SESSION profile name
            while ($row = mysqli_fetch_assoc($result)) {
                $_SESSION["profile_name"] = $row["profile_name"];
                // Assign and update the profile name from database to $user_profile_name variable
                $user_profile_name = $_SESSION["profile_name"];
            }
            echo "<h3 class='pt-2 text-center'>" . $_SESSION["profile_name"] ."'s Add Friend Page</h3><div class='container'>";

             
            return $user_profile_name;
        }

        // Retrieving the currently logged in user's total count number of friends
        function getUserFriendsTotal($conn, $user_id) {
            $query = "SELECT num_of_friends
                      FROM friends
                      WHERE friend_id = '$user_id';";

            // Storing the result into the result variable
            $result = @mysqli_query($conn, $query)
                    or die("<p>Error: An error occured!!!</p><p>Error code " . mysqli_errno($conn) . ": " . mysqli_error($conn) . "</p>");

            // Loop through the fetching from $result to assign the updated data of num_of_friends to the SESSION num_of_friends
            while ($row = mysqli_fetch_assoc($result)) {
                $_SESSION["num_of_friends"] = $row["num_of_friends"];
                // Assign and update the num_of_friends from database to $user_friends_total variable
                $user_friends_total = $_SESSION["num_of_friends"];
            }

            echo "<h3 class='pb-2 text-center'>Total number of Friends: " .  $user_friends_total . "</h3></div>";
            
             
            return $user_friends_total;
        }

        // Retrieving users that the currently logged in user are not friend with
        function getFriendName($conn, $add_friend_id) {
            $query = "SELECT profile_name
                      FROM friends
                      WHERE friend_id = '$add_friend_id';";
            
            // Storing the result into the result variable
            $result = @mysqli_query($conn, $query)
                    or die("<p>Error: An error occured!!!</p><p>Error code " . mysqli_errno($conn) . ": " . mysqli_error($conn) . "</p>");

            while ($row = mysqli_fetch_assoc($result)) {
                $_SESSION["friend_profile_name"] = $row["profile_name"];
                $friend_profile_name = $_SESSION["friend_profile_name"];
            }
             
            
                return $friend_profile_name;
              
        }

        // Adding the selected user to the lists of friends of the currently logged in user
        function addingFriend($conn, $user_id, $add_friend_id, $friend_profile_name, $user_profile_name) {
            $query = "INSERT INTO myfriends (friend_id1,friend_id2)
                      VALUES ($user_id,$add_friend_id);";

            // Storing the result into the result variable
            $result = @mysqli_query($conn, $query)
                    or die("<p>Error: Error occured while adding {$friend_profile_name} to the friend list of {$user_profile_name}</p><p>Error code " . mysqli_errno($conn) . ": " . mysqli_error($conn) . "</p>");

            $query = "INSERT INTO myfriends (friend_id1,friend_id2)
                    VALUES ($add_friend_id,$user_id);";
            
            $result = @mysqli_query($conn, $query)
                    or die("<p>Error: Error occured while adding {$user_profile_name} to the friend list of {$friend_profile_name}</p><p>Error code " . mysqli_errno($conn) . ": " . mysqli_error($conn) . "</p>");

        }

        // Updating the total number of friends of currently logged in user
        function updatingFriendCount($conn, $add_friend_id, $user_id, $user_friends_total, $user_profile_name) {
            $query = "UPDATE friends
                      SET num_of_friends = num_of_friends + 1
                      WHERE friend_id = '$user_id';";
            // Storing the result into the result variable
            $result = @mysqli_query($conn, $query)
                    or die("<p>Error: An error occured!!!</p><p>Error code " . mysqli_errno($conn) . ": " . mysqli_error($conn) . "</p>");

            $query = "UPDATE friends
                    SET num_of_friends = num_of_friends + 1
                    WHERE friend_id = '$add_friend_id';";
            // Storing the result into the result variable
            $result = @mysqli_query($conn, $query)
                    or die("<p>Error: An error occured!!!</p><p>Error code " . mysqli_errno($conn) . ": " . mysqli_error($conn) . "</p>");        

             
        }

        // Displaying the current logged in user's - person not in friends list
        function displayingFriendsList($conn, $user_id) {
            // Retrieving the total number of rows records
            $query = "SELECT COUNT(friend_id) as count
                      FROM friends
                      WHERE friend_id 
                      NOT IN 
                      (
                            SELECT friend_id2
                            FROM myfriends
                            WHERE friend_id1 = '$user_id'
                      )
                            AND NOT friend_id = '$user_id'
                            ORDER BY profile_name ASC;";

            $result = @mysqli_query($conn, $query)
                    or die ("<p>Error: An error occured!!!</p><p>Error code " . mysqli_errno($conn) . ":" . mysqli_errno($conn) ."</p>");
            
            $resultx = mysqli_fetch_assoc($result);
            $total_records = $resultx["count"];

             
            
            $users_per_page = 5; // The number of user record each page
            $total_pages = ceil($total_records / $users_per_page); // Calculating the total number of pages to display
        
            // Check whether or not the target page number is set
            if(isset($_GET["page"]) && is_numeric($_GET["page"])) {
                $current_page = (int) $_GET["page"];
            } else {
                // Default page number would be set to 1 in case that the the page hasn't been set
                $current_page = 1;
            }

            // If the current page number is greater than the total number of pages
            if ($current_page > $total_pages) {
                // If yes, then set the current page number to the last page of the total
                $current_page = $total_pages;
            }

            // If the current page number is less than the first page number
            if ($current_page < 1) {
                // If yes, then set the current page number to the first page number of the total
                $current_page = 1;
            }

            // Offset of the list of registered users who are not friends with the user
            $offset = $users_per_page * ($current_page - 1);

            $query = "SELECT friend_id, profile_name
                      FROM friends
                      WHERE friend_id 
                      NOT IN 
                      (
                            SELECT friend_id2
                            FROM myfriends
                            WHERE friend_id1 = '$user_id'
                      )
                      AND NOT friend_id = '$user_id'
                      ORDER BY profile_name ASC
                      LIMIT $offset, $users_per_page";

            // Storing the result into the result variable
            $result = @mysqli_query($conn, $query)
                    or die("<p>Error: An error occured!!!</p><p>Error code " . mysqli_errno($conn) . ": " . mysqli_error($conn) . "</p>");
            
            // In case there are results returned, then display
            if (@mysqli_num_rows($result) > 0) {
                echo "<div class='container'>
                        <table class='table table-bordered table-hover'>
                            <thead class='thead-dark'>
                                <tr>
                                    <th class='text-center'>Name</th>
                                    <th class='text-center'>Mutual Friends</th>
                                    <th class='text-center'>Option</th>
                                </tr>
                            </thead>
                        <tbody>";

                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>"
                        . "<td class='text-center'>{$row["profile_name"]}</td>"
                        ."<td class='text-center'>". displayingMutualFriends($conn, $user_id, $row["friend_id"])." mutual friends</td>"
                        . "<td class='text-center'>"
                            ."<a href=\"{$_SERVER['PHP_SELF']}?add_friend={$row["friend_id"]}\" class=\"btn btn-outline-success\">Add Friend</a>"
                        ."</td>"    
                        . "</tr>";
                }

                echo "</tbody></table></div>";
            }

             
            displayingPagination($current_page, $total_pages, $total_records);
        }

        // Displaying the total number of mutual friends of the currently logged in user
        function displayingMutualFriends($conn, $user_id, $friend_id) {
            $query = "SELECT COUNT(friend_id) as num_of_mutual_friends
                      FROM friends as users
                      INNER JOIN myfriends as friends
                      ON users.friend_id = friends.friend_id1
                      AND friends.friend_id2 IN 
                      (
                            SELECT friend_id2
                            FROM myfriends
                            WHERE friend_id1 = '$friend_id'
                      )
                      AND users.friend_id = '$user_id'";

            // Storing the result into the result variable
            $result = @mysqli_query($conn, $query)
                    or die("<p>Error: An error occured!!!</p><p>Error code " . mysqli_errno($conn) . ": " . mysqli_error($conn) . "</p>");
            
            $row = mysqli_fetch_assoc($result);
            return $row["num_of_mutual_friends"];

             
        }

        // Displays the pagination
        function displayingPagination($current_page, $total_pages, $total_records) {
            echo "<div class='container'><div class='row'>";

            // If the current page number is greater than 1, Then do not show the navigation link 'Back'
            if ($current_page > 1) {
                // In case that ,then set the page number to the previous page
                $previous_page = $current_page - 1;
                // Following with the display of the link to go back to the previous page 'Previous'
                echo "<div class='col align-self-start text-center'>
                        <a href=\"{$_SERVER['PHP_SELF']}?page={$previous_page}\" class=\"btn btn-outline-primary\">Previous</a>
                    </div>";
            }

            // If the current page number is not the last page, Then displays the navigation link 'Next'
            if (($current_page != $total_pages) && ($total_records != 0)) {
                // In case that, then set the page number to the next page
                $next_page = $current_page + 1;
                // Following with the display of the link to go back to the next page 'Next'
                echo "<div class='col align-self-end text-center'>
                        <a href=\"{$_SERVER['PHP_SELF']}?page={$next_page}\" class=\"btn btn-outline-primary\">Next</a>
                    </div>";
            }
            echo "</div></div>";
        }
        // Displaying button
        function displayingbutton() {
            echo "<div class='row py-4'>
                    <div class='col-6 text-center'>
                        <a href='friendlist.php' class='btn btn-secondary'>Friends List</a>
                    </div>
                    <div class='col-6 text-center'>
                        <a href='logout.php' class='btn btn-secondary'>Log Out</a>
                    </div>
                </div>";
        }
        // Run with function from now
                require_once("settings.php");
                // Connect to MySQL server
                $conn = @mysqli_connect($host, $username, $password, $sql_database_name)
                        or die("<p>Unable to connect to database server.</p>");

                // linked to getUsersId to assign the retrieving data to $user_id
                $user_id = getUsersId($conn, $user_email_address);
                // linked to getUserProfileName to assign the retrieving data to $user_profile_name
                $user_profile_name = getUserProfileName($conn, $user_id);
                // linked to getUserFriendsTotal to assign the retrieving data to $user_friends_total
                $user_friends_total = getUserFriendsTotal($conn, $user_id);
                displayingFriendsList($conn, $user_id);
                displayingbutton();
                // If statement in order to add friend if user click add button then the friend add would be set
                if (isset($_GET["add_friend"])) {
                    $add_friend_id = $_GET["add_friend"];
                    $friend_profile_name = getFriendName($conn, $add_friend_id);
                    addingFriend($conn, $user_id, $add_friend_id, $friend_profile_name, $user_profile_name);
                    updatingFriendCount($conn, $add_friend_id, $user_id, $user_friends_total, $user_profile_name);
                    // After functioning the adding linked to addingFriend and updatingFriendTotal function, redirect to friendadd.php
                    // header('Location: friendadd.php'); Because some error happening when I used header redirect, so choose script instead
                    // It redirects faster than using header('location:');
                    echo "<script>
                            location.href = 'friendadd.php';
                        </script>";
                }

                // Closing the connection
                mysqli_close($conn);

            } else {
                echo "<div class='pt-4 container'>
                            <div class='alert alert-danger' role='alert'>
                                <h3 class='py-2 text-center'>Please Login First!</h3>
                            </div>
                        </div>
                        <div class='row py-4'>
                            <div class='col-4 text-center'>
                                <a href='login.php' class='btn btn-secondary'>Log In</a>
                            </div>
                            <div class='col-4 text-center'>
                                <a href='index.php' class='btn btn-secondary'>Home Page</a>
                            </div>
                            <div class='col-4 text-center'>
                                <a href='signup.php' class='btn btn-secondary'>Sign Up</a>
                            </div>
                        </div>";
            }
?>

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