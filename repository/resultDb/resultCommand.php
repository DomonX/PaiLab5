<?php
        include "../sqlQuery.php";

        class ResultCommand {
    
            public function createTable() {
                $query = new SqlQuery();
    
                $sql = "CREATE TABLE Result (
                    Id INT PRIMARY KEY,
                    GroupNumber VARCHAR(6),
                    AlbumNumber INT,
                    Grade INT,
                    Comment VARCHAR(250),
                    Password VARCHAR(10),
                    Status INT
                )";
    
                return $query->command($sql);
            }
        }
?>