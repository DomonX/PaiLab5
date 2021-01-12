<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Log Panel</title>
    <link rel="stylesheet" href="./css/index.css"></link>
</head>
<body>
    <div id="loginForm"></div>
    <div id="alert"></div>
    <div id="teacherData"></div>
    <script>

        function buildData(data) {
            let stringifiedHtml = ``;
            let dataObject = JSON.parse(data);
            stringifiedHtml.concat(`<table>`);
            stringifiedHtml.concat(`</table>`);
        }

        function processData(data) {
            if(data.status = "permission") {
                document.getElementById('loginForm').innerHTML = ``;
                document.getElementById('teacherData').innerHTML = buildData(data.data);
            }
            if(data.status = "nopermission") {
                document.getElementById('alert').innerHTML = `Nie masz uprawnien`;
            }
        }

        const sendRequest = (data, location) => {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.open("POST", location, true);
            xmlhttp.onreadystatechange( processData );
            xmlhttp.send(data);
        };

        const check = () => {
            var data = new FormData();
            const teacherData = {
                name: document.getElementById('name').value,
                password: document.getElementById('password').value
            };
            console.log(teacherData);
            data.append('name', JSON.stringify(teacherData.name));
            data.append('password', JSON.stringify(teacherData.password));
            data.append('mode', 'checkPassword');
            sendRequest(data, "/PaiLab5/api/teacherEndpoint.php");
        };

    </script>

    <script>
        window.onload = () => {
            document.getElementById('loginForm').innerHTML = `
            <div class="panel-container">
                <h2>Teacher Log Panel</h2>
                <form id="teacher-form">
                    <label for="name">Name</label>
                    <input type="text" id="name" placeholder="Name">
                    
                    <label for="name">Password</label>
                    <input type="password" id="password" placeholder="Password">
                    
                    <button type="submit" id="log-btn" class="btn submit-btn" name="checkPassword" onclick="check()">Log in</button>
                </form>
                <button class="btn submit-btn"><a href="/PaiLab5">HOME</a></button>
            </div>`
        }

    </script>
</body>
</html>