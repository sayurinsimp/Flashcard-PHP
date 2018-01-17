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
            header('Location: ' . 'set.php?set_id=' . $set_id . '');
        } else {
            $msg = 'Please fill in all fields';
        }
    }
?>

<?php include('./inc/header.php'); ?>

    <h1>Add Card to <?php echo $setName; ?></h1>
    <?php include('./inc/form.php'); ?>

<?php include('./inc/footer.php'); ?>