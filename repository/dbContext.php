<?php
    class DbContext {

        private function getConnectionDetails() {
            $file = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/PaiLab5/repository/dbSettings.json');
            $json = json_decode($file, true);

            $servername = $json["servername"];
            $username = $json["username"];
            $password = $json["password"];

            return new mysqli($servername, $username, $password);
        }

        public function connectToDb($dbName) {
            $file = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/PaiLab5/repository/dbSettings.json');
            $json = json_decode($file, true);

            $servername = $json["servername"];
            $username = $json["username"];
            $password = $json["password"];

            return new mysqli($servername, $username, $password, $dbName);
        }

        public function createDbContext() {
            $conn = $this->getConnectionDetails();

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "CREATE DATABASE IF NOT EXISTS School";

            if ($conn->query($sql)) {
                // echo "Database created successfully";
            } else {
                echo "Error creating database: " . $conn->error;
            }

            $conn->close();
        }

        public function dropDbContext() {
            $conn = $this->getConnectionDetails();

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "DROP DATABASE IF EXISTS School";

            if ($conn->query($sql)) {
            } else {
                echo "Error deleting database: " . $conn->error;
            }

            $conn->close();
        }
    }
    // $s = new DbContext();
    // $s -> createDbContext();
?>