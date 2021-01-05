<?php

include "../fpdf/fpdf.php";

class PdfSaver {
  public function save($currentExam, $currentIndex) {
      $pdf = new FPDF();
      $pdf->AddPage();
      $pdf->SetFont("Arial", "B", 20);
      $pdf->cell(0, 20, "Hello World!!", 0, 0, "C");
      $pdf->output();
  }
}

if($_GET and isset($_GET['generatePdf'])){
  $p = new PdfSaver();
  $p->save("", "");
}

?>