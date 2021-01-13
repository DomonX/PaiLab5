<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Log Panel</title>
    <link rel="stylesheet" href="./css/index.css"></link>
</head>
<body>
    <div class="panel-container" id="panel-container"></div>
    <div id="student-logged"></div>

    <script>
        window.onload = () => {
            document.getElementById("panel-container").innerHTML = `
            <h2>Student Log Panel</h2>
            <form id="teacher-form">
                <label for="albumNumber">Album number</label>
                <input type="text" id="albumNumber" placeholder="album number">

                <label for="name">Password</label>
                <input type="password" id="password" placeholder="Password">

                <button type="button" id="log-btn" class="btn submit-btn" name="checkPassword" onclick="checkStudent()">Log in</button>
            </form>
            `
        }

        const sendRequest = (data, location) => {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.open("POST", location, true);
            xmlhttp.onreadystatechange = () => {
                console.log(xmlhttp.response);
                if(xmlhttp.readyState == 4){
                    if(xmlhttp.response == 1){
                        window.location.href = "/PaiLab5/frontend/studentPanel.php";
                    } else {
                        alert("Błędne dane logowania!");
                    }
                }
            };
            xmlhttp.send(data);
        };

        const checkStudent = () => {
            var data = new FormData();
            var studentData = {
                albumNumber: document.getElementById('albumNumber').value,
                password: document.getElementById('password').value
            };
            var storeAlbumNumber = parseInt(studentData.albumNumber);
            localStorage.setItem('albumNumber', storeAlbumNumber);
            data.append('albumNumber', studentData.albumNumber);
            data.append('password', studentData.password);
            data.append('mode', 'checkStudentPassword');
            sendRequest(data, "/PaiLab5/api/resultEndpoint.php");
        };

    </script>
</body>
</html>