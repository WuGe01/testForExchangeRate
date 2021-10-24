<?php
$rate = file_get_contents('https://tw.rter.info/capi.php');
$rateData = json_decode($rate, true);

switch($_SERVER['REQUEST_METHOD']){
    case "POST":

    $rate = $rateData['USD'.$_POST["data"]["currency"]]['Exrate']/$rateData['USDTWD']['Exrate'];
    if($_POST["data"]["currency"] == "JPY" || $_POST["data"]["currency"] == "USD" ){
        $result = $rate*( $_POST["data"]["price"] );
    }else{
        $result = $rate*( $_POST["data"]["price"] + ($_POST["data"]["discount"]*0.01) );
    }
    $record_time = $rateData['USDCVE']['UTC'];

    echo json_encode(array(
        "currency" => $_POST["data"]["currency"],
        "rate" => $rate,
        "price" => $_POST["data"]["price"],
        "discount" => $_POST["data"]["discount"],
        "result" => $result
    ));


    break;
    case "GET":

    echo json_encode(array(
        "result" => "success",
        "message" => "",
        "data" => array(
            array(
            "currency" => "USD",
            "rate" => 29.4,
            "price" => 25.0,
            "discount" => 9.9,
            "result" => 443.94,
            "record_time" => 12312 
            ),
        )
    ));
    break;
};


?>
