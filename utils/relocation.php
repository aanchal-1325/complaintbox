<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
    header("Location: http://complaintbox.co.in/userPanel/");
}


?>