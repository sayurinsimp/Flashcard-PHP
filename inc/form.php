
<?php if ($msg != ''):  ?>
    <div class="alert alert-danger"><?php echo $msg; ?></div>
<?php endif; ?>
<form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>" class="form">
    <div class="form-group">
        <label for="user_question">Question</label>
        <input value="<?php  echo isset($card_id) ? $card['question'] : '' ?>" type="text" name="question" id="user_question" class="form-control">
    </div>
    <div class="form-group">
        <label for="user_answer">Answer</label>
        <input value="<?php  echo isset($card_id) ? $card['answer'] : '' ?>" type="text" name="answer" id="user_answer" class="form-control">
    </div>
    <input type="submit" name="submit" value="<?php echo isset($card_id) ? 'Update' : 'Submit' ?>" class="btn btn-primary">
    <a class="btn btn-secondary" href="set.php?set_id=<?php echo $set_id; ?>">Cancel</a>
    <!-- Only show delete button when on edit.php -->
    <?php if(isset($card_id)): ?>
        <input type="submit" name="delete" value="Delete" class="btn btn-danger">
    <?php endif; ?>
</form>