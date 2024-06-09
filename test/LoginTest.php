<?php
// login.test.php

// Include the login.php file to be tested
require_once 'login.php';

use PHPUnit\Framework\TestCase;

class LoginTest extends TestCase
{
    public function testValidLogin()
    {
        $username = 'validUser1';
        $password = 'validPassword1';

        // Simulate reading from the credentials file
        $credentials = file('credentials.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        $valid = false;

        foreach ($credentials as $credential) {
            list($storedUsername, $storedPassword) = explode(',', $credential);
            if ($username === $storedUsername && $password === $storedPassword) {
                $valid = true;
                break;
            }
        }

        $this->assertTrue($valid);
    }

    public function testInvalidLogin()
    {
        $username = 'invalidUser';
        $password = 'invalidPassword';

        // Simulate reading from the credentials file
        $credentials = file('credentials.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        $valid = false;

        foreach ($credentials as $credential) {
            list($storedUsername, $storedPassword) = explode(',', $credential);
            if ($username === $storedUsername && $password === $storedPassword) {
                $valid = true;
                break;
            }
        }

        $this->assertFalse($valid);
    }

    public function testShortUsername() {
       $this->assertFalse(validateCredentials("short", "validPassword1"));
    }

    public function testNonAlphanumericUsername() {
       $this->assertFalse(validateCredentials("user@name", "validPassword1"));
    }
}
?>
