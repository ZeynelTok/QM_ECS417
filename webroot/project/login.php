<?php
session_start();
var_dump($_POST);
echo $_POST["email"];
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    echo '123';
    var_dump($_POST);
    extract($_POST);
    var_dump($_POST);
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
        //header('Location: blog.php');
        //exit;
    }
    else
    {
        echo "Invalid Email/Password";
        //header('Location: blog.php');
        //exit;
    }
    $conn->close();

    
}
?>