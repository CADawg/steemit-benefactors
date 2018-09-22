<?php
/**
 * Created by PhpStorm.
 * User: Conor Howland
 * Date: 22/09/2018
 * Time: 12:17
 */

function genNewBeneficiaries($names,$percents) {
    $beneficiaries = "";

    if(!($names === null or $percents === null)) {
        foreach ($names as $ind=>$val) {
            if (isset($val) and $val !== "" and $val !== null and isset($percents[$ind]) and $percents[$ind] !== "" and $percents[$ind] !== null) {
				
                $beneficiary = $val . ":" . ($percents[$ind]) . ",";

                $beneficiaries .= $beneficiary;
            }
        }
		
	}
	
	return ((isset($_SERVER["HTTPS"]) and $_SERVER["HTTPS"] != "off") ? "https://" : "http://") . $_SERVER["HTTP_HOST"] . (str_replace("/getBenefactorUrl.php","",explode("?",$_SERVER["REQUEST_URI"])[0])) . "?bf=" . $beneficiaries;
	
}

if(isset($_POST["ubenefactors"]) and isset($_POST["vbenefactors"])) {
    echo genNewBeneficiaries($_POST["ubenefactors"],$_POST["vbenefactors"]);
}