<?php
    include_once($_SERVER['DOCUMENT_ROOT'].'/PaiLab5/pdfSaver/pdfSaver.php');
    include_once($_SERVER['DOCUMENT_ROOT'].'/PaiLab5/repository/resultDb/resultQuery.php');

    // if(!isset($_POST['testId'])) {
    //   return;
    // }
    
    $resultQuery = new ResultQuery();
    $tests = $resultQuery->getTestResults(1);
    $pdf = new PdfSaver();
    $pdf->save($tests);
?>