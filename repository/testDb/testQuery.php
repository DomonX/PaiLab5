<?php
    include_once($_SERVER['DOCUMENT_ROOT'].'/PaiLab5/repository/sqlQuery.php');
    include_once($_SERVER['DOCUMENT_ROOT'].'/PaiLab5/models/test.php');

    class TestQuery {

        public function getAllTests() {
            $query = new SqlQuery();

            $sql = "SELECT * FROM Test";

            $result = $query->query($sql);
            $tests = [];

            while($row = $result->fetch_assoc()) {
                $test = new Test();
                $test->id = $row["Id"];
                $test->name = $row["Name"];

                array_push($tests, $test);
            }

            return $tests;
        }
    }
?>