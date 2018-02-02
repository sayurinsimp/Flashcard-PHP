<form 
    class="form card add-card-form container py-2" 
    method="POST" 
    action="config/set.config.php?set_id=<?php echo $set_id; ?>">
    <div class="form-group">
        <label for="user_question">Question</label>
        <input type="text" name="question" id="user_question" class="form-control">
    </div>
    <div class="form-group">
        <label for="user_answer">Answer</label>
        <input type="text" name="answer" id="user_answer" class="form-control">
    </div>
    <input type="submit" name="submit_card" value="Submit" class="btn btn-primary">
    <button class="btn btn-secondary form-cancel" type="button">Cancel</button>
</form>