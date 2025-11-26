<title>Kết quả</title>
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<?php
    $filename = "Quiz.txt";
    $questions = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $answers = [];
    foreach ($questions as $line) {
        if (strpos($line, "ANSWER:") !== false) {
            $answers[] = trim(substr($line, strpos($line, ":") + 1));
        }
    }
    
    $score = 0;
    foreach ($_POST as $key => $userAnswer) {
        $questionNumber = (int)filter_var($key, FILTER_SANITIZE_NUMBER_INT);
        if (isset($answers[$questionNumber]) && $answers[$questionNumber] === $userAnswer) {
            $score++;
        }
    }
    
    echo "<div class='alert alert-success text-center'>";
    echo "Bạn trả lời đúng <strong>$score</strong>/" . count($answers) . " câu.";
    echo "</div>";
?>
<a href="index.php" class="btn btn-primary">Làm lại</a>