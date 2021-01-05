<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Panel</title>
    <link rel="stylesheet" href="./css/index.css"></link>
</head>
<body>
    <div class="panel-container">
        <form action="">
            <label for="subject-select"></label>
            <select name="subject-select" id="subject-select" class="subject-select">
                <option value="test1">test1</option>
                <option value="test2">test2</option>
            </select>
            <button type="submit" class="btn submit-btn">Filter</button>
        </form>

        <?php
            echo '<p class="subject-element">Subject 1</p>';
            echo '<p class="subject-element">Subject 2</p>';
            echo '<p class="subject-element">Subject 3</p>';
        ?>

        <form action="/PaiLab5/pdfSaver/pdfSaver.php" method="GET">
            <button type="submit" name="generatePdf" class="btn generate-btn">Generate PDF</button>
        </form>

    </div>



</body>
</html>