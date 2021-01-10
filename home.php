<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
      type="text/css"
    />
    <link rel="stylesheet" href="/styles/theme.css" type="text/css" />
    <link rel="icon" href="images/favicon.png" />
  </head>
  <body>
			<h2>Home Page</h2>
            <p>Welcome back, <?=$_SESSION['name']?>!</p>
            <form action="logout.php">
                <button type="submit">Logout</button>
            </form>
	</body>
</html>