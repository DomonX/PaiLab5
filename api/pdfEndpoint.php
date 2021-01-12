<?php
    include_once($_SERVER['DOCUMENT_ROOT'].'/PaiLab5/pdfSaver/pdfSaver.php');
    include_once($_SERVER['DOCUMENT_ROOT'].'/PaiLab5/repository/resultDb/resultQuery.php');

    if(!isset($_POST['mode'])) {
      return;
    }

    if($POST['mode'] == 'create' && isset($_POST['testId'])) {
      $resultQuery = new ResultQuery();
      $tests = $resultQuery->getTestResults($_POST['testId']);
      $pdf = new PdfSaver();
      $pdf->save($tests);
    }
?>