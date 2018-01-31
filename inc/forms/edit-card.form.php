<form action="config/edit.config.php" class="form container py-2" method="POST">
    <div class="form-group">
        <label for="q">Question:</label>
        <input 
            value="<?php echo $card['question']; ?>" 
            class="form-control" 
            type="text" 
            id="q" 
            name="edit_question">
    </div>
    <div class="form-group">
        <label for="a">Answer:</label>
        <input 
            value="<?php echo $card['answer']; ?>" 
            class="form-control" 
            type="text" 
            id="a" 
            name="edit_answer">
    </div>
    <!-- Hidden input to get card id, set_name, and set_id -->
    <input type="hidden" name="card_id" value="<?php echo $card['card_id']; ?>"/>
    <input type="hidden" name="set_name" value="<?php echo $setName; ?>"/>
    <input type="hidden" name="set_id" value="<?php echo $set_id; ?>"/>
    <!-- /Hidden fields -->
    <input type="submit" name="submit_edit" value="Submit" class="btn btn-primary">
    <button class="btn btn-secondary form-cancel" type="button">Cancel</button>
</form>