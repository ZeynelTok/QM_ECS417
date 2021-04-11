<?php
session_start();
if(isset($_POST['save']))
{
    extract($_POST);
    include 'db.php';
    $sql=mysqli_query($conn,"SELECT * FROM users where email='$email' and password='$password'");
    $row  = mysqli_fetch_array($sql);
    if(is_array($row))
    {
        $_SESSION["ID"]=$row['ID'];
        $_SESSION["firstName"]=$row['firstName'];
        $_SESSION["lastName"]=$row['lastName'];
        $_SESSION["email"]=$row['email']; 
        $url = "blog.html";
        header("Location: $url");
    }
    else
    {
        echo "Invalid Email/Password";
    }

    
}
if (isset($_SESSION)){
    $disable = false;
}
else {
    $disable = true;
}
?>