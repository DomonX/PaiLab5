<?php
    include_once($_SERVER['DOCUMENT_ROOT'].'/PaiLab5/repository/testDb/testCommand.php');
    include_once($_SERVER['DOCUMENT_ROOT'].'/PaiLab5/repository/testDb/testQuery.php');
    include_once($_SERVER['DOCUMENT_ROOT'].'/PaiLab5/csv/csvLoader.php');

    if(!isset($_POST['mode'])) {
        return;
    }

    if($_POST['mode'] == 'create') {
        create();
    }

    if($_POST['mode'] == 'loadNewResults') {
        loadNewResults();
    }

    if($_POST['mode'] == 'getAllTests') {
        getAllTests();
    }

    function create() {
        $repository = new TestCommand();
        echo $repository->createTable();
    }

    function loadNewResults() {
        $repository = new TestCommand();
        $loader = new CsvLoader();
        echo $repository->updateAllTests($loader->getData());
    }

    function getAllTests() {
        $repository = new TestQuery();
        echo json_encode($repository->getAllTests());
    }
?>