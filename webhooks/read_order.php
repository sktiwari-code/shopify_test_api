<?php
define('SECRET_KEY','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');
$response="";
function verify_request($data,$hmac)
{
    $verify_hmac = base64_encode( hash_hmac( 'sha256', $data, SECRET_KEY, true) );

    return hash_equals($hmac,$verify_hmac);
}

$my_hmac = $_SERVER['HTTP_X_SHOPIFY_HMAC_SHA256'];

$data = file_get_contents('php://input');
$utf8 = utf8_encode( $data );
$data_json = json_decode ( $utf8, true );

$verify_merchant = verify_request( $data, $my_hmac );

if( $verify_merchant )
{
    $response = $data_json;
}
else{
    $response = 'Somthing Went Wrong';
}

$shop_domain = $_SERVER['HTTP_X_SHOPIFY_SHOP_DOMAIN'];
$log = fopen( $shop_domain.time(). ".json", "w") or die("Cannot open or create file");
fwrite($log,json_encode($response));
fclose($log);

?>