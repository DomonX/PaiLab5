<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Panel</title>
    <link rel="stylesheet" href="./css/index.css"></link>
</head>
<body>
    <div class="grade-container">
        <p>Your grade: </p>
        <?php
            //TODO fetch grade info
            //! Add index number of logged student
            echo '<p class="grade">GRADE</p>';
        ?>
    </div>

    <form action="" class="form-container">
        <button type="submit" class="btn accept-btn">Accept grade</button>
        <div class="question-container">
            <textarea name="question" id="question" cols="40" rows="10" placeholder="Ask question about the grade..."></textarea>
            <button type="submit" class="btn question-submit-btn">Submit question</button>
        </div>
    </form>
</body>
</html>