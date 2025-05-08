<?php
// includes/functions.php

// Redirection
function redirect($url) {
    header("Location: $url");
    exit();
}

// Affichage d'alerte (bootstrap)
function alert($message, $type = 'success') {
    echo "<div class='alert alert-$type' role='alert'>$message</div>";
}
?>
