<?php
require __DIR__  . '/mp/lib/autoload.php';

$request=$_REQUEST;
// $request=array(
//     "id"=>"1008905035",
//     "topic"=>"merchant_order"
// );

/* SAVE REQUEST */
$nuevoarchivo = fopen("logs/request_" . date("d_m_Y__H_i_s") . ".txt", "w+");
fwrite($nuevoarchivo, var_export($_REQUEST, true));
fclose($nuevoarchivo);
/* END SAVE REQUEST */
MercadoPago\SDK::setAccessToken("APP_USR-4804142976439698-041607-4aabcd2552d8c58dda4ef2a179ad59c2-425126449");
try{
    $merchant_order = null;
    switch($request["topic"]) {
        case "payment":
        $payment = MercadoPago\Payment::find_by_id($request["id"]);
        // Get the payment and the corresponding merchant_order reported by the IPN.
        $merchant_order = MercadoPago\MerchantOrder::find_by_id($payment->order_id);
        case "merchant_order":
        $merchant_order = MercadoPago\MerchantOrder::find_by_id($request["id"]);
    }
    
    /* SAVE RESULT ORDER */
    $nuevoarchivo = fopen("logs/merchant_order_" . date("d_m_Y__H_i_s") . ".txt", "w+");
    fwrite($nuevoarchivo, var_export((Array)$merchant_order, true));
    fclose($nuevoarchivo);
    
    $paid_amount = 0;
    foreach ($merchant_order->payments as $payment) {   
        if ($payment->status == 'approved'){
            $paid_amount += $payment->transaction_amount;
        }
    }

    // If the payment's transaction amount is equal (or bigger) than the merchant_order's amount you can release your items
    if($paid_amount >= $merchant_order->total_amount){
        if (count($merchant_order->shipments)>0) { // The merchant_order has shipments
            if($merchant_order->shipments[0]->status == "ready_to_ship") {
                // sendPayApi($merchant_order);
            }
        } else { 
            sendPayApi($merchant_order);
        }
    } else {
        // sendPayApi($merchant_order);
    }
}catch (Exception $excepcion) {
    /* SAVE RESULT ORDER */
    $nuevoarchivo = fopen("logs/excepcion" . date("d_m_Y__H_i_s") . ".txt", "w+");
    fwrite($nuevoarchivo, var_export((Array)$excepcion, true));
    fclose($nuevoarchivo);
    /* END SAVE RESULT ORDER */
}

function sendPayApi($merchant_order){

    if($_SERVER['HTTP_HOST']=='land.page'){
        $urlAPI=$_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].'/api/pay/payIPN';
    }else{
        $urlAPI=$_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].$_SERVER['BASE'].'/api/pay/payIPN';
    }
    $postdata = http_build_query(
        array(
            'var1' => 'some content',
            'var2' => 'doh'
        )
    );
    $opts = array('http' =>
        array(
            'method'  => 'POST',
            'header'  => 'Content-type: application/x-www-form-urlencoded',
            'content' => $postdata
        )
    );
    $context  = stream_context_create($opts);
    $result = file_get_contents($urlAPI.'/'.$merchant_order->external_reference, false, $context);
    exit();
    // $ch = curl_init();
    // curl_setopt($ch, CURLOPT_URL,$urlAPI.'/'.$merchant_order->external_reference);
    // curl_setopt($ch, CURLOPT_POST, 1);
    // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    // curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.0.3705; .NET CLR 1.1.4322)');
    // $result = curl_exec ($ch);
    // echo '<pre>';
    // print_r($result);
    // echo '</pre>';
    // exit();
    // curl_close ($ch);

}

?>