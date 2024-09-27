<?php
    require '../klachtverwerking/vendor/autoload.php';

    $html = "<!DOCTYPE html>
    <html lang='en'>
    <head>
        <title></title>
        <meta charset='utf-8' />
    </head>
    <body>
        <h1>Dit is een titel </h1>
        <p>En dit een alinea</p>
    </body>
    </html>";
    // reference the Dompdf namespace
    use Dompdf\Dompdf;

    // instantiate and use the dompdf class
    $dompdf = new Dompdf();
    $dompdf->loadHtml($html);

    // (Optional) Setup the paper size and orientation
    $dompdf->setPaper('A4', 'landscape');

    // Render the HTML as PDF
    $dompdf->render();

    // Output the generated PDF to Browser
    $dompdf->stream();
    ?>