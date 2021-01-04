<?php
    include "../sqlQuery.php";

    class TestCommand {

        public function createTable() {
            $query = new SqlQuery();

            $sql = "CREATE TABLE Test (
                Id INT PRIMARY KEY,
                Name VARCHAR(20)
            )";

            return $query->command($sql);
        }
    }
?>