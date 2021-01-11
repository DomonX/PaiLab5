<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Panel</title>
    <link rel="stylesheet" href="/PaiLab5/frontend/css/index.css"></link>
</head>
<body>

    <div class="buttons-container">
        <button class="btn generate-btn" onclick="createData()">Create Data</button>
        <button class="btn generate-btn" onclick="loadData()">Load Data</button>
    </div>

    <div class="main-container">
        <div class="main-nav">
            <ul class="index-list">
                <li class="nav-element"><button class="btn panel-btn"><a href="/PaiLab5/frontend/teacherLogPanel.php">Teacher Panel</a></button></li>
                <li class="nav-element"><button class="btn panel-btn"><a href="/PaiLab5/frontend/studentLogPanel.php">Student Panel</a></button></li>
            </ul>
        </div>
    </div>

    <script>
        const sendRequest = (data, location) => {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.open("POST", location, true);
            xmlhttp.send(data);
        };

        const createTeacher = () => {
            var data = new FormData();
            data.append('mode', 'create');
            sendRequest(data, "/PaiLab5/api/teacherEndpoint.php");
        };

        const createTest = () => {
            var data = new FormData();
            data.append('mode', 'create');
            sendRequest(data, "/PaiLab5/api/testEndpoint.php");
        };

        const createResult = () => {
            var data = new FormData();
            data.append('mode', 'create');
            sendRequest(data, "/PaiLab5/api/resultEndpoint.php");
        };

        const loadTest = () => {
            var data = new FormData();
            data.append('mode', 'loadNewResults');
            sendRequest(data, "/PaiLab5/api/testEndpoint.php");
        };

        const loadTeacher = () => {
            var data = new FormData();
            data.append('mode', 'seed');
            sendRequest(data, "/PaiLab5/api/teacherEndpoint.php");
        };

        const createData = () => {
            createTeacher();
            createTest();
            createResult();
        };

        const loadData = () => {
            loadTest();
            loadTeacher();
        };
    </script>
</body>
</html>