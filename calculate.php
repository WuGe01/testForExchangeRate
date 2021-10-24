<?php
$rate = file_get_contents('https://tw.rter.info/capi.php');
$rateData = json_decode($rate, true);

$host        = "host=127.0.0.1";
$port        = "port=5432";
$dbname      = "dbname=calculate_record";
$credentials = "user=postgres password=zzzz";
$db = pg_connect( "$host $port $dbname $credentials"  );

switch($_SERVER['REQUEST_METHOD']){
    case "POST":

    $currency = $_POST["data"]["currency"];
    $rate = number_format($rateData['USD'.$_POST["data"]["currency"]]['Exrate']/$rateData['USDTWD']['Exrate'],2);
    $price = number_format($_POST["data"]["price"],2);
    $discount = number_format($_POST["data"]["discount"],2);

    if($_POST["data"]["currency"] == "JPY" || $_POST["data"]["currency"] == "USD" ){
        $result = $rate*( $_POST["data"]["price"] );
    }else{
        $result = $rate*( $_POST["data"]["price"] + ($_POST["data"]["discount"]*0.01) );
    }

    $record_time = $rateData['USD'.$_POST["data"]["currency"]]['UTC'];

    $query="insert into calculate_record values('$currency',$rate,$price,$discount,$result,'$record_time')";
    $result=@pg_query($db,$query);

    echo json_encode(array(
        "currency" => $currency,
        "rate" => $rate,
        "price" => $price,
        "discount" => $discount,
        "query" => $query,
        "result" => $result
    ));

    break;
    case "GET":

    $query="select * from calculate_record";
    $result=@pg_query($db,$query);
    $row=@pg_fetch_all($result);

    echo json_encode(array(
        "result" => "success",
        "message" => "",
        "data" => $row
    ));
    break;
};


?>
