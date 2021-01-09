<?php
    include_once($_SERVER['DOCUMENT_ROOT'].'/PaiLab5/repository/sqlQuery.php');
    include_once($_SERVER['DOCUMENT_ROOT'].'/PaiLab5/models/result.php');
    include_once($_SERVER['DOCUMENT_ROOT'].'/PaiLab5/models/test.php');

    class ResultQuery {

        public function checkStudentPassword($albumNumber, $password) {
            $query = new SqlQuery();

            $sql = "SELECT * FROM Result WHERE AlbumNumber = '".$albumNumber."'";

            $result = $query->query($sql);
            $row = $result->fetch_assoc();

            return $row["Password"] === $password;
        }

        public function getTestResults($testId) {
            $query = new SqlQuery();

            $sql = "SELECT Result.Id, Result.GroupNumber, Result.AlbumNumber, 
                    Result.Grade, Result.Comment, Result.TeacherComment, Result.Status, Test.Name 
                    FROM Result
                    JOIN Test ON Result.Test = Test.Id
                    WHERE Result.Test = ".$testId."";

            $results = [];            
            $queryResult = $query->query($sql);

            $test = new Test();
            $test->id = $testId;
            
            while($row = $queryResult->fetch_assoc()) {
                $result = new Result();
                $test->name = $row["Name"];
                $result->id = $row["Id"];
                $result->groupNumber = $row["GroupNumber"];
                $result->albumNumber = $row["AlbumNumber"];
                $result->grade = $row["Grade"];
                $result->comment = $row["Comment"];
                $result->teacherComment = $row["TeacherComment"];
                $result->status = $row["Status"];
                array_push($results, $result);
            }

            $test->results = $results;

            return $test;
        }
    }
?>