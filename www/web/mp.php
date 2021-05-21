<?php
require_once "lib/mercadopago.php";
$mp = new MP("6855942644171528", "N8zF5XaWdZNnVYPXCQLErxNW3dkBywCK");
$preference_data = array(
    "items" => array(
        array(
            "title" => $_POST['title'],
            "currency_id" => "ARS",
            "quantity" => (int) $_POST['quantity'],
            "unit_price" => (float)$_POST['unit_price'],
            "picture_url" =>$_POST['picture_url'],
            "description" => $_POST['description']
        )
    ),
    "notification_url" => $_POST['notification_url'],
    "external_reference" => $_POST['external_reference']
);
$preference = $mp->create_preference($preference_data);
echo json_encode($preference); exit();
/*?>

<!doctype html>
<html>
    <head>
        <title>MercadoPago SDK - Create Preference and Show Checkout Example</title>
    </head>
    <body>
       	<a href="<?php echo $preference["response"]["init_point"]; ?>" name="MP-Checkout" class="orange-ar-m-sq-arall">Pay</a>
        <script type="text/javascript" src="//resources.mlstatic.com/mptools/render.js"></script>
    </body>
</html>
