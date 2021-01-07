<?php
    include "../sqlQuery.php";

    class TeacherQuery {

        public function checkTeacherPassword($teacherName, $password) {
            $query = new SqlQuery();

            $sql = "SELECT * FROM Teacher WHERE Name = '".$teacherName."' LIMIT 1";

            $result = $query->query($sql);
            $row = $result->fetch_assoc();

            return $row["Password"] === $password;
        }
    }
?>