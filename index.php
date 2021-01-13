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
        <button class="btn generate-btn create-btn" id="create-data-btn" onclick="createData()">Create Data</button>
        <button class="btn generate-btn load-btn" id="load-data-btn" onclick="loadData()" disabled>Load Data</button>
    </div>

    <div class="main-container">
        <div class="main-nav">
            <ul class="index-list">
                <li class="nav-element"><button class="btn panel-btn" id="teacher-button" onclick="toTeacherPanel()" disabled>Teacher Panel</button></li>
                <li class="nav-element"><button class="btn panel-btn" id="student-button" onclick="toStudentPanel()" disabled>Student Panel</button></li>
            </ul>
        </div>
    </div>

    <script>
        function toTeacherPanel() {
            window.open("/PaiLab5/frontend/teacherLogPanel.php", "_blank");
        }

        function toStudentPanel() {
            window.open("/PaiLab5/frontend/studentLogPanel.php", "_blank");
        }

        const sendRequest = (data, location) => {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.open("POST", location, true);
            xmlhttp.onreadystatechange = (responseText) => {
                console.log(responseText);
            };
            xmlhttp.send(data);
        };

        const dropData = () => {
            var data = new FormData();
            data.append('mode', 'drop');
            sendRequest(data, "/PaiLab5/api/dbContextEndpoint.php");
        }

        const createDatabase = () => {
            var data = new FormData();
            data.append('mode', 'create');
            sendRequest(data, "/PaiLab5/api/dbContextEndpoint.php");
        }

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
            dropData();
            createDatabase();
            createTeacher();
            createTest();
            createResult();
            document.getElementById("load-data-btn").disabled = false;
            document.getElementById("create-data-btn").disabled = true;
        };

        const loadData = () => {
            loadTest();
            loadTeacher();
            document.getElementById("teacher-button").disabled = false;
            document.getElementById("student-button").disabled = false;
            document.getElementById("load-data-btn").disabled = true;
        }
    </script>
</body>
</html>