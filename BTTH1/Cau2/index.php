<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trắc nghiệm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php
        $filename = "Quiz.txt";
        $lines = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        $questionlist = [];
        $index = 0;
        $total = count($lines);

        while ($index + 5 < $total) {
            $question = [];
            $question[] = $lines[$index++];
            for ($i = 0; $i < 4; $i++) {
                if ($index >= $total) break;
                $question[] = $lines[$index++];
            }
            if ($index < $total && str_starts_with(trim($lines[$index]), 'ANSWER:')) {
                $question[] = $lines[$index++];
            }
            $questionlist[] = $question;
        }
    ?>

    <div class="container mt-5">
        <form action="submit.php" method="post">

            <?php foreach ($questionlist as $number =>$question) : ?>
                <div class='card mb-4'>
                    <div class='card-header'><strong><?php echo $question[0]?></strong></div>
                    <div class="card-body">
                        <?php for($i=1;$i<=4;$i++):
                            $answer = substr($question[$i], 0, 1);?>
                            <div class='form-check'>
                                <input class='form-check-input' type='radio' name='question<?php echo $number?>' value='<?php echo $answer?>' id='question<?php echo $number?><?php echo $answer?>'>
                                <label class='form-check-label' for='question<?php echo $number?><?php echo $answer?>'><?php echo $question[$i]?></label>
                            </div>
                        <?php endfor?>
                    </div>
                </div>
            <?php endforeach;?>
            <button type="submit" class="btn btn-primary">Nộp bài</button>
        </form>
    </div>
</body>
</html>