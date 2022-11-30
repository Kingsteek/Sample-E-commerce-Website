<?php
    session_start();
    // If the user is not logged in go back to index
    if (!isset($_SESSION['loggedin'])) {
        header('Location: ../index.html');
        exit;
    }
?>