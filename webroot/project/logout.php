<?php
session_start();
session_unset();
session_write_close();
session_destroy();
$url = "blog.php";
header("Location: $url");