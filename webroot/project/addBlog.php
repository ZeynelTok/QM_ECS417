<?php
session_start();
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    include 'db.php';   
    $sql_query = "INSERT INTO blogs (id, dateandtime, title, maintext) VALUES ('1', CURRENT_TIMESTAMP(), ".$_POST['title'].", ".$_POST['maintext'].")";
    echo $sql_query;
    if(mysqli_query($conn, $sql_query)){
        echo ('123');
        header('Location: blog.php');
        exit;
    }
    $conn->close();       
}
?>