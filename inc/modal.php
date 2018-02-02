<!-- Button trigger modal -->
<div class="modal-trigger text-center">
  <button type="button" class="btn btn-danger mb-4" data-toggle="modal" data-target="#delete-modal">
              Delete Set
  </button>
</div>

<!-- Modal -->
<div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="Delete Flashcard Set" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Delete <b><?php echo $set_name; ?></b> set?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>You will not be able to recover this set once it's deleted.  Are you sure you want to delete this set?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <form action="config/delete.config.php?set_id=<?php echo $set_id; ?>" method="POST">
            <button type="submit" name="delete" class="btn btn-danger">Delete</button>
            <input type="hidden" name="set_name" value="<?php echo $setName; ?>">
        </form>
      </div>
    </div>
  </div>
</div>