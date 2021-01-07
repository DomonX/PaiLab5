<?php
    include "../sqlQuery.php";

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

            $sql = "INSERT INTO Teacher VALUES 
                (DEFAULT, 'Arkadiusz Chrobot', 'abcd'), (DEFAULT, 'Karol Wieczorek', 'abcd')";

            return $query->command($sql);
        }
    }
?>