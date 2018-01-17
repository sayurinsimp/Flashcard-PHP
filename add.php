<?php
    require('./config/config.php');
    require('./config/query.php');

    $msg = '';

    if (isset($_POST['submit'])) {
        $question = htmlspecialchars($_POST['question']);
        $answer = htmlspecialchars($_POST['answer']);

        if (!empty($question) && !empty($answer)) {
            $sql = "INSERT INTO `$setName`(question, answer) VALUES(?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$question, $answer]);
            header('Location: ' . 'set.php?set_id=' . $id . '');
        } else {
            $msg = 'Please fill in all fields';
        }

        
    }
?>

<?php include('./inc/header.php'); ?>
    <h1>Add Card to <?php echo $setName; ?></h1>
    <div class="container">
        <?php if ($msg != ''):  ?>
            <div class="alert alert-danger"><?php echo $msg; ?></div>
        <?php endif; ?>
        <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>" class="form">
            <div class="form-group">
                <label for="user_question">Question</label>
                <input type="text" name="question" id="user_question" class="form-control">
            </div>
            <div class="form-group">
                <label for="user_answer">Answer</label>
                <input type="text" name="answer" id="user_answer" class="form-control">
            </div>
            <input type="submit" name="submit" value="Submit" class="btn btn-primary">
        </form>
    </div>

<?php include('./inc/footer.php'); ?>