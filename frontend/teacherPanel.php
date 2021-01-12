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
            <button type="submit" class="btn submit-btn">Filter</button>
        </form>
        <div id="results-container"></div>
        <button type="submit" name="generatePdf" class="btn generate-btn" onclick="generatePdf()">Generate PDF</button>
       
        
    </div>

    <script>
        const sendRequest = (data, location) => {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.open("POST", location, true);
            xmlhttp.onreadystatechange = function()  {
                console.log("DUPA");
            };
            xmlhttp.send(data);
        };

        const sendRequestPdf = (data, location) => {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.open("POST", location, true);
            xmlhttp.onreadystatechange = function()  {
                if (xmlhttp.readyState === 4) {
                    if (xmlhttp.status === 200) {
                        console.log('successful');
                        // window.location.href = "/PaiLab5/api/pdfEndpoint.php";
                    } else {
                        console.log('failed');
                    }
                }
            };
            xmlhttp.send(data);
        };

        function generatePdf () {
            var data = new FormData();
            data.append('testId', '1');
            sendRequestPdf(data, "/PaiLab5/api/pdfEndpoint.php");
        }

        function getExams () {
            var data = new FormData();
            data.append('mode', 'getAllTests');
            sendRequest(data, "/PaiLab5/api/testEndpoint.php");
        }

        function showExams(exams) {
            document.getElementById("subject-select").options.add(new Option("dupa", "dupa"));
        }

        function getResults() {
            var data = new FormData();
            data.append('mode', 'getTestResults');
            sendRequest(data, "/PaiLab5/api/resultEndpoint.php");
        }

        function showResults() {
            for(let i = 0; i < 6; i ++) {
                document.getElementById("results-container").innerHTML += 
                `
                <p class="subject-element">TEST${i}</p>
                `;
            }
            
        }

        window.onload = () => {
            getExams();
            showExams();
            showResults();
        }
    </script>

</body>
</html>