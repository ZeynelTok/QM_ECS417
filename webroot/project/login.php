<?php
session_start();
if(isset($_POST['save']))
{
    echo '123';
    extract($_POST);
    include 'db.php';
    $sql=mysqli_query($conn,"SELECT * FROM users where email='$email' and password='$password'");
    $row  = mysqli_fetch_array($sql);
    if(is_array($row))
    {
        echo '456';
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

    
}
if (isset($_SESSION)){
    $disable = false;
}
else {
    $disable = true;
}
?>