<form 
    method="POST" 
    action="config/set.config.php?set_id=<?php echo $set_id; ?>" 
    class="form edit-set-form">
    <div class="form-group mt-3">
        <label for="user_set_name">Set Name</label>
        <input value="<?php echo $set_name; ?>" type="text" name="set_name" id="user_set_name" class="form-control">
    </div>
    <input type="submit" name="submit_set_name" value="Submit" class="btn btn-primary">
    <button type="button" class="btn btn-secondary form-cancel">Cancel</button>
</form>