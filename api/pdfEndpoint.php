<?php
    include_once($_SERVER['DOCUMENT_ROOT'].'/PaiLab5/pdfSaver/pdfSaver.php');
    include_once($_SERVER['DOCUMENT_ROOT'].'/PaiLab5/repository/resultDb/resultQuery.php');

    if(!isset($_GET['mode'])) {
      return;
    }

    if($_GET['mode'] == 'create' && isset($_GET['testId'])) {
      $resultQuery = new ResultQuery();
      $tests = $resultQuery->getTestResults($_GET['testId']);
      $pdf = new PdfSaver();
      $pdf->save($tests);
    }
?>