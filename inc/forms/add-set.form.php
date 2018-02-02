<form 
    method="POST"
    action="config/create.config.php" 
    class="form add-set-form">
    <div class="form-group mt-3">
        <label for="user_set_name">Set Name</label>
        <input value="<?php  echo isset($set_id) ? $setName : '' ?>" type="text" name="set_name" id="user_set_name" class="form-control">
    </div>
    <input type="submit" name="submit" value="Submit" class="btn btn-primary">
    <button type="button" class="btn btn-secondary form-cancel">Cancel</button>
</form>