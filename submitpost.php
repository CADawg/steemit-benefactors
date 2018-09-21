<?php

session_start();

require_once "makePost.php";

$postGenerator = new snaddyvitch_dispenser\operations\makePost();

function vCaptcha($response) {
    return true;
    /*$curl2 = curl_init();

    $ipAddress = $_SERVER['REMOTE_ADDR'];

    curl_setopt_array($curl2, array(
        CURLOPT_URL => "https://www.google.com/recaptcha/api/siteverify",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "secret=6Lf29lgUAAAAAEP3k8VWo_zY2-IPntSOUzgAAiZV&response=$response&remoteip=$ipAddress",
        CURLOPT_HTTPHEADER => array(
            "cache-control: no-cache",
            "content-type: application/x-www-form-urlencoded",
        ),
    ));

    $response = curl_exec($curl2);
    $err = curl_error($curl2);

    curl_close($curl2);

    if ($err) {
        return false;
    } else {
        return json_decode($response)->success;
    }
    return true;*/
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
            "account" => "cadawg",
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
                $weight = (double)$val * 100;

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
                print "Post created successfully!:|:&*83252835723&&+£<p class='link_to'>Visit your post:</p><br><a class='link_to' href='https://steemit.com/" . $category . "/@" . $_SESSION['user'] . "/" . $_POST['permlink'] . "'>Here (Steemit)</a><br><a class='link_to' href='https://busy.org/" . $category . "/@" . $_SESSION['user'] . "/" . $_POST['permlink'] . "'>Here (Busy)</a>";
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