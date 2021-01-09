<?php
    include_once($_SERVER['DOCUMENT_ROOT'].'/PaiLab5/repository/resultDb/resultCommand.php');
    include_once($_SERVER['DOCUMENT_ROOT'].'/PaiLab5/repository/resultDb/resultQuery.php');

    if(!isset($_POST['mode'])) {
        return;
    }

    if($_POST['mode'] == 'create') {
        create();
    }

    if($_POST['mode'] == 'changeStatus') {
        changeStatus();
    }

    if($_POST['mode'] == 'sendComment') {
        sendComment();
    }

    if($_POST['mode'] == 'checkStudentPassword') {
        checkStudentPassword();
    }

    if($_POST['mode'] == 'getTestResults') {
        getTestResults();
    }

    function create() {
        $repository = new ResultCommand();
        echo $repository->createTable();
    }

    function changeStatus() {
        $repository = new ResultCommand();
        $resultId = json_decode($_POST['resultId']);
        $newStatus = json_decode($_POST['newStatus']);
        echo $repository->changeStatus($resultId, $newStatus);
    }

    function sendComment() {
        $repository = new ResultCommand();
        $resultId = json_decode($_POST['resultId']);
        $comment = json_decode($_POST['comment']);
        echo $repository->changeStatus($resultId, $comment);
    }

    function checkStudentPassword() {
        $repository = new ResultQuery();
        $resultId = json_decode($_POST['albumNumber']);
        $newStatus = json_decode($_POST['password']);
        echo $repository->checkStudentPassword($resultId, $newStatus);
    }

    function getTestResults() {
        $repository = new ResultQuery();
        $testId = json_decode($_POST['testId']);
        echo json_encode($repository->getTestResults($testId));
    }
?>