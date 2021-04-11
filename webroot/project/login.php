<?php
session_start();
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    include 'db.php';   
    $sql_query = "select count(*) as count from users where email='".$_POST['email']."' and password='".$_POST['password']."'";
        $result = mysqli_query($conn,$sql_query);
        $row = mysqli_fetch_array($result);
        $count = $row['count'];
        if($count > 0){
            $_SESSION["ID"]=$row['ID'];
            $_SESSION["firstName"]=$row['firstName'];
            $_SESSION["lastName"]=$row['lastName'];
            $_SESSION["email"]=$row['email']; 
            header('Location: blog.php');
            exit;
        }
        else
        {
            echo "Invalid Email/Password";
            header('Location: blog.php');
            exit;
        }
        $conn->close();   
}
?>