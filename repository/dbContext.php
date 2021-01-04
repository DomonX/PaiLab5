<?php
    class DbContext {

        private function getConnectionDetails() {
            $file = file_get_contents("../dbSettings.json");
            $json = json_decode($file, true);

            $servername = $json["servername"];
            $username = $json["username"];
            $password = $json["password"];
            
            return new mysqli($servername, $username, $password);
        }

        public function connectToDb($dbName) {
            $file = file_get_contents("../dbSettings.json");
            $json = json_decode($file, true);

            $servername = $json["servername"];
            $username = $json["username"];
            $password = $json["password"];
            
            return new mysqli($servername, $username, $password, $dbName);
        }

        public function createDbContext() {
            $conn = getConnectionDetails();

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            
            $sql = "CREATE DATABASE IF NOT EXISTS School";

            if ($conn->query($sql)) {
                echo "Database created successfully";
            } else {
                echo "Error creating database: " . $conn->error;
            }
            
            $conn->close();
        }
    }
?>