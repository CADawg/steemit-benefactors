<!DOCTYPE HTML>
<html>

    <head>

        <title>Steemit 👏 Benefactors</title>
        <meta name="description" content="Steemit Beneficiaries is the best way to post on the steemit blockchain with tons of options! The 👏 future 👏 of 👏 steemit 👏 posting 👏 is 👏 here, 👏 now!"/>
        <meta name="keywords" content="steem,steemit,post,make,money,blockchain,delegation,benefactor,rewards,voting,split,share"/>
        <meta charset="utf-8"/>
        <meta lang="en"/>
        <meta name="author" content="Conor Howland (@cadawg)"/>
        <meta name="generator" content="@cadawg"/>
        <meta name="copyright" content="Copyright Conor Howland 2018"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <?php include "icons.php"; ?>

        <link type="text/css" rel="stylesheet" href="style.css"/>
        <link href="https://fonts.googleapis.com/css?family=Montserrat|Pacifico" rel="stylesheet">

        <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.1.0/cookieconsent.min.css" />
        <script src="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.1.0/cookieconsent.min.js"></script>
        <script src="consent.js"></script>
    </head>

    <body>
    
        <div id="wrapper">
        
            <div id="header">
            
                <div id="id">
                
                    <p>Steemit<br>Benefactors</p>
                
                </div>
                <div id="nav">
                
                    <ul>
                        <li><a href="index.php">Home</a></li>
                        <li><a href="https://v2.steemconnect.com/oauth2/authorize?client_id=cadawg.app&redirect_uri=https://cubiccastles.website/benefactor/callback.php&scope=comment,comment_options,custom_json,offline<?php if(isset($_GET['bf'])) {echo "&state=" . $actual_link;}?>">Login</a></li>
                        <li><a href="about.html">About</a></li>
                    </ul>
                    
                </div>
            
            </div>
            
            <div id="banner">
            
                <h1>Welcome to Steemit Benefactors</h1>
                <p>This is an app designed to customise posts more than most platforms will</p>
                <p>This app allows you to customise the permalink, add beneficiaries (people who share post rewards) along with live previews of the post.</p>
                <p>Click the login button to start using our app. We use steemconnect, this means that we do not get access to your steem keys and you can revoke access any time <a href="https://v2.steemconnect.com/revoke/@cadawg.app">here</a>.</p>
            </div>
            <div id="content">
            
                <h1>Sponsors/Supporters:</h1>
                <div class="supporter">
                    <div class="usr-image" id="cadawg"></div>
                    <h2><a href="https://steemit.com/@cadawg">@CADawg</a>&nbsp;<a href="https://conor.icu">[My Website]</a></h2>
                    <p>Wastes time writing code!</p>
                </div>
                <div class="supporter">
                    <div class="usr-image" id="mermaidvampire"></div>
                    <h2><a href="https://steemit.com/@mermaidvampire">@MermaidVampire</a></h2>
                    <p>Ideas, Concepts &amp; Motivation</p>
                </div>
                <div class="supporter">
                    <div class="usr-image" id="johndoer123"></div>
                    <h2><a href="https://steemit.com/@johndoer123">@JohnDoer123</a></h2>
                    <p>Donations &amp; Support</p>
                </div>
                    
            </div>
            
        </div>
        
    </body>

</html>