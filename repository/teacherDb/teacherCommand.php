<?php
    include_once($_SERVER['DOCUMENT_ROOT'].'/PaiLab5/repository/sqlQuery.php');

    class TeacherCommand {

        public function createTable() {
            $query = new SqlQuery();

            $sql = "CREATE TABLE Teacher (
                Id INT PRIMARY KEY AUTO_INCREMENT,
                Name VARCHAR(20),
                Password VARCHAR(10)
            )";

            return $query->command($sql);
        }

        public function teacherSeed() {
            $query = new SqlQuery();

            $sql = "INSERT INTO Teacher VALUES (DEFAULT, 'Jaroslaw Wikarek', 'abcd')";

            return $query->command($sql);
        }
    }
?>