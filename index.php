<!DOCTYPE html>
<html lang="en">
<head>
    <title>Simplified Social Network Application - Home Page</title>
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
    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="images/ourplatform1.png" class="d-block w-100" alt="facebook">
            <div class="carousel-caption d-none d-md-block py-1">
              <h3 style="color:#CB8CFF">With Our Platform</h3>
              <p style="color:#CB8CFF">Login in and find some new friends to add.</p>
            </div>
          </div>
          <div class="carousel-item">
            <img src="images/postjob1.png" class="d-block w-100" alt="twitter">
            <div class="carousel-caption d-none d-md-block py-1">
              <h3>Find New Friends</h3>
              <p>Our dream is to make everyone in the world can connect together and share love.</p>
              <!-- 1920-895 -->
            </div>
          </div>
          <div class="carousel-item">
            <img src="images/searchjob1.png"  class="d-block w-100" alt="instagram">
            <div class="carousel-caption d-none d-md-block py-1">
              <h3>Add New Friends</h3>
              <p>Twenty years from now you will be more disappointed by the things that you didn't do than by the ones you did do.</p>
            </div>
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
        </div>
    </div>
    <div class="justify-content-center">
        <div class="h2 text-center align-middle py-3">Let signing up and adding new friends now. Next Gen_Now</div>
    </div>
</div>
<br />

<div class="container-lg">
    <div class="row text-center align-middle py-2">
        <div class="col-lg-6 px-3">
            <img src="images/postjobicon.png" style="width:250px;"> 
            <div class="h4 py-3">
                <a href="signup.php" class="btn btn-success btn-lg btn-radius">Sign Up</a>
            </div>
        </div>
        <div class="col-lg-6 px-3 py-3">
            <img src="images/findjobicon.png" style="width:240px;">
            <div class="h4 py-3">
                <a href="login.php" class="btn btn-warning btn-lg btn-radius">Login In</a>
            </div>
        </div>
    </div>
    <br />
</div>
</div>
</div>
<div style="background-color:#CFCFCF">
    <div class="container-lg py-3">
        <div class="p py-2">Name: Minh Hoang Nguyen</div>
        <div class="p py-2">Student ID: 103295032</div>
        <div class="p py-2">Email: <a href="mailto:name@mail.com" style="color:orangered">name@mail.com</a></div>
        <div class="p py-2">I declare that this assignment is my individual work. I have not worked collaboratively nor have I copied from any other student's work or from any other source.</div>
    </div>
</div>
        <?php
            // linked to settings.php which saved credentials
            require_once("settings.php"); 
            // Connects to MySQL server
            $conn = @mysqli_connect($host, $username, $password, $sql_database_name)
                    or die("<p>Unable to connect to database server.</p>");
            // Linked to the function createTables in order to create if not exists
            $tablesCreated = createTables($conn);
            // Linked to the function addDataTables in order to add data into those tables.
            $tablesAdded = addDataTables($conn);
            // Close connection
            mysqli_close($conn);

            // Creates the friends and myFriends tables if not exists
            function createTables($conn) {
                $tablesCreated = true;
                // Creates the 'friends' table if not exists
                $query = "CREATE TABLE IF NOT EXISTS friends
                            (
                                friend_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
                                friend_email VARCHAR(50) NOT NULL,
                                password VARCHAR(20) NOT NULL,
                                profile_name VARCHAR(30) NOT NULL,
                                date_started date NOT NULL,
                                num_of_friends INT UNSIGNED,
                                UNIQUE (friend_email)
                            );";

                $result = @mysqli_query($conn, $query)
                        or die("<p>Error: An error occured!!!</p><p>Error code " . mysqli_errno($conn) . ":" . mysqli_error($conn) . "</p>");

                
                

                // Creates the 'myfriends' table if not exists
                $query = "CREATE TABLE IF NOT EXISTS myfriends
                            (
                                friend_id1 INT NOT NULL,
                                friend_id2 INT NOT NULL,
                                CONSTRAINT PK_myfriends PRIMARY KEY (friend_id1, friend_id2),
                                CONSTRAINT FK1_myfriends FOREIGN KEY (friend_id1) REFERENCES friends(friend_id),
                                CONSTRAINT FK2_myfriends FOREIGN KEY (friend_id2) REFERENCES friends(friend_id)
                            );";

                $result = @mysqli_query($conn, $query)
                        or die("<p>Error: An error occured!!!</p><p>Error code " . mysqli_errno($conn) . ":" . mysqli_error($conn) . "</p>");

                
                
                
                return $tablesCreated;
            }

            // Add data to 'friends' and 'myfriends' table as the requirement (10,20 records)
            function addDataTables($conn) {
                $check = false;
                $tablesAdded = false;

                $query = "SELECT * FROM friends";
                $result = @mysqli_query($conn, $query)
                        or die("<p>Error: An error occured!!!</p><p>Error code " . mysqli_errno($conn) . ": " . mysqli_error($conn) . "</p>");

                $check_fetch = mysqli_fetch_assoc($result);
                if($check_fetch) {
                    $check = true;
                }

                // Add data to 'friends' table (10 records requirement)
                $query = "INSERT IGNORE INTO friends
                            (
                                friend_email,
                                password,
                                profile_name,
                                date_started,
                                num_of_friends
                            )
                            VALUES
                                -- #1 -> 'friends' table 
                                (
                                    'minhhoangnguyen@gmail.com', 
                                    'hoangzkl',
                                    'Minh Hoang Nguyen',
                                    '2021-07-27',
                                    3
                                ),
                                -- #2 -> 'friends' table 
                                (
                                    'minhquanghoang@gmail.com',
                                    'quangtoxic',
                                    'Minh Quang Hoang',
                                    '2021-07-27',
                                    2
                                ),
                                -- #3 -> 'friends' table 
                                (
                                    'anhminhho@gmail.com',
                                    'minhhochill',
                                    'Anh Minh Ho',
                                    '2021-07-27',
                                    3
                                ),
                                -- #4 -> 'friends' table 
                                (
                                    'baosonto@gmail.com',
                                    'sonbaoto',
                                    'Bao Son To',
                                    '2021-07-27',
                                    2
                                ),
                                -- #5 -> 'friends' table 
                                (
                                    'minhtanngo@gmail.com',
                                    'minhtan',
                                    'Minh Tan Ngo',
                                    '2021-07-27',
                                    2
                                ),
                                -- #6 -> 'friends' table 
                                (
                                    'duclongnguyen@gmail.com',
                                    'duclong',
                                    'Duc Long Nguyen',
                                    '2021-07-27',
                                    2
                                ),
                                -- #7 -> 'friends' table 
                                (
                                    'minhquanto@gmail.com',
                                    'quanto',
                                    'Minh Quan To',
                                    '2021-07-27',
                                    2
                                ),
                                -- #8 -> 'friends' table 
                                (
                                    'dangmanhnguyen@gmail.com',
                                    'dangmanh',
                                    'Manh Dang Nguyen',
                                    '2021-07-27',
                                    1
                                ),
                                -- #9 -> 'friends' table 
                                (
                                    'thaiduyngo@gmail.com',
                                    'thaiduypro',
                                    'Thai Duy Ngo',
                                    '2021-07-27',
                                    2
                                ),
                                -- #10 -> 'friends' table 
                                (
                                    'dinhlamnguyen@gmail.com',
                                    'lamnon',
                                    'Dinh Lam Nguyen',
                                    '2021-07-27',
                                    1
                                );";

                $result = @mysqli_query($conn, $query)
                        or die("<p>Error: An error occured!!!</p><p>Error code " . mysqli_errno($conn) . ": " . mysqli_error($conn) . "</p>");

                
                if(!$check) {
                // Add data to 'myfriends' table (20 records requirement)
                $query = "INSERT IGNORE INTO myfriends
                            (
                                friend_id1, 
                                friend_id2
                            )
                            VALUES
                                (1, 2), -- 1. Minh Hoang - friend - Minh Quang
                                (2, 1), -- 2. Minh Quang - friend - Minh Hoang
                                (1, 3), -- 3. Minh Hoang - friend - Anh Minh Ho
                                (3, 1), -- 4. Anh Minh Ho - friend - Minh Hoang
                                (1, 4), -- 5. Minh Hoang - friend - Son Bao To
                                (4, 1), -- 6. Son Bao To - friend - Minh Hoang
                                (2, 3), -- 7. Minh Quang - friend - Anh Minh Ho
                                (3, 2), -- 8. Anh Minh Ho - friend - Minh Quang
                                (3, 4), -- 9. Anh Minh Ho - friend - Son Bao To
                                (4, 3), -- 10. Anh Minh Ho - friend - Bao Son To
                                (5, 6), -- 11. Minh Tan Ngo - friend - Duc Long Nguyen
                                (6, 5), -- 12. Duc Long Nguyen - friend - Minh Tan Ngo
                                (5, 7), -- 13. Minh Tan Ngo - friend - Minh Quan To
                                (7, 5), -- 14. Minh Quan To - friend - Minh Tan Ngo
                                (6, 7), -- 15. Duc Long Nguyen - friend - Minh Quan To
                                (7, 6), -- 16. Minh Quan To - friend - Duc Long Nguyen 
                                (8, 9), -- 17. Dang Manh - friend - Thai Duy Ngo
                                (9, 8), -- 18. Thai Duy Ngo - friend - Dang Manh
                                (9, 10), -- 19. Thai Duy Ngo - friend - Dinh Lam
                                (10, 9) -- 20. Dinh Lam - friend - Thai Duy Ngo
                            ";
                $result = @mysqli_query($conn, $query)
                        or die("<p>Error: An error occured!!!</p><p>Error code " . mysqli_errno($conn) . ": " . mysqli_error($conn) . "</p>");
                
                

                }
                return $tablesAdded = true;
            }
            
            // if the 'friends' and 'myfriends' table created - Echo success notification
            if ($tablesCreated && $tablesAdded) {
                echo "<p>Tables successfully created and Data has been added to tables.</p>";
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
                    <div class="p py-4 text-center">Contact us: <a href="mailto:name@mail.com" style="color:orangered">name@mail.com</a></div>
                </div>
            </div>
        </div>
</footer>
</body>
<!-- boostrap js  -->
<script src="framework/js/bootstrap.bundle.min.js"></script>
</html> 