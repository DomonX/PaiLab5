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

    if($_POST['mode'] == 'sendAnswer') {
        sendAnswer();
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
        $resultId = $_POST['resultId'];
        $newStatus = $_POST['newStatus'];
        echo $repository->changeStatus($resultId, $newStatus);
    }

    function sendComment() {
        $repository = new ResultCommand();
        $resultId = $_POST['resultId'];
        $comment = $_POST['comment'];
        echo $repository->sendComment($resultId, $comment);
    }

    function sendAnswer() {
        $repository = new ResultCommand();
        $resultId = $_POST['resultId'];
        $comment = $_POST['comment'];
        echo $repository->sendAnswer($resultId, $comment);
    }

    function checkStudentPassword() {
        $repository = new ResultQuery();
        $resultId = $_POST['albumNumber'];
        $newStatus = $_POST['password'];
        echo $repository->checkStudentPassword($resultId, $newStatus);
    }

    function getTestResults() {
        $repository = new ResultQuery();
        $testId = json_decode($_POST['testId']);
        echo json_encode($repository->getTestResults($testId));
    }
?>