<?php
require __DIR__  . '/mp/lib/autoload.php';
try {
    $baseUrl=$_POST['baseUrl'];
    $urlSetting=$_POST['urlSetting'];
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,$urlSetting);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec ($ch);
    curl_close ($ch);
    if(!$result)
        throw new Exception("Error Processing Request", 1);
    $setting=json_decode($result,true);  
    
    MercadoPago\SDK::setClientId($setting["data"]["mp_client_id"]);
    MercadoPago\SDK::setClientSecret($setting["data"]["mp_client_secret"]);
    MercadoPago\SDK::setPublicKey('APP_USR-2ca8612c-d6c4-4aa3-944d-27fcea544211');
    MercadoPago\SDK::setAccessToken('APP_USR-4804142976439698-041607-4aabcd2552d8c58dda4ef2a179ad59c2-425126449');
    
    $preference = new MercadoPago\Preference();
    
    $item = new MercadoPago\Item();
    $item->id = $_POST["id"];
    $item->title = $_POST["title"];
    $item->description = $_POST["description"];
    $item->quantity = (int)$_POST["quantity"];
    $item->currency_id = $_POST["currency_id"];
    $item->picture_url = $_POST["picture_url"];
    $item->unit_price = (float)$_POST["unit_price"];

    $payer = new MercadoPago\Payer();
    $payer->email = $_POST["email"];

    $preference->items = array($item);
    $preference->payer = $payer;
    $preference->external_reference = $_POST["external_reference"];
    // $preference->notification_url = $baseUrl."/ipn.php";
    $preference->save();
    $preferenceArray=(Array)$preference;
    $return=array(
        'result'=>true,
        'data'=>$preferenceArray,
    );
    $json=json_encode($return);
    $response=str_replace('\u0000*\u0000','',$json);
    echo $response;
}catch (Exception $excepcion) {
    $excepcionArray=(Array)$excepcion;
    $return=array(
        'result'=>false,
        'data'=>$excepcionArray,
    );
    $json=json_encode($return);
    $response=str_replace('\u0000*\u0000','',$json);
    echo $response;
}
exit();
?>