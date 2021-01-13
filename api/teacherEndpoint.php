<?php
    include_once($_SERVER['DOCUMENT_ROOT'].'/PaiLab5/repository/teacherDb/teacherCommand.php');
    include_once($_SERVER['DOCUMENT_ROOT'].'/PaiLab5/repository/teacherDb/teacherQuery.php');
    
    if(!isset($_POST['mode'])) {
        return;
    }

    if($_POST['mode'] == 'create') {
        create();
    }

    if($_POST['mode'] == 'seed') {
        seed();
    }

    if($_POST['mode'] == 'checkPassword') {
        checkPassword();
    }

    function create() {
        $repository = new TeacherCommand();
        echo $repository->createTable();
    }

    function seed() {
        $repository = new TeacherCommand();
        echo $repository->teacherSeed();
    }

    function checkPassword() {
        $repository = new TeacherQuery();
        $name = $_POST['name'];
        $password = $_POST['password'];
        echo $repository->checkTeacherPassword($name, $password);
    }
?>