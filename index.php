<?php
session_start();

$actual_link = isset($_SERVER['HTTPS']) ? "https" : "http";

$actual_link .= "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"
?>
<!DOCTYPE HTML>
<html>
<head>
    <title>Benefactor Posting Tool</title>
    <style>
        * {font-family: Ubuntu, Arial, sans-serif;}
    </style>
    <?php if(!isset($_GET['htmlonly'])) { ?><link href="https://fonts.googleapis.com/css?family=Ubuntu:300,700" rel="stylesheet">
        <style>.w3-input:focus {outline: none; border-bottom: 2px solid green;} .w3-panel {margin-top: 0 !important;}</style>
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"
                integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">
        <script src="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.js"></script>
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-45168180-5"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'UA-45168180-5');
        </script>
        <script>
            function createCookie(name, value, days) {
                var date, expires;
                if (days) {
                    date = new Date();
                    date.setTime(date.getTime()+(days*24*60*60*1000));
                    expires = "; expires="+date.toGMTString();
                } else {
                    expires = "";
                }
                document.cookie = name+"="+value+expires+"; path=/";
            }
        </script>
    <?php } ?>
</head>
<body>
<noscript>To experience this site at it's best, please <a href="https://enable-javascript.com/">Enable Javascript!</a></noscript>
<?php if(!isset($_COOKIE['cookies'])) { ?>
<div class="w3-panel w3-blue w3-display-container">
  <span onclick="this.parentElement.style.display='none';createCookie('cookies',1,30);"
        class="w3-button w3-red w3-large w3-display-topright">x</span>
    <h3 style="text-align: center;">This Site Uses Cookies!</h3>
    <p style="text-align: center;">We use cookies to improve your experience, if you wish to turn them off in your browser, see <a href="https://cookiesandyou.com/">here</a> for how to do so in your browser! (This will cause issues and depending on settings may stop the site from functioning!)</p>
    <p style="text-align: center;">By closing this you agree to our use of cookies!</p>
</div>
<?php } ?>
<?php if (!isset($_SESSION['code'])) { ?>
<h2 style="text-align: center;"><a href="https://v2.steemconnect.com/oauth2/authorize?client_id=cadawg.app&redirect_uri=https://cubiccastles.website/benefactor/callback.php&scope=comment,comment_options,custom_json,offline<?php if(isset($_GET['bf'])) {echo "&state=" . $actual_link;}?>">Sign In Using Steemconnect</a> to use this app!</h2>
<?php } else {?>
    <h2 style="text-align: center;">Hello, @<?php echo $_SESSION['user']; ?>   <a href="logout.php?state=<?php echo $actual_link;?>">Logout!</a></h2>
<form id="postform" action="submitpost.php" method="post" style="margin: 0 auto; text-align: center;" class="w3-container w3-card-4 w3-margin">
    <p style="text-align: center;">Title *:</p>
    <input required type="text" name="title" class="w3-input" style="width: 100%; font-size: 20px; font-weight: 700;"><br><br>
    <p style="text-align: center;">Permlink * (https://steemit.com/tag1(category)/@you/permlink) Only alphanumeric and dashes</p>
    <input required type="text" name="permlink" class="w3-input" style="width: 100%;"><br><br>
    <p style="text-align: center;">Tags* (All lowercase, alphanumeric and dashes only, separated by commas, min 1 max 5)!</p>
    <input required type="text" name="tags" class="w3-input" style="width: 100%;"><br><br>
    <p style="text-align: center;">Benefactors, in form benefactor:percentageto2dp<br> i.e. name:50.00,jeff:8.00 (No more than 100% and no trailing commas please :))</p>
    <input type="text" name="benefactor" class="w3-input" style="width: 100%;" placeholder="cadawg:10.00,mermaidvampire:5.00,johndoer123:2.50,ned:12:74" value="<?php if(isset($_GET['bf'])) {echo $_GET['bf'];} ?>"><br><br>
    <p>Your Post *:</p>
    <textarea class="w3-input" required title="Write your post here!" id="post" style="width: 100%; height: 50ch;" name="post"></textarea>


    <div id="yourpost"></div>

    <!--<script src='https://www.google.com/recaptcha/api.js'></script>
    <div class="g-recaptcha" data-sitekey="6Lf29lgUAAAAAGFJ33HRoDBGYrD3R3QqLEIs78dY"></div>-->

    <noscript><input type="submit" value="Submit!" class="w3-button w3-blue w3-round"> <br> If you see double submit buttons, don't worry! Either will work! <br></noscript><?php if(isset($_GET['htmlonly'])) { echo '<input type="submit" value="Submit!">'; } ?>
    <?php if(!isset($_GET['htmlonly'])) { ?> <button class="w3-button w3-blue w3-round" id="subjs" class="no-js">Submit!</button> <?php } ?>
    <div id="hyperholder"></div><br>
    <br><br>
</form>
<?php }; ?>

</body>
<?php if(!isset($_GET['htmlonly'])) { ?>
    <script>
        $("#subjs").click(function() {

            var url = "submitpost.php?js"; // the script where you handle the form input.

            $.ajax({
                type: "POST",
                url: url,
                data: $("#postform").serialize(), // serializes the form's elements.
                success: function(data)
                {
                    var ds = data.split(":|:&*83252835723&&+£");
                    alert(ds[0]); // show response from the php script.
                    if (1 in ds) {
                        $("#hyperholder").html(ds[1]);
                    }

                }
            });

            return false;
        });
    </script>
    <style>
        .no-js {display: none;}
        .btnb {
            background-color: dodgerblue;
            border-radius: 5px;
            border: 10px solid dodgerblue;
        }
        .btnb:active {
            background-color: blue;
            border: 10px solid blue;
            border-radius: 5px;
            outline: none;
        }
    </style>

<script>
    $(document).ready(function() {
        $("#subjs").removeClass("no-js");
    });

    var simplemd = new SimpleMDE({
        element: $("#post")[0],
        autosave: {
            enabled: true,
            delay: 10000,
            uniqueId: "post_content"
        },
        autoDownloadFontAwesome: true,
        placeholder: "Write your epic steemit post here!",
        forceSync: true
    });

    setInterval(function () {
        var markAble = "";
        $(".CodeMirror-line").each(function (index) {
            markAble = markAble + $($(".CodeMirror-line")[index]).text() + "\n";
        });
        document.getElementById('yourpost').innerHTML = simplemd.options.previewRender(markAble);
        $('#yourpost').find("code").addClass("w3-codespan ch-mono");
    }, 1000);
</script>
<?php } ?>

<div style="position:fixed;width:100%;bottom:0px;z-index: 10000; width: 100%; background-color: black; color: white;"><div style="margin: 0 auto; display: inline-block; position: relative; width: 100%;"><p style="margin: 0; text-align: center;">Contributors: <a href="https://steemit.com/@cadawg" target="_blank">@cadawg</a>, <a href="https://steemit.com/@mermaidvampire" target="_blank">@mermaidvampire</a>, <a href="https://steemit.com/@johndoer123" target="_blank">@JohnDoer123</a></p><p style="margin: 0; text-align: center; text-align: center;"><a href="privacy.php">Privacy</a></p></div></div>
</html>