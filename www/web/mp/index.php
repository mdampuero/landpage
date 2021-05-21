<?php
require __DIR__  . '/vendor/autoload.php';

MercadoPago\SDK::setClientId("6855942644171528");
MercadoPago\SDK::setClientSecret("N8zF5XaWdZNnVYPXCQLErxNW3dkBywCK");

//Create a preference object
$preference = new MercadoPago\Preference();
# Create an item object
$item = new MercadoPago\Item();
$item->id = "1234";
$item->title = "Durable Bronze Car";
$item->quantity = 7;
$item->currency_id = "ARS";
$item->unit_price = 2.62;
# Create a payer object
$payer = new MercadoPago\Payer();
$payer->email = "jack@hotmail.com";
# Setting preference properties
$preference->items = array($item);
$preference->payer = $payer;
# Save and posting preference
$preference->save();

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Pagar</title>
    </head>
    <body>
        <button class="btn btn-primary noRadius" type="button" onclick="pagar()" id="btn-pay">Pagar</button>
        <script type="text/javascript">
        var mp;
        function pagar(){
            $MPC.openCheckout({
                url: '<?php echo $preference->init_point; ?>',
                    mode: "modal",
                    onreturn: function (data) {
                        console.log(data);
                        if (data.collection_status=='approved'){
                            $('#form_collection_id').val(data.collection_id);
                            $('#form_status').val(1);
                            $('#form_success').submit();
                        } else if(data.collection_status=='pending'){
                            $('#form_collection_id').val(data.collection_id);
                            $('#form_status').val(0);
                            $('#form_success').submit();
                        } else if(data.collection_status=='in_process'){    
                            $('#form_collection_id').val(data.collection_id);
                            $('#form_status').val(0);
                            $('#form_success').submit();
                        } else if(data.collection_status=='rejected'){
                            // printAlert('alert-danger',"No se pudo realizar el pago, vuelve a intentarlo");
                        } else if(data.collection_status==null){
                            // printAlert('alert-danger',"No se pudo realizar el pago, vuelve a intentarlo");
                            console.log("cancelado");
                        }else{
                            console.log("cancelado");
                            // printAlert('alert-danger',"No se pudo realizar el pago, vuelve a intentarlo");
                        }
                    }
                });
        }
        </script>
        <script type="text/javascript">
            (function(){function $MPC_load(){window.$MPC_loaded !== true && (function(){var s = document.createElement("script");s.type = "text/javascript";s.async = true;s.src = document.location.protocol+"//secure.mlstatic.com/mptools/render.js";var x = document.getElementsByTagName('script')[0];x.parentNode.insertBefore(s, x);window.$MPC_loaded = true;})();}window.$MPC_loaded !== true ? (window.attachEvent ?window.attachEvent('onload', $MPC_load) : window.addEventListener('load', $MPC_load, false)) : null;})();
        </script>
    </body>
</html>
