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
                <div id="previewbox" class="blogbox">
                    <table>
                        <tr>
                            <th id='blogdate'>Date & Time</th>
                            <th id='blogtitle'>Title</th>
                            <th id='blogmaintext'>Blog Text</th>
                        </tr>
                        <tr>
                            <td id='previewdateandtime'>date</td>
                            <td id='previewtitle'>title</td>
                            <td id='previewmaintext'>maintext</td>
                        </tr>
                    </table>
                    <form action="addBlog.php" method="post">

                        <input type="submit" name="PreviewConfirmed" id="PreviewConfirmed" value="Confirm" onclick="previewconfirmed(event)">
                        <input type="submit" name="PreviewCancelled" id="Cancelled" value="Cancel" onclick="previewcancelled(event)">
                        <script>
                            function previewconfirmed(e) {
                                e.preventDefault();
                                var form = new FormData();
                                form.append("title",document.getElementById("title").value);
                                form.append("maintext", document.getElementById("maintext").value); 


                                // var content = '<a id="a"><b id="b">hey!</b></a>'; 
                                // var blob = new Blob([content], {
                                //     type: "text/xml"
                                // });
                                // formData.append("webmasterfile", blob);

                                var request = new XMLHttpRequest();
                                request.open("POST", "addBlog.php");
                                request.send(form);
                            }
                        </script>
                        <script>
                            function previewcancelled(e) {
                                e.preventDefault();
                                previewbox.style.display = "none";
                               
                            }
                        </script>
                    </form>
                </div>
                <div class="blogbox">
                    <section>
                        <?php
                        include 'db.php';
                        $blogquery = "SELECT * FROM blogs order by dateandtime desc";
                        $output = mysqli_query($conn, $blogquery);
                        echo "<table id='blogPosts'><thead>
                        <tr>
                        <th id='blogdate'>Date & Time</th>
                        <th id='blogtitle'>Title</th>
                        <th id='blogmaintext'>Blog Text</th>
                        </tr>
                        </thead>";
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
                            for (i = 1; i < tr.length; i++) {
                                cells = tr[i].getElementsByTagName("td");
                                cell = cells[0].innerText;
                                month = cell.split('-')[1];
                                console.log(selectmonth.value);
                                console.log(month);
                                if (selectmonth.value != '00') {
                                    if (month != selectmonth.value) {
                                        tr[i].style.display = "none";
                                    } else {
                                        tr[i].style.display = "";
                                    }
                                } else {
                                    tr[i].style.display = "";
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
                            function previewBlog(e, title, maintext) {
                                e.preventDefault();
                                var previewbox = document.getElementById("previewbox");
                                var previewdateandtime = document.getElementById("previewdateandtime");
                                var previewtitle = document.getElementById("previewtitle");
                                var previewmaintext = document.getElementById("previewmaintext");
                                previewbox.style.display = "block";
                                previewtitle.innerText = document.getElementById("title").value;
                                previewmaintext.innerText = document.getElementById("maintext").value;
                                previewdateandtime.innerText = new Date().toLocaleString();
                                console.log(title.value);
                                console.log(maintext.value);
                            }
                        </script>
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