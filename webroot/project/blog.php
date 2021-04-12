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
    if (!isset($_SESSION['ID'])) {
        $disable = true;
    } else {
        $disable = false;
    }
    ?>
    <div class="row">
        <div class="column left">
            <article>
                <h2>Blog</h2>
                <form action="" onsubmit="orderBlog(event, selectmonth)" method="post">
                    <select name="selectmonth" id="selectmonth">
                        <option value="00" selected="selected">Any Month</option>
                        <option value="01">January</option>
                        <option value="02">February</option>
                        <option value="03">March</option>
                        <option value="04">April</option>
                        <option value="05">May</option>
                        <option value="06">June</option>
                        <option value="07">July</option>
                        <option value="08">August</option>
                        <option value="09">September</option>
                        <option value="10">October</option>
                        <option value="11">November</option>
                        <option value="12">December</option>
                    </select>
                    <label for="Search">Blogs Posted In:</label>
                    <input type="submit" id="Go" value="Search">
                </form>
                <div class="blogbox">
                    <section>
                        <?php
                        include 'db.php';
                        $blogquery = "SELECT * FROM blogs order by dateandtime desc";
                        $output = mysqli_query($conn, $blogquery);
                        echo "<table id='blogPosts'>";
                        while ($row = mysqli_fetch_array($output)) {
                            echo "<tr id ='blogrow'><td id='blogdate'>" . $row['dateandtime'] . "</td><td id='blogtitle'>" . $row['title'] . "</td><td id='blogmaintext'>" . $row['maintext'] . "</td></tr>";
                        }
                        echo "</table>";
                        ?>
                    </section>
                    <script>
                        function orderBlog(e, selectmonth) {
                            e.preventDefault();
                            table = document.getElementById("blogPosts");
                            tr = table.getElementsByTagName("tr");
                            for (i = 0; i < tr.length; i++) {
                                cells = tr[i].getElementsByTagName("td");
                                cell = cells[0].innerText;
                                month = cell.split('-')[1];
                                console.log(selectmonth.value);
                                console.log(month);
                                if (selectmonth.value != '00') {
                                    if (month != selectmonth.value) {
                                        tr[i].style.display = "none";
                                    } else {
                                        tr[i].style.display = "block";
                                    }
                                } else {
                                    tr[i].style.display = "block";
                                }
                            }
                        }
                    </script>
                </div>

            </article>
        </div>
        <div class="column right">
            <aside>
                <div class="box">

                    <h2>Login</h2>
                    <?php if (isset($_SESSION['ID'])) : ?>

                        <form action="logout.php">
                            <P>You are logged in as <?= $_SESSION['firstName'] ?></P>
                            <input type="submit" id="logout" value="Logout">
                        </form>
                    <?php else : ?>
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
                <div id="previewmodal" class="modal">

                    <div class="modal-content">
                        <table>
                            <tr>
                                <td id='previewdateandtime'></td>
                                <td id='previewtitle'></td>
                                <td id ='previewmaintext'></td>
                            </tr>
                        </table>
                    </div>

                </div>
                <div class="box">

                    <h2>Add Blog</h2>

                    <form action="addBlog.php" onsubmit="validateForm(event,title,maintext)" method="post">

                        <div class="login-form">

                            <label for="title">Title</label>
                            <input type="text" id="title" name="title" <?= ($disable ? " disabled=\"disabled\"" : ""); ?> placeholder="title">

                            <label for="maintext">Enter your text here</label>
                            <input type="text" id="maintext" name="maintext" <?= ($disable ? " disabled=\"disabled\"" : ""); ?> placeholder="maintext">

                        </div>

                        <input type="submit" name="Post" id="Post" <?= ($disable ? " disabled=\"disabled\"" : ""); ?> value="Post">
                        <input type="submit" name="Preview" id="Preview" <?= ($disable ? " disabled=\"disabled\"" : ""); ?> value="Preview" onclick="return previewBlog(event, title,maintext)">
                        <script>
                            function validateForm(e, title, maintext) {
                                //var title = document.getElementById("title");
                                //var maintext = document.getElementById("maintext");
                                if (title.value == "" || maintext.value == "") {
                                    e.preventDefault();
                                    if (title.value == "" && maintext.value == "") {
                                        title.style.backgroundColor = "yellow";
                                        maintext.style.backgroundColor = "yellow";
                                    } else if (title.value == "") {
                                        title.style.backgroundColor = "yellow";
                                        maintext.style.backgroundColor = "white";
                                    } else {
                                        maintext.style.backgroundColor = "yellow";
                                        title.style.backgroundColor = "white";
                                    }
                                    return false;
                                }
                            }
                        </script>
                        <script>
                            function previewBlog(e, title,maintext) {
                                e.preventDefault();
                                var previewmodal = document.getElementById("previewmodal");
                                var previewdateandtime = document.getElementById("previewdateandtime");
                                var previewtitle = document.getElementById("previewtitle");
                                var previewmaintext = document.getElementById("previewmaintext");
                                previewmodal.style.display ="block";
                                previewtitle.value = title;
                                previewmaintext.value = maintext;
                                previewdateandtime.value = new Date();
                                if (confirm("Do you want to post this blog or cancel and edit?")) {
                                    return true;
                                }
                                else {
                                    return false;
                                }
                            }
                        </script>
                        <script>
                            function alertWindow() {
                                var title = document.getElementById("title");
                                var maintext = document.getElementById("maintext");
                                if (confirm("Are you sure you want to clear?")) {
                                    title.value = "";
                                    maintext.value = "";
                                }
                            }
                        </script>
                        <input type="button" name="Clear" id="Clear" value="Clear" <?= ($disable ? " disabled=\"disabled\"" : ""); ?> onclick="alertWindow()">



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