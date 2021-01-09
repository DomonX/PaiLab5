<?php 
    include_once($_SERVER['DOCUMENT_ROOT'].'/PaiLab5/repository/dbContext.php');

    if(!isset($_POST['mode'])) {
        return;
    }

    if($_POST['mode'] == 'create') {
        createDb();
    }

    function createDb() {
        $dbContext = new DbContext();
        echo $dbContext->createDbContext();
    }
?>