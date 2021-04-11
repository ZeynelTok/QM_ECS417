<?php
session_start();
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    include 'db.php';   
    if(!empty($month)) {
        $blogquery = "SELECT * FROM blogs where month(dateandtime) = "'.$month.'" order by dateandtime desc";
         }
         else {
            $blogquery = "SELECT * FROM blogs order by dateandtime desc";
         }
        $conn->close();   
        header('Location: blog.php');
        exit;
}
?>