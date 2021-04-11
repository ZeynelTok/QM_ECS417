<?php
session_start();
session_destroy();
$url = "blog.php";
header("Location: $url");