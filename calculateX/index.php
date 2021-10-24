<?php
$rate = file_get_contents('https://tw.rter.info/capi.php');
$rateData = json_decode($rate, true);
echo "<pre>";
print_r($rateData);
echo "</pre>";

?>
