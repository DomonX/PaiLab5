<?php
    include "../sqlQuery.php";
    include "../../models/result.php";
    include "../../models/test.php";

    class ResultQuery {

        public function checkStudentPassword($albumNumber, $password) {
            $query = new SqlQuery();

            $sql = "SELECT * FROM Result WHERE AlbumNumber = '".$albumNumber."'";

            $result = $query->query($sql);
            $row = $result->fetch_assoc();

            return $row["Password"] === $password;
        }

        public function checkComments($testId) {
            $query = new SqlQuery();

            $sql = "SELECT * FROM Result 
                    WHERE Result.Test = ".$testId."";

            $results = [];            
            $queryResult = $query->query($sql);

            $test = new Test();
            $test->id = $testId;
            
            while($row = $queryResult->fetch_assoc()) {
                $result = new Result();
                $result->id = $row["Id"];
                $result->groupNumber = $row["GroupNumber"];
                $result->albumNumber = $row["AlbumNumber"];
                $result->grade = $row["Grade"];
                $result->comments = $row["Comment"];
                $result->status = $row["Status"];
                array_push($results, $result);
            }

            $test->results = $results;

            return $test;
        }
    }
?>