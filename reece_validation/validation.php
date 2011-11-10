<?php

/*

  Function to validate diffrent things on a form. I.e filesize, String Length
  Email

 */

//function to validate string depending on it's length
function validateString($string, $length) {
    if (strlen($string) < $length) {
        return false;
    } else {
        return true;
    }
}

//function to validate email
function validateEmail($email) {
    return ereg("^[a-zA-Z0-9]+[a-zA-Z0-9_-]+@[a-zA-Z0-9]+[a-zA-Z0-9.-]+[a-zA-Z0-9]+.[a-z]{2,4}$", $email);
}

//function to validate file size
function validateFileSize($file_name) {
    if (filesize($file_name) <= 2097152) {
        return true;
    } else {
        return false;
    }
}

?>