<?php

  include '../models/test.php';
  include '../models/result.php';  

  class CsvLoader {
    public function getData() {
        $dir = scandir("../data");
        $csvs = array_filter($dir, function ($i) { return strpos($i, ".csv") != false; });
        $examNames = array_map(function($i) { return str_replace(".csv", "", $i); }, $csvs);
        $exams = array_map(function($i) { 
          $test = new Test();
          $test->name = $i;
          return $test;
        }, $examNames);
        $examsWithResults = array_map(function($i) {
          $i->results = $this->getResultsForExam($i);
          return $i;
        }, $exams);
        var_dump($examsWithResults);
    } 

    private function getResultsForExam($exam) {
      $results = [];
      if(($handle = fopen("../data/" . $exam->name . ".csv", "r")) !== FALSE) {
        while(($data = fgetcsv($handle, 100, ";"))) {
          array_push($results, $this->arrayToResult($data));
        }
      }
      return $results;
    }

    private function arrayToResult($array) {
      $result = new Result();
      $result->groupNumber = $array[0];
      $result->albumNumber = $array[1];
      $result->grade = $array[2];
      $result->comments = $array[3];
      $result->password = $array[4];
      return $result;
    }
  }

  $loader = new CsvLoader();
  $loader->getData();

?>


