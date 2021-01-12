<?php
    include_once($_SERVER['DOCUMENT_ROOT'].'/PaiLab5/repository/sqlQuery.php');
    include_once($_SERVER['DOCUMENT_ROOT'].'/PaiLab5/status.php');

    class ResultCommand {

        public function createTable() {
            $query = new SqlQuery();

            $sql = "CREATE TABLE Result (
                Id INT PRIMARY KEY AUTO_INCREMENT,
                GroupNumber VARCHAR(6),
                AlbumNumber INT,
                Grade INT,
                Comment VARCHAR(250),
                TeacherComment VARCHAR(250),
                Password VARCHAR(10),
                Status INT,
                Test INT
            )";

            return $query->command($sql);
        }

        private function removeAllResults() {
            $query = new SqlQuery();
            $sql = "DELETE FROM Result";

            return $query->command($sql);
        }

        private function addNewResults($newResults, $testId) {
            $queryResults = array();

            foreach($newResults as $result) {
                $query = new SqlQuery();
                $sql = "INSERT INTO Result
                        VALUES (DEFAULT, '$result->groupNumber', '$result->albumNumber', '$result->grade', '$result->comment',
                                '$result->teacherComment', '$result->password', '$result->status', '$testId')";

                array_push($queryResults, $query->command($sql));
            }

            return $queryResults;
        }

        public function updateAllResults($newResults, $testId) {
            $removeResults = $this->removeAllResults();

            if($removeResults === "Ok") {
                $addResults = $this->addNewResults($newResults, $testId);
                $invalidRows = array_filter($addResults, function ($i) { return $i !== "Ok"; });

                return count($invalidRows) > 0 ? "One or more results are invalid" : "Ok";
            }

            return $removeResults;
        }

        public function changeStatus($resultId, $newStatus) {
            $query = new SqlQuery();
            $sql = "UPDATE Result SET Status = '$newStatus' WHERE Id = '$resultId'";

            return $query->command($sql);
        }

        public function sendComment($resultId, $comment) {
            $query = new SqlQuery();
            $sql = "UPDATE Result SET Comment = '$comment' WHERE Id = '$resultId'";
            $commentResult = $query->command($sql);
            $status = new Status();

            return $commentResult === "Ok" ? $this->changeStatus($resultId, $status::WITHCOMMENT) : $commentResult;
        }
    }

?>