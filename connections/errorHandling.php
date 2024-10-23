<?php
class ErrorHandler
{
    // Static method to handle errors
    public static function handleError($errorMessage)
    {

        echo "<div class='error'>Error: $errorMessage</div>";
        exit; // Stop script execution after handling the error
    }
}
