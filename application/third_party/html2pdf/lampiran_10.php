<?php
    ob_start();
    include(dirname(__FILE__).'/report/lampiran_10.php');
    $content = ob_get_clean();

    // convert in PDF
    require_once(dirname(__FILE__).'/html2pdf.class.php');
    try
    {
        $html2pdf = new HTML2PDF('P', 'A4', 'fr');
//      $html2pdf->setModeDebug();
        $html2pdf->pdf->SetDisplayMode('fullpage');
        $html2pdf->setDefaultFont('times');
        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
        $html2pdf->Output('FOSS cetak pdf.pdf');
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }
echo "<meta http-equiv='Refresh' content='0; URL=input.php'>";
?>
