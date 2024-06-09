<?php
// login.php

// Function to validate credentials
function validateCredentials($username, $password) {
    // Read the text file containing credentials
    $credentialsFile = 'users.txt';
    $lines = file($credentialsFile, FILE_IGNORE_NEW_LINES);

    // Loop through each line to check for matching credentials
    foreach ($lines as $line) {
        list($storedUsername, $storedPassword) = explode(',', $line);
        echo $storedUsername;
        echo $storedPassword;
        if ($username === $storedUsername && $password === $storedPassword) {
            return true; // Credentials match
        }
    }

    return false; // No matching credentials found
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Validate credentials
    if (validateCredentials($username, $password)) {
        // Redirect to success page
        header("Location: success.php");
        exit;
    } else {
        // Redirect to failure page
        header("Location: failure.php");
        exit;
    }
}
?>
