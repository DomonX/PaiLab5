<?php
    include "../sqlQuery.php";

    class ResultQuery {

        public function checkStudentPassword($albumNumber, $password) {
            $query = new SqlQuery();

            $sql = "SELECT * FROM Result WHERE AlbumNumber = '".$albumNumber."'";

            $result = $query->query($sql);
            $row = $result->fetch_assoc();

            return $row["Password"] === $password;
        }
    }
?>