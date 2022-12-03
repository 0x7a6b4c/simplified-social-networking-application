<?php
    session_start(); // Continues the current session
    $_SESSION = array(); // Unsets all session variables
    session_destroy(); // Deletes the session
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Simplified Social Network Application - Log Out</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link href="framework/css/style.css" rel="stylesheet">
    <!-- Bootstrap -->
    <link href="framework/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
<?php
    header("Location: index.php");
?>
</body>
</html>