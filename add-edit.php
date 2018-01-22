<?php
    require('./config/config.php');
    require('./config/query.php');
    require('./config/functions.php');

    $pageTitle = 'Add Card';
    $msg = '';
    $question_value = '';
    $answer_value = '';

    // Check if page loaded is a card edit
    if (isset($_GET['card_id'])) {
        $card_id = htmlspecialchars($_GET['card_id']);
        $sql = "SELECT * FROM `$setName` WHERE card_id = ?";
        $card = prepareAndExecute($sql, array($card_id), 'fetch');
        $pageTitle = 'Edit Card';
        $question_value = $card['question'];
        $answer_value = $card['answer'];
    }

    // Delete card on submit
    if (isset($_POST['delete'])) {
        $sql = "DELETE FROM `$setName` WHERE card_id = ?";
        prepareAndExecute($sql, array($card_id));
        header('Location: ' . 'set.php?set_id=' . $set_id . '');
    } 
    // Add New Card
    if (isset($_POST['submit'])) {
        $question = htmlspecialchars($_POST['question']);
        $answer = htmlspecialchars($_POST['answer']);

        if (!empty($question) && !empty($answer)) {
            if (isset($_GET['card_id'])) {
                $sql = "UPDATE `$setName` SET question = ?, answer = ? WHERE card_id = ?";
                prepareAndExecute($sql, array($question, $answer, $card_id));
            } else {
                $sql = "INSERT INTO `$setName`(question, answer) VALUES(?, ?)";
                prepareAndExecute($sql, array($question, $answer));
            }
            header('Location: ' . 'set.php?set_id=' . $set_id . '');
        } else {
            $msg = 'Please fill in all fields';
        }
    }
?>

<?php include('./inc/header.php'); ?>

    <h1 class="text-center"><?php echo $pageTitle; ?></h1>
    <?php if ($msg != ''):  ?>
        <div class="alert alert-danger"><?php echo $msg; ?></div>
    <?php endif; ?>
    <form class="form add-edit" method="POST" action="<?php $_SERVER['PHP_SELF']; ?>" class="form">
        <div class="form-group">
            <label for="user_question">Question</label>
            <input value="<?php  echo $question_value; ?>" type="text" name="question" id="user_question" class="form-control">
        </div>
        <div class="form-group">
            <label for="user_answer">Answer</label>
            <input value="<?php echo $answer_value; ?>" type="text" name="answer" id="user_answer" class="form-control">
        </div>
        <div class="form-btns">
            <input type="submit" name="submit" value="<?php echo isset($card_id) ? 'Update' : 'Submit' ?>" class="btn btn-primary">
            <a class="btn btn-secondary form-btns__cancel" href="set.php?set_id=<?php echo $set_id; ?>">Cancel</a>
            <!-- Only show delete button when on edit.php -->
            <?php if(isset($card_id)): ?>
                <input type="submit" name="delete" value="Delete" class="btn btn-danger form-btns__delete">
            <?php endif; ?>
        </div>
    </form>

<?php include('./inc/footer.php'); ?>