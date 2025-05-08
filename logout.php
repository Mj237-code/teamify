<?php
session_start();
session_unset();
session_destroy();
header("Location: index.php"); // ou login.php selon ta logique
exit();
