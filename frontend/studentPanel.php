<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Panel</title>
    <link rel="stylesheet" href="./css/index.css"></link>
</head>
<body>

    <form action="" class="form-container">
        <div id="grade-container"></div>
        <button type="button" name="submit-grade" class="btn accept-btn" onclick="acceptGrade()">Accept grade</button>
        <textarea name="question" id="question" cols="40" rows="10" maxlength="250" placeholder="Ask question about the grade..."></textarea>
        <button type="button" name="submit-question" class="btn question-submit-btn" onclick="submitQuestion()">Submit question</button>
        <div id="teacher-response-container"></div>
        <button type="button" name="submit-grade" class="btn submit-btn" onclick="returnToLog()">Logout</button>
    </form>

    <script>
        const sendRequest = (data, location, callback) => {
            var xmlhttp = new XMLHttpRequest();
            var testResult = '';
            xmlhttp.open("POST", location, true);
            xmlhttp.onreadystatechange = function()  {
                if (xmlhttp.readyState == 4) {
                    if (xmlhttp.status == 200) {
                        callback(xmlhttp.response);
                    } else {
                        console.log('failed');
                    }
                }
            };
            xmlhttp.send(data);
        };

        function getIdOfStudent(results) {
            var albumNumber = localStorage.getItem('albumNumber');
            var filteredResults = results.results.filter(r => {
                return r.albumNumber === albumNumber
            });
            var studentId = parseInt(filteredResults[0].id);
            localStorage.setItem('id', studentId);
            return filteredResults[0];
        }

        function getResults() {
            var data = new FormData();
            data.append('testId', '1');
            data.append('mode', 'getTestResults');
            sendRequest(data, "/PaiLab5/api/resultEndpoint.php", (response) => {
                const results = JSON.parse(response);
                showResults(getIdOfStudent(results));
            });
        }
        
        function showResults(results) {
            if(results.status == '0') changeStatus('1');
            console.log(results.teacherComment);
            if(results.teacherComment.trim() !== '') {
                let htmlResponse = `
                    <p><b>Message from the Teacher: </b></p>
                    <p>${results.teacherComment.trim()}</p>
                `;
                console.log(htmlResponse);
                document.getElementById('teacher-response-container').innerHTML = htmlResponse;
            }
            let htmlResults =  `
                <p>Your Grade:</p>
                <p class="grade">${results.grade}</p>
                `;
            document.getElementById('grade-container').innerHTML = htmlResults;
        }

        function changeStatus(status) {
            var data = new FormData();
            const resultId = localStorage.getItem('id');
            data.append('resultId', resultId);
            data.append('newStatus', status);
            data.append('mode', 'changeStatus');
            sendRequest(data, "/PaiLab5/api/resultEndpoint.php", () =>{});
        } 

        function sendMessage(comment) {
            var data = new FormData();
            const resultId = localStorage.getItem('id');
            data.append('resultId', resultId);
            data.append('comment', comment);
            data.append('mode', 'sendComment');
            sendRequest(data, "/PaiLab5/api/resultEndpoint.php", () =>{});
        }

        function logout() {
            localStorage.removeItem('id');
            localStorage.removeItem('albumNumber');
            window.location.href = "/PaiLab5/frontend/studentLogPanel.php";
        }
        
        function acceptGrade() {
            changeStatus('2');
            logout();
        }

        function submitQuestion() {
            var comment = document.getElementById('question').value;
            if(comment.trim() == '') {
                logout();
                return;
            }
            sendMessage(comment);
            changeStatus('3');
            logout();
        }

        function returnToLog() {
            logout();
        }

        window.onload = () =>{
            getResults();
        }
    </script>
</body>
</html>