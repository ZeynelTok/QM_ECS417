<?php
session_start();
session_unset();
session_write_close();
$url = "blog.html";
header("Location: $url");