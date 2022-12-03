<!DOCTYPE html>
<html lang="en">
<head>
    <title>Simplified Social Network Application - About</title>
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

    <div class="container">
        <h1>About Page</h1>
        <ul>
            <li>What is the PHP version?</li>
            <?php
                echo "<p>The PHP version is " . phpversion() . ".</p>";
            ?>
            <li>What tasks you have not attempted or not completed?</li>
            <p>I have completed all the tasks including extra challenge in this project</p>
            <li>What special features have you done, or attempted, in creating the site that we should know about?</li>
            <p>I have added a special authentication feature that if you haven't loged in, you won't access the friend list and friend add function</p>
            <li>Which parts did you have trouble with?</li>
            <p>When I need to deal with the way to display a specific number of person and create a "Previous" and "Next" link. But I have fixed it and now It works well</p>
            <li>What would you like to do better next time?</li>
            <p>For the next time, I think I would deploy the hash encryption function with salt for password saved in database, in order to increase security of my application.</p>
            <li>What additional features did you add to the assignment? (if any)</li>
            <p>You would see that the web application prevents you when you go directly to the friendlist.php and friendadd.php without login</p>
            <li>Listing of links to the following pages</li>
            <p>Friend List: <a href="friendlist.php">Link</a></p>
            <p>Friend Add: <a href="friendadd.php">Link</a></p>
            <p>Home Page: <a href="index.php">Link</a></p>
            <li>What discussion points did you participated on in the unit’s discussion board for project? If you did not participate, state your reason.</li>
            <p>I discussed directly with my lecturer on Collaborate Ultra (Canvas) when we have a class.</p>
        </ul>
    </div>
    <div class="h4 py-3 text-center">
        <a href="index.php" class="btn btn-secondary btn-lg btn-radius">Return to Home Page</a>
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