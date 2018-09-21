<?php
/**
 * Created by PhpStorm.
 * User: Conor Howland
 * Date: 21/09/2018
 * Time: 23:07
 */

if(isset($_POST['title']) /*and isset($_POST['g-recaptcha-response'])*/ and isset($_POST['permlink']) and isset($_POST['tags']) and isset($_POST['benefactor']) and isset($_POST['post'])) {
    if(vCaptcha($_POST['g-recaptcha-response'])) {
        $json_metadata = [
            "community" => "beneficiaries",
            "app" => "beneficiaries/1.1.2",
            "format" => "markdown",
            "tags" => array_slice(explode(",", $_POST['tags']), 0, 5)
        ];

        $category = explode(",", $_POST['tags'], 2)[0];
        $post = $postGenerator->createPost($_POST['title'], $_POST['post'], $json_metadata, $_POST['permlink'], genBeneficiaries($_POST['benefactor']), $category);
        $state = $postGenerator->broadcast($post);
        if(isset($state->result)) {
            print "Your post was created successfully!<br>Visit your post: <br><a href='https://steemit.com/" . $category . "/@" . $_SESSION['user'] . "/" . $_POST['permlink'] . "'>Here (Steemit.com)</a><br><a href='https://busy.org/" . $category . "/@" . $_SESSION['user'] . "/" . $_POST['permlink'] . "'>Here (Busy.org)</a>";
        } elseif (isset($state->error)) {
            print("<a href='/benefactor/'>Go Back to the form!</a><br>");
            print("We Have encountered a " . $state->error . " : " . $state->error_description . "!<br>So That you can re-create the post, here is the data you submitted:<br><br>");
            foreach ($_POST as $key => $value) {
                print $key . " --- " . $value . "<br>";
            }
        } else {
            print("<a href='/benefactor/'>Go Back to the form!</a>");
            print "Unknown error!, Please try again!<br>";
            print "So that you can re-create the post, here is the data you submitted:<br><br>";
            foreach ($_POST as $key => $value) {
                print $key . " --- " . $value . "<br>";
            }
        }
    } else {
        print("<a href='/benefactor/'>Go Back to the form!</a><br>");
        print ("Invalid captcha response!<br>");
        print "So that you can re-create the post, here is the data you submitted:<br><br>";
        foreach ($_POST as $key => $value) {
            print $key . " --- " . $value . "<br>";
        }
    }
} else {
    print("<a href='/benefactor/'>Go Back to the form!</a><br>");
    print("Sorry, you are missing some of the items<br>");
    print "So that you can re-create the post, here is the data you submitted:<br><br>";
    foreach ($_POST as $key => $value) {
        print $key . " --- " . $value . "<br>";
    }
}