<?php

namespace snaddyvitch_dispenser\operations;

class makePost
{

    public function createPost($title, $body, $json_php_array, $permalink, $beneficiaries,$category)
    {
        $json_meta = json_encode($json_php_array);
        $post = [
            "operations" => [
                ["comment", [
                    "parent_author" => "",
                    "parent_permlink" => $category,
                    "title" => $title,
                    "body" => $body . "\n## **This post was created using @cadawg's [beneficiairies.app](https://cubiccastles.website/benefactor/)**",
                    "json_metadata" => $json_meta,
                    "author" => $_SESSION['user'],
                    "permlink" => $permalink
                ]],
                ["comment_options", [
                    "author" => $_SESSION['user'],
                    "permlink" => $permalink,
                    "max_accepted_payout" => "1000000.000 SBD",
                    "percent_steem_dollars" => 10000,
                    "allow_votes" => true,
                    "allow_curation_rewards" => true,
                    "extensions" => []
                ]]
            ]
        ];

        if ($beneficiaries != []) {
            $post["operations"][1][1]["extensions"] = [[0, ["beneficiaries" => $beneficiaries]]];
        }

        $fixed_str = str_replace(str_replace("/", "\\\\\\/", $json_php_array['app']), $json_php_array['app'], json_encode($post));
        //print($fixed_str);
        return $fixed_str;
    }

    public function broadcast($post)
    {

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://v2.steemconnect.com/api/broadcast",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_POSTFIELDS => $post,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_HTTPHEADER => array(
                "accept: application/json",
                "authorization: " . $_SESSION['code'],
                "cache-control: no-cache",
                "content-type: application/json",
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return json_decode('{"error":"server_comms","error_description":"Failed to connect to the server!"}');
        } else {
            return json_decode($response);
        }
    }
}