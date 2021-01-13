<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Panel</title>
    <link rel="stylesheet" href="./css/index.css"></link>
</head>
<body>
    <div class="panel-container" id>
        <form action="">
            <label for="subject-select"></label>
            <select name="subject-select" id="subject-select" class="subject-select">
            </select>
            <button type="button" class="btn submit-btn" onclick="filter()">Filter</button>
        </form>
        <div id="results-container"></div>
        <button type="submit" name="generatePdf" class="btn generate-btn" id="generatePdf" onclick="generatePdf()">Generate PDF</button>
       
        
    </div>

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

        function generatePdf () {
            var valueOfId = filter(); 
            window.location.href = `/PaiLab5/api/pdfEndpoint.php?mode=create&&testId=${valueOfId}`;
        }

        function getExams () {
            var data = new FormData();
            data.append('mode', 'getAllTests');
            sendRequest(data, "/PaiLab5/api/testEndpoint.php", (response) => {
                const exams = JSON.parse(response);
                showExams(exams);
            });
        }

        function showExams(exams) {
            console.log(exams);
            for(let i = 0; i < exams.length; i++) {
                document.getElementById("subject-select").options.add(new Option(`${exams[i].name}`, `${exams[i].id}`));
            }
        }

        function getResults(testId) {
            var data = new FormData();
            data.append('testId', testId);
            data.append('mode', 'getTestResults');
            sendRequest(data, "/PaiLab5/api/resultEndpoint.php", (response) => {
                const results = JSON.parse(response);
                showResults(results);
            });
        }

        function showResults(results) {
            console.log(results.results);
            let htmlResults = '';
            for(let i = 0; i < results.results.length; i++)
            {
                htmlResults +=  
                `<div class="subject-element">
                    <div class="student-result">
                        <span class="result-groupNumber"> <b>Group: </b> ${results.results[i].groupNumber}
                        <span class="result-albumNumber"> <b>Album Number: </b>  ${results.results[i].albumNumber}</span>
                        <span class="result-grade"> <b>Grade: </b>${results.results[i].grade}</span>
                        <span class="result-grade"> <b>Comment: </b>${results.results[i].comment}</span>
                    </div>
                </div>
                `;

                if(results.results[i].comment.trim() !== "" && results.results[i].teacherComment.trim() == "") {
                    htmlResults += `
                            <textarea name="question" id="txt-${results.results[i].id}" cols="40" rows="10" maxlength="250" placeholder="Respond to student message"></textarea>
                            <button class="btn respond-btn" id="btn-${results.results[i].id}" name="${results.results[i].id}" onclick="respondToStudent(this.name)">Respond</button>
                        </div>
                     </div>
                    `;
                } else {
                    htmlResults += `
                    </div>
                </div>
                `;
                }
            }
            document.getElementById('results-container').innerHTML = htmlResults;
        }

        function filter() {
            var idValue = document.getElementById("subject-select").value;
            getResults(idValue);
            return idValue;
        }

        function respondToStudent(testId) {
            var data = new FormData();
            const comment = document.getElementById(`txt-${testId}`);
            const button = document.getElementById(`btn-${testId}`);
            data.append('resultId', testId);
            data.append('comment', comment.value);
            data.append('mode', 'sendAnswer');
            sendRequest(data, "/PaiLab5/api/resultEndpoint.php", ()=>{});
            destroyElements(comment, button);
        }
        

        function destroyElements(firstElement, secondElement) {
            firstElement.remove();
            secondElement.remove();
        }

        window.onload = () => {
            filter();
            getExams();
        }
    </script>

</body>
</html>