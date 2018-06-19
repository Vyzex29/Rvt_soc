<?php

require_once ('vendor/autoload.php');

$mpdf = new \Mpdf\Mpdf();

ob_start();

$day = date('d');
$year = date('Y');
$month = date('F');

echo "Hello World
Today is $month $day, $year";

$html = ob_get_contents();
ob_end_clean();

// Here convert the encode for UTF-8, if you prefer 
// the ISO-8859-1 just change for $mpdf->WriteHTML($html);
$mpdf->WriteHTML(utf8_encode($html));
$mpdf->Output('Output.pdf','D');
?>
