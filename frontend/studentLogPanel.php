<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Log Panel</title>
    <link rel="stylesheet" href="./css/index.css"></link>
</head>
<body>
    <div class="panel-container">
        <h2>Student Log Panel</h2>
        <form id="teacher-form">
            <label for="albumNumber">Album number</label>
            <input type="text" id="albumNumber" placeholder="album number">

            <label for="name">Password</label>
            <input type="password" id="password" placeholder="Password">

            <button type="submit" id="log-btn" class="btn submit-btn" name="checkPassword" onclick="checkStudent()">Log in</button>
        </form>
        <button class="btn submit-btn"><a href="/PaiLab5">HOME</a></button>
    </div>

    <script>
        const sendRequest = (data, location) => {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.open("POST", location, true);
            xmlhttp.send(data);
        };

        const checkStudent = () => {
            var data = new FormData();
            const studentData = {
                albumNumber: document.getElementById('albumNumber').value,
                password: document.getElementById('password').value
            };
            console.log(studentData);
            data.append('albumNumber', JSON.stringify(studentData.name));
            data.append('password', JSON.stringify(studentData.password));
            data.append('mode', 'checkStudentPassword');
            sendRequest(data, "/PaiLab5/api/resultEndpoint.php");
        };

    </script>
</body>
</html>