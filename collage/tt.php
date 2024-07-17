<?php
    /*date_default_timezone_set('America/Atikokan');
    echo date_default_timezone_get(); // Europe/Sofia
    echo ' => '.date('T'); // => EET



echo "----------------------------";*/
?>

<?php
echo timezone_name_from_abbr("AWST") . "\n";
echo timezone_name_from_abbr("", 3600, 0) . "\n";
echo "----------------------------<br/>";
$dateTime = new DateTime('now', new DateTimeZone(timezone_name_from_abbr("AWST")));
$dateTime->setTimezone(new DateTimeZone('AWST'));
echo $dateTimeUtc = $dateTime->format('Y-m-d H:i:s');
?>
