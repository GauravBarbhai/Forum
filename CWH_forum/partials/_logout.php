<?php
session_start();
session_unset();
session_destroy();
header("Location: /CWH_forum/index.php");


?>