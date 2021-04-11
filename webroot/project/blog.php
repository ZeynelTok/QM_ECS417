<!DOCTYPE html>

<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" href="main.css">

    <head></head>

    <header>
        <nav>
            <ul id="topbar">
                <li><strong>Zeynel Tok</strong></li>
                <li><a href="about myself.html">About Me</a></li>
                <li><a href="blog.php">Blog</a></li>
                <li><a href="contact.html">Contact</a></li>
            </ul>
        </nav>
    </header>

<body>
<?php
session_start();
if (!isset($_SESSION['ID'])){
    $disable = true;
}
else {
    $disable = false;
}
?>
    <div class="row">
        <div class="column left">
            <article>
                <h2>Blog</h2>
                <div class="blogbox">
                    <section></section>
                </div>

            </article>
        </div>
        <div class="column right">
            <aside>
                <div class="box">

                    <h2>Login</h2>
                    <?php if(isset($_SESSION['ID'])): ?>
                        
                        <form action="logout.php">
                            <P>You are logged in as <?=$_SESSION['firstName']?></P>
                        <input type="submit" id="logout" value="Logout">
                    </form>
                    <?php else: ?>
                        <form action="login.php" method="post">
                        <div class="login-form">

                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" required placeholder="Email">

                            <label for="password">Password</label>
                            <input type="password" id="password" name="password" required placeholder="Password">

                        </div>
                        <input type="submit" id="submit" value="Login">                       
                    </form>
                    <?php endif ?>
                </div>
            </aside>
            <aside>
                <div class="box">

                    <h2>Add Blog</h2>

                    <form action="addBlog.php" onsubmit="validateForm(event)" method="post">

                        <div class="login-form">

                            <label for="Title">Title</label>
                            <input type="text" id="title" name="title" <?=($disable ? " disabled=\"disabled\"" : "");?> placeholder="title">

                            <label for="maintext">Enter your text here</label>
                            <input type="text" id="maintext" name="maintext" <?=($disable ? " disabled=\"disabled\"" : "");?> placeholder="maintext">

                        </div>

                        <input type="submit" name="Post" id="Post" <?=($disable ? " disabled=\"disabled\"" : "");?> value="Post">
                        <script>
                            function validateForm(e) {
                                var title = document.getElementById("title");
                                var maintext = document.getElementById("maintext");
                                console.log(title);
                                console.log(maintext);
                                if (title.value == "" || maintext.value == "") {
                                    e.preventDefault();
                                    if (title.value == "" && maintext.value == "") {
                                        title.style.backgroundColor = "yellow";
                                        maintext.style.backgroundColor = "yellow";
                                    }
                                    else if (title.value ==""){
                                        title.style.backgroundColor = "yellow";
                                        maintext.style.backgroundColor = "white";
                                    }
                                    else {
                                        maintext.style.backgroundColor = "yellow";
                                        title.style.backgroundColor = "white";
                                    }
                                }
                            }
                        </script>
                        <input type="button" name="Clear" id="Clear" value="Clear" <?=($disable ? " disabled=\"disabled\"" : "");?> onclick="alertWindow()">
                        <script>
                            function alertWindow() {
                                if (confirm("Are you sure you want to clear?")) {
                                    document.getElementById("title").value = "";
                                    document.getElementById("maintext").value = "";
                                }
                            }
                        </script>


                    </form>

                </div>
            </aside>
        </div>





    </div>
    <footer>
        <p>Author: Zeynel Tok<br>
            <a href="mailto:ec18398@qmul.ac.uk">ec18398@qmul.ac.uk</a>
        </p>
    </footer>
</body>


</html>