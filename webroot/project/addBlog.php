<?php
session_start();
if($_SERVER["REQUEST_METHOD"] == "POST")
{  
    echo "im here";
    print_r($_POST);
    include 'db.php';   
    date_default_timezone_set('Europe/London');
    $date = date('Y-m-d H:i:s');
    $sql_query = "INSERT INTO blogs (dateandtime, title, maintext) VALUES ('$date', '".$_POST['title']."', '".$_POST['maintext']."')";
    // if (isset($_POST['Preview'])) {
        
    //     echo "
    //         <script type=\"text/javascript\">
    //         if (confirm('Would you like to post this blog or cancel to edit?')) {

    //         }
    //         else {
    //             var e = document.getElementById('testForm'); e.action='test.php'; e.submit();
    //         }
            
    //         </script>
    //     ";
    // }
    if (mysqli_query($conn, $sql_query)){
        header('Location: blog.php');
        exit;
    }
    $conn->close();       
}
?>