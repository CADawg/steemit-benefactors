<?php

session_start();

require_once "makePost.php";

$postGenerator = new snaddyvitch_dispenser\operations\makePost();

function vCaptcha($response) {
    return true;
}

function genBeneficiaries($tring) {
    $arr_str = explode(",",$tring);

    $beneficiaries = [];
    if(!($arr_str === null or $arr_str === [""])) {
        foreach ($arr_str as $tr) {
            $xpld = explode(":", $tr);

            $weight = (float)$xpld[1] * 100;

            $weight = (int)$weight;

            $beneficiary =
                [
                    "account" => $xpld[0],
                    "weight" => $weight
                ];

            $beneficiaries[] = $beneficiary;
        }
    }

    return $beneficiaries;
}

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}


function genNewBeneficiaries($names,$percents) {
    $beneficiaries = [
        [
            "account" => "steemyjokes",
            "weight" => 100,
        ],
        [
            "account" => "apps4steem",
            "weight" => 400,
        ]
    ];

    if(!($names === null or $percents === null)) {
        foreach ($names as $ind=>$val) {
            if (isset($val) and $val !== "" and $val !== null and isset($percents[$ind]) and $percents[$ind] !== "" and $percents[$ind] !== null) {
                $weight = (double)$percents[$ind] * 100;

                $weight = (int)$weight;

                $beneficiary =
                    [
                        "account" => $val,
                        "weight" => $weight
                    ];

                $beneficiaries[] = $beneficiary;
            }
        }
    }

    return $beneficiaries;
}


$vl = require  'verifylogin.php';

if (isset($_GET['js']) and $vl) {
    if(isset($_POST['title']) and isset($_POST["ubenefactors"]) and isset($_POST["vbenefactors"]) and /*isset($_POST['g-recaptcha-response']) and*/ isset($_POST['permlink']) and isset($_POST['tags']) and isset($_POST['post'])) {
        if(vCaptcha($_POST['g-recaptcha-response'])) {
            $json_metadata = [
                "community" => "beneficiaries",
                "app" => "beneficiaries/1.1.2",
                "format" => "markdown",
                "tags" => array_slice(explode(",", $_POST['tags']), 0, 5)
            ];

            $category = explode(",", $_POST['tags'], 2)[0];
            $post = $postGenerator->createPost($_POST['title'], $_POST['post'], $json_metadata, $_POST['permlink'], genNewBeneficiaries($_POST['ubenefactors'],$_POST['vbenefactors']), $category);
            $state = $postGenerator->broadcast($post);
            if(isset($state->result)) {
                print "<p>Post created successfully!</p><p class='titl'>Steemit:</p><p><a href='https://steemit.com/" . $category . "/@" . $_SESSION['user'] . "/" . $_POST['permlink'] . "'>Link To Post</a></p><p class='titl'>Busy:</p><p><a href='https://busy.org/" . $category . "/@" . $_SESSION['user'] . "/" . $_POST['permlink'] . "'>Link To Post</a></p>";
                $_SESSION["randstring"] = generateRandomString();
            } elseif (isset($state->error)) {
                print($state->error . " : " . $state->error_description);
            } else {
                print "Unknown error!, Please try again!";
            }
        } else {
            print ("Invalid captcha response!");
        }
    } else {
        print("Sorry, you are missing some of the items");
    }
} elseif (!$vl) {
    print("Sorry, you are not signed in!");
    print_r($_POST);
} else {
    print("Invalid Request!");
}