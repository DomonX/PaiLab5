<?php
    include($_SERVER['DOCUMENT_ROOT'].'/PaiLab5/repository/dbContext.php');

    class SqlQuery {

        public function query($sql) {
            $dbContext = new DbContext();
            $conn = $dbContext->connectToDb("School");

            $result = "";
            if ($conn->connect_error) {
                $result = "Connection failed: " . $conn->connect_error;
            } else {
                $result = $conn->query($sql) ? $conn->query($sql) : $conn->error;
            }

            $conn->close();

            return $result;
        }

        public function command($sql) {
            $dbContext = new DbContext();
            $conn = $dbContext->connectToDb("School");

            $result = "";
            if ($conn->connect_error) {
                $result = "Connection failed: " . $conn->connect_error;
            } else {
                $result = $conn->query($sql) ? "Ok" : $conn->error;
            }

            $conn->close();

            return $result;
        }
    }
?>