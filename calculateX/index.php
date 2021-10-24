<?php
$rate = file_get_contents('https://tw.rter.info/capi.php');
$rateData = json_decode($rate, true); 

// if(!empty($_GET)){
//     // var_dump($_GET);
//     echo json_encode(array("data1"=>1));
// }
// if(!empty($_POST)){
//     // var_dump($_POST);
//     echo json_encode(array("data2"=>2));
// }

// echo 123;


echo ('<pre>');
print_r($rateData);
print_r($rateData['USDCVE']);
echo ('</pre>');
echo "<hr>";
echo $rateData['USDCVE']['Exrate'];



?>
