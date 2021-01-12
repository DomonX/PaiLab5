<?php
    include_once($_SERVER['DOCUMENT_ROOT'].'/PaiLab5/repository/sqlQuery.php');

    class TeacherQuery {

        public function checkTeacherPassword($teacherName, $password) {
            $query = new SqlQuery();
            $sql = "SELECT * FROM Teacher WHERE `Name` = '".$teacherName."' AND `Password` = '" . $password . "'";
            $result = $query->query($sql);
            return $result->num_rows > 0;
        }
    }
?>