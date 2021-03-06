<?php
// Change this to your connection info.
$DATABASE_HOST = 'caujayzbyczeq.mysql.db';
$DATABASE_USER = 'caujayzbyczeq';
$DATABASE_PASS = 'Wiedzmin123';
$DATABASE_NAME = 'caujayzbyczeq';
// Try and connect using the info above.
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
	// If there is an error with the connection, stop the script and display the error.
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

// Now we check if the data was submitted, isset() function will check if the data exists.
if (!isset($_POST['username'], $_POST['password'])) {
	exit('Please complete the registration form!');
}
// Make sure the submitted registration values are not empty.
if (empty($_POST['username']) || empty($_POST['password'])) {
	// One or more values are empty.
	exit('Please complete the registration form');
}

if($_POST['password'] != $_POST['passwordRepet'])
{
    exit('Password are not matching.');
}

if ($stmt = $con->prepare('SELECT id, password FROM accounts WHERE username = ?')) {
	// Bind parameters (s = string, i = int, b = blob, etc), hash the password using the PHP password_hash function.
	$stmt->bind_param('s', $_POST['username']);
	$stmt->execute();
	$stmt->store_result();
	// Store the result so we can check if the account exists in the database.
	if ($stmt->num_rows > 0) {
		// Username already exists
		echo 'Username exists, please choose another!';
	    } else {
            // Username doesnt exists, insert new account
            if ($stmt = $con->prepare('INSERT INTO accounts (username, password) VALUES (?, ?)')) {
                $stmt->bind_param('ss', $_POST['username'], $_POST['password']);
                $stmt->execute();
                echo 'You have successfully registered, you can now login!';
            } else {
                // Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
                echo 'Could not prepare statement!';
            }
        }
        $stmt->close();
    } else {
        // Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
        echo 'Could not prepare statement!';
    }
$con->close();
?>