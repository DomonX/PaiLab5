<?php
    include_once($_SERVER['DOCUMENT_ROOT'].'/PaiLab5/repository/dbContext.php');

    if(!isset($_POST['mode'])) {
        return;
    }

    if($_POST['mode'] == 'create') {
        createDb();
    }

    if($_POST['mode'] == 'drop') {
        dropDb();
    }

    function createDb() {
        $dbContext = new DbContext();
        echo $dbContext->createDbContext();
    }

    function dropDb() {
        $dbContext = new DbContext();
        echo $dbContext->dropDbContext();
    }
?>