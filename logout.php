<?php
session_start();           // Start the session first
session_destroy();         // Then destroy it
header("Location: index.php"); // Redirect to index.php
exit();                    // Optional but recommended to stop script
