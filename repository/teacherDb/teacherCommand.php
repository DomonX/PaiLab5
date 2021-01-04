<?php
    include "../sqlQuery.php";

    class TeacherCommand {

        public function createTable() {
            $query = new SqlQuery();

            $sql = "CREATE TABLE Teacher (
                Id INT PRIMARY KEY,
                Name VARCHAR(20),
                Password VARCHAR(10)
            )";

            return $query->command($sql);
        }
    }
?>