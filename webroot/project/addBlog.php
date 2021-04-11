<?php
session_start();
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    include 'db.php';   
    date_default_timezone_set('Europe/London');
    $date = date('Y-m-d H:i:s');
    $sql_query = "INSERT INTO blogs (dateandtime, title, maintext) VALUES ('$date', '".$_POST['title']."', '".$_POST['maintext']."')";
    echo $sql_query;
    if(mysqli_query($conn, $sql_query)){
        header('Location: blog.php');
        exit;
    }
    $conn->close();       
}
?>