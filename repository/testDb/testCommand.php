<?php
    include_once($_SERVER['DOCUMENT_ROOT'].'/PaiLab5/repository/resultDb/resultCommand.php');

    class TestCommand {

        public function createTable() {
            $query = new SqlQuery();

            $sql = "CREATE TABLE Test (
                Id INT PRIMARY KEY AUTO_INCREMENT,
                Name VARCHAR(20)
            )";

            return $query->command($sql);
        }

        private function removeAllTests() {
            $query = new SqlQuery();
            $sql = "DELETE FROM Test";

            return $query->command($sql);
        }

        private function removeAllResults() {
            $query = new SqlQuery();
            $sql = "DELETE FROM Result";

            return $query->command($sql);
        }

        private function addNewTests($newTests) {
            $queryResults = array_map(function($i) {
                $query = new SqlQuery();
                $sql = "INSERT INTO Test
                        VALUES (DEFAULT, '$i->name')";

                $query->command($sql);
                $id = $query->query("SELECT MAX(Id) FROM Test");
                $row = $id->fetch_assoc();
                $resultCommand = new ResultCommand();

                return $resultCommand->updateAllResults($i->results, $row["MAX(Id)"]);
            }, $newTests);

            return $queryResults;
        }

        public function updateAllTests($newTests) {
            $removeResults = $this->removeAllResults();
            $removeTests = $this->removeAllTests();

            if($removeResults === "Ok" && $removeTests === "Ok") {
                $addResults = $this->addNewTests($newTests);
                $invalidRows = array_filter($addResults, function ($i) { return $i !== "Ok"; });

                return count($invalidRows) > 0 ? "One or more results are invalid" : "Ok";
            }

            return $removeResults;
        }
    }

?>