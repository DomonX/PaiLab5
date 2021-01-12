<?php

include "../fpdf/fpdf.php";

class PdfSaver {
  public function save($data) {
      $pdf = new FPDF();
      $pdf->AddPage();
      $pdf->SetFont("Arial", "B", 20);
      $pdf->SetTitle("Raport");
      foreach($data as $current) {
        $pdf->Cell(0,10,'Student ' . $current->index,1,1,'C');
        $pdf->Cell(0,10,'Grupa: ' . $current->group,1,1,'C');
        $pdf->Cell(0,10,'Nazwa zaliczenia: ' . $current->name,1,1,'C');
        $pdf->Cell(0,10,'Status: ' . $this->getStatus($current->status),1,1,'C');
        $pdf->Cell(0,10,'' ,0,1,'C');        
      }

      $pdf->output("D", "raport.pdf");
  }

  private function getStatus($status) {
    switch($status) {
      case 0:
        return "Nie zalogowal sie";
      case 1:
        return "Zobaczyl ocene ale nic nie zrobil";
      case 2:
        return "Zaakceptowal ocene";
      case 3:
        return "Wyslal uwagi";
      default:
        return "status nieznany";
    }
  }
}

if($_POST and isset($_POST['generatePdf'])){
}
$p = new PdfSaver();
$p->save([ 
  (object)[ 
    "index"=> "089112",
    "group"=> "3ID11A",
    "name"=> "nazwa",
    "status"=> 0
  ],
  (object)[ 
    "index"=> "089113",
    "group"=> "3ID11A",
    "name"=> "nazwa",
    "status"=> 1
  ]
]);

?>